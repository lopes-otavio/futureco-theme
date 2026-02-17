<?php
/**
 * Testimonials Section
 * @package FutureCO
 */
?>
<?php
$testemunhas_group = get_field('testemunhas_section');
$label_sessao = $testemunhas_group['label_sessao'] ?? 'DEPOIMENTOS';
$titulo = $testemunhas_group['titulo'] ?? 'O que nossos <span class="text-gradient">clientes dizem</span>';
$testemunhas = $testemunhas_group['testemunhas'] ?? array();
?>
<section class="testimonials-section section-padding" id="depoimentos">
  <div class="decorative-1"></div>
  <div class="decorative-2"></div>
  <div class="container" style="position:relative;z-index:1;">
    <!-- Section Header -->
    <div class="section-header">
      <p class="section-label" style="color:rgba(255,255,255,0.5);"><?php echo esc_html($label_sessao); ?></p>
      <h2 class="section-title" style="color:#fff;">
        <?php echo $titulo; ?>
      </h2>
    </div>

    <!-- Testimonial Carousel -->
    <div class="testimonial-carousel" id="testimonial-carousel">
      <?php if ($testemunhas) : foreach ($testemunhas as $index => $t) : 
          $active = $index === 0 ? '' : 'style="display:none;"';
          // Gerar iniciais se não houver foto
          $initials = '';
          if (empty($t['foto']) && !empty($t['nome'])) {
              $names = explode(' ', $t['nome']);
              $initials = (isset($names[0]) ? substr($names[0], 0, 1) : '') . (isset($names[1]) ? substr($names[1], 0, 1) : '');
          }
      ?>
      <div class="testimonial-card glass-card testimonial-slide" <?php echo $active; ?>
        data-index="<?php echo $index; ?>">
        <!-- Quote Icon -->
        <svg class="testimonial-quote-icon" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" />
          <path
            d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" />
        </svg>

        <div class="testimonial-content">
          <!-- Avatar -->
          <div class="testimonial-avatar">
            <?php if (!empty($t['foto'])) : ?>
              <img src="<?php echo esc_url($t['foto']); ?>" alt="<?php echo esc_attr($t['nome']); ?>" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
            <?php else : ?>
              <span><?php echo esc_html(strtoupper($initials)); ?></span>
            <?php endif; ?>
          </div>

          <div class="testimonial-text-content">
            <!-- Stars -->
            <div class="testimonial-stars">
              <?php for ($s = 0; $s < 5; $s++): ?>
              <img src="<?php echo futureco_icon('star.svg'); ?>" alt="★" class="icon-white"
                style="width:1.25rem;height:1.25rem;">
              <?php endfor; ?>
            </div>

            <!-- Quote -->
            <p class="testimonial-quote">"<?php echo esc_html($t['texto']); ?>"</p>

            <!-- Author -->
            <p class="testimonial-author"><?php echo esc_html($t['nome']); ?></p>
            <p class="testimonial-role"><?php echo esc_html($t['cargo']); ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>

    <!-- Carousel Navigation -->
    <div class="carousel-nav">
      <button class="carousel-btn" id="testimonial-prev" aria-label="Anterior">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6" />
        </svg>
      </button>
      <div class="carousel-dots" id="testimonial-dots">
        <?php if ($testemunhas) : foreach ($testemunhas as $index => $t): ?>
        <button class="carousel-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"
          aria-label="Depoimento <?php echo $index + 1; ?>"></button>
        <?php endforeach; endif; ?>
      </div>
      <button class="carousel-btn" id="testimonial-next" aria-label="Próximo">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </button>
    </div>
  </div>
</section>
