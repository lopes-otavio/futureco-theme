<?php
/**
 * Process Section
 * @package FutureCO
 */
?>
<?php
$processo_group = get_field('processo_section');
$label_sessao = $processo_group['label_sessao'] ?? 'COMO TRABALHAMOS';
$titulo = $processo_group['titulo'] ?? 'Nossa Metodologia';
$descricao = $processo_group['descricao'] ?? 'Um processo estruturado em três pilares que garante resultados consistentes e mensuráveis.';
$cards = $processo_group['cards'] ?? array();

if (get_field('ativar') !== false) :
?>
<section class="process-section section-padding" id="processo">
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <p class="section-label" style="color:rgba(57,73,106,0.5);"><?php echo esc_html($label_sessao); ?></p>
      <h2 class="section-title" style="color:#39496A;"><?php echo $titulo; ?></h2>
      <p class="section-description" style="color:rgba(57,73,106,0.6);">
        <?php echo $descricao; ?>
      </p>
    </div>

    <!-- Process Slider -->
    <div class="process-slider-container">
      <div class="process-grid" id="process-slider">
      <?php if ($cards) : foreach ($cards as $index => $card) : 
          $delay = $index * 200;
          $number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
      ?>
      <div class="process-card scroll-animate <?php echo $delay ? 'delay-' . $delay : ''; ?>">
        <div class="process-number"><span><?php echo $number; ?></span></div>
        <div class="process-icon">
          <img src="<?php echo esc_url($card['icone']); ?>" alt="<?php echo esc_attr($card['titulo']); ?>" class="icon-white">
        </div>
        <h3><?php echo esc_html($card['titulo']); ?></h3>
        <p><?php echo esc_html($card['descricao']); ?></p>
        <?php if (!empty($card['itens_card'])) : ?>
        <ul class="process-details">
          <?php foreach ($card['itens_card'] as $item) : ?>
          <li><span class="dot"></span><?php echo esc_html($item['texto']); ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endforeach; endif; ?>
      </div>

      <!-- Process Navigation -->
      <div class="process-nav">
        <button class="process-nav-btn" id="process-prev" aria-label="Anterior">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6" />
          </svg>
        </button>
        <button class="process-nav-btn" id="process-next" aria-label="Próximo">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
