<?php
/**
 * Template Name: Home (ES)
 * 
 * Future CO Homepage (ES version)
 * Design: Corporate Futurism
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

<?php get_footer(); ?>
