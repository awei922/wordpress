<?php
/**
 * Template Name: Front Page Template
 */

get_header();
?>

    <main id="site-content" role="main">

        <div class="container">

            <div class="row">

                <div class="col-mb-12 col-8">

                    <?php

                    if (!get_the_content()) {
                        global $wp_query;
                        $wp_query->query(['posts_per_page' => 1]);
                    }

                    $i = 0;
                    while (have_posts()) {
                        $i++;
                        if ($i > 1) {
                            echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
                        }
                        the_post();

                        get_template_part('template-parts/content', get_post_type());

                    }

                    ?>

                    <hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true"/>

                    <article <?php post_class(); ?>>

                        <div class="post-inner thin">

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

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();