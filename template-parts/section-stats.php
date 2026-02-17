<?php
/**
 * Stats Section
 * @package FutureCO
 */
?>
<?php
$stats_group = get_field('numeros_section');
$numeros = $stats_group['numeros'] ?? array();
?>
<section class="stats-section" id="numeros"
  style="background-image:url('<?php echo futureco_image('futureco-results.png'); ?>');background-size:cover;background-position:center;">
  <div class="stats-overlay"></div>
  <div class="container" style="position:relative;z-index:1;">
    <div class="stats-grid">
      <?php if ($numeros) : foreach ($numeros as $index => $item) : 
          $delay = $index * 100;
          $full_value = $item['numero_sufixo'] ?? '0+';
          // Extrair apenas o número para o atributo data-target (JS usa para animar)
          preg_match('/\d+/', $full_value, $matches);
          $target = $matches[0] ?? '0';
      ?>
      <div class="stat-item scroll-animate <?php echo $delay ? 'delay-' . $delay : ''; ?>">
        <div class="stat-value" data-target="<?php echo esc_attr($target); ?>">0<?php echo str_replace($target, '', $full_value); ?></div>
        <p class="stat-label"><?php echo esc_html($item['label']); ?></p>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
