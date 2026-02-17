<?php
/**
 * Blog posts index template.
 *
 * @package FutureCO
 */

get_header();

$search_query = isset($_GET['q']) ? sanitize_text_field(wp_unslash($_GET['q'])) : '';
$paged        = get_query_var('paged') ? (int) get_query_var('paged') : 1;

$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if (!empty($search_query)) {
    $args['s'] = $search_query;
}

$query = new WP_Query($args);
$posts_page_id = (int) get_option('page_for_posts');
$posts_page_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');
?>

<main class="search-page-container">
  <div class="container">

    <div class="search-header-section">
      <h1 class="search-page-title">Blog & <span class="text-gradient">Notícias</span></h1>
      <form action="<?php echo esc_url($posts_page_url); ?>" method="get" class="search-page-form">
        <input type="text" name="q" class="search-page-input" placeholder="Pesquisar por nome..."
          value="<?php echo esc_attr($search_query); ?>">
        <button type="submit" class="search-page-btn" aria-label="Buscar">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </button>
      </form>
    </div>

    <?php if ($query->have_posts()) : ?>
    <div class="search-results-grid">
      <?php while ($query->have_posts()) : $query->the_post(); ?>
      <article class="post-card">
        <div class="post-card-thumb">
          <a href="<?php the_permalink(); ?>">
            <?php $destaque = get_field('imagem_destaque'); ?>
            <?php if ($destaque): ?>
            <img src="<?= $destaque ?>" alt="">
            <?php else: ?>
            <div
              style="width:100%;height:100%;background:#39496a;display:flex;align-items:center;justify-content:center;">
              <span style="color:rgba(255,255,255,0.2);font-weight:700;">FUTURE CO</span>
            </div>
            <?php endif ?>
          </a>
        </div>
        <div class="post-card-content">
          <div class="post-card-date"><?php echo esc_html(get_the_date('d \d\e F, Y')); ?></div>
          <h2 class="post-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <div class="post-card-excerpt">
            <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20, '...')); ?>
          </div>
          <a href="<?php the_permalink(); ?>" class="post-card-link">
            Ler mais
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </article>
      <?php endwhile; ?>
    </div>

    <div class="search-pagination">
      <?php
                echo paginate_links(
                    array(
                        'total'     => $query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                        'mid_size'  => 1,
                    )
                );
                ?>
    </div>

    <?php else : ?>
    <div style="text-align:center;padding:4rem 0;">
      <h3 style="font-size:1.5rem;color:#fff;margin-bottom:1rem;">Nenhum post encontrado.</h3>
      <p style="color:rgba(255,255,255,0.6);">Tente buscar por outro termo.</p>
    </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

  </div>
</main>

<?php get_footer(); ?>