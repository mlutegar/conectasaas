<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NewsCard
 */

get_header();

newscard_layout_primary();
?>
		<main id="main" class="site-main">
		<?php if ( is_home() && !is_front_page() ) {

			if ( ($newscard_settings['newscard_banner_display'] === 'front-blog' && ($newscard_settings['newscard_banner_slider_posts_hide'] === 0 || $newscard_settings['newscard_banner_featured_posts_1_hide'] === 0 || $newscard_settings['newscard_banner_featured_posts_2_hide'] === 0)) || $newscard_settings['newscard_header_featured_posts_hide'] === 0 ) { ?>

				<h2 class="stories-title"><?php echo get_the_title(get_option('page_for_posts')); ?> </h2>


			<?php } else { ?>

				<header class="page-header">
					<h2 class="page-title"><?php echo get_the_title(get_option('page_for_posts')); ?> </h2>
				</header><!-- .page-header -->
			<?php }
			} ?>

<section class="ultimas-noticias-topo">
        <div class="noticia-destaque">
            <?php
            // Query para pegar a notícia mais recente
            $args_destaque = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $query_destaque = new WP_Query($args_destaque);

            if ($query_destaque->have_posts()) :
                while ($query_destaque->have_posts()) : $query_destaque->the_post(); ?>
                    <div class="destaque-imagem">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                    <div class="destaque-conteudo">
                        <span class="categoria"><?php the_category(', '); ?></span>
                        <h2 class="titulo-noticia-destacada"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <span class="data-publicacao">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                          <g clip-path="url(#clip0_325_681)">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM7 3V8.41421L10.2929 11.7071L11.7071 10.2929L9 7.58579V3H7Z" fill="black"/>
                                                          </g>
                                                          <defs>
                                                            <clipPath id="clip0_325_681">
                                                              <rect width="16" height="16" fill="white"/>
                                                            </clipPath>
                                                          </defs>
                                                        </svg>
                            <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' atrás'; ?></span>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="outras-noticias">
            <?php
            // Query para pegar as próximas 4 notícias
            $args_outras = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'offset' => 1, // Pula a notícia em destaque
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $query_outras = new WP_Query($args_outras);

            if ($query_outras->have_posts()) :
                while ($query_outras->have_posts()) : $query_outras->the_post(); ?>
                    <div class="banner-outras-noticia-item">
                        <div class="noticia-thumb">
                            <a href="<?php the_permalink(); ?>" class="imagem-banner-outras-noticias">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                        <div class="noticia-info">
                            <span class="categoria"><?php the_category(', '); ?></span>
                            <div class="titulo-outras-noticia">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                            <div class="data-publicacao">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                              <g clip-path="url(#clip0_325_681)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM7 3V8.41421L10.2929 11.7071L11.7071 10.2929L9 7.58579V3H7Z" fill="black"/>
                              </g>
                              <defs>
                                <clipPath id="clip0_325_681">
                                  <rect width="16" height="16" fill="white"/>
                                </clipPath>
                              </defs>
                            </svg>
                            <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' atrás'; ?></div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
</section>


		<?php
        if ( have_posts() ) :
        $args = array(
            'category_name' => 'brasil', // Slug da categoria
            'posts_per_page' => 5, // Número de posts a exibir
        );
        $categoria1_query = new WP_Query($args);

        if ($categoria1_query->have_posts()) : ?>
            <section class="categoria-1-section">
                <div class="row flex-column">
                    <div class="titulo">BRASIL</div>
                    <div class="row gutter-parent-14 post-wrap">
                        <?php while ($categoria1_query->have_posts()) :
                            $categoria1_query->the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <a href="<?php the_permalink(); ?>">
                                <div class="imagem-noticia">
                                    <?php
                                    // Exibe a imagem destacada (thumbnail) com tamanho médio
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('medium', array('class' => 'post-thumbnail'));
                                    }
                                    ?>
                                    </div>
                                                            <div class="categoria-noticia">
                                                                <?php
                                                                // Exibe a categoria do post
                                                                $categories = get_the_category();
                                                                if (!empty($categories)) {
                                                                    echo '<span class="categoria">' . esc_html($categories[0]->name) . '</span>';
                                                                }
                                                                ?>
                                                            </div>
                                <div class="titulo-noticia"><?php the_title(); ?></div>
                                </a>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        <?php
        wp_reset_postdata();
        endif;
        ?>

        <?php
        $args_categoria2 = array(
            'category_name' => 'mundo', // Substitua pelo slug da sua segunda categoria
            'posts_per_page' => 5, // Número de posts a exibir
        );
        $categoria2_query = new WP_Query($args_categoria2);

if ($categoria2_query->have_posts()) : ?>
    <section class="categoria-black">
        <div class="row flex-column">
            <div class="titulo black">MUNDO</div> <!-- Nome da categoria -->
            <div class="row gutter-parent-14 post-wrap">
                <?php while ($categoria2_query->have_posts()) :
                    $categoria2_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <a href="<?php the_permalink(); ?>">
                            <div class="imagem-noticia">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium', array('class' => 'post-thumbnail'));
                                }
                                ?>
                            </div>
                            <div class="categoria-noticia black">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<span class="categoria">' . esc_html($categories[0]->name) . '</span>';
                                }
                                ?>
                            </div>
                            <div class="titulo-noticia black"><?php the_title(); ?></div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php
wp_reset_postdata();
endif;
?>

<section class="newsletter-section">
    <div class="container newsletter-container">
        <div class="newsletter-content">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Conecta SaaS" class="newsletter-logo">
            <h2>Fique atualizado com as principais novidades do mundo SaaS! Não perca nada!</h2>
            <form action="#" method="POST" class="newsletter-form">
                <div class="newsletter-fields">
                    <input type="text" name="nome" placeholder="Nome completo" class="input-field">
                    <input type="email" name="email" placeholder="Email" class="input-field">
                </div>
                <div class="newsletter-terms">
                    <label>
                        <input type="checkbox" name="termos">
                        Li e concordo com os termos de uso e os termos de privacidade
                    </label>
                </div>
                <button type="submit" class="newsletter-button">Cadastrar</button>
            </form>
        </div>
    </div>
</section>


			<div class="row gutter-parent-14 post-wrap">
			</div><!-- .row .gutter-parent-14 .post-wrap -->

			<?php the_posts_pagination( array(
				'prev_text' => __( 'Previous', 'newscard' ),
				'next_text' => __( 'Next', 'newscard' ),
				)
			);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action('newscard_sidebar');
get_footer();
