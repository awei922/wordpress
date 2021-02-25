<?php get_header(); ?>

<main id="site-content">

    <div class="container">

        <div class="row">

            <div class="col-mb-12 col-8">

                <?php

                if (!get_the_content()) {
                    global $wp_query;
                    $wp_query->query(['posts_per_page' => 1]);
                }

                if ( have_posts() ) :
                    while ( have_posts() ) :

                        the_post();

                        get_template_part( 'content', get_post_type() );

                        // Display related posts
                        get_template_part( 'parts/related-posts' );

                    endwhile;
                endif;

                ?>

                <article <?php post_class( 'section-inner' ); ?> id="post-<?php the_ID(); ?>">

                    <div class="post-inner" id="post-inner">

                        <div class="entry-content">

                            <?php if (function_exists('the_recent_posts')) {
                                the_recent_posts();
                            } ?>

                        </div><!-- .entry-content -->

                    </div><!-- .post-inner -->

                </article><!-- .post -->

            </div>

            <?php get_sidebar(); ?>

        </div>

    </div>

</main><!-- #site-content -->

<?php get_footer(); ?>
