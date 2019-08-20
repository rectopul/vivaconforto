<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vivaconforto
 */

get_header(); ?>	
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 slide-simple" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/images/-image-slide.jpg')">
            <img src="<?php bloginfo('template_url'); ?>/assets/images/-image-slide.jpg" alt="Slide 1" style="visibility:hidden">
        </div>
    </div>
</div>

<div class="container">
    <div class="row no-gutters slid-contact">
        <!-- SLIDER LOGOS -->
        <div class="col-sm-12 col-md-6 slide-parceiros">            
            <!-- Swiper -->
            <div class="swiper-container slider-partners mail-and-partners">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-1.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-2.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-3.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-4.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-2.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-4.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-1.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/logo-3.jpg" class="align-middle mx-auto d-block" alt="..."></div>
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next arrow-next"></div>
            <div class="swiper-button-prev arrow-prev"></div>
        </div>
        <!-- mail contact -->
        <div class="col-sm-12 col-md-6 form-mail-news">
            <div class="cont-news">
                <div class="col-sm-12 col-md-6">
                    <img src="<?php bloginfo( 'template_url' );?>/assets/images/news-letter.png" alt="mail-vivaconforto" align="left">
                    Receba Nossas <br>
                    Novidades e Ofertas
                </div>
                <div class="col-sm-12 col-md-6">
                    <form action="">
                        <input type="email" name="mail-news" id="mail-news" placeholder="Digite o seu e-mail">
                        <button></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Indica -->
    <div class="row">
        <div class="col-md-12 text-indic">
            <h1>Viva Conforto Indica</h1>
            <p><small>Produtos escolhidos a dedos para você</small></p>
        </div>
    </div>
    <!-- //.prod-slide-selling .prod-slide-outlet -->
    <div class="row indica">
        <div class="left-trans prev1">Prev</div>
        <div class="right-trans next1">next</div>
        <div class="cont-slide prod-slide swiper-container">
            <div class="col-md-12 swiper-wrapper">
                <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'orderby' => 'rand'
                    );
                    $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        echo '<!-- Produtos -->';
                        while ( $loop->have_posts() ) : $loop->the_post();                    
                            echo '<div class="swiper-slide list-products-indic">';
                            wc_get_template_part( 'content', 'product' );
                            echo '</div>';
                        endwhile;
                    } else {
                        echo __( 'Não há produtos disponíveis no momento' );
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>

    <!-- Mini imagens -->
    <div class="row min-img bord-bottom">
        <div class="col-md-12">
            <!-- Swiper -->
            <div class="swiper-container slider-min-img">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/custom/slider-confort-1.jpg" alt="Lorem Pixel"></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/custom/slider-confort-2.jpg" alt="Lorem Pixel"></div>
                    <div class="swiper-slide"><img src="<?php bloginfo( 'template_url' );?>/assets/images/custom/slider-confort-3.png" alt="Lorem Pixel"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mais Vendidos -->
    <div class="row">
        <div class="col-md-12 text-indic">
            <h1>Mais Vendidos</h1>
            <p><small>Os produtos que todo mundo leva pra casa</small></p>
        </div>
    </div>

    <div class="row indica bord-bottom ">
        <div class="left-trans prev2">Prev</div>
        <div class="right-trans next2">next</div>
        <div class="cont-slide prod-slide-selling swiper-container">
            <div class="col-md-12 swiper-wrapper">
                <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'orderby' => 'rand'
                    );
                    $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        echo '<!-- Produtos -->';
                        while ( $loop->have_posts() ) : $loop->the_post();                    
                            echo '<div class="swiper-slide list-products-indic">';
                            wc_get_template_part( 'content', 'product' );
                            echo '</div>';
                        endwhile;
                    } else {
                        echo __( 'Não há produtos disponíveis no momento' );
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>

    <!-- Outlet -->
    <div class="row">
        <div class="col-md-12 text-indic">
            <h1>Outlet</h1>
            <p><small>Preços incríveis para levar agora</small></p>
        </div>
    </div>

    <div class="row indica bord-bottom ">
        <div class="left-trans prev3">Prev</div>
        <div class="right-trans next3 ">next</div>
        <div class="cont-slide prod-slide-outlet  swiper-container">
            <div class="col-md-12 swiper-wrapper">
                <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'orderby' => 'rand'
                    );
                    $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        echo '<!-- Produtos -->';
                        while ( $loop->have_posts() ) : $loop->the_post();                    
                            echo '<div class="swiper-slide list-products-indic">';
                            wc_get_template_part( 'content', 'product' );
                            echo '</div>';
                        endwhile;
                    } else {
                        echo __( 'Não há produtos disponíveis no momento' );
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
    <!-- Informaçoes de entrega e pagamento -->    
    <div class="row payment-tip">
        <div class="col-12">
            <div class=""><img src="<?php echo bloginfo( 'template_url' ); ?>/assets/images/boleto.png" alt="Boleto viva conforto"> Desconto de 5% no boleto </div>
            <div class=""><img src="<?php echo bloginfo( 'template_url' ); ?>/assets/images/cards.png" alt="cards viva conforto"> Parcelamos em 3x sem juros </div>
            <div class=""><img src="<?php echo bloginfo( 'template_url' ); ?>/assets/images/truck.png" alt="truck viva conforto"> Entregamos em Todo Brasil </div>
            <div class=""><img src="<?php echo bloginfo( 'template_url' ); ?>/assets/images/padlock.png" alt="parlock viva conforto"> Compra 100% segura </div>
        </div>
    </div>
</div>
<?php
get_footer();
