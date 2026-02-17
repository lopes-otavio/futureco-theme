<?php
/**
 * Template Name: Política de Privacidade
 */
get_header(); 
?>

<main class="privacy-policy-page section-padding">
  <div class="container">
    <div class="privacy-content-wrapper glass-card">
      <header class="privacy-header">
        <?php $banner = get_field('imagem_destaque'); ?>
        <?php if ($banner): ?>
        <div class="post-banner" style="margin-bottom: 2rem; border-radius: 12px; overflow: hidden; height: 350px;">
          <img src="<?php echo esc_url($banner); ?>" alt="<?php the_title_attribute(); ?>"
            style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <?php endif; ?>
        <h1 class="privacy-title single-post"><?php the_title(); ?></h1>
      </header>

      <div class="privacy-body">
        <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>