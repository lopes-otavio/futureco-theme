<?php
/**
 * Stats Section
 * @package FutureCO
 */
?>
<?php
$stats_group = get_field('numeros_section');
$numeros = $stats_group['numeros'] ?? array();
$background = $stats_group['background'] ?? '';

if (get_field('ativar') !== false) :
?>
<section class="stats-section" id="numeros"
  style="<?php if ($background) : ?>background-image:url('<?php echo esc_url($background); ?>');<?php endif; ?>background-size:cover;background-position:center;">
  <div class="stats-overlay"></div>
  <div class="container" style="position:relative;z-index:1;">
    <div class="stats-grid">
      <?php if ($numeros) : foreach ($numeros as $index => $item) : 
          $delay = $index * 100;
          $full_value = $item['numero_sufixo'] ?? '';
          // Extrair apenas o número para o atributo data-target (JS usa para animar)
          preg_match('/\d+/', $full_value, $matches);
          $target = $matches[0] ?? '';
      ?>
      <div class="stat-item scroll-animate <?php echo $delay ? 'delay-' . $delay : ''; ?>">
        <div class="stat-value" data-target="<?php echo esc_attr($target); ?>">0<?php echo str_replace($target, '', $full_value); ?></div>
        <p class="stat-label"><?php echo esc_html($item['label']); ?></p>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
