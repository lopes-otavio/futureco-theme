# Auditoria técnica de performance e bugs — Tema Future CO

## Escopo revisado

- CSS: `assets/css/*.css` e `style.css`
- JavaScript: `assets/js/modules/*.js` e `assets/js/main.js`
- Templates/Componentes: `header.php`, `header-secondary.php`, `footer.php`,
  `template-parts/*.php`
- Páginas: `page-*.php`, `index.php`, `single.php`
- Bootstrap do tema: `functions.php`

---

## Prioridade crítica (corrigir primeiro)

### 2) Dark mode usa muitos `linear-gradient` + `box-shadow` + `backdrop-filter` em várias seções

- **Onde**: `assets/css/17-dark-mode.css` (muitos blocos com
  `background: var(--dark-gradient) !important`, `box-shadow`,
  `backdrop-filter`).
- **Problema**: combinação cara para pintura/GPU em vários elementos grandes,
  principalmente em mobile e dispositivos com GPU limitada.
- **Como otimizar**:
  - reduzir uso do gradiente para wrappers grandes (não em cada
    card/componente);
  - trocar parte dos gradientes por cor sólida ou gradiente simplificado de 2-3
    stops;
  - remover `backdrop-filter` de elementos secundários (manter só em 1-2 áreas
    de destaque);
  - preferir pseudo-elemento (`::before`) único por seção ao invés de repetir
    gradiente em múltiplos filhos.

### 18) Background/efeitos em hero e seções podem custar caro em mobile

- **Onde**: `assets/css/02-hero-section.css`, `07-testimonials-section.css`,
  `10-faq-section.css` etc.
- **Problema**: múltiplos `filter: blur(48px)`, sticky hero + sombras/overlays
  elevam custo de pintura.
- **Como otimizar**:
  - reduzir blur em mobile;
  - desabilitar efeitos decorativos pesados abaixo de breakpoint;
  - usar imagens pré-renderizadas para “glow” em vez de blur dinâmico.

## Oportunidades de arquitetura (médio/longo prazo)

### 23) Consolidar tema claro/escuro com CSS variables por design tokens

- **Motivo**: reduz CSS duplicado e necessidade de overrides agressivos.
- **Estratégia**:
  - definir tokens semânticos (`--surface-1`, `--text-1`, `--border-1`,
    `--elevation-1`);
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
  - enfileirar por template/condição (`is_front_page`, `is_page`, `is_home`,
    etc.);
  - dividir módulos por feature realmente usada na página.

---

## Quick wins recomendados (ordem prática)

1. Remover transição global do dark mode e restringir transições.
2. Reduzir gradientes/sombras/backdrop-filter no dark mode.
3. Aplicar tema no `<head>` para evitar flash e repaint grande.
4. Adicionar cache nas queries auxiliares (socials/contact).
