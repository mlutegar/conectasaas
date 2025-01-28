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

                                <div class="data-atual">
                                    <?php echo date_i18n("j \\d\\e F \\d\\e Y"); ?>
                                </div>

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );
				?>
<section class="mais-noticias">
                        <div class="mais-noticias-container">
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
                            <span class="noticia-data"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                         <g clip-path="url(#clip0_201_3077)">
                                                           <path fill-rule="evenodd" clip-rule="evenodd" d="M8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM7 3V8.41421L10.2929 11.7071L11.7071 10.2929L9 7.58579V3H7Z" fill="#990A04"/>
                                                         </g>
                                                         <defs>
                                                           <clipPath id="clip0_201_3077">
                                                             <rect width="16" height="16" fill="white"/>
                                                           </clipPath>
                                                         </defs>
                                                       </svg><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' atrás'; ?></span>
                        </div>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Nenhuma notícia encontrada.</p>
        <?php endif; ?>
    </div>
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
