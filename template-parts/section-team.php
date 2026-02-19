<?php
/**
 * Team Section
 * @package FutureCO
 */
?>
<?php
$equipe_group = get_field('equipe_section');
$label_sessao = $equipe_group['label_sessao'] ?? 'CONHEÇA NOSSO TIME';
$titulo = $equipe_group['titulo'] ?? 'Nossa <span class="text-gradient">Equipe</span>';
$equipe = $equipe_group['equipe'] ?? array();

if (get_field('ativar') !== false) :
?>
<section class="team-section section-padding" id="equipe">
  <div class="decorative-bg"></div>
  <div class="decorative-blob"></div>
  <div class="container" style="position:relative;z-index:1;">
    <!-- Header -->
    <div class="team-header">
      <div>
        <p class="section-label" style="color:rgba(255,255,255,0.5);"><?php echo esc_html($label_sessao); ?></p>
        <h2 class="section-title" style="color:#fff;">
          <?php echo $titulo; ?>
        </h2>
      </div>
      <div class="team-nav-arrows">
        <button class="team-nav-btn" id="team-prev" aria-label="Anterior">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6" />
          </svg>
        </button>
        <button class="team-nav-btn" id="team-next" aria-label="Próximo">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Team Slider -->
    <div class="team-slider" id="team-slider">
      <?php if ($equipe) : foreach ($equipe as $member) : 
          // Gerar iniciais se não houver foto
          $initials = '';
          if (empty($member['foto']) && !empty($member['nome'])) {
              $names = explode(' ', $member['nome']);
              $initials = (isset($names[0]) ? substr($names[0], 0, 1) : '') . (isset($names[1]) ? substr($names[1], 0, 1) : '');
          }
      ?>
      <div class="team-card-wrapper">
        <div class="team-card">
          <div class="team-card-inner">
            <!-- Front -->
            <div class="team-card-front">
              <?php if (!empty($member['foto'])): ?>
              <img src="<?php echo esc_url($member['foto']); ?>" alt="<?php echo esc_attr($member['nome']); ?>"
                class="member-image">
              <?php else: ?>
              <div class="placeholder-avatar">
                <div class="circle">
                  <span><?php echo esc_html(strtoupper($initials)); ?></span>
                </div>
              </div>
              <?php endif; ?>
              <div class="overlay"></div>
              <div class="plus-icon">+</div>
              <div class="member-info">
                <div class="member-name-box">
                  <h3><?php echo esc_html($member['nome']); ?></h3>
                </div>
                <div class="member-role-badge">
                  <span class="dot"></span>
                  <span><?php echo esc_html($member['cargo']); ?></span>
                </div>
              </div>
            </div>

            <!-- Back -->
            <div class="team-card-back">
              <div class="back-content">
                <div class="back-header">
                  <div class="back-avatar">
                    <?php if (!empty($member['foto'])): ?>
                    <img src="<?php echo esc_url($member['foto']); ?>"
                      alt="<?php echo esc_attr($member['nome']); ?>">
                    <?php else: ?>
                    <span><?php echo esc_html(strtoupper($initials)); ?></span>
                    <?php endif; ?>
                  </div>
                  <div>
                    <p class="back-name"><?php echo esc_html($member['nome']); ?></p>
                    <p class="back-role"><?php echo esc_html($member['cargo']); ?></p>
                  </div>
                </div>
                <p class="back-bio"><?php echo esc_html($member['texto']); ?></p>
                <div class="back-decoration">
                  <div class="bar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
