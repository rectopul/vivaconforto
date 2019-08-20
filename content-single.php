<div class="container">
    <div class="row">
        <div id="post-<?php the_ID(); ?>" <?php post_class( 'col-xs-12' ); ?>>
            <header class="entry-header">
                <?php
                storefront_post_thumbnail( 'full' );
                the_title( '<h1 class="entry-title">', '</h1>' );
                ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php the_content(); ?>
                <?php
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