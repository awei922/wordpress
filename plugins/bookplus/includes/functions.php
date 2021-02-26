<?php

if (!function_exists('the_breadcrumb')) {
    function the_breadcrumb()
    {
        $post = get_post(get_query_var('p'));
        setup_postdata($post);

        ?>

        <span class="breadcrumb">
            <a href=" <?php bloginfo('url') ?> "><?php _e('Home'); ?></a>
            <span class="seprater"> &raquo; </span>

            <?php

            if (!is_front_page()) {
                if (is_category() || is_single()) {
                    the_category(', ');

                    if (is_single()) { ?>

                        <span class="seprater"> &raquo; </span>
                        <?php

                        the_current(get_the_title());
                    }
                } elseif (is_page() && $post->post_parent) {
                    $home = get_page(get_option('page_on_front'));
                    for ($i = count($post->ancestors) - 1; $i >= 0; $i--) {
                        if (($home->ID) != ($post->ancestors[$i])) {
                            ?>

                            <a href="<?php the_permalink($post->ancestors[$i]) ?>">
                                <?php the_the_title($post->ancestors[$i]) ?>
                            </a>
                            <span class="seprater"> &raquo; </span>

                            <?php
                        }
                    }
                    the_current(get_the_title());
                } elseif (is_page()) {
                    the_current(get_the_title());
                } elseif (is_404()) {
                    the_current(get_the_title());
                } else {
                    the_current(__('Post'));
                }
            } else {
                the_current(__('Last Post'));
            }
            ?>
        </span>

        <?php

        wp_reset_postdata();
    }

    function the_current($text)
    {
        ?>

        <span class="current"><?php echo $text; ?></span>

        <?php
    }

}


if (!function_exists('the_recent_posts')) {
    function the_recent_posts()
    {
        ?>

        <div class="recent-posts">
            <h2><?php _e('Recent Posts'); ?></h2>
            <ul>

                <?php

                global $wp_query;
                $wp_query->query(['posts_per_page' => 15]);

                while (have_posts()) {
                    the_post();
                    ?>

                    <li>
                        <span class="post-date"><?php echo esc_html(get_the_date()); ?>&raquo;</span>
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </li>

                    <?php

                }
                wp_reset_postdata();

                ?>

                <li>
                    <a class="more-link"
                       href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))) ?>"><?php _e('Read more...') ?></a>
                </li>
            </ul>
        </div>

        <?php
    }
}
?>
