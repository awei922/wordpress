<?php

class BookPlus_FrontEnd
{
    private static $code_options;

    public static function init()
    {
        self::catalogs_hooks();
        self::code_hooks();

        add_filter('the_content', [__CLASS__, 'post_content']);
    }

    public static function catalogs_hooks()
    {
        if (!BookPlus_Settings::get_option('register_post_catalogs')) {
            return false;
        }

        add_shortcode('list_catalogs', [__CLASS__, 'list_catalogs']);
        add_shortcode('nav_catalog', [__CLASS__, 'nav_catalog']);

        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
        add_action('pre_get_posts', [__CLASS__, 'pre_get_posts']);
    }

    public static function enqueue_scripts()
    {
        wp_enqueue_style('bookplus-fontend', BookPlus::$plugin_url . 'css/fontend.css', [], filemtime(BookPlus::$plugin_path . 'css/fontend.css'));
    }

    public static function post_content($content = '')
    {
        global $post;

        // archive
        if ((is_archive() || is_home()) && BookPlus_Settings::get_option('archive_display_excerpt')) {
            return wp_trim_words($content);
        }

        // single
        if (is_single() && !empty(get_children(['post_parent' => $post->ID, 'post_type' => BookPlus::$post_type]))) {
            $content .= self::nav_catalog(['post_id' => $post->ID]);
        }

        //if post password
        if (post_password_required($post) && BookPlus_Settings::get_option('split_protected_posts')) {
            $content = explode('<!--more-->', $post->post_content)[0] . $content;
        }

        // target="_blank"
        if (BookPlus_Settings::get_option('target_equal_blank')) {
            $content = str_replace('<a', '<a target="_blank" rel="nofollow"', $content);
        }

        return $content;
    }

    public static function pre_get_posts($query)
    {
        if (!$query->is_main_query()) {
            return false;
        }
    }

    public static function list_catalogs($atts = [], $content = '')
    {
        $list = wp_list_pages(
            [
                'echo' => 0,
                'title_li' => '',
                'post_type' => BookPlus::$post_type,
                'meta_key' => 'post_type',
                'meta_value' => 'catalog',
                'sort_column' => 'menu_order',
            ]
        );

        if (!empty($list)) {
            $content .= '<section class="list-catalogs"><ul>' . $list . '</ul></section>';
        }

        return $content;
    }

    public static function nav_catalog($atts = [], $content = '')
    {
        global $post;

        $title_li = '';
        if (isset($atts['post_id']) && $atts['post_id'] > 0) {
            $parent_id = intval($atts['post_id']);
            $title_li = __('Post');
        } else if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $root = count($ancestors) - 1;
            $parent_id = $ancestors[$root];
        } else {
            $parent_id = $post->ID;
        }

        $parent_post = get_post($parent_id);
        $list = wp_list_pages(
            [
                'echo' => 0,
                'child_of' => $parent_post->ID,
                'title_li' => '<h3 class="widget-title">' . ($title_li ? $title_li : esc_html($parent_post->post_title)) . '</h3>',
                'post_type' => BookPlus::$post_type,
                'sort_column' => 'menu_order',
            ]
        );

        if (!empty($list)) {
            $content .= '<section class="nav-catalog"><ul class="widget">' . $list . '</ul></section> ';
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

