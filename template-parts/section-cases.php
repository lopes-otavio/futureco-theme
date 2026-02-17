<?php
/**
 * Cases Section
 * @package FutureCO
 */

$cases_group = get_field('cases_section');
$label_sessao = $cases_group['label_sessao'] ?? 'NOSSO PORTFÓLIO';
$titulo = $cases_group['titulo'] ?? 'Cases de <span class="text-gradient">Sucesso</span>';
$descricao = $cases_group['descricao'] ?? 'Não são apenas clientes. São histórias que valorizamos profundamente.';
$cases = $cases_group['cases'] ?? array();
?>

<section class="cases-section section-padding" id="cases">
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <p class="section-label" style="color:rgba(255,255,255,0.5);"><?php echo esc_html($label_sessao); ?></p>
      <h2 class="section-title" style="color:#fff;">
        <?php echo $titulo; ?>
      </h2>
      <p class="section-description" style="color:rgba(255,255,255,0.6);">
        <?php echo esc_html($descricao); ?>
      </p>
    </div>

    <!-- Cases Grid -->
    <div class="cases-grid">
      <?php if ($cases) : foreach ($cases as $index => $case) : 
          $delay = ($index % 3) * 100;
      ?>
      <div class="case-card glass-card scroll-animate <?php echo $delay ? 'delay-' . $delay : ''; ?>">
        <div class="case-image">
          <?php if ($case['imagem']) : ?>
          <img src="<?php echo esc_url($case['imagem']); ?>" alt="<?php echo esc_attr($case['nome_empresa']); ?>">
          <?php else : ?>
          <div class="image-placeholder"></div>
          <?php endif; ?>
          <div class="case-overlay">
            <a href="<?php echo esc_url($case['link']); ?>" class="view-case"></a>
          </div>
        </div>
        <div class="case-content">
          <h3><?php echo esc_html($case['nome_empresa']); ?></h3>
          <p><?php echo esc_html($case['descricao']); ?></p>
          <?php if ($case['link']) : ?>
          <a href="<?php echo esc_url($case['link']); ?>" class="case-link">
            Conheça o Case
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <line x1="7" y1="17" x2="17" y2="7"></line>
              <polyline points="7 7 17 7 17 17"></polyline>
            </svg>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>