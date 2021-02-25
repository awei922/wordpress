<?php get_header(); ?>

<main id="site-content">

    <div class="container">

        <div class="row">

            <div class="col-mb-12 <?php if ( is_active_sidebar( 'sidebar-0' ) ) { ?> col-8 <?php } ?>">

                <?php

                if ( have_posts() ) :
                    while ( have_posts() ) :

                        the_post();

                        get_template_part( 'content', get_post_type() );

                        // Display related posts
                        get_template_part( 'parts/related-posts' );

                    endwhile;
                endif;

                ?>

            </div>

            <?php get_sidebar(); ?>

        </div>

    </div>

</main><!-- #site-content -->

<?php get_footer(); ?>
