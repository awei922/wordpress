<?php get_header(); ?>

<main id="site-content">

    <div class="container">

        <div class="row">

            <?php

            $active_sidebar = is_active_sidebar('sidebar-0');
            $is_cover_template = chaplin_is_cover_template();

            ?>

            <div class="col-mb-12 <?php if ($active_sidebar && !$is_cover_template) { ?> col-8 <?php } ?>">

                <?php

                if (have_posts()) :
                    while (have_posts()) :

                        the_post();

                        get_template_part('content', get_post_type());

                        // Display related posts
                        get_template_part('parts/related-posts');

                    endwhile;
                endif;

                ?>

            </div>

            <?php

            if (is_front_page()) {

                ?>

                <div class="col-mb-12 <?php if ($active_sidebar) { ?> col-8 <?php } ?>">

                    <article <?php post_class('section-inner'); ?>>

                        <div class="post-inner" id="post-inner">

                            <div class="entry-content">

                                <?php if (function_exists('the_recent_posts')) {
                                    the_recent_posts();
                                } ?>

                            </div><!-- .entry-content -->

                        </div><!-- .post-inner -->

                    </article><!-- .post -->

                </div>

                <?php

            }

            if ($active_sidebar) {
                get_sidebar();
            }

            ?>

        </div>

    </div>

</main><!-- #site-content -->

<?php get_footer(); ?>
