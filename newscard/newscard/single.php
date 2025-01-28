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

<section class="newsletter-section preto">
    <div class="container newsletter-container">
        <div class="newsletter-content preto">
            <svg xmlns="http://www.w3.org/2000/svg" width="146" height="54" viewBox="0 0 146 54" fill="none">
              <path d="M0 0H53.0261V2.35672H0V0ZM0 0H2.35672V53.0261H0V0ZM53.0261 53.0261H0V50.6694H53.0261V53.0261ZM53.0261 53.0261H50.6694V42.4209H53.0261V53.0261ZM53.0261 10.6052H50.6694V0H53.0261V10.6052Z" fill="white"/>
              <path d="M10.0156 17.7609H97.1297V35.1476H10.0156V17.7609Z" fill="white"/>
              <path d="M19.1965 21.2678C18.5455 20.9732 17.8296 20.8259 17.0519 20.8259C16.0002 20.8259 15.0841 21.0557 14.3034 21.5212C13.5227 21.9866 12.9218 22.6524 12.5034 23.5214C12.0851 24.3875 11.876 25.4038 11.876 26.5704C11.876 27.7429 12.0851 28.7769 12.5034 29.6725C12.9218 30.5651 13.5227 31.2603 14.3034 31.7552C15.0841 32.2501 16.0002 32.4976 17.0519 32.4976C17.9917 32.4976 18.7988 32.309 19.4734 31.932C20.148 31.5519 20.6695 31.11 21.0436 30.5975C21.4177 30.0878 21.6534 29.6135 21.7565 29.1746C21.786 28.9684 21.73 28.8417 21.5886 28.7916L20.0862 28.4676C20.0567 28.4587 20.0096 28.4529 19.9477 28.4529C19.8476 28.4529 19.7798 28.4882 19.7504 28.5618C19.4823 29.2541 19.1376 29.7549 18.7163 30.0613C18.2921 30.3677 17.7737 30.5209 17.1609 30.5209C16.3243 30.5209 15.6997 30.2086 15.2903 29.587C14.8837 28.9654 14.6775 27.9727 14.6775 26.6146C14.6775 24.0016 15.4965 22.6936 17.1285 22.6936C17.6912 22.6936 18.1419 22.8556 18.4777 23.1826C18.8136 23.5096 19.0404 23.9545 19.1523 24.5171C19.173 24.6085 19.1965 24.6703 19.2201 24.6998C19.2466 24.7322 19.3055 24.7469 19.3968 24.7469L21.4649 24.6085C21.5267 24.5996 21.5709 24.5819 21.6033 24.5613C21.6328 24.5407 21.6475 24.5024 21.6475 24.4405C21.6475 24.3492 21.6387 24.2667 21.618 24.196C21.5061 23.5627 21.238 22.9912 20.8138 22.4786C20.3896 21.9689 19.8505 21.5653 19.1965 21.2678ZM26.9884 31.7994C27.7779 32.2648 28.7118 32.4976 29.7841 32.4976C30.8446 32.4976 31.7696 32.2619 32.5562 31.7935C33.3427 31.3222 33.9466 30.6505 34.3708 29.7785C34.795 28.9065 35.0071 27.8755 35.0071 26.6912C35.0071 25.4981 34.7921 24.4582 34.362 23.5744C33.9348 22.6907 33.328 22.0131 32.5414 21.5359C31.7549 21.0616 30.8358 20.8259 29.7841 20.8259C28.7206 20.8259 27.7926 21.0616 27.0031 21.5359C26.2107 22.0131 25.6009 22.6907 25.1708 23.5744C24.7436 24.4582 24.5286 25.5011 24.5286 26.7059C24.5286 27.902 24.7407 28.933 25.1649 29.8021C25.5891 30.6682 26.196 31.3369 26.9884 31.7994ZM31.6282 29.6931C31.2452 30.3058 30.6295 30.6122 29.7841 30.6122C28.9239 30.6122 28.3023 30.3058 27.9134 29.6931C27.5246 29.0803 27.3331 28.0905 27.3331 26.7236C27.3331 25.3243 27.5275 24.3021 27.9223 23.6599C28.3141 23.0147 28.9357 22.6936 29.7841 22.6936C30.6089 22.6936 31.2217 23.0147 31.6135 23.6599C32.0053 24.3021 32.2026 25.3243 32.2026 26.7236C32.2026 28.0905 32.0112 29.0803 31.6282 29.6931ZM47.5832 20.9791H45.8834C45.6978 20.9791 45.6065 21.0704 45.6065 21.2531V27.5809C45.6065 27.6928 45.5829 27.7488 45.5299 27.7488C45.4886 27.7488 45.4386 27.7075 45.3767 27.6251L40.8724 21.2089C40.8017 21.1058 40.7399 21.041 40.6898 21.0174C40.6397 20.9909 40.5513 20.9791 40.4305 20.9791H38.5746C38.392 20.9791 38.3007 21.0763 38.3007 21.2678V32.0851C38.3007 32.2589 38.4008 32.3444 38.607 32.3444H40.2008C40.3127 32.3444 40.3922 32.3267 40.4364 32.2914C40.4836 32.256 40.5071 32.1971 40.5071 32.1146V32.0675V25.3273C40.5071 25.2772 40.5248 25.2477 40.5602 25.2359C40.5955 25.2271 40.6338 25.2477 40.675 25.2978L45.5623 32.1617C45.6212 32.2413 45.6772 32.2943 45.7302 32.3149C45.7803 32.3355 45.851 32.3444 45.9452 32.3444H47.4918C47.5743 32.3444 47.6421 32.3208 47.6981 32.2766C47.754 32.2295 47.7835 32.1706 47.7835 32.0999V21.2089C47.7835 21.0557 47.7157 20.9791 47.5832 20.9791ZM51.7045 20.9791C51.5395 20.9791 51.46 21.0763 51.46 21.2678V32.0233C51.46 32.1352 51.4835 32.2177 51.5366 32.2678C51.5866 32.3179 51.6721 32.3444 51.7958 32.3444H59.517C59.7203 32.3444 59.8234 32.2531 59.8234 32.0675V30.6122C59.8234 30.459 59.732 30.3824 59.5464 30.3824H54.3086C54.2468 30.3824 54.2026 30.3677 54.179 30.3382C54.1525 30.3058 54.1407 30.2557 54.1407 30.185V27.7782C54.1407 27.6575 54.2114 27.5956 54.3528 27.5956H57.6316C57.7966 27.5956 57.8761 27.5249 57.8761 27.3805V25.9105C57.8761 25.7485 57.7907 25.666 57.6169 25.666H54.3705C54.2173 25.666 54.1407 25.5777 54.1407 25.4038V23.1826C54.1407 23.0206 54.2379 22.9381 54.4294 22.9381H59.3167C59.5317 22.9381 59.6378 22.8321 59.6378 22.617L59.6554 21.2384C59.6554 21.0645 59.5789 20.9791 59.4257 20.9791H51.7045ZM69.1059 21.2678C68.4519 20.9732 67.736 20.8259 66.9613 20.8259C65.9096 20.8259 64.9934 21.0557 64.2127 21.5212C63.4291 21.9866 62.8311 22.6524 62.4128 23.5214C61.9915 24.3875 61.7824 25.4038 61.7824 26.5704C61.7824 27.7429 61.9915 28.7769 62.4128 29.6725C62.8311 30.5651 63.4291 31.2603 64.2127 31.7552C64.9934 32.2501 65.9096 32.4976 66.9613 32.4976C67.901 32.4976 68.7082 32.309 69.3828 31.932C70.0545 31.5519 70.5788 31.11 70.9529 30.5975C71.3241 30.0878 71.5628 29.6135 71.6629 29.1746C71.6953 28.9684 71.6393 28.8417 71.495 28.7916L69.9955 28.4676C69.9631 28.4587 69.9189 28.4529 69.8571 28.4529C69.754 28.4529 69.6892 28.4882 69.6568 28.5618C69.3916 29.2541 69.047 29.7549 68.6228 30.0613C68.1985 30.3677 67.6801 30.5209 67.0673 30.5209C66.2307 30.5209 65.6091 30.2086 65.1996 29.587C64.7901 28.9654 64.5869 27.9727 64.5869 26.6146C64.5869 24.0016 65.4029 22.6936 67.0379 22.6936C67.6005 22.6936 68.0483 22.8556 68.3871 23.1826C68.7229 23.5096 68.9468 23.9545 69.0587 24.5171C69.0794 24.6085 69.1029 24.6703 69.1294 24.6998C69.153 24.7322 69.2119 24.7469 69.3062 24.7469L71.3742 24.6085C71.4331 24.5996 71.4803 24.5819 71.5097 24.5613C71.5421 24.5407 71.5569 24.5024 71.5569 24.4405C71.5569 24.3492 71.548 24.2667 71.5274 24.196C71.4125 23.5627 71.1444 22.9912 70.7232 22.4786C70.299 21.9689 69.7599 21.5653 69.1059 21.2678ZM74.2524 21.2531V22.6789C74.2524 22.8321 74.3496 22.9087 74.544 22.9087H77.5017C77.5606 22.9087 77.6048 22.9234 77.6313 22.9529C77.6549 22.9853 77.6696 23.0353 77.6696 23.1061V32.0851C77.6696 32.2589 77.7462 32.3444 77.8994 32.3444H80.0882C80.262 32.3444 80.3504 32.2472 80.3504 32.0527V23.0619C80.3504 22.9588 80.4063 22.9087 80.5183 22.9087H83.3817C83.5673 22.9087 83.6586 22.8321 83.6586 22.6789V21.2531C83.6586 21.0704 83.5555 20.9791 83.3522 20.9791H74.5587C74.4674 20.9791 74.3938 21.0027 74.3378 21.0557C74.2818 21.1058 74.2524 21.1706 74.2524 21.2531ZM84.454 32.0851C84.454 32.2589 84.5306 32.3444 84.6838 32.3444H86.4454C86.5986 32.3444 86.7076 32.2766 86.7695 32.1441L87.5796 29.8787C87.612 29.7756 87.6768 29.7255 87.7799 29.7255H91.5182C91.5772 29.7255 91.6213 29.7373 91.6479 29.7638C91.6714 29.7873 91.695 29.8315 91.7156 29.8934L92.514 32.1293C92.5522 32.2737 92.6495 32.3444 92.8027 32.3444H95.0563C95.127 32.3444 95.18 32.3179 95.2153 32.2678C95.2536 32.2177 95.2713 32.15 95.2713 32.0675C95.2713 32.038 95.2595 31.9909 95.2389 31.932L91.4564 21.3149C91.424 21.2118 91.368 21.1323 91.2885 21.0704C91.206 21.0086 91.1088 20.9791 90.9968 20.9791H88.699C88.5871 20.9791 88.5016 20.9997 88.4457 21.0469C88.3897 21.094 88.3396 21.1706 88.3013 21.2855L84.4864 31.8995C84.4658 31.9408 84.454 32.0027 84.454 32.0851ZM90.8878 27.6869H88.3779C88.263 27.6869 88.2071 27.6457 88.2071 27.5661C88.2071 27.5337 88.2188 27.4895 88.2395 27.4277L89.5416 23.8573C89.571 23.7866 89.6034 23.7512 89.6329 23.7512C89.6741 23.7512 89.7095 23.7807 89.7389 23.8425L91.0263 27.4277C91.0381 27.4571 91.041 27.5043 91.041 27.5661C91.041 27.6457 90.9909 27.6869 90.8878 27.6869Z" fill="#333333"/>
              <path d="M102.438 32.3541C103.287 32.8019 104.159 33.0258 105.054 33.0258C105.888 33.0258 106.619 32.8873 107.246 32.6045C107.874 32.3247 108.354 31.9358 108.687 31.4321C109.022 30.9313 109.19 30.3539 109.19 29.6969C109.19 28.6335 108.846 27.8116 108.159 27.2253C107.473 26.642 106.51 26.1825 105.269 25.8466C104.218 25.5962 103.472 25.2899 103.031 24.9246C102.589 24.5622 102.368 24.0673 102.368 23.4487C102.368 22.8389 102.606 22.3587 103.084 22.0081C103.561 21.6546 104.176 21.4779 104.928 21.4779C105.644 21.4779 106.259 21.6193 106.772 21.8991C107.284 22.179 107.756 22.6121 108.186 23.1983L109.243 22.3027C108.681 21.6105 108.047 21.0979 107.337 20.762C106.624 20.4291 105.823 20.2612 104.928 20.2612C103.699 20.2612 102.739 20.547 102.047 21.1214C101.354 21.6929 101.007 22.5119 101.007 23.5724C101.007 25.281 102.297 26.4506 104.875 27.0839C105.9 27.3697 106.651 27.6996 107.122 28.0767C107.594 28.4508 107.829 28.9929 107.829 29.6969C107.829 30.3421 107.608 30.8517 107.167 31.2259C106.725 31.6029 106.08 31.7915 105.231 31.7915C104.456 31.7915 103.735 31.5911 103.066 31.1905C102.397 30.7928 101.849 30.2508 101.419 29.5703L100.326 30.5365C100.889 31.3024 101.593 31.9064 102.438 32.3541ZM120.791 32.74H122.043L117.586 20.5293H116.331L112.001 32.74H113.344L114.469 29.3199H119.536L120.791 32.74ZM114.882 28.2093L116.941 22.2851L119.127 28.2093H114.882ZM133.055 32.74H134.307L129.85 20.5293H128.598L124.265 32.74H125.608L126.736 29.3199H131.8L133.055 32.74ZM127.146 28.2093L129.205 22.2851L131.391 28.2093H127.146ZM139.194 32.3541C140.043 32.8019 140.915 33.0258 141.81 33.0258C142.644 33.0258 143.377 32.8873 144.002 32.6045C144.629 32.3247 145.11 31.9358 145.446 31.4321C145.778 30.9313 145.946 30.3539 145.946 29.6969C145.946 28.6335 145.602 27.8116 144.915 27.2253C144.229 26.642 143.266 26.1825 142.025 25.8466C140.974 25.5962 140.228 25.2899 139.786 24.9246C139.345 24.5622 139.124 24.0673 139.124 23.4487C139.124 22.8389 139.362 22.3587 139.839 22.0081C140.317 21.6546 140.932 21.4779 141.684 21.4779C142.399 21.4779 143.015 21.6193 143.528 21.8991C144.04 22.179 144.512 22.6121 144.942 23.1983L145.999 22.3027C145.437 21.6105 144.803 21.0979 144.093 20.762C143.383 20.4291 142.579 20.2612 141.684 20.2612C140.455 20.2612 139.495 20.547 138.803 21.1214C138.11 21.6929 137.763 22.5119 137.763 23.5724C137.763 25.281 139.053 26.4506 141.631 27.0839C142.656 27.3697 143.407 27.6996 143.878 28.0767C144.35 28.4508 144.585 28.9929 144.585 29.6969C144.585 30.3421 144.364 30.8517 143.922 31.2259C143.481 31.6029 142.835 31.7915 141.99 31.7915C141.212 31.7915 140.491 31.5911 139.822 31.1905C139.153 30.7928 138.605 30.2508 138.175 29.5703L137.082 30.5365C137.645 31.3024 138.349 31.9064 139.194 32.3541Z" fill="white"/>
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
                <button type="submit" class="newsletter-button preto">Cadastrar</button>
            </form>
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
