<?php

if (!function_exists('the_breadcrumb')) {
    function the_breadcrumb()
    {
        global $post;

        $html = '<span class="breadcrumb">';
        $html .= '<a href="' . get_bloginfo('url') . '">' . __('Home');
        $html .= '</a><span class="seprater"> &raquo; </span>';

        if (!is_front_page()) {
            if (is_category() || is_single()) {
                $html .= get_the_category_list(', ');
                if (is_single()) {
                    $html .= '</a><span class="seprater"> &raquo; </span><span class="current">' . get_the_title() . '</span>';;
                }
            } elseif (is_page() && $post->post_parent) {
                $home = get_page(get_option('page_on_front'));
                for ($i = count($post->ancestors) - 1; $i >= 0; $i--) {
                    if (($home->ID) != ($post->ancestors[$i])) {
                        $html .= '<a href="' . get_permalink($post->ancestors[$i]) . '">' . get_the_title($post->ancestors[$i]) . '</a><span class="seprater"> &raquo; </span>';
                    }
                }
                $html .= '<span class="current">' . get_the_title() . '</span>';
            } elseif (is_page()) {
                $html .= '<span class="current">' . get_the_title() . '</span>';
            } elseif (is_404()) {
                $html .= '<span class="current">' . get_the_title() . '</span>';
            } else {
                $html .= '<span class="current">' . __('Post') . '</span>';
            }
        } else {
            $html .= '<span class="current">' . __('Last Post') . '</span>';
        }
        $html .= '</span>';

        echo $html;
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
                <?php } ?>
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
