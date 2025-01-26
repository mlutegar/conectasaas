<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NewsCard
 */

get_header();

	newscard_layout_primary(); ?>
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );
				?>
<section class="mais-noticias">
    <h2>Mais Notícias</h2>
    <div class="noticias-lista">
        <?php
        // Query para pegar as últimas 5 notícias (exceto a atual)
        $args = array(
            'post_type' => 'post', // Tipo de post
            'posts_per_page' => 5, // Quantidade de posts
            'post__not_in' => array(get_the_ID()), // Exclui o post atual
            'orderby' => 'date', // Ordena por data
            'order' => 'DESC', // Ordem decrescente
        );
        $mais_noticias = new WP_Query($args);

        if ($mais_noticias->have_posts()) :
            while ($mais_noticias->have_posts()) : $mais_noticias->the_post(); ?>
                <div class="noticia-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="noticia-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="noticia-conteudo">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <span class="noticia-data"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' atrás'; ?></span>
                        </div>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Nenhuma notícia encontrada.</p>
        <?php endif; ?>
    </div>
</section>


                <?php

				the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action('newscard_sidebar');
get_footer();
