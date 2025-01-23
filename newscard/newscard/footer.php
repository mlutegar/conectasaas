<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewsCard
 */

?>
		<?php global $newscard_settings; ?>
			</div><!-- row -->
		</div><!-- .container -->
	</div><!-- #content .site-content-->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( $newscard_settings['newscard_footer_featured_posts_hide'] === 0 ) {

			$footer_newscard_cat = absint($newscard_settings['newscard_footer_featured_post_categories']);

			$footer_post_type = array(
				'posts_per_page' => 4,
				'post__not_in' => get_option('sticky_posts'),
				'post_type' => array(
					'post'
				),
			);
			if ( $newscard_settings['newscard_footer_featured_latest_post'] == 'category' ) {
				$footer_post_type['category__in'] = $footer_newscard_cat;
			}

			$footer_newscard_get_featured_post = new WP_Query($footer_post_type); ?>

			<div class="container">
				<section class="featured-stories">
					<?php newscard_sections_title($newscard_settings['newscard_footer_featured_latest_post'], $newscard_settings['newscard_footer_featured_posts_title'], $footer_newscard_cat); ?>
					<div class="row gutter-parent-14">
						<?php while ($footer_newscard_get_featured_post->have_posts()) {
							$footer_newscard_get_featured_post->the_post(); ?>
							<div class="col-sm-6 col-lg-3">
								<div class="post-boxed">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-img-wrap">
											<div class="featured-post-img">
												<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'large')); ?>');"></a>
											</div>
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
										</div><!-- .post-img-wrap -->
									<?php } ?>
									<div class="post-content">
										<?php if ( !has_post_thumbnail() ) { ?>
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
										<?php } ?>
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
										<?php if ( 'post' === get_post_type() ) { ?>
											<div class="entry-meta">
												<?php newscard_posted_on(); ?>
											</div>
										<?php } ?>
									</div><!-- .post-content -->
								</div><!-- .post-boxed -->
							</div><!-- .col-sm-6 .col-lg-3 -->
						<?php }
						// Reset Post Data
						wp_reset_postdata(); ?>
					</div><!-- .row -->
				</section><!-- .featured-stories -->
			</div><!-- .container -->
		<?php } ?>

		<?php if ( is_active_sidebar('newscard_footer_sidebar') || is_active_sidebar('newscard_footer_column2') || is_active_sidebar('newscard_footer_column3') || is_active_sidebar('newscard_footer_column4') ) { ?>
			<div class="widget-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 1
								if ( is_active_sidebar( 'newscard_footer_sidebar' ) ) :
									dynamic_sidebar( 'newscard_footer_sidebar' );
								endif;
							?>
						</div><!-- footer sidebar column 1 -->
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 2
								if ( is_active_sidebar( 'newscard_footer_column2' ) ) :
									dynamic_sidebar( 'newscard_footer_column2' );
								endif;
							?>
						</div><!-- footer sidebar column 2 -->
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 3
								if ( is_active_sidebar( 'newscard_footer_column3' ) ) :
									dynamic_sidebar( 'newscard_footer_column3' );
								endif;
							?>
						</div><!-- footer sidebar column 3 -->
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 4
								if ( is_active_sidebar( 'newscard_footer_column4' ) ) :
									dynamic_sidebar( 'newscard_footer_column4' );
								endif;
							?>
						</div><!-- footer sidebar column 4 -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .widget-area -->
		<?php } ?>
		<div class="site-footer-container">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Logo -->
                        <div class="col-lg-3 footer-logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Conecta SaaS">
                        </div>

                        <!-- Categorias -->
                        <div class="col-lg-6 footer-categories">
                            <h3>CATEGORIAS</h3>
                            <ul class="categories-list">
                                <li><a href="#">Lançamentos e Atualizações</a></li>
                                <li><a href="#">Tendências do Setor</a></li>
                                <li><a href="#">Estudos de Caso e Sucesso</a></li>
                                <li><a href="#">Comparativos e Reviews</a></li>
                                <li><a href="#">Segurança e Privacidade</a></li>
                                <li><a href="#">Empresas e Startups</a></li>
                                <li><a href="#">Integrações e APIs</a></li>
                                <li><a href="#">Marketing e Vendas</a></li>
                                <li><a href="#">Eventos e Conferências</a></li>
                                <li><a href="#">Melhores Práticas e Dicas</a></li>
                                <li><a href="#">Finanças e Investimentos</a></li>
                                <li><a href="#">Recursos Humanos e Produtividade</a></li>
                            </ul>
                        </div>

                        <!-- Institucional -->
                        <div class="col-lg-3 footer-institutional">
                            <h3>INSTITUCIONAL</h3>
                            <ul>
                                <li><a href="#">Fale conosco</a></li>
                                <li><a href="#">Sobre nós</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 copyright">
                            <p>ConectaSaaS © <?php echo date('Y'); ?> Todos os direitos reservados.</p>
                        </div>
                        <div class="col-lg-6 footer-links text-right">
                            <a href="#">Termos de uso</a>
                            <a href="#">Política de privacidade</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</footer><!-- #colophon -->
	<div class="back-to-top"><a title="<?php esc_attr_e('Go to Top','newscard');?>" href="#masthead"></a></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
