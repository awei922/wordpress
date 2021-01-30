<?php
/**
 * Parent style.css
 */
function bookrss_enqueue_scripts()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('bookrss-style', get_stylesheet_directory_uri() . '/assets/dist/style.css');
//    wp_enqueue_script('bookrss-test-js', '//localhost:8080/main.js');
    wp_enqueue_script('bookrss-js', get_stylesheet_directory_uri() . '/assets/dist/bundel.js', [], false, true);
}

add_action('wp_enqueue_scripts', 'bookrss_enqueue_scripts');

function bookrss_dequeue_scripts()
{
    wp_dequeue_style('twentythirteen-fonts');
    wp_dequeue_style('twentythirteen-block-style');
}

add_action('wp_enqueue_scripts', 'bookrss_dequeue_scripts', 99);

function theme_custom_post_content($content)
{
    if (is_singular()) {
        $content = '<div class="markdown-body">' . $content . '</div>';
    }

    return $content;
}

add_filter('the_content', 'theme_custom_post_content');
