<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NewsCard
 */

?>
<?php global $newscard_settings; ?>
<?php if ( !is_singular() ) { ?>
	<div class="col-sm-6<?php echo ( 'fullwidth' == $newscard_settings['newscard_content_layout'] ) ? ' col-lg-4': ''; ?> col-xxl-4 post-col">
<?php } ?>
	<div  id="divconteudo"  <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) {

			if ( !is_single() ) { ?>

				<figure class="post-featured-image post-img-wrap">
					<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
					<div class="entry-meta category-meta">
						<div class="cat-links"><?php the_category(' '); ?></div>
					</div><!-- .entry-meta -->
				</figure><!-- .post-featured-image .post-img-wrap -->

			<?php } elseif ( is_single() ) {

				if ( $newscard_settings['newscard_featured_image_single'] === 1 ) { ?>

    <figure class="post-featured-image-single">
        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php the_title_attribute(); ?>" />
    </figure>

					<figure class="post-featured-image page-single-img-wrap">
						<div class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></div>
						<?php if ( get_the_post_thumbnail_caption( get_the_ID() ) ) { ?>
							<figcaption class="featured-image-caption"><?php echo get_the_post_thumbnail_caption( get_the_ID() ); ?></figcaption>
						<?php } ?>
					</figure><!-- .post-featured-image .page-single-img-wrap -->

				<?php } ?>

				<div class="entry-meta category-meta">
					<div class="cat-links"><?php the_category(' '); ?></div>
				</div><!-- .entry-meta -->

			<?php }

		} else { ?>

			<div class="entry-meta category-meta">
				<div class="cat-links"><?php the_category(' '); ?></div>
			</div><!-- .entry-meta -->

		<?php } ?>

		<?php if ( !has_post_format( 'quote' ) ) { // for not format quote ?>
			<header class="entry-header">
				<?php if ( is_singular() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				} ?>

				<?php if ( 'post' === get_post_type() ) {
					if ( !has_post_format( 'link' ) ){ // for not format link ?>
					<div class="entry-meta">
						<?php newscard_posted_on(); ?>
						<?php if ( comments_open() && get_comments_number() ) { ?>
							<div class="comments">
								<?php comments_popup_link( __('No Comments', 'newscard'), __('1 Comment', 'newscard'), __('% Comments', 'newscard'), '', __('Comments Off', 'newscard') ); ?>
							</div><!-- .comments -->
						<?php } ?>
					</div><!-- .entry-meta -->
					<?php }
				} ?>
			</header>
		<?php } ?>
		<div class="entry-content">
            <?php if ( is_single() ) : ?>
                <figure class="post-featured-image-single">
                    <img class="imagem-noticia-leitura" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php the_title_attribute(); ?>" />
                </figure>

                <?php
                // Captura o conteúdo
                $content = apply_filters('the_content', get_the_content());
                $paragrafos = explode('</p>', $content); // Divide o conteúdo por parágrafos
                $metade = ceil(count($paragrafos) / 2); // Define o ponto de inserção no meio

                // Exibe a primeira metade do conteúdo
                for ($i = 0; $i < $metade; $i++) {
                    echo $paragrafos[$i] . '</p>';
                }
                ?>

                <!-- Seção de Notícias Relacionadas -->
                <section class="noticias-relacionadas">
                    <h2 class="noticias-relacionadas-titulo"
                    >
                        Notícias Relacionadas</h2>
                    <div class="relacionadaa-lista">
                        <?php
                        // Query para buscar notícias relacionadas com base nas categorias
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3, // Número de notícias relacionadas
                            'post__not_in' => array(get_the_ID()), // Exclui o post atual
                            'category__in' => wp_get_post_categories(get_the_ID()), // Mesmas categorias do post atual
                            'orderby' => 'rand' // Ordena aleatoriamente
                        );
                        $relacionadas = new WP_Query($args);

                        if ($relacionadas->have_posts()) :
                            while ($relacionadas->have_posts()) : $relacionadas->the_post(); ?>
                                <div class="relacionada-item">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="relacionada-thumb">
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <h3><?php the_title(); ?></h3>
                                    </a>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        else : ?>
                            <p>Nenhuma notícia relacionada encontrada.</p>
                        <?php endif; ?>
                    </div>
                </section>
                <!-- Fim da Seção de Notícias Relacionadas -->

                <?php
                // Exibe a segunda metade do conteúdo
                for ($i = $metade; $i < count($paragrafos); $i++) {
                    echo $paragrafos[$i] . '</p>';
                }
                ?>
            <?php else : ?>
                <?php if ( !(has_post_format('link') || has_post_format('quote')) ) : ?>
                    <p><?php echo wp_trim_words( get_the_excerpt(), 16 ); ?></p>
                <?php else :
                    the_content();
                endif; ?>
            <?php endif; ?>
        </div><!-- entry-content -->


		<?php if ( is_single() ) {
			echo get_the_tag_list( sprintf('<footer class="entry-meta"><span class="tag-links"><span class="label">%s:</span> ', esc_html__('Tags', 'newscard') ), ', ', '</span><!-- .tag-links --></footer><!-- .entry-meta -->' );
		}
		 wp_link_pages( array(
			'before' 			=> '<div class="page-links">' . esc_html__( 'Pages: ', 'newscard' ),
			'separator'			=> '',
			'link_before'		=> '<span>',
			'link_after'		=> '</span>',
			'after'				=> '</div>'
		) ); ?>
	</div><!-- .post-<?php the_ID(); ?> -->
<?php if ( !is_singular() ) { ?>
	</div><!-- .col-sm-6 .col-xxl-4 .post-col -->
<?php } ?>
