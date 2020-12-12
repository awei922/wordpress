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
function custom_login()
{
    echo '<style>#login h1{display: none}</style>';
}

add_action('login_head', 'custom_login');

/**
 * Open links
 */
add_filter('pre_option_link_manager_enabled', '__return_true');

/**
 * Custom post content
 *
 * @param $content
 * @return string
 */
function theme_custom_post_content($content)
{
    global $post;

    //archive excerpt
    if (!is_singular() && !is_sticky()) {
        return wp_trim_words($content);
    }

    //if post password
    if (post_password_required($post)) {
        $content = explode('<!--more-->', $post->post_content)[0] . $content . (get_theme_mod('wxPublic_image') ? '<blockquote><center><b>请扫描获取密码</b><br/><img width="150" src="' . esc_url(get_theme_mod('wxPublic_image')) . '"></center></blockquote>' : '');
    }

    //auto blank
    $content = str_replace('<a', '<a target="_blank" rel="nofollow"', $content);
    return $content;
}

add_filter('the_content', 'theme_custom_post_content');

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_custom_sidebar_registration() {
    // Arguments used in all register_sidebar() calls.
    $shared_args = array(
        'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
        'after_title'   => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
    );
    // Footer #2.
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __( 'Sidebar', 'twentytwenty' ),
                'id'          => 'sidebar-0',
                'description' => __( 'Widgets in this area will be displayed in the second column in the sidebar.', 'twentytwenty' ),
            )
        )
    );
}

add_action( 'widgets_init', 'theme_custom_sidebar_registration' );