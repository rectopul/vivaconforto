<?php
// Opçoes do tema
load_template( get_template_directory() . '/inc/rmb_options_theme.php' );

//ENQUEUE SCRIPTS
function rob_scripts_theme() {
	//Get Jquery
	wp_enqueue_script('jquery');
	//Get Styles CSS
	wp_enqueue_style('style', get_stylesheet_uri(), false, '0.0.1');
	//Get Bootstrap CSS
	wp_enqueue_style('Bootstrap', get_template_directory_uri() . '/assets/css/base/bootstrap.min.css', false, '4.3.1');
	//Get Bootstrap JS
	wp_enqueue_script('Bootstrap JS', get_template_directory_uri(). '/assets/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
	//Get Swiper CSS
	wp_enqueue_style('Swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', false, '4.5.0');
	//Get Swiper JS
	wp_enqueue_script('Swiper JS', get_template_directory_uri(). '/assets/js/swiper.min.js', array('jquery'), '4.5.0', true);
 	//Fonts
	wp_enqueue_style('Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap', false);

	//Javascripts
	wp_enqueue_script('Efeitos', get_template_directory_uri(). '/assets/js/effects.js', array('jquery'), '0.0.1', true);	
}

add_action('wp_enqueue_scripts', 'rob_scripts_theme');

//HOOK DE FRETE GRÁTIS
function my_wc_free_shipping_by_shipping_class( $rates, $package ) {
	$shipping_class = 'entrega-gratuita'; // Slug da sua classe de entrega.
	$allow_free_shipping = true;
	// Verifica se todos os produtos precisam ser entregues e se possuem a class de entrega selecionada.
	foreach ( $package['contents'] as $value ) {
		$product = $value['data'];
		if ( $product->needs_shipping() && $shipping_class !== $product->get_shipping_class() ) {
			$allow_free_shipping = false;
			break;
		}
	}
	// Remove a entrega gratuita se algum produto não possuir a classe de entrega selecionada.
	if ( ! $allow_free_shipping ) {
		foreach ( $rates as $rate_id => $rate ) {
			if ( 'free_shipping' === $rate->method_id ) {
				unset( $rates[ $rate_id ] );
				break;
			}
		}
	}
	return $rates;
}
add_filter( 'woocommerce_package_rates', 'my_wc_free_shipping_by_shipping_class', 100, 2 );

//Hook Sale Badge

add_filter( 'woocommerce_sale_flash', 'wc_custom_replace_sale_text' );
function wc_custom_replace_sale_text( $html ) {
	global $product;
    if( $product->is_on_sale() ) {
		
		//var_dump($arr_prices);
    }
	$saleprice = $product->get_sale_price();
	$regularprice = $product->get_regular_price();

	$arr_prices = array(
		'sale' => $product->get_sale_price(),
		'regular' => $product->get_regular_price(),
		'percent' => substr((($product->get_regular_price()/$product->get_sale_price())-1)*100, 0, 2)
	);
	//var_dump($arr_prices['percent']);
	return str_replace( __( 'Sale!', 'woocommerce' ), __( '-'.$arr_prices['percent'].'%', 'woocommerce' ), $html );
}


//Configuraçoes do tema
function rmb_theme_setup(){
//Hide admin bar
	show_admin_bar (false);
// Default RSS feed links
    add_theme_support('automatic-feed-links');
//WOOCOMMERCE support
    add_theme_support('woocommerce');
//Post Formats
	// Enable support for Post Formats
	add_theme_support('post-formats', array(
		'audio', 'gallery', 'link', 'quote', 'video'
	));
//Custom logo
   add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
//IMAGES
	// Add post thumbnail functionality
    // Square sizes
    add_theme_support('post-thumbnails');
    add_image_size('medium', 300, 300, true);
    add_image_size('large', 640, 640, true);
    add_image_size('x-large', 960, 960, true);
    // Landscape sizes
    add_image_size('product-preview', 260, 212, false);
    add_image_size('mini-preview', 360, 300, true);
	add_image_size('full-banner', 1920, 430, true);

// Registra Menus de Navegação
	register_nav_menus( array(
		'primary' => 'Primary Navigation',
        'user'    => 'Opçoes de acesso ao Usuário',
		'cat'  	  => 'Categorias Navigation',
		'inst' 	  => 'Institucionais',
		'help' 	  => 'Ajuda',
		'mobile'  => 'Menu para dispositivos móveis'
	));

//Support Custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 190,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	));
//Cabeçalho personalizado
	add_theme_support( 'custom-header', apply_filters( 'twentysixteen_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 1200,
		'height'                 => 280,
		'flex-height'            => true,
		'wp-head-callback'       => '',
	)));
	
//Others
	// Add html editor css styles
    add_editor_style( array( 'css/icons.css', 'css/editor.css' ) );
    
    // This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}

add_action('after_setup_theme', 'rmb_theme_setup');

//REQUIRE WOOCOMMERCE HOOKS
require('inc/woocommerce-single-product.php');


#ADD AVATAR PROFILE IN USER MENU
add_filter('wp_nav_menu_items','add_custom_in_menu', 10, 2);

function add_custom_in_menu( $items, $args ) 
{
    if( $args->theme_location == 'user' &&  $items ) // only for primary menu
    {
		$items_array = array();
		while ( false !== ( $item_pos = strpos ( $items, '<li', 3 ) ) )
		{
			$items_array[] = substr($items, 0, $item_pos);
			$items = substr($items, $item_pos);
		}
		$items_array[] = $items;
		array_splice($items_array, 0, 0, '<li><span class="profile-menu"></span></li>'); // insert custom item after 2nd one

		$items = implode('', $items_array);
    }
    return $items;
}

# ITEM ADICIONAIS LAST POSITION MAIN MENU
add_filter( 'wp_nav_menu_items', 'nav_menu_search', 10, 2 );
function nav_menu_search($items, $args) {
	# var_dump($args);
    if( 'cat' === $args->theme_location ){
    	$items .= '<li class="menu-item complete-menu">Menu completo';
		$locations = get_nav_menu_locations();
		$mn_terms = get_term( $locations['cat'], 'nav_menu' );
		$menu_objects = wp_get_nav_menu_items($mn_terms->term_id);
		$items .= '<ul class="menu-item-allcat">';

		foreach ($menu_objects as $key => $value) {
			# code...			

			if( $menu_objects[$key]->menu_item_parent == 0 ){
				$start_lvl;
				$end_lvl;
				$idp;
				$items .= sprintf('<li class="item-menu-allcat %s"><a href="%s">%s</a>',
					( $menu_objects[$key]->classes ) ? implode(' ', $menu_objects[$key]->classes) : '',
					$menu_objects[$key]->url,
					$menu_objects[$key]->title
				);

				foreach( $menu_objects as $i => $v ){
					if( $menu_objects[$i]->menu_item_parent == $menu_objects[$key]->ID ){
						$start_lvl = '<ul>'; $end_lvl = '</ul>'; $idp = $menu_objects[$i]->ID;
					}
				}
				
				$items .= $start_lvl;
	
				foreach( $menu_objects as $c => $v2 ){
					if( $menu_objects[$c]->menu_item_parent == $menu_objects[$key]->ID ){
						$items .= sprintf('<li class="childres-menu-allitem %s"><a href="%s">%s</a></li>',
							( $menu_objects[$c]->classes ) ? implode(' ', $menu_objects[$c]->classes) : '',
							$menu_objects[$c]->url,
							$menu_objects[$c]->title
						);
					}
				}
	
				$items .= $end_lvl;
				$start_lvl = '';
				$end_lvl = '';
			}
			$items .= '</li>';
		}
		$items .= '</ul></li>';
		#print_r($menu_objects);
	}

	return $items;
}

# SHOP CART
add_shortcode('woo_cart_but', 'woo_cart_but' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; # Set variable for cart item count
		$cart_url = wc_get_cart_url();  # Set Cart URL
		var_dump($cart_count);
		
        echo '<li><span class="separator">|</span><span class="bagshop"></span><a class="menu-item cart-contents" href="'.$cart_url.'" title="My Basket">';
		
		if ( $cart_count >= 0 ) {
			echo '<span class="cart-contents-count">'.$cart_count.'</span>';
		}
        echo '</a></li>';
	        
	return ob_get_clean();	
}

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="menu-item cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('<span class="cart-contents-count">%d</span>', '<span class="cart-contents-count">%d</span>',
		$woocommerce->cart->cart_contents_count, 'woothemes'),
		$woocommerce->cart->cart_contents_count);?>
	</a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

