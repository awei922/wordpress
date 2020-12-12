<?php
/**
 * The best and safest way to extend the Humean WordPress theme with your own custom code is to create a child theme.
 * You can add temporary code snippets and hacks to the current functions.php file, but unlike with a child theme, they will be lost on upgrade.
 *
 * If you don't know what a child theme is, you really want to spend 5 minutes learning how to use child themes in WordPress, you won't regret it :) !
 * https://codex.wordpress.org/Child_Themes
 *
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

/**
 * 打开友情链接
 */
add_filter('pre_option_link_manager_enabled', '__return_true');

/**
 * 自定义登录页面的LOGO链接为首页链接
 */
add_filter('login_headerurl', create_function(false, "return get_bloginfo('url');"));

/**
 * 自定义登录页面的LOGO提示为网站名称
 */
add_filter('login_headertitle', create_function(false, "return get_bloginfo('name');"));