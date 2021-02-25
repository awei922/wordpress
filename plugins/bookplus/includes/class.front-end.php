<?php

class BookPlus_FrontEnd
{
    private static $code_options;

    public static function init()
    {
        if (is_admin()) {
            return false;
        }

        self::code_hooks();

        add_filter('the_content', [__CLASS__, 'post_content']);
    }

    public static function post_content($content = '')
    {
        global $post;

        // archive
        if ((is_archive() || is_home()) && BookPlus_Settings::get_option('archive_display_excerpt')) {
            $link = sprintf(
                '<a href="%1$s" class="more-link">%2$s</a>',
                esc_url(get_permalink(get_the_ID())),
                /* translators: %s: Post title. */
                sprintf(__('Continue reading %s'), '<span class="screen-reader-text">' . get_the_title(get_the_ID()) . '</span><span class="meta-nav">&rarr;</span>')
            );
            return wp_trim_words($content, 55, ' &hellip; ' . $link);
        }

        //if post password
        if (post_password_required($post) && BookPlus_Settings::get_option('split_protected_posts')) {
            $content = explode('<!--more-->', $post->post_content)[0] . $content;
        }

        // target="_blank"
        if (BookPlus_Settings::get_option('target_equal_blank')) {
            $content = str_replace('<a', '<a target="_blank" rel="nofollow"', $content);
        }

        // markdown-body
        if (is_singular()) {
            if (empty($content)) {
                $content = '';
            } else {
                $content = '<div class="markdown-body">' . $content . '</div>';
            }

            // document
            if (is_single() && BookPlus_Settings::get_option('register_document')) {
                $content .= BookPlus_Document::nav_document();
            }
        }

        return $content;
    }

    public static function code_hooks()
    {
        $settings_sections = BookPlus_Settings::settings_sections();
        self::$code_options = get_option($settings_sections['code']['id']);
        if (empty(self::$code_options)) {
            return false;
        }

        add_action('wp_head', [__CLASS__, 'header_code']);
        add_action('wp_footer', [__CLASS__, 'footer_code']);
    }

    public static function header_code()
    {
        echo self::$code_options['header_code'];
    }

    public static function footer_code()
    {
        echo self::$code_options['footer_code'];
    }
}

BookPlus_FrontEnd::init();

