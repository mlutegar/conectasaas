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

		}

		if ( have_posts() ) : ?>
		<?php
        // Query para exibir posts da categoria 1
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
