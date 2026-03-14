<?php
/**
 * Services Section
 * @package FutureCO
 */
?>
<?php
$servicos_group = get_field('servicos_section');
$label_sessao = $servicos_group['label_sessao'] ?? '';
$titulo = $servicos_group['titulo'] ?? '';
$descricao = $servicos_group['descricao'] ?? '';
$cards = $servicos_group['cards'] ?? array();

if (($servicos_group['ativar'] ?? true) !== false) :
?>
<section class="services-section section-padding" id="servicos">
  <div class="decorative-gradient"></div>
  <div class="container section-container">
    <!-- Section Header -->
    <div class="section-header">
      <p class="section-label"><?= $label_sessao; ?></p>
      <h2 class="section-title">
        <?= $titulo; ?>
      </h2>
      <p class="section-description dark">
        <?= $descricao; ?>
      </p>
    </div>

    <!-- Services Grid -->
    <div class="services-grid">
      <?php if ($cards) : foreach ($cards as $index => $card) : 
          $delay = ($index % 3) * 100;
      ?>
      <div class="service-card glass-card scroll-animate <?php echo $delay ? 'delay-' . $delay : ''; ?>">
        <div class="service-icon">
          <img src="<?php echo esc_url($card['icon']); ?>" alt="<?php echo esc_attr($card['card_title']); ?>"
            class="icon-white-on-dark">
        </div>
        <h3><?php echo esc_html($card['card_title']); ?></h3>
        <p><?php echo esc_html($card['card_desc']); ?></p>
        <a href="#" class="service-link">
          <?= pll__('Saiba mais'); ?>
          <img src="<?php echo futureco_icon('arrow-top-right.svg'); ?>" alt="" class="icon-white-on-dark">
        </a>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>