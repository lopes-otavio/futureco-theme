<?php
/**
 * Services Section
 * @package FutureCO
 */
?>
<?php
$servicos_group = get_field('servicos_section');
$label_sessao = $servicos_group['label_sessao'] ?? 'O QUE COMPÕE O';
$titulo = $servicos_group['titulo'] ?? '<span class="text-gradient">Marketing 360°</span>';
$descricao = $servicos_group['descricao'] ?? 'Uma abordagem completa que integra todas as frentes do marketing digital para maximizar seus resultados.';
$cards = $servicos_group['cards'] ?? array();
?>
<section class="services-section section-padding" id="servicos">
  <div class="decorative-gradient"></div>
  <div class="container" style="position:relative;z-index:1;">
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

    <!-- Services Grid -->
    <div class="services-grid">
      <?php if ($cards) : foreach ($cards as $index => $card) : 
          $delay = ($index % 3) * 100;
      ?>
      <div class="service-card glass-card scroll-animate <?php echo $delay ? 'delay-' . $delay : ''; ?>">
        <div class="service-icon">
          <img src="<?php echo esc_url($card['icon']); ?>" alt="<?php echo esc_attr($card['card_title']); ?>" class="icon-white">
        </div>
        <h3><?php echo esc_html($card['card_title']); ?></h3>
        <p><?php echo esc_html($card['card_desc']); ?></p>
        <a href="#" class="service-link">
          Saiba mais
          <img src="<?php echo futureco_icon('arrow-top-right.svg'); ?>" alt="" class="icon-white">
        </a>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
