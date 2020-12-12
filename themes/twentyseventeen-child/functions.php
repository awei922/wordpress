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
 * Add a custom JS
 */
function theme_custom_footer_js()
{
    ?>
    <script>
        //百度统计
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?96d91412aff9543cd8e022f381d8bf1c";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <?php
}

add_action('wp_footer', 'theme_custom_footer_js');

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

/**
 * Open links
 */
add_filter('pre_option_link_manager_enabled', '__return_true');
function links_shortcode($atts)
{
    ob_start();
    echo '<blockquote><ul>'
        . wp_list_bookmarks(wp_parse_args($atts, ['echo' => 0]))
        . '</ul></blockquote>';
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('links', 'links_shortcode');

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


//==================================
if (!function_exists('twentyseventeen_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function twentyseventeen_posted_on()
    {
        // Get the author name; wrap it in a link.
        $byline = sprintf(
        /* translators: %s: Post author. */
            __('by %s', 'twentyseventeen'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_the_author() . '</a></span>'
        );

        // Finally, let's write all of this to the page.
        echo '<span class="posted-on">' . twentyseventeen_time_link() . '</span><span class="byline"> ' . $byline . '</span>';

        // New comments
        if (!post_password_required() && (comments_open() || get_comments_number())) :
            ?>
            <span class="comments-link"><?php comments_popup_link(); ?></span>
        <?php
        endif;
    }
endif;

if (!function_exists('twentyseventeen_edit_link')) :
    /**
     * Returns an accessibility-friendly link to edit a post or page.
     *
     * This also gives us a little context about what exactly we're editing
     * (post or page?) so that users understand a bit more where they are in terms
     * of the template hierarchy and their content. Helpful when/if the single-page
     * layout with multiple posts/pages shown gets confusing.
     */
    function twentyseventeen_edit_link()
    {

        // New comments
        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) :
            ?>
            <span class="comments-link"><?php comments_popup_link(); ?></span>
        <?php
        endif;

        edit_post_link(
            sprintf(
            /* translators: %s: Post title. */
                __('Edit<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;
