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
<section class="services-hero-section section-padding" id="servicos" style="background-color: #ffffff;">
  <div class="container section-container">
    <div class="services-split-layout">
      
      <!-- Lado Esquerdo: Box de Seleção -->
      <div class="clickable-tags-col">
        <div class="clickable-tags-grid">
          <h3 class="grid-title"><?= $titulo; ?></h3>
          
          <div class="tags-container">
            <?php if ($cards) : foreach ($cards as $index => $card) : ?>
            <div class="tag-component <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
              <div class="tag-checkbox"></div>
              <div class="tag-icon">
                 <img src="<?php echo esc_url($card['icon']); ?>" alt="" class="svg-icon">
              </div>
              <span class="tag-text"><?php echo esc_html($card['card_title']); ?></span>
            </div>
            <?php endforeach; endif; ?>
          </div>

          <div class="tags-cta">
            <div class="dynamic-desc-wrapper">
               <?php if ($cards) : foreach ($cards as $index => $card) : ?>
                  <p class="service-desc <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"><?php echo esc_html($card['card_desc']); ?></p>
               <?php endforeach; endif; ?>
            </div>
            <a href="#" class="btn-start">
              <?= pll__('Começar'); ?>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Lado Direito: Media/Background do Serviço -->
      <div class="service-media-col">
        <div class="bg-images-container">
          <?php if ($cards) : foreach ($cards as $index => $card) : 
              $bg_val = $card['background'] ?? '';
              if (empty($bg_val)) {
                  $fallbacks = ['futureco-results.png', 'futureco-strategy.png', 'futureco-team.png', 'futureco-hero-bg.png'];
                  $bg_fallback = $fallbacks[$index % count($fallbacks)];
                  $bg_url = futureco_image($bg_fallback);
              } else {
                  $bg_url = esc_url($bg_val);
              }
          ?>
          <img src="<?php echo $bg_url; ?>" class="bg-img <?php echo $index === 0 ? 'active' : ''; ?>" alt="<?php echo esc_attr($card['card_title']); ?>" data-index="<?php echo $index; ?>">
          <?php endforeach; endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>
<?php endif; ?>