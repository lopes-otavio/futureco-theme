<?php
/**
 * Template Name: Cookie Policy (EN)
 */
get_header(); 
?>

<main class="privacy-policy-page section-padding">
  <div class="container">
    <div class="privacy-content-wrapper glass-card">
      <header class="privacy-header">
        <h1 class="privacy-title "><?php the_title(); ?></h1>
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
