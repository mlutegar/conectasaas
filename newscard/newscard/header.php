<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewsCard
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Libre+Franklin:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class('theme-body'); ?>>
<?php wp_body_open();
global $newscard_settings;
$newscard_settings = newscard_get_option_defaults(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'newscard' ); ?></a>
	<?php if (has_header_video() || has_header_image()) {
		the_custom_header_markup();
	} ?>

	<header id="masthead" class="site-header">
		<?php if ( $newscard_settings['newscard_top_bar_hide'] == 0 ) { ?>
			<div class="info-bar<?php echo ( has_nav_menu('right-section') ) ? ' infobar-links-on' : ''; ?>">
				<div class="container">
					<div class="row gutter-10">
						<div class="col col-sm contact-section">
							<div class="date">
								<ul><li><?php echo esc_html(date_i18n("l, F j, Y")); ?></li></ul>
							</div>
						</div><!-- .contact-section -->

						<?php if ( $newscard_settings['newscard_social_profiles'] != '' && $newscard_settings['newscard_top_bar_social_profiles'] === 0 ) { ?>
							<div class="col-auto social-profiles order-md-3">
								<?php echo esc_html( newscard_social_profiles() ); ?>
							</div><!-- .social-profile -->
						<?php }

						if ( has_nav_menu('right-section') ) { ?>
							<div class="col-md-auto infobar-links order-md-2">
								<button class="infobar-links-menu-toggle"><?php esc_html_e('Responsive Menu', 'newscard' ); ?></button>
								<?php wp_nav_menu( array(
									'theme_location'	=> 'right-section',
									'container'			=> '',
									'depth'				=> 1,
									'items_wrap'      	=> '<ul class="clearfix">%3$s</ul>',
								) ); ?>
							</div><!-- .infobar-links -->
						<?php } ?>
					</div><!-- .row -->
          		</div><!-- .container -->
        	</div><!-- .infobar -->
        <?php } ?>
		<nav class="navbar navbar-expand-lg d-block">
			<div class="navbar-head<?php echo ($newscard_settings['newscard_header_background'] !== '') ? ' navbar-bg-set' : '' ; echo ($newscard_settings['newscard_header_bg_overlay'] === 'dark') ? ' header-overlay-dark' : '' ; echo ($newscard_settings['newscard_header_bg_overlay'] === 'light') ? ' header-overlay-light' : '' ;?>" <?php if ($newscard_settings['newscard_header_background'] !== '') { ?> style="background-image:url('<?php echo esc_url($newscard_settings['newscard_header_background']); ?>');"<?php } ?>>
				<div class="container">
					<div class="row navbar-head-row align-items-center">
						<div class="col-lg-4">
							<div class="site-branding navbar-brand">
								<?php
								the_custom_logo();
								if ( is_page_template('templates/front-page-template.php') || is_home() ) :
									?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
								else :
									?>
									<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
								<?php
								endif;
								$newscard_description = get_bloginfo( 'description', 'display' );
								if ( $newscard_description || is_customize_preview() ) :
									?>
									<p class="site-description"><?php echo $newscard_description; /* WPCS: xss ok. */ ?></p>
								<?php endif; ?>
							</div><!-- .site-branding .navbar-brand -->
						</div>
                    <div class="parte-direita-header">

                    															<div class="nav-search">
                    															<div class="search-bar">
                                                                                						<div class="container">
                                                                                							<div class="search-block off">
                                                                                								<?php get_search_form(); ?>
                                                                                							</div><!-- .search-box -->
                                                                                						</div><!-- .container -->
                                                                                					</div><!-- .search-bar -->

                                                        							<span class="search-toggle">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="38" viewBox="0 0 40 38" fill="none">
                                                                                          <path d="M26.3258 25.0342L35 33.25M30 16.625C30 23.1833 24.4035 28.5 17.5 28.5C10.5964 28.5 5 23.1833 5 16.625C5 10.0666 10.5964 4.75 17.5 4.75C24.4035 4.75 30 10.0666 30 16.625Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                        </svg></span>
                                                        						</div>
                                                                            <div class="menu-hamburgue">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="34" viewBox="0 0 40 34" fill="none">
                                                                                  <line y1="1" x2="40" y2="1" stroke="white" stroke-width="2"/>
                                                                                  <line y1="33" x2="40" y2="33" stroke="white" stroke-width="2"/>
                                                                                  <line y1="17" x2="40" y2="17" stroke="white" stroke-width="2"/>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
						<?php if ( $newscard_settings['newscard_header_add_image'] !== '' ) { ?>
							<div class="col-lg-8 navbar-ad-section">
								<?php if ( $newscard_settings['newscard_header_add_link'] !== '' ) { ?>
									<a href="<?php echo esc_url( $newscard_settings['newscard_header_add_link'] ); ?>" class="newscard-ad-728-90" target="_blank" rel="noopener noreferrer">
								<?php } ?>
									<img class="img-fluid" src="<?php echo esc_url( $newscard_settings['newscard_header_add_image'] ); ?>" alt="<?php esc_attr_e('Banner Add', 'newscard'); ?>">
								<?php if ( $newscard_settings['newscard_header_add_link'] !== '' ) { ?>
									</a>
								<?php } ?>
							</div>
						<?php } ?>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .navbar-head -->
			<div class="navigation-bar">
				<div class="navigation-bar-top">
					<div class="container">
						<button class="navbar-toggler menu-toggle" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'newscard'); ?>"></button>
						<span class="search-toggle"></span>
					</div><!-- .container -->
				</div><!-- .navigation-bar-top -->
				<div class="navbar-main">
					<div class="container">
						<div class="collapse navbar-collapse" id="navbarCollapse">
