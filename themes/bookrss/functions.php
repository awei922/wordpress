<?php

// style.css
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

function bookrss_block_editor_styles()
{
    wp_enqueue_style('bookrss-block-editor-styles', get_stylesheet_directory_uri() . '/assets/dist/style.css');
}

add_action('enqueue_block_editor_assets', 'bookrss_block_editor_styles');

function bookrss_dequeue_scripts()
{
//    wp_deregister_style('chaplin-google-fonts');
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

function bookrss_sidebar_registration()
{
    $shared_args = array(
        'before_title' => '<h2 class="widget-title subheading heading-size-3">',
        'after_title' => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget' => '</div></div>',
    );

    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name' => __('Sidebar'),
                'id' => 'sidebar-0',
                'description' => __('Sidebar'),
            )
        )
    );
}

add_action('widgets_init', 'bookrss_sidebar_registration');

// function_exists
function chaplin_excerpt_more()
{
}

function chaplin_register_widgets()
{
}
