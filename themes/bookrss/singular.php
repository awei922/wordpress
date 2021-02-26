<?php get_header(); ?>

<main id="site-content">

    <div class="container">

        <div class="row">

            <?php

            $active_sidebar = is_active_sidebar('sidebar-0');

            if (is_page_template('template-cover.php') ||
                is_page_template('template-full-width.php') ||
                is_page_template('template-full-width-cover.php')) {

                $active_sidebar = false;
            }

            ?>

            <div class="col-mb-12 <?php if ($active_sidebar) { ?> col-8 <?php } ?>">

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

            if ($active_sidebar) {
                get_sidebar();
            }

            ?>

        </div>

    </div>

</main><!-- #site-content -->

<?php get_footer(); ?>