<div id="site-navigation" class="main-navigation<?php echo ($newscard_settings['newscard_nav_uppercase'] == 1) ? " nav-uppercase" : "";?>" role="navigation">
        <ul class="nav-menu navbar-nav d-lg-block">
            <!-- Link para a Página Inicial -->
            <li class="menu-item">
                <a href="<?php echo home_url(); ?>">Início</a>
            </li>
            <!-- Listando Categorias -->
            <?php
            $categorias = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC',
            ));

            foreach ($categorias as $categoria) {
                echo '<li class="menu-item">';
                echo '<a href="' . get_category_link($categoria->term_id) . '">' . $categoria->name . '</a>';
                echo '</li>';
            }
            ?>
        </ul>
    </div><!-- #site-navigation .main-navigation -->
						</div><!-- .navbar-collapse -->
					</div><!-- .container -->
				</div><!-- .navbar-main -->
			</div><!-- .navigation-bar -->
		</nav><!-- .navbar -->

		<?php if ( ( is_front_page() || is_home() ) && $newscard_settings['newscard_top_stories_hide'] === 0 ) {

			$newscard_cat_tp = absint($newscard_settings['newscard_top_stories_categories']);

			$post_type_tp = array(
				'posts_per_page' => 5,
				'post__not_in' => get_option('sticky_posts'),
				'post_type' => array(
					'post'
				),
			);
			if ( $newscard_settings['newscard_top_stories_latest_post'] == 'category' ) {
				$post_type_tp['category__in'] = $newscard_cat_tp;
			}

			$newscard_get_top_stories = new WP_Query($post_type_tp); ?>

			<div class="top-stories-bar">
				<div class="container">
					<div class="row top-stories-box clearfix">
						<div class="col-sm-auto">
							<div class="top-stories-label">
								<div class="top-stories-label-wrap">
									<span class="flash-icon"></span>
									<span class="label-txt">
										<?php echo esc_html($newscard_settings['newscard_top_stories_title']); ?>
									</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm top-stories-lists">
							<div class="row align-items-center">
								<div class="col">
									<div class="marquee<?php echo (is_rtl()) ? " marquee-rtl" : " marquee-ltr"; ?>">
										<?php while ($newscard_get_top_stories->have_posts()) {
											$newscard_get_top_stories->the_post();
											the_title( '<a href="' . esc_url( get_permalink() ) . '">', '</a>' );
										}
										// Reset Post Data
										wp_reset_postdata(); ?>
									</div><!-- .marquee -->
								</div><!-- .col -->
							</div><!-- .row .align-items-center -->
						</div><!-- .col-12 .col-sm .top-stories-lists -->
					</div><!-- .row .top-stories-box -->
				</div><!-- .container -->
			</div><!-- .top-stories-bar -->
		<?php } ?>

		<?php if ( ( ( is_front_page() || ( is_home() && $newscard_settings['newscard_banner_display'] === 'front-blog' ) ) && ( $newscard_settings['newscard_banner_slider_posts_hide'] === 0 || $newscard_settings['newscard_banner_featured_posts_1_hide'] === 0 || $newscard_settings['newscard_banner_featured_posts_2_hide'] === 0 ) ) || ( ( is_front_page() || ( is_home() && $newscard_settings['newscard_header_featured_posts_banner_display'] === 'front-blog' ) ) && $newscard_settings['newscard_header_featured_posts_hide'] === 0 ) ) { ?>
            <section class="featured-section">
				<div class="container">
                    <div class="data-atual">
                        <?php echo date_i18n("j \\d\\e F \\d\\e Y"); ?>
                    </div>


					<?php if ( ( is_front_page() || ( is_home() && $newscard_settings['newscard_header_featured_posts_banner_display'] === 'front-blog' ) ) && $newscard_settings['newscard_header_featured_posts_hide'] === 0 ) {

						$header_newscard_cat = absint($newscard_settings['newscard_header_featured_post_categories']);

						$header_post_type = array(
							'posts_per_page' => 4,
							'post__not_in' => get_option('sticky_posts'),
							'post_type' => array(
								'post'
							),
						);
						if ( $newscard_settings['newscard_header_featured_latest_post'] == 'category' ) {
							$header_post_type['category__in'] = $header_newscard_cat;
						}

						$header_newscard_get_featured_post = new WP_Query($header_post_type); ?>
					<?php } ?>
				</div><!-- .container -->
			</section><!-- .featured-section -->
		<?php } ?>

		<?php if ( !is_front_page() && !is_home() && !is_page_template('templates/front-page-template.php') && function_exists('newscard_breadcrumbs') && $newscard_settings['newscard_breadcrumbs_hide'] === 0 ) { ?>
			<div id="breadcrumb">
				<div class="container">
					<?php newscard_breadcrumbs(); ?>
				</div>
			</div><!-- .breadcrumb -->
		<?php } ?>
	</header><!-- #masthead -->
	<div id="content" class="site-content <?php echo ( ( ( is_front_page() || ( is_home() && $newscard_settings['newscard_banner_display'] === 'front-blog' ) ) && ( $newscard_settings['newscard_banner_slider_posts_hide'] === 0 || $newscard_settings['newscard_banner_featured_posts_1_hide'] === 0 || $newscard_settings['newscard_banner_featured_posts_2_hide'] === 0 ) ) || ( ( is_front_page() || ( is_home() && $newscard_settings['newscard_header_featured_posts_banner_display'] === 'front-blog' ) ) && $newscard_settings['newscard_header_featured_posts_hide'] === 0 ) ) ? "pt-0" : ""; ?>">
		<div class="container">
			<?php if ( is_page_template('templates/front-page-template.php') ) { ?>
				<div class="row gutter-14 justify-content-center site-content-row">
			<?php } else { ?>
				<div class="row justify-content-center site-content-row">
			<?php } ?>

			<div class="menu-hamburguer-lateral">
                <button class="close-menu">&times;</button>
                <nav class="menu-lateral">
                    <ul>
                        <li><a href="#">Início</a></li>
                        <li><a href="#">Empresas e Startups</a></li>
                        <li><a href="#">Marketing/Vendas</a></li>
                        <li><a href="#">Eventos</a></li>
                        <li><a href="#">Lançamentos</a></li>
                        <li><a href="#">Tendências</a></li>
                        <li><a href="#">Estudos de Caso e Sucesso</a></li>
                        <li><a href="#">Finanças</a></li>
                    </ul>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </nav>
            </div>


			<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuHamburguer = document.querySelector('.menu-hamburgue');
    const menuLateral = document.querySelector('.menu-hamburguer-lateral');
    const closeMenu = document.querySelector('.close-menu');

    // Abrir o menu
    menuHamburguer.addEventListener('click', () => {
        menuLateral.classList.add('active');
        menuHamburguer.classList.add('open'); // Adiciona uma classe para animação
    });


    // Fechar o menu
    closeMenu.addEventListener('click', () => {
        menuLateral.classList.remove('active');
        menuHamburguer.classList.remove('open'); // Remove a classe
    });

    // Fechar o menu ao clicar fora (opcional)
    document.addEventListener('click', (event) => {
        if (!menuLateral.contains(event.target) && !menuHamburguer.contains(event.target)) {
            menuLateral.classList.remove('active');
        }
    });
});

			</script>
