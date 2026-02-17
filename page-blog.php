<?php
/**
 * Template Name: Página de Busca / Blog
 */
get_header(); 

// Get the search query from URL 'q' parameter to keep user on this template
$search_query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC'
);

// If search exists, append to args (filtering by 's' keyword manually)
if (!empty($search_query)) {
    $args['s'] = $search_query;
}

$query = new WP_Query($args);
?>

<main class="search-page-container">
    <div class="container">
        
        <!-- Search Header -->
        <div class="search-header-section">
            <h1 class="search-page-title">Blog & Notícias</h1>
            <form action="<?php echo esc_url(get_permalink()); ?>" method="get" class="search-page-form">
                <input type="text" name="q" class="search-page-input" placeholder="Pesquisar por nome..." value="<?php echo esc_attr($search_query); ?>">
                <button type="submit" class="search-page-btn" aria-label="Buscar">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Results Grid -->
        <?php if ($query->have_posts()) : ?>
            <div class="search-results-grid">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <article class="post-card">
                        <div class="post-card-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else : ?>
                                    <!-- Fallback Placeholder -->
                                    <div style="width:100%;height:100%;background:#39496a;display:flex;align-items:center;justify-content:center;">
                                        <span style="color:rgba(255,255,255,0.2);font-weight:700;">FUTURE CO</span>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-card-content">
                            <div class="post-card-date"><?php echo get_the_date('d \d\e F, Y'); ?></div>
                            <h2 class="post-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-card-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="post-card-link">
                                Ler mais
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="search-pagination">
                <?php
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                    'mid_size'  => 1
                ));
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
