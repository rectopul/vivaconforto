<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php wp_title('-',true,'right');?></title>
	<script> 
		var url_directory = "<?php bloginfo('template_url'); ?>"; 
	</script>
	<?php 
	    /* Always have wp_head() just before the closing </head>
	     * tag of your theme, or you will break many plugins, which
	     * generally use this hook to add elements to <head> such
	     * as styles, scripts, and meta tags.
	     */
	    wp_head();
	?>
</head>

<body <?php body_class(); ?>>
<div class="container">
	<div class="row header-main-theme">
		<!-- CUSTOM LOGO -->
		<div class="col-md-3 custom-logo">
			<div class="row">
			<?php
				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
					echo get_custom_logo();
				}else{
					echo 'Selecione o logo de sua loja';
				}
			?>
			</div>
		</div>

		<div class="all-menus-mobile">
			<!-- TODOS OS MENUS -->
			<span class="button-menu-mobile">
				<span></span>
				<span></span>
				<span></span>
			</span>
			<article class="container-menu-mobile">
				<header class="welcome">
					Bem vindo!
					
					<span class="xis">
						<span></span>
					</span>
					<?php 
						wp_nav_menu( array(
							'theme_location'  => 'user',
							'sort_column'     => 'menu_order',
							'container'       => 'nav',
							'container_class' => '',
							'menu_class' 	  => '',
							'after'		  	  => '<span class="separ"></span>'
						) );
					?>
				</header>
				<?php 
					wp_nav_menu( array(
						'theme_location'  => 'mobile',
						'sort_column'     => 'menu_order',
						'container'       => 'nav',
						'container_class' => 'mobile-menu-itens',
						'menu_class' 	  => ' ',
					) );
				?>
			</article>			
		</div>
		<!-- MENU DE NAVEGAÇÃO -->
		<?php
			wp_nav_menu( array(
				'theme_location'  => 'user',
				'sort_column'     => 'menu_order',
				'container'       => 'nav',
				'container_class' => 'col-xs-3 col-md-3 menu-container menu-hover-effect',
				'menu_class' 	  => 'menu-user-flex',
				'after'		  	  => '/',
				'before'          => '<span class="helcome">Bem Vindo!</span>'
			) );

			wp_nav_menu( array(
				'theme_location'  => 'primary',
				'sort_column'     => 'menu_order',
				'container'       => 'nav',
				'container_class' => 'col-xs-4 col-md-4 menu-container menu-container-effect menu-hover-effect',
				'menu_class' 	  => 'menu-flex'
			) );			
			global $woocommerce;
			echo '<nav class="col-xs-2 col-md-2 menu-container">'.
				'<ul class="custom-menu-search">'.
					'<li class="menu-item menu-item-search grow1" id="nav-search">' . get_search_form(FALSE) . '</li>'; ?>
					<li><span class="separator">|</span><span class="bagshop"></span>
						<a class="menu-item cart-contents" href="<?php echo wc_get_cart_url(); ?>" 
							title="<?php _e( 'View your shopping cart' ); ?>">
							<?php echo sprintf ( _n( '<span class="cart-contents-count">%d</span>',
								'<span class="cart-contents-count">%d</span>', 
								WC()->cart->get_cart_contents_count() ), 
								WC()->cart->get_cart_contents_count() );
							?>
						</a>						
					</li>
				</ul>
			</nav>
		<span class="target"></span>	

	</div>

	<!-- MENU CATEGORIAS -->
	<div class="row mn-cat">
		<?php
			wp_nav_menu( array(
				'theme_location'  => 'cat',
				'sort_column'     => 'menu_order',
				'container'       => 'nav',
				'container_class' => 'col-xs-12 col-md-12 menu-container menu-hover-effect',
				'menu_class' 	  => 'menu-cat-flex',
				'walker'		  => new img_sub()
			) );
		?>
	</div>
</div>

		
