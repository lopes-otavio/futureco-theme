<?php
/**
 * Team Section (Graffico.it Style - Hub and Spoke)
 * @package FutureCO
 */

$equipe_group = get_field('equipe_section');
$label_sessao = $equipe_group['label_sessao'] ?? '';
$titulo = $equipe_group['titulo'] ?? '';
$equipe = $equipe_group['equipe'] ?? array();

if (($equipe_group['ativar'] ?? true) !== false) :
?>
<section class="team-section graffico-team-section section-padding" id="equipe">
  <div class="decorative-blob"></div>
  <div class="container section-container">

    <div class="graffico-team-layout">
      <!-- Módulo Esquerdo (Texto) -->
      <div class="graffico-team-text scroll-animate">
        <p class="section-label"><?php echo esc_html($label_sessao); ?></p>
        <h2 class="section-title">
          <?php echo $titulo; ?>
        </h2>
        <div class="graffico-team-desc">
          <p>Conheça as mentes brilhantes por trás da nossa engenharia e inovação. Nossa matriz conecta talentos de
            diversas áreas para criar soluções únicas.</p>
        </div>
        <a href="#contato" class="btn-primary dark mt-8" style="margin-top: 2rem;">
          Junte-se a nós
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12" />
            <polyline points="12 5 19 12 12 19" />
          </svg>
        </a>
      </div>

      <!-- Módulo Direito (Constelação / Hub and Spoke) -->
      <div class="graffico-team-constellation scroll-animate delay-200">
        <?php
        // Coordenadas visuais (X, Y) mapeadas em formato de arco/nuvem
        $coords = [
            ['x' => 35, 'y' => 25],
            ['x' => 65, 'y' => 25],
            ['x' => 65, 'y' => 15],
            ['x' => 85, 'y' => 45],
            ['x' => 25, 'y' => 70],
            ['x' => 75, 'y' => 75],
            ['x' => 50, 'y' => 40],
            ['x' => 50, 'y' => 70],
        ];
        $hub_x = 50;
        $hub_y = 95;
        ?>

        <!-- SVG Nativo para as Linhas de Conexão -->
        <!-- O preserveAspectRatio garante que as % funcionem como coordenadas precisas no ambiente responsivo -->
        <svg class="graffico-team-svg" preserveAspectRatio="none">
          <?php if ($equipe) : foreach ($equipe as $index => $member) : 
              $pos = $coords[$index % count($coords)];
          ?>
          <line x1="<?php echo $hub_x; ?>%" y1="<?php echo $hub_y; ?>%" x2="<?php echo $pos['x']; ?>%"
            y2="<?php echo $pos['y']; ?>%" class="graffico-line" data-target="member-<?php echo $index; ?>" />
          <?php endforeach; endif; ?>
        </svg>

        <!-- Hub Controller -->
        <div class="graffico-hub" style="left: <?php echo $hub_x; ?>%; top: <?php echo $hub_y; ?>%;">
          <div class="hub-pill">Future Co</div>
        </div>

        <!-- Membros da Equipe flutuantes -->
        <?php if ($equipe) : foreach ($equipe as $index => $member) : 
            $pos = $coords[$index % count($coords)];
            // Gerar iniciais se não houver foto
            $initials = '';
            if (empty($member['foto']) && !empty($member['nome'])) {
                $names = explode(' ', $member['nome']);
                $initials = (isset($names[0]) ? substr($names[0], 0, 1) : '') . (isset($names[1]) ? substr($names[1], 0, 1) : '');
            }
        ?>
        <div class="graffico-member" style="left: <?php echo $pos['x']; ?>%; top: <?php echo $pos['y']; ?>%;"
          id="member-<?php echo $index; ?>">

          <div class="graffico-member-avatar">
            <?php if (!empty($member['foto'])): ?>
            <img src="<?php echo esc_url($member['foto']); ?>" alt="<?php echo esc_attr($member['nome']); ?>">
            <?php else: ?>
            <span><?php echo esc_html(strtoupper($initials)); ?></span>
            <?php endif; ?>
          </div>

          <div class="graffico-member-info">
            <h4><?php echo esc_html($member['nome']); ?></h4>
            <p><?php echo esc_html($member['cargo']); ?></p>
          </div>

        </div>
        <?php endforeach; endif; ?>
      </div>
    </div>

  </div>
</section>
<?php endif; ?>