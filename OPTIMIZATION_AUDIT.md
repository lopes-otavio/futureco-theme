# Auditoria técnica de performance e bugs — Tema Future CO

## Escopo revisado
- CSS: `assets/css/*.css` e `style.css`
- JavaScript: `assets/js/modules/*.js` e `assets/js/main.js`
- Templates/Componentes: `header.php`, `header-secondary.php`, `footer.php`, `template-parts/*.php`
- Páginas: `page-*.php`, `index.php`, `single.php`
- Bootstrap do tema: `functions.php`

---

## Prioridade crítica (corrigir primeiro)

### 1) Dark mode aplica transição global em praticamente toda a árvore DOM
- **Onde**: seletor global no final de `assets/css/17-dark-mode.css` (`body, section, div, h1... svg` com `transition`).
- **Problema**: ao trocar tema, quase todos os elementos entram em transição simultânea (background, color, border, box-shadow). Isso gera custo alto de style recalculation + repaint.
- **Sintoma esperado**: leve travada exatamente no toggle de dark/light mode.
- **Como otimizar**:
  - remover a transição global;
  - restringir transição apenas a elementos realmente necessários (ex.: `body`, `.site-header`, `.btn-*`, cards);
  - evitar transicionar `box-shadow` em massa;
  - adicionar fallback para `prefers-reduced-motion`.

### 2) Dark mode usa muitos `linear-gradient` + `box-shadow` + `backdrop-filter` em várias seções
- **Onde**: `assets/css/17-dark-mode.css` (muitos blocos com `background: var(--dark-gradient) !important`, `box-shadow`, `backdrop-filter`).
- **Problema**: combinação cara para pintura/GPU em vários elementos grandes, principalmente em mobile e dispositivos com GPU limitada.
- **Como otimizar**:
  - reduzir uso do gradiente para wrappers grandes (não em cada card/componente);
  - trocar parte dos gradientes por cor sólida ou gradiente simplificado de 2-3 stops;
  - remover `backdrop-filter` de elementos secundários (manter só em 1-2 áreas de destaque);
  - preferir pseudo-elemento (`::before`) único por seção ao invés de repetir gradiente em múltiplos filhos.

### 3) Uso excessivo de `!important` no dark mode
- **Onde**: `assets/css/17-dark-mode.css` em quase todos os overrides.
- **Problema**: aumenta custo de manutenção, dificulta cascade previsível e obriga regras mais pesadas a cada evolução visual.
- **Como otimizar**:
  - refatorar para estratégia por tokens (`--surface`, `--text`, `--border`, `--elevation`) e trocar valores no `body[data-theme="dark"]`;
  - reduzir override pontual com `!important` para casos realmente inevitáveis.

### 4) `main.css` com cadeia de `@import`
- **Onde**: `assets/css/main.css` importa 18 arquivos.
- **Problema**: `@import` dentro de CSS é pior para performance de carregamento (encadeia resolução/parse), especialmente sem pipeline de build/minificação.
- **Como otimizar**:
  - gerar bundle único em build (ex.: `dist/main.min.css`) e enfileirar só esse arquivo;
  - manter source modular apenas para desenvolvimento.

### 5) Script de tema só roda em `DOMContentLoaded` (FOUT de tema)
- **Onde**: `assets/js/modules/theme-switcher.js`.
- **Problema**: página pode renderizar clara e depois escurecer (flash), além de custo de repaint completo após carga inicial.
- **Como otimizar**:
  - aplicar tema com script **inline mínimo no `<head>`** antes do CSS renderizar;
  - manter módulo atual apenas para bind de eventos.

### 6) `single.php` está como template de política de privacidade
- **Onde**: `single.php`.
- **Problema**: posts individuais usam layout incorreto e metadados/template errado.
- **Como otimizar/corrigir**:
  - separar `single.php` real de post;
  - manter páginas institucionais em `page-*.php`;
  - remover `Template Name` de `single.php`.

### 7) `page-home.php` fecha `<main>` duas vezes
- **Onde**: `page-home.php`.
- **Problema**: HTML inválido, potencial impacto em acessibilidade, estilos e comportamento de scripts.
- **Como otimizar/corrigir**:
  - remover fechamento extra.

---

## Prioridade alta

### 8) `scroll-behavior: smooth` no CSS + smooth scroll via JS (duplicidade)
- **Onde**: `assets/css/00-base-global.css` e `assets/js/modules/general.js`.
- **Problema**: duas camadas para o mesmo efeito; JS adiciona listener em todos os anchors internos e pode gerar trabalho desnecessário.
- **Como otimizar**:
  - escolher **uma** estratégia: CSS nativo (preferível) ou JS apenas para casos com offset complexo;
  - se manter JS, usar delegação de eventos e validar links internos com pathname/hash.

### 9) Cálculo de offset do header provavelmente não funciona
- **Onde**: `assets/js/modules/general.js` usa `getElementById("site-header")`, mas headers usam classes/data-attributes.
- **Problema**: `headerHeight` tende a zero; rolagem pode “comer” conteúdo atrás do header fixo.
- **Como otimizar/corrigir**:
  - usar seletor real (`.site-header--primary` ou header visível);
  - calcular dinamicamente header ativo (primário/secundário).

### 10) Carousel de depoimentos usa `setInterval` sem pausa por visibilidade
- **Onde**: `assets/js/modules/carousel.js`.
- **Problema**: continua executando em background (aba oculta/seção fora de viewport), gerando trabalho desnecessário.
- **Como otimizar**:
  - pausar por `document.visibilityState`;
  - pausar quando carrossel não estiver em viewport (IntersectionObserver);
  - guardar referência do intervalo e limpar em teardown.

### 11) Accordion FAQ depende de `onclick` inline
- **Onde**: `template-parts/section-faq.php` + `assets/js/modules/faq.js`.
- **Problema**: mistura markup com comportamento; pior para manutenção, CSP e testabilidade.
- **Como otimizar**:
  - remover `onclick` inline;
  - bind via JS com `addEventListener` e delegação no container `.faq-list`.

### 12) Query de contatos e sociais sem cache
- **Onde**: `template-parts/section-contact.php` e `functions.php` (`futureco_display_social_links`).
- **Problema**: novas consultas em toda request, custo extra no banco.
- **Como otimizar**:
  - cachear resultado em transient/object cache;
  - limitar campos do WP_Query quando possível (`no_found_rows`, `fields`, etc.).

### 13) Uso de `posts_per_page => -1` em consultas auxiliares
- **Onde**: contatos e sociais.
- **Problema**: escala mal com crescimento de conteúdo.
- **Como otimizar**:
  - definir limite razoável e ordenação explícita por `menu_order`/`date`;
  - se precisa tudo, cache obrigatório.

### 14) `wp_localize_script` com `pll__` sem checagem de existência
- **Onde**: `functions.php` em `futureco_scripts()`.
- **Problema**: se Polylang estiver inativo, risco de fatal (`pll__` undefined).
- **Como otimizar/corrigir**:
  - envolver chamadas com `function_exists('pll__')` e fallback de texto.

---

## Prioridade média

### 15) Muitos estilos inline nos templates
- **Onde**: `header.php`, `header-secondary.php`, `index.php`, `template-parts/*`.
- **Problema**: dificulta cache de CSS, aumenta HTML e cria overrides difíceis (inclusive no dark mode).
- **Como otimizar**:
  - mover estilos inline para classes utilitárias em CSS;
  - padronizar cores/tipografia com tokens.

### 16) Conteúdo parcialmente sem escaping adequado
- **Onde**: vários títulos/descrições com `<?= $titulo; ?>` / `<?= $descricao; ?>`.
- **Problema**: superfície de XSS se conteúdo vier sem sanitização forte no CMS.
- **Como otimizar/corrigir**:
  - usar `esc_html` para texto puro;
  - usar `wp_kses_post` quando HTML é intencional.

