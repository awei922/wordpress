<?php

class BookPlus_Ajax
{
    public static function init()
    {
        if (!is_admin() && !wp_doing_ajax()) {
            return false;
        }

        add_action('wp_ajax_bookplus_add_post', [__CLASS__, 'add_post']);
        add_action('wp_ajax_bookplus_delete_post', [__CLASS__, 'delete_post']);
        add_action('wp_ajax_bookplus_get_posts', [__CLASS__, 'get_posts']);
        add_action('wp_ajax_bookplus_sort_posts', [__CLASS__, 'sort_posts']);
    }

    public static function post_type_object()
    {
        return get_post_type_object(BookPlus::$post_type);
    }

    public static function add_post()
    {
        self::check_ajax_referer();

        $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
        $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : 'publish';
        $parent = isset($_POST['parent']) ? absint($_POST['parent']) : 0;
        $order = isset($_POST['order']) ? absint($_POST['order']) : 0;

        if (!current_user_can(self::post_type_object()->cap->publish_posts)) {
            $status = 'pending';
        }

        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_status' => $status,
            'post_parent' => $parent,
            'post_author' => get_current_user_id(),
            'menu_order' => $order,
        ]);

        if (is_wp_error($post_id)) {
            wp_send_json_error();
        } else {
            if (0 == $parent) {
                add_post_meta($post_id, 'post_type', 'document', true);
            }
        }

        wp_send_json_success(self::build_data(get_post($post_id)));
    }


    public static function delete_post()
    {
        self::check_ajax_referer();

        $force_delete = false;
        $post_id = isset($_POST['id']) ? absint($_POST['id']) : 0;

        if (!current_user_can(self::post_type_object()->cap->delete_post, $post_id)) {
            wp_send_json_error(__('Sorry, you are not allowed to delete this post.'));
        }

        if ($post_id > 0) {
            // delete childrens first if found
            self::delete_child_post($post_id, $force_delete);

            // delete main
            wp_delete_post($post_id, $force_delete);
        }

        wp_send_json_success();
    }

    public static function get_posts()
    {
        self::check_ajax_referer();

        $data = self::document_list(isset($_GET['post']) ? absint($_GET['post']) : -1);

        wp_send_json_success($data);
    }


    public static function sort_posts()
    {
        self::check_ajax_referer();

        $post_ids = isset($_POST['ids']) ? array_map('absint', $_POST['ids']) : [];

        if (!empty($post_ids)) {
            foreach ($post_ids as $order => $id) {
                wp_update_post([
                    'ID' => $id,
                    'menu_order' => $order,
                ]);
            }
        }

        wp_send_json_success();
    }

    public static function document_list($post_id = -1)
    {
        $posts = get_posts([
            'meta_key' => 'post_type',
            'meta_value' => 'document',
            'numberposts' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_status' => ['publish', 'draft', 'pending']
        ]);

        $posts = self::build_tree($posts);
        usort($posts, [__CLASS__, 'sort_callback']);

        $post = null;
        if ($post_id > 0) {
            $post = get_post($post_id);
            if (!$post) {
                wp_die(__('You attempted to edit an item that doesn&#8217;t exist. Perhaps it was deleted?'));
            }

            $postChildren = get_pages([
                'child_of' => $post_id,
                'post_type' => BookPlus::$post_type,
                'sort_column' => 'menu_order',
                'post_status' => ['publish', 'draft', 'pending']
            ]);

            $postChildren = self::build_tree($postChildren, $post_id);
            usort($postChildren, [__CLASS__, 'sort_callback']);

            $post = self::build_data($post, $postChildren);
        }

        return ['post' => $post, 'posts' => $posts];
    }


    public static function delete_child_post($parent_id = 0, $force_delete)
    {
        $childrens = get_children(['post_parent' => $parent_id]);

        if ($childrens) {
            foreach ($childrens as $child_post) {
                // recursively delete
                self::delete_child_post($child_post->ID, $force_delete);

                wp_delete_post($child_post->ID, $force_delete);
            }
        }
    }

    public static function build_tree($posts, $parent = 0)
    {
        $result = [];

        if (empty($posts)) {
            return $result;
        }

        foreach ($posts as $key => $post) {
            if ($post->post_parent == $parent) {
                unset($posts[$key]);

                // build tree and sort
                $children = self::build_tree($posts, $post->ID);
                usort($children, [__CLASS__, 'sort_callback']);

                $result[] = self::build_data($post, $children);
            }
        }

        return $result;
    }

    public static function build_data($post, $children = [])
    {
        if (is_wp_error($post)) {
            wp_send_json_error();
        }

        if (empty($post)) {
            return [];
        }

        return [
            'id' => $post->ID,
            'title' => esc_html($post->post_title),
            'status' => __(ucfirst($post->post_status)),
            'order' => $post->menu_order,
            'caps' => [
                'edit' => current_user_can(self::post_type_object()->cap->edit_post, $post->ID),
                'delete' => current_user_can(self::post_type_object()->cap->delete_post, $post->ID),
            ],
            'children' => $children,
        ];
    }

    public static function check_ajax_referer()
    {
        check_ajax_referer('bookplus-ajax-nonce');
    }

    public static function sort_callback($a, $b)
    {
        return $a['order'] - $b['order'];
    }
}

BookPlus_Ajax::init();


