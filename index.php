<?php
/**
 * Main template file (fallback)
 * 
 * @package FutureCO
 */

get_header();
?>

<main>
    <section class="section-padding" style="min-height:60vh;display:flex;align-items:center;justify-content:center;">
        <div class="container" style="text-align:center;">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article>
                        <h1 style="font-size:2.5rem;font-weight:800;margin-bottom:1rem;"><?php the_title(); ?></h1>
                        <div style="color:rgba(255,255,255,0.7);line-height:1.75;max-width:42rem;margin:0 auto;">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <h1 style="font-size:2.5rem;font-weight:800;margin-bottom:1rem;">Nenhum conteúdo encontrado</h1>
                <p style="color:rgba(255,255,255,0.7);">A página que você procura não existe.</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary" style="margin-top:2rem;">Voltar ao Início</a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
