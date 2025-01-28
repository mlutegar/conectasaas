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
                    <div class="categoria-secao-noticias">
                        <?php while ($categoria1_query->have_posts()) :
                            $categoria1_query->the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <a href="<?php the_permalink(); ?>">
                                <div class="imagem-noticia">
                                    <?php
                                    // Exibe a imagem destacada (thumbnail) com tamanho médio
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('medium', array('class' => 'categoria-secao-noticias-imagem'));
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
            <div class="categoria-secao-noticias">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="186" height="70" viewBox="0 0 186 70" fill="none">
              <g clip-path="url(#clip0_157_1895)">
                <path d="M0.693359 0.83007H67.7436V3.8674H0.693359V0.83007ZM0.693359 0.83007H3.67337V69.1699H0.693359V0.83007ZM67.7436 69.1699H0.693359V66.1326H67.7436V69.1699ZM67.7436 69.1699H64.7636V55.502H67.7436V69.1699ZM67.7436 14.498H64.7636V0.83007H67.7436V14.498Z" fill="#333333"/>
                <path d="M13.3584 23.7201H123.512V46.1281H13.3584V23.7201Z" fill="#990A04"/>
                <path d="M24.9666 28.2397C24.1434 27.8601 23.2382 27.6702 22.2548 27.6702C20.925 27.6702 19.7665 27.9664 18.7794 28.5663C17.7922 29.1661 17.0323 30.0242 16.5034 31.1442C15.9744 32.2604 15.71 33.5703 15.71 35.0737C15.71 36.5848 15.9744 37.9174 16.5034 39.0716C17.0323 40.222 17.7922 41.118 18.7794 41.7559C19.7665 42.3937 20.925 42.7126 22.2548 42.7126C23.4431 42.7126 24.4637 42.4696 25.3168 41.9837C26.1698 41.4939 26.8291 40.9244 27.3022 40.2638C27.7753 39.6069 28.0733 38.9957 28.2037 38.43C28.2409 38.1642 28.1701 38.001 27.9913 37.9364L26.0916 37.5188C26.0543 37.5074 25.9947 37.4998 25.9165 37.4998C25.7898 37.4998 25.7042 37.5454 25.6669 37.6403C25.3279 38.5325 24.8921 39.1779 24.3594 39.5728C23.823 39.9676 23.1674 40.1651 22.3926 40.1651C21.3347 40.1651 20.545 39.7626 20.0273 38.9615C19.5132 38.1604 19.2524 36.8809 19.2524 35.1307C19.2524 31.763 20.288 30.0773 22.3517 30.0773C23.0631 30.0773 23.6331 30.2861 24.0577 30.7076C24.4824 31.129 24.7692 31.7023 24.9107 32.4275C24.9368 32.5452 24.9666 32.6249 24.9964 32.6629C25.0299 32.7046 25.1044 32.7236 25.2199 32.7236L27.8349 32.5452C27.9131 32.5338 27.969 32.511 28.01 32.4844C28.0472 32.4578 28.0658 32.4085 28.0658 32.3287C28.0658 32.2111 28.0547 32.1047 28.0286 32.0136C27.887 31.1973 27.5481 30.4608 27.0117 29.8002C26.4753 29.1434 25.7936 28.6232 24.9666 28.2397ZM34.8193 41.8128C35.8176 42.4127 36.9984 42.7126 38.3543 42.7126C39.6953 42.7126 40.865 42.4089 41.8596 41.8052C42.8541 41.1977 43.6178 40.3321 44.1542 39.2083C44.6906 38.0845 44.9588 36.7557 44.9588 35.2294C44.9588 33.6917 44.6868 32.3515 44.143 31.2125C43.6029 30.0735 42.8355 29.2003 41.8409 28.5852C40.8464 27.974 39.6841 27.6702 38.3543 27.6702C37.0096 27.6702 35.8362 27.974 34.8379 28.5852C33.8359 29.2003 33.0648 30.0735 32.5209 31.2125C31.9808 32.3515 31.7089 33.6955 31.7089 35.2484C31.7089 36.7898 31.9771 38.1187 32.5135 39.2387C33.0499 40.3549 33.8173 41.2167 34.8193 41.8128ZM40.6862 39.0982C40.2019 39.8879 39.4234 40.2827 38.3543 40.2827C37.2666 40.2827 36.4806 39.8879 35.9889 39.0982C35.4972 38.3085 35.2551 37.0328 35.2551 35.2712C35.2551 33.4677 35.501 32.1503 36.0001 31.3226C36.4955 30.4912 37.2815 30.0773 38.3543 30.0773C39.3973 30.0773 40.1721 30.4912 40.6676 31.3226C41.163 32.1503 41.4126 33.4677 41.4126 35.2712C41.4126 37.0328 41.1704 38.3085 40.6862 39.0982ZM60.8609 27.8677H58.7115C58.4768 27.8677 58.3614 27.9854 58.3614 28.2208V36.376C58.3614 36.5203 58.3316 36.5924 58.2645 36.5924C58.2124 36.5924 58.149 36.5392 58.0708 36.4329L52.3753 28.1638C52.2859 28.0309 52.2076 27.9474 52.1443 27.917C52.081 27.8829 51.9692 27.8677 51.8165 27.8677H49.4698C49.2388 27.8677 49.1233 27.993 49.1233 28.2397V42.1811C49.1233 42.4051 49.25 42.5152 49.5107 42.5152H51.526C51.6675 42.5152 51.7681 42.4924 51.824 42.4468C51.8836 42.4013 51.9134 42.3254 51.9134 42.219V42.1583V33.4715C51.9134 33.407 51.9357 33.369 51.9804 33.3538C52.0251 33.3425 52.0735 33.369 52.1257 33.4336L58.3055 42.2798C58.38 42.3823 58.4508 42.4506 58.5178 42.4772C58.5811 42.5038 58.6705 42.5152 58.7897 42.5152H60.7454C60.8497 42.5152 60.9354 42.4848 61.0061 42.4279C61.0769 42.3671 61.1142 42.2912 61.1142 42.2001V28.1638C61.1142 27.9664 61.0285 27.8677 60.8609 27.8677ZM66.0722 27.8677C65.8635 27.8677 65.763 27.993 65.763 28.2397V42.1013C65.763 42.2456 65.7928 42.3519 65.8598 42.4165C65.9231 42.481 66.0312 42.5152 66.1876 42.5152H75.9509C76.2079 42.5152 76.3383 42.3975 76.3383 42.1583V40.2827C76.3383 40.0853 76.2228 39.9866 75.9881 39.9866H69.3651C69.2868 39.9866 69.231 39.9676 69.2012 39.9297C69.1676 39.8879 69.1527 39.8234 69.1527 39.7322V36.6304C69.1527 36.4747 69.2421 36.395 69.4209 36.395H73.5669C73.7755 36.395 73.8761 36.3039 73.8761 36.1178V34.2233C73.8761 34.0145 73.768 33.9082 73.5482 33.9082H69.4433C69.2496 33.9082 69.1527 33.7943 69.1527 33.5703V30.7076C69.1527 30.4988 69.2757 30.3925 69.5178 30.3925H75.6976C75.9695 30.3925 76.1036 30.2558 76.1036 29.9786L76.126 28.2018C76.126 27.9778 76.0291 27.8677 75.8354 27.8677H66.0722ZM88.0758 28.2397C87.2488 27.8601 86.3437 27.6702 85.364 27.6702C84.0342 27.6702 82.8757 27.9664 81.8886 28.5663C80.8977 29.1661 80.1415 30.0242 79.6126 31.1442C79.0799 32.2604 78.8154 33.5703 78.8154 35.0737C78.8154 36.5848 79.0799 37.9174 79.6126 39.0716C80.1415 40.222 80.8977 41.118 81.8886 41.7559C82.8757 42.3937 84.0342 42.7126 85.364 42.7126C86.5523 42.7126 87.5729 42.4696 88.426 41.9837C89.2753 41.4939 89.9383 40.9244 90.4114 40.2638C90.8807 39.6069 91.1825 38.9957 91.3091 38.43C91.3501 38.1642 91.2793 38.001 91.0968 37.9364L89.2008 37.5188C89.1598 37.5074 89.1039 37.4998 89.0257 37.4998C88.8953 37.4998 88.8134 37.5454 88.7724 37.6403C88.4371 38.5325 88.0013 39.1779 87.4649 39.5728C86.9285 39.9676 86.2729 40.1651 85.4981 40.1651C84.4402 40.1651 83.6542 39.7626 83.1364 38.9615C82.6187 38.1604 82.3616 36.8809 82.3616 35.1307C82.3616 31.763 83.3935 30.0773 85.4608 30.0773C86.1723 30.0773 86.7385 30.2861 87.1669 30.7076C87.5916 31.129 87.8747 31.7023 88.0162 32.4275C88.0423 32.5452 88.0721 32.6249 88.1056 32.6629C88.1354 32.7046 88.2099 32.7236 88.3291 32.7236L90.9441 32.5452C91.0186 32.5338 91.0782 32.511 91.1154 32.4844C91.1564 32.4578 91.175 32.4085 91.175 32.3287C91.175 32.2111 91.1638 32.1047 91.1378 32.0136C90.9925 31.1973 90.6535 30.4608 90.1208 29.8002C89.5844 29.1434 88.9028 28.6232 88.0758 28.2397ZM94.5834 28.2208V30.0583C94.5834 30.2558 94.7063 30.3545 94.9522 30.3545H98.6921C98.7666 30.3545 98.8225 30.3735 98.856 30.4114C98.8858 30.4532 98.9044 30.5177 98.9044 30.6089V42.1811C98.9044 42.4051 99.0013 42.5152 99.195 42.5152H101.963C102.182 42.5152 102.294 42.3899 102.294 42.1393V30.5519C102.294 30.419 102.365 30.3545 102.507 30.3545H106.127C106.362 30.3545 106.477 30.2558 106.477 30.0583V28.2208C106.477 27.9854 106.347 27.8677 106.09 27.8677H94.9708C94.8553 27.8677 94.7622 27.898 94.6914 27.9664C94.6207 28.0309 94.5834 28.1145 94.5834 28.2208ZM107.483 42.1811C107.483 42.4051 107.58 42.5152 107.774 42.5152H110.001C110.195 42.5152 110.333 42.4279 110.411 42.257L111.435 39.3374C111.476 39.2045 111.558 39.14 111.689 39.14H116.416C116.49 39.14 116.546 39.1551 116.58 39.1893C116.609 39.2197 116.639 39.2766 116.665 39.3564L117.675 42.238C117.723 42.4241 117.846 42.5152 118.04 42.5152H120.889C120.979 42.5152 121.046 42.481 121.091 42.4165C121.139 42.3519 121.161 42.2646 121.161 42.1583C121.161 42.1203 121.146 42.0596 121.12 41.9837L116.337 28.3005C116.297 28.1676 116.226 28.0651 116.125 27.9854C116.021 27.9056 115.898 27.8677 115.756 27.8677H112.851C112.709 27.8677 112.601 27.8943 112.531 27.955C112.46 28.0157 112.396 28.1145 112.348 28.2625L107.524 41.9419C107.498 41.995 107.483 42.0748 107.483 42.1811ZM115.619 36.5127H112.445C112.3 36.5127 112.229 36.4595 112.229 36.357C112.229 36.3152 112.244 36.2583 112.27 36.1786L113.916 31.577C113.953 31.4859 113.994 31.4403 114.032 31.4403C114.084 31.4403 114.129 31.4783 114.166 31.558L115.794 36.1786C115.809 36.2165 115.812 36.2773 115.812 36.357C115.812 36.4595 115.749 36.5127 115.619 36.5127Z" fill="white"/>
                <path d="M130.225 42.5275C131.297 43.1046 132.4 43.3932 133.532 43.3932C134.587 43.3932 135.51 43.2147 136.304 42.8502C137.097 42.4896 137.704 41.9884 138.125 41.3392C138.55 40.6937 138.762 39.9496 138.762 39.1029C138.762 37.7323 138.326 36.6731 137.459 35.9175C136.591 35.1658 135.373 34.5735 133.804 34.1407C132.474 33.818 131.532 33.4231 130.973 32.9523C130.415 32.4854 130.135 31.8475 130.135 31.0502C130.135 30.2643 130.437 29.6455 131.04 29.1937C131.644 28.7381 132.422 28.5103 133.372 28.5103C134.277 28.5103 135.056 28.6925 135.704 29.0532C136.352 29.4139 136.948 29.972 137.492 30.7275L138.829 29.5733C138.118 28.6811 137.317 28.0205 136.419 27.5877C135.518 27.1586 134.505 26.9422 133.372 26.9422C131.819 26.9422 130.604 27.3105 129.729 28.0509C128.854 28.7874 128.414 29.8429 128.414 31.2097C128.414 33.4117 130.046 34.919 133.305 35.7353C134.601 36.1036 135.551 36.5288 136.147 37.0148C136.743 37.4969 137.041 38.1955 137.041 39.1029C137.041 39.9344 136.762 40.5912 136.203 41.0734C135.644 41.5594 134.829 41.8024 133.756 41.8024C132.776 41.8024 131.864 41.5442 131.018 41.0278C130.172 40.5153 129.48 39.8167 128.936 38.9397L127.554 40.185C128.265 41.1721 129.155 41.9504 130.225 42.5275ZM153.431 43.0249H155.015L149.379 27.2877H147.792L142.316 43.0249H144.015L145.438 38.617H151.845L153.431 43.0249ZM145.959 37.1856L148.563 29.5505L151.327 37.1856H145.959ZM168.939 43.0249H170.522L164.886 27.2877H163.303L157.823 43.0249H159.522L160.948 38.617H167.352L168.939 43.0249ZM161.466 37.1856L164.07 29.5505L166.834 37.1856H161.466ZM176.702 42.5275C177.774 43.1046 178.877 43.3932 180.009 43.3932C181.064 43.3932 181.991 43.2147 182.781 42.8502C183.574 42.4896 184.181 41.9884 184.606 41.3392C185.027 40.6937 185.239 39.9496 185.239 39.1029C185.239 37.7323 184.803 36.6731 183.936 35.9175C183.068 35.1658 181.85 34.5735 180.281 34.1407C178.951 33.818 178.009 33.4231 177.45 32.9523C176.892 32.4854 176.612 31.8475 176.612 31.0502C176.612 30.2643 176.914 29.6455 177.517 29.1937C178.121 28.7381 178.899 28.5103 179.849 28.5103C180.754 28.5103 181.533 28.6925 182.181 29.0532C182.829 29.4139 183.425 29.972 183.969 30.7275L185.306 29.5733C184.595 28.6811 183.794 28.0205 182.896 27.5877C181.999 27.1586 180.982 26.9422 179.849 26.9422C178.296 26.9422 177.082 27.3105 176.206 28.0509C175.331 28.7874 174.891 29.8429 174.891 31.2097C174.891 33.4117 176.523 34.919 179.782 35.7353C181.078 36.1036 182.028 36.5288 182.624 37.0148C183.22 37.4969 183.518 38.1955 183.518 39.1029C183.518 39.9344 183.239 40.5912 182.68 41.0734C182.121 41.5594 181.306 41.8024 180.237 41.8024C179.253 41.8024 178.341 41.5442 177.495 41.0278C176.649 40.5153 175.957 39.8167 175.413 38.9397L174.031 40.185C174.742 41.1721 175.632 41.9504 176.702 42.5275Z" fill="black"/>
              </g>
              <defs>
                <clipPath id="clip0_157_1895">
                  <rect width="186" height="70" fill="white"/>
                </clipPath>
              </defs>
            </svg>
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
