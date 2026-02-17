<?php
/**
 * Blog Section
 * @package FutureCO
 */

$blog_group = get_field('blog_sections');
$label_sessao = $blog_group['label_sessao'] ?? 'NOSSO CONTEÚDO';
$titulo = $blog_group['titulo'] ?? 'Últimas do <span class="text-gradient">Blog</span>';
$descricao = $blog_group['descricao'] ?? 'Acesse nossos conteúdos exclusivos sobre marketing, performance e tecnologia.';

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
);

$blog_query = new WP_Query($args);
?>

<section class="blog-section section-padding" id="blog">
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <p class="section-label" style="color:rgba(255,255,255,0.5);"><?php echo esc_html($label_sessao); ?></p>
      <h2 class="section-title" style="color:#fff;">
        <?php echo $titulo; ?>
      </h2>
      <p class="section-description" style="color:rgba(255,255,255,0.6);">
        <?php echo esc_html($descricao); ?>
      </p>
    </div>

    <!-- Blog Grid -->
    <div class="blog-grid">
      <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); 
          $imagem_destaque = get_field('imagem_destaque', get_the_ID());
          $delay = ($blog_query->current_post % 3) * 100;
      ?>
      <article class="post-card glass-card scroll-animate <?php echo $delay ? 'delay-' . $delay : ''; ?>">
        <div class="post-image">
          <?php if ($imagem_destaque) : ?>
            <img src="<?php echo esc_url($imagem_destaque); ?>" alt="<?php the_title_attribute(); ?>">
          <?php elseif (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium_large'); ?>
          <?php else : ?>
            <div class="image-placeholder"></div>
          <?php endif; ?>
          <div class="post-date">
            <span><?php echo get_the_date('d'); ?></span>
            <span><?php echo get_the_date('M'); ?></span>
          </div>
        </div>
        <div class="post-content">
          <h3 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h3>
          <div class="post-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
          </div>
          <a href="<?php the_permalink(); ?>" class="post-link">
            Ler Mais
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </article>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>
</section>
