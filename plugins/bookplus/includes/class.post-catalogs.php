<?php

class BookPlus_PostCatalogs
{
    public static function init()
    {
        if (!BookPlus_Settings::get_option('register_post_catalogs')) {
            return false;
        }

        add_action('init', array(__CLASS__, 'register_post_type'));
        add_action('admin_menu', [__CLASS__, 'admin_menus']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
    }


    public static function admin_menus()
    {
        add_posts_page(__('Catalogs', 'bookplus'), __('Catalogs', 'bookplus'), 'publish_posts', 'bookplus_catalog', [__CLASS__, 'page_catalogs']);
    }

    public static function page_catalogs()
    {
        include_once BookPlus::$plugin_path . '/views/catalogs.php';
    }

    public static function enqueue_scripts($hook)
    {
        if ('posts_page_bookplus_catalog' != $hook) {
            return false;
        }

        //css
        wp_enqueue_style('bookplus-admin', BookPlus::$plugin_url . 'css/admin.css', [], filemtime(BookPlus::$plugin_path . 'css/admin.css'));

        //js
        wp_enqueue_script('vuejs', BookPlus::$plugin_url . 'js/vue.min.js', [], BookPlus::$version, true);
        wp_enqueue_script('sweetalert', BookPlus::$plugin_url . 'js/sweetalert2.min.js', ['jquery'], BookPlus::$version, true);
        wp_enqueue_script('bookplus-admin', BookPlus::$plugin_url . 'js/admin.js', ['jquery', 'jquery-ui-sortable', 'wp-util'], filemtime(BookPlus::$plugin_path . 'js/admin.js'), true);
        wp_localize_script('bookplus-admin', 'bookPlus', [
            'edit_url' => admin_url('post.php?action=edit&post='),
            'view_url' => home_url('/?p='),
            'catalog_url' => admin_url('admin.php?page=bookplus_catalog&post='),

            'post_data' => BookPlus_Ajax::catalog_list(isset($_GET['post']) ? absint($_GET['post']) : -1),
            'post_status' => __('Publish'),
            'ajax_nonce' => wp_create_nonce('bookplus-ajax-nonce'),

            'placeholder_value' => __('Enter title here', 'bookplus'),
            'delete_title' => __('Are you sure?', 'bookplus'),
            'button_cancel' => __('Cancel', 'bookplus'),
            'button_confirm' => __('Yes', 'bookplus'),
            'button_delete' => __('Yes, delete it!', 'bookplus'),

            'enter_catalog_title' => __('Enter catalog title', 'bookplus'),
            'delete_catalog_text' => __('Are you sure to delete the entire catalog? Sections and articles inside this catalog will be deleted too!', 'bookplus'),

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
}

BookPlus_PostCatalogs::init();