### 17) Links de acessibilidade/SEO incompletos
- **Onde**: `footer.php` links de política e termos apontam para `#`; imagens com `alt` genérico (ex.: parceiro).
- **Problema**: pior UX, SEO e acessibilidade.
- **Como otimizar**:
  - apontar para páginas reais por slug traduzido;
  - melhorar `alt` contextual.

### 18) Background/efeitos em hero e seções podem custar caro em mobile
- **Onde**: `assets/css/02-hero-section.css`, `07-testimonials-section.css`, `10-faq-section.css` etc.
- **Problema**: múltiplos `filter: blur(48px)`, sticky hero + sombras/overlays elevam custo de pintura.
- **Como otimizar**:
  - reduzir blur em mobile;
  - desabilitar efeitos decorativos pesados abaixo de breakpoint;
  - usar imagens pré-renderizadas para “glow” em vez de blur dinâmico.

### 19) `transition: all` em muitos componentes
- **Onde**: vários CSS (`00-base-global`, `01-header-navbar`, `03/04/07/09/10/11/12/16/17`).
- **Problema**: transiciona propriedades desnecessárias e pode disparar layout/paint extra.
- **Como otimizar**:
  - trocar por propriedades específicas (`opacity`, `transform`, `color`).

### 20) Partners carousel animação infinita contínua
- **Onde**: `assets/css/06-partners-section.css`.
- **Problema**: animação contínua mesmo fora de viewport (dependendo do browser), consumo de CPU.
- **Como otimizar**:
  - pausar por `prefers-reduced-motion`;
  - pausar quando seção não estiver visível via classe controlada por JS/observer.

### 21) Formulário usa `alert()` para newsletter
- **Onde**: `assets/js/modules/forms.js`.
- **Problema**: UX ruim, bloqueante e sem consistência visual.
- **Como otimizar**:
  - usar feedback inline com regiões `aria-live` como no formulário de contato.

### 22) Falta tratamento robusto de erro no fetch de formulários
- **Onde**: `assets/js/modules/forms.js`.
- **Problema**: assume `response.json()` sempre válido; erro HTTP/HTML inesperado quebra fluxo.
- **Como otimizar**:
  - validar `response.ok` antes de parse;
  - fallback para mensagem amigável.

---

## Oportunidades de arquitetura (médio/longo prazo)

### 23) Consolidar tema claro/escuro com CSS variables por design tokens
- **Motivo**: reduz CSS duplicado e necessidade de overrides agressivos.
- **Estratégia**:
  - definir tokens semânticos (`--surface-1`, `--text-1`, `--border-1`, `--elevation-1`);
  - usar os tokens em todos os componentes;
  - trocar somente valores no `body[data-theme="dark"]`.

### 24) Pipeline de build (PostCSS + minificação + purge)
- **Motivo**: reduzir bytes transferidos e tempo de parse.
- **Estratégia**:
  - gerar `main.min.css` e `main.min.js`;
  - sourcemap só em dev;
  - adicionar versionamento por hash para cache busting.

### 25) Carregamento condicional de scripts
- **Motivo**: hoje quase todos os módulos carregam em todas as páginas.
- **Estratégia**:
  - enfileirar por template/condição (`is_front_page`, `is_page`, `is_home`, etc.);
  - dividir módulos por feature realmente usada na página.

---

## Quick wins recomendados (ordem prática)
1. Remover transição global do dark mode e restringir transições.
2. Reduzir gradientes/sombras/backdrop-filter no dark mode.
3. Corrigir `single.php` e `page-home.php` (bug estrutural).
4. Trocar `@import` por bundle único.
5. Aplicar tema no `<head>` para evitar flash e repaint grande.
6. Remover `onclick` inline do FAQ + delegação de eventos.
7. Adicionar cache nas queries auxiliares (socials/contact).

