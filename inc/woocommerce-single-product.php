<?php
    // Remove default wrappers.
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

    // Add custom wrappers.
    add_action( 'woocommerce_before_main_content', 'before_rgb_single_product' );
    add_action( 'woocommerce_after_main_content', 'after_rgb_single_product' );

    function before_rgb_single_product(){
        echo '<div class="container"><div class="row">';
    }

    function after_rgb_single_product(){
        echo '</div></div>"';
    }

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    add_action( 'woocommerce_single_product_summary', 'rgb_single_product_price', 10 );
    function rgb_single_product_price(){
        global $product;
        $price_output = '<span class="price">';
            if( $product->sale_price ){
                $price_output .= sprintf( '<del class="regular_single_price">%s</del><ins class="sale-price-single">%s</ins>',
                    $product->regular_price,
                    $product->sale_price
                );
            }else{
                $price_output .= sprintf( '<ins class="regular_single_price">%s</ins>',
                    $product->regular_price
                );
            }
        $price_output .= '</span>';
        echo $price_output;
    }

    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );