<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="container content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'content', 'single' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
