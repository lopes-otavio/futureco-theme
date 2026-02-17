<?php
/**
 * Process Section
 * @package FutureCO
 */
?>
<?php
$processo_group = get_field('processo_section');
$titulo = $processo_group['titulo'] ?? 'Nossa Metodologia';
$descricao = $processo_group['descricao'] ?? 'Um processo estruturado em três pilares que garante resultados consistentes e mensuráveis.';
$cards = $processo_group['cards'] ?? array();
?>
<section class="process-section section-padding" id="processo">
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <p class="section-label" style="color:rgba(57,73,106,0.5);">COMO TRABALHAMOS</p>
      <h2 class="section-title" style="color:#39496A;"><?php echo esc_html($titulo); ?></h2>
      <p class="section-description" style="color:rgba(57,73,106,0.6);">
        <?php echo esc_html($descricao); ?>
      </p>
    </div>

    <!-- Process Grid -->
    <div class="process-grid">
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
  </div>
</section>
