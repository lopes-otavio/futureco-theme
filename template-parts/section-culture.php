<?php
/**
 * Culture Section
 * @package FutureCO
 */
?>
<?php
$cultura_group = get_field('cultura_section');
$label_sessao = $cultura_group['label_sessao'] ?? '';
$titulo = $cultura_group['titulo'] ?? '';
$descricao = $cultura_group['descricao'] ?? '';
$cards = $cultura_group['cards'] ?? array();

if (($cultura_group['ativar'] ?? true) !== false) :
?>
<section class="culture-section section-padding" id="sobre">
  <!-- NOVA ESTRUTURA MONDAY STYLE -->
  <div class="container monday-culture-container">
    <div class="monday-culture-header scroll-animate">
      <p class="section-label"><?php echo esc_html($label_sessao); ?></p>
      <h2 class="section-title"><?php echo $titulo; ?></h2>
      <p class="section-description">
        <?php echo esc_html($descricao); ?>
      </p>
    </div>
    <div class="monday-cards-grid scroll-animate delay-200">
      <?php if ($cards) : foreach ($cards as $index => $card) :
            $foto = $card['foto_funcionario'] ?? '';
            $nome = $card['nome_funcionario'] ?? '';
            $cargo = $card['cargo_funcionario'] ?? '';
            $depoimento = $card['depoimento'] ?? '';
          ?>
      <div class="monday-card">
        <div class="monday-card-inner">
          <!-- Front -->
          <div class="monday-card-front">
            <div class="monday-zone-icon">
              <div class="monday-icon">
                <img src="<?php echo esc_url($card['icone']); ?>" alt="<?php echo esc_attr($card['titulo']); ?>"
                  class="icon-white-on-dark">
              </div>
            </div>
            <div class="monday-zone-text">
              <h3><?php echo esc_html($card['titulo']); ?></h3>
              <p><?php echo esc_html($card['descricao']); ?></p>
            </div>
          </div>
          <!-- Back -->
          <div class="monday-card-back"">
                      <div class=" monday-zone-logo">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/logo-triangulo.png'); ?>"
              alt="Future CO" class="monday-triangle-logo">
          </div>
          <div class="monday-zone-employee">
            <?php if ($foto) : ?>
            <div class="monday-employee-photo">
              <img src="<?php echo esc_url(is_array($foto) ? $foto['url'] : $foto); ?>"
                alt="<?php echo esc_attr($nome); ?>">
            </div>
            <?php endif; ?>
            <span class="monday-employee-name"><?php echo esc_html($nome); ?></span>
            <span class="monday-employee-role"><?php echo esc_html($cargo); ?></span>
            <p class="monday-employee-quote">"<?php echo esc_html($depoimento); ?>"</p>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; endif; ?>
  </div>
  </div>

  <?php /* ESTRUTURA ANTIGA COMENTADA:
  <!-- <div class="decorative-bg"></div> -->
  <div class="container section-container">
    <!-- Banner Image -->
    <div class="culture-banner scroll-animate">
      <img src="<?php echo futureco_image('futureco-team.png'); ?>" alt="Equipe Future CO">
  </div>

  <!-- Grid -->
  <div class="culture-grid">
    <!-- Left Content -->
    <div class="culture-content scroll-animate">
      <p class="section-label"><?php echo esc_html($label_sessao); ?></p>
      <h2 class="section-title"><?php echo $titulo; ?></h2>
      <p class="section-description">
        <?php echo esc_html($descricao); ?>
      </p>
      <a href="#contato" class="btn-primary">
        <?= pll__('Junte-se a nós'); ?>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12" />
          <polyline points="12 5 19 12 12 19" />
        </svg>
      </a>
    </div>

    <!-- Values Grid -->
    <div class="values-grid scroll-animate delay-200">
      <?php 
          // Cores inspiradas no Monday.com
          $monday_colors = ['#00CA72', '#6161FF', '#FF7575', '#FDAB3D', '#98013D'];
          if ($cards) : foreach ($cards as $index => $card) : 
          $bg_color = $monday_colors[$index % count($monday_colors)];
        ?>
      <div class="value-card">
        <div class="value-card-inner">
          <!-- Front Side -->
          <div class="value-card-front">
            <div class="value-icon">
              <img src="<?php echo esc_url($card['icone']); ?>" alt="<?php echo esc_attr($card['titulo']); ?>"
                class="icon-white-on-dark" style="max-width:24px;">
            </div>
            <h3><?php echo esc_html($card['titulo']); ?></h3>
          </div>
          <!-- Back Side -->
          <div class="value-card-back" style="background-color: <?php echo esc_attr($bg_color); ?>;">
            <h3><?php echo esc_html($card['titulo']); ?></h3>
            <p><?php echo esc_html($card['descricao']); ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
  </div>
  FIM ESTRUTURA ANTIGA COMENTADA */ ?>
</section>
<?php endif; ?>