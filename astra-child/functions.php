<?php

/**
 * Parent style.css
 */
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_stylesheet_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function theme_custom_block_editor_styles()
{
    // Block styles.
    wp_enqueue_style('theme-custom-block-editor-style', get_theme_file_uri('style.css'), array(), '20190328');
}

add_action('enqueue_block_editor_assets', 'theme_custom_block_editor_styles');