class img_sub extends Walker_Nav_Menu {	
    function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		# code...	
	#START MENU		
		if ( array_search( 'menu-item-has-children', $item->classes ? $item->classes : 0 ) ) {
			$cat_id   = $item->object_id;
			global $_wp_additional_image_sizes;
			$thumbnail_id = get_woocommerce_term_meta( $cat_id, 'thumbnail_id', true ); // Get Category Thumbnail
			#var_dump($attrachment);
			$attrachment = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
			$if_image .= wp_get_attachment_url( $thumbnail_id ); 
			if ( $attrachment ) {
				# code...
				$output .= sprintf( "\n<li class='has-image %s' data-image='%s'><a href='%s'>%s</a><ul\n",
					( $item->classes ) ? implode(' ', $item->classes) : '', 
					$attrachment[0],
					$item->url,
					$item->title					
				);
			}else {
				$output .= sprintf( "\n<li class='not-image %s'><a href='%s'>%s</a><ul\n",
					( $item->classes ) ? implode(' ', $item->classes) : '',
					$item->url,
					$item->title
				);
			}
		}else {
			$output .= sprintf("\n<li class='%s'><a href='%s'>%s</a>\n",
				( $item->classes ) ? implode(' ', $item->classes): '',
				$item->url, 
				$item->title
			);
		}
	}
#Start Submenu
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		#$output .= '<div class="content-left"><ul class=\'sub-menu\' role=\'menu\'>';
		$indent = str_repeat("\t", $depth);
		#print_r($depth);
        $output .= "\n$indent class='sub-menu' role='menu'><div class='content-left'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n </div></ul>\n";
	}
}