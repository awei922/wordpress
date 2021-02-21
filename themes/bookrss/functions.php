<?php
/**
 * Parent style.css
 */
function bookrss_enqueue_scripts()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('bookrss-js', get_stylesheet_directory_uri() . '/assets/dist/bundel.js', [], false, true);

    if (WP_DEBUG) {
        wp_enqueue_script('bookrss-test-js', '//localhost:8080/main.js');
        return false;
    }
    wp_enqueue_style('bookrss-style', get_stylesheet_directory_uri() . '/assets/dist/style.css');

}

add_action('wp_enqueue_scripts', 'bookrss_enqueue_scripts');

function bookrss_dequeue_scripts()
{
    wp_dequeue_style('twentytwelve-fonts');
    wp_dequeue_style('twentytwelve-block-style');
}

add_action('wp_enqueue_scripts', 'bookrss_dequeue_scripts', 99);

function bookrss_excerpt_more($link)
{
    if (is_admin()) {
        return $link;
    }

    $link = sprintf(
        '<a href="%1$s" class="more-link">%2$s</a>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Post title. */
        sprintf(__('Continue reading %s'), '<span class="screen-reader-text">' . get_the_title(get_the_ID()) . '</span><span class="meta-nav">&rarr;</span>')
    );
    return ' &hellip; ' . $link;
}

add_filter('excerpt_more', 'bookrss_excerpt_more');
