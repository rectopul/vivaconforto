
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
<?php if( have_posts() ): 

the_post(); ?>
<div class="container">
    <div class="row">
        <div id="post-<?php the_ID(); ?>" <?php post_class( 'col-xs-12' ); ?>>
            <header class="entry-header">
                <?php
                    the_post_thumbnail( 'large' ); 
                    the_title( '<h1 class="entry-title">', '</h1>' );
                ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php 
                
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
                            'after'  => '</div>',
                        )
                    );
                ?>
            </div><!-- .entry-content -->
        </div>
    </div>
</div>
<?php endif; ?>
<?php
get_footer();