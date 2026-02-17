<?php
/**
 * Culture Section
 * @package FutureCO
 */
?>
<?php
$cultura_group = get_field('cultura_section');
$label_sessao = $cultura_group['label_sessao'] ?? 'QUEM SOMOS';
$titulo = $cultura_group['titulo'] ?? 'Nossa Cultura';
$descricao = $cultura_group['descricao'] ?? 'Acreditamos que o sucesso nasce da combinação entre inovação, transparência e paixão pelo que fazemos. Nossa cultura é o alicerce de cada projeto que entregamos.';
$cards = $cultura_group['cards'] ?? array();
?>
<section class="culture-section section-padding" id="sobre">
  <div class="decorative-bg"></div>
  <div class="container" style="position:relative;z-index:1;">
    <!-- Banner Image -->
    <div class="culture-banner scroll-animate">
      <img src="<?php echo futureco_image('futureco-team.png'); ?>" alt="Equipe Future CO">
    </div>

    <!-- Grid -->
    <div class="culture-grid">
      <!-- Left Content -->
      <div class="culture-content scroll-animate">
        <p class="section-label"><?php echo esc_html($label_sessao); ?></p>
        <h2 class="section-title"><?php echo $titulo; ?></h2>
        <p class="section-description">
          <?php echo esc_html($descricao); ?>
        </p>
        <a href="#contato" class="culture-cta">
          Junte-se a nós
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12" />
            <polyline points="12 5 19 12 12 19" />
          </svg>
        </a>
      </div>

      <!-- Values Grid -->
      <div class="values-grid scroll-animate delay-200">
        <?php if ($cards) : foreach ($cards as $card) : ?>
        <div class="value-card">
          <div class="value-icon">
            <img src="<?php echo esc_url($card['icone']); ?>" alt="<?php echo esc_attr($card['titulo']); ?>"
              class="icon-white" style="max-width:24px;">
          </div>
          <h3><?php echo esc_html($card['titulo']); ?></h3>
          <p><?php echo esc_html($card['descricao']); ?></p>
        </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
</section>