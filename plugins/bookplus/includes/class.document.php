<?php

class BookPlus_Document
{
    public static function init()
    {
        if (!BookPlus_Settings::get_option('register_document')) {
            return false;
        }

        add_action('init', [__CLASS__, 'register_post_type']);
        add_action('pre_get_posts', [__CLASS__, 'pre_get_posts']);

        add_shortcode('list_document', [__CLASS__, 'list_document']);
        add_shortcode('nav_document', [__CLASS__, 'nav_document']);

        add_filter('widget_posts_args', [__CLASS__, 'widget_posts_args']);

        if (!is_admin()) {
            return false;
        }
        add_action('admin_menu', [__CLASS__, 'admin_menus']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
    }


    public static function admin_menus()
    {
        add_posts_page(__('Documentation'), __('Documentation'), 'publish_posts', 'bookplus_document', [__CLASS__, 'page_document']);
    }

    public static function page_document()
    {
        include_once BookPlus::$plugin_path . '/views/documents.php';
    }

    public static function enqueue_scripts($hook)
    {
        if ('posts_page_bookplus_document' != $hook) {
            return false;
        }

        wp_localize_script('bookplus-admin', 'bookPlus', [
            'edit_url' => admin_url('post.php?action=edit&post='),
            'view_url' => home_url('/?p='),
            'document_url' => admin_url('admin.php?page=bookplus_document&post='),

            'post_data' => BookPlus_Ajax::document_list(isset($_GET['post']) ? absint($_GET['post']) : -1),
            'post_status' => __('Publish'),
            'ajax_nonce' => wp_create_nonce('bookplus-ajax-nonce'),

            'placeholder_value' => __('Enter title here', 'bookplus'),
            'delete_title' => __('Are you sure?', 'bookplus'),
            'button_cancel' => __('Cancel', 'bookplus'),
            'button_confirm' => __('Yes', 'bookplus'),
            'button_delete' => __('Yes, delete it!', 'bookplus'),

            'enter_document_title' => __('Enter document title', 'bookplus'),
            'delete_document_text' => __('Are you sure to delete the entire document? Sections and articles inside this document will be deleted too!', 'bookplus'),

            'enter_section_title' => __('Enter section title', 'bookplus'),
            'delete_section_text' => __('Are you sure to delete the entire section? Articles inside this section will be deleted too!', 'bookplus'),

            'enter_article_title' => __('Enter article title', 'bookplus'),
            'delete_article_text' => __('Are you sure to delete the article?', 'bookplus'),

            'post_deleted_text' => __('This posts has been deleted', 'bookplus'),
        ]);
    }

    public static function register_post_type()
    {
        register_post_type(BookPlus::$post_type, array(
            'labels' => array_merge((array)get_post_type_labels(new WP_Post_Type(BookPlus::$post_type)), [
                'name_admin_bar' => _x('Post', 'add new from admin bar'),
            ]),
            'public' => true,
            '_builtin' => true, /* internal use only. don't use this when registering your own post type. */
            '_edit_link' => 'post.php?post=%d', /* internal use only. don't use this when registering your own post type. */
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'menu_position' => 5,
            'hierarchical' => true,
            'rewrite' => false,
            'query_var' => false,
            'delete_with_user' => true,
            'supports' => array('title', 'editor', 'author', 'page-attributes', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats'),
            'show_in_rest' => true,
            'rest_base' => 'posts',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        ));
    }

    public static function pre_get_posts($query)
    {
        if (!$query->is_main_query()) {
            return false;
        }

        if (is_admin() || is_singular()) {
            return false;
        }

        $post_ids = self::get_all_document_ids();
        if (!empty($post_ids)) {
            $query->set('post__not_in', $post_ids);
        }
    }

    public static function widget_posts_args($args)
    {
        $post_ids = self::get_all_document_ids();
        if (!empty($post_ids)) {
            $args['post__not_in'] = $post_ids;
        }

        return $args;
    }

    public static function get_all_document_ids()
    {
        $posts = get_posts([
            'meta_key' => BookPlus::$meta_key,
            'meta_value' => BookPlus::$meta_value,
            'numberposts' => -1
        ]);

        $ids = [];
        if (!empty($posts)) {
            $ids = array_column($posts, 'ID');
        }

        return $ids;
    }

    public static function list_document($atts = [], $content = '')
    {
        $list = wp_list_pages(
            [
                'echo' => 0,
                'title_li' => '',
                'post_type' => BookPlus::$post_type,
                'meta_key' => BookPlus::$meta_key,
                'meta_value' => BookPlus::$meta_value,
                'sort_column' => 'menu_order',
                'show_date' => true,
                'link_before' => '<i class="fa fa-folder-o" aria-hidden="true"></i> '
            ]
        );

        if (!empty($list)) {
            $content .= '<section class="list-document"><ul>' . $list . '</ul></section>';
        }

        return $content;
    }

    public static function nav_document($atts = [], $content = '')
    {
        global $post;

        if (isset($atts['post_id']) && $atts['post_id'] > 0) {
            $parent_id = intval($atts['post_id']);
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
                'title_li' => '',
                'post_type' => BookPlus::$post_type,
                'sort_column' => 'menu_order',
                'link_before' => '<i class="fa fa-file-text-o" aria-hidden="true"></i> '
            ]
        );

        if (!empty($list)) {
            $content .= '<section class="nav-document"><h3>' . __('Documentation') . '：<a href="' . get_permalink($parent_post) . '">' . $parent_post->post_title . '</a></h3><ul>' . $list . '</ul></section>';
        }

        return $content;
    }
}

BookPlus_Document::init();
