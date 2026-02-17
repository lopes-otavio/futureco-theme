<?php
/**
 * Template Name: Home
 * 
 * Página principal do site Future CO
 * Design: Corporate Futurism
 * Cores: #39496A, #9AA7B8, #FFFFFF
 * 
 * @package FutureCO
 */

get_header();
?>

<main>

  <?php get_template_part('template-parts/section', 'hero'); ?>
  <div class="home-content-scroll">
    <?php get_template_part('template-parts/section', 'services'); ?>
    <?php get_template_part('template-parts/section', 'process'); ?>
    <?php get_template_part('template-parts/section', 'stats'); ?>
    <?php get_template_part('template-parts/section', 'partners'); ?>
    <?php get_template_part('template-parts/section', 'testimonials'); ?>
    <?php get_template_part('template-parts/section', 'team'); ?>
    <?php get_template_part('template-parts/section', 'cases'); ?>
    <?php get_template_part('template-parts/section', 'culture'); ?>
    <?php get_template_part('template-parts/section', 'faq'); ?>
    <?php get_template_part('template-parts/section', 'contact'); ?>
    <?php get_template_part('template-parts/section', 'blog'); ?>
  </div>

</main>

</main>

<?php get_footer(); ?>