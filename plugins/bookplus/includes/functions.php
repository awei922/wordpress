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
            }else{
                $html .= '<span class="current">' . __('Post') . '</span>';
            }
        } else {
            $html .= '<span class="current">' . __('Last Post') . '</span>';
        }
        $html .= '</span>';

        echo $html;
    }
}
