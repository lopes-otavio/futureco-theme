<?php
/**
 * Partners Section
 * @package FutureCO
 */
?>
<?php
$partners_group = get_field('empresas_section');
$titulo = $partners_group['titulo'] ?? '';
$empresas = $partners_group['empresas'] ?? array();

if (($partners_group['ativar'] ?? true) !== false) :
?>
<section class="partners-section" id="parceiros">
  <p class="partners-label"><?php echo esc_html($titulo); ?></p>
  <div class="partners-carousel">
    <div class="fade-left"></div>
    <div class="fade-right"></div>
    <div class="owl-carousel partners-owl-carousel">
      <?php
          if ($empresas) :
              foreach ($empresas as $empresa):
      ?>
      <div class="partner-item">
        <?php if (!empty($empresa['logo'])) : ?>
        <img src="<?php echo esc_url($empresa['logo']); ?>" alt="Parceiro">
        <?php endif; ?>
      </div>
      <?php
              endforeach;
          endif;
      ?>
    </div>
  </div>
</section>
<?php endif; ?>