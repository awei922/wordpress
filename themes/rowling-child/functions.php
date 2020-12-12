<?php

/**
 * Parent style.css
 */
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/**
 * Add a custom CSS
 */
function theme_custom_login()
{
    echo '<style>#login h1{display: none}</style>';
}

add_action('login_head', 'theme_custom_login');


/**
 * Open links
 */
add_filter('pre_option_link_manager_enabled', '__return_true');

/**
 * Custom Post Content
 *
 * @param $content
 * @return string
 */
function theme_custom_post_content($content)
{
    global $post;

    //if post password
    if (post_password_required($post)) {
        $content = explode('<!--more-->', $post->post_content)[0] . $content . (get_theme_mod('wxPublic_image') ? '<blockquote><center><b>请扫描获取密码</b><br/><img width="150" src="' . esc_url(get_theme_mod('wxPublic_image')) . '"></center></blockquote>' : '');
    }

    //auto blank
    $content = str_replace('<a', '<a target="_blank" rel="nofollow"', $content);
    return $content;
}

add_filter('the_content', 'theme_custom_post_content');

/* ---------------------------------------------------------------------------------------------
   MODIFY WIDGETS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rowling_unregister_default_widgets' ) ) :
    function rowling_unregister_default_widgets() {
    }
    add_action( 'widgets_init', 'rowling_unregister_default_widgets', 11 );
endif;
