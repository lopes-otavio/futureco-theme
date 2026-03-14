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
$background_dark = $stats_group['background_dark'] ?? '';

if (($stats_group['ativar'] ?? true) !== false) :
?>
<section class="stats-section" id="numeros"
  style="--bg-light: url('<?php echo esc_url($background); ?>'); --bg-dark: url('<?php echo esc_url($background_dark ?: $background); ?>'); background-image: var(--bg-light); background-size: cover; background-position: center;">
  <div class="stats-overlay"></div>
  <div class="container section-container">
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
