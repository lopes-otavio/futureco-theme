<?php
/**
 * Partners Section
 * @package FutureCO
 */
?>
<?php
$partners_group = get_field('empresas_section');
$titulo = $partners_group['titulo'] ?? 'Empresas que confiam em nós';
$empresas = $partners_group['empresas'] ?? array();

if (get_field('ativar') !== false) :
?>
<section class="partners-section" id="parceiros">
  <p class="partners-label"><?php echo esc_html($titulo); ?></p>
  <div class="partners-carousel">
    <div class="fade-left"></div>
    <div class="fade-right"></div>
    <div class="partners-track" id="partners-track">
      <?php
          if ($empresas) :
              // Duplicar para efeito infinito
              for ($i = 0; $i < 2; $i++):
                  foreach ($empresas as $empresa):
          ?>
      <div class="partner-item">
        <?php if (!empty($empresa['logo'])) : ?>
        <img src="<?php echo esc_url($empresa['logo']); ?>" alt="Parceiro"
          style="max-height: 40px; width: auto; filter: grayscale(1) brightness(200%);">
        <?php else : ?>
        <div class="partner-placeholder">
          <span>Logo</span>
        </div>
        <?php endif; ?>
      </div>
      <?php
                  endforeach;
              endfor;
          endif;
          ?>
    </div>
  </div>
</section>
<?php endif; ?>