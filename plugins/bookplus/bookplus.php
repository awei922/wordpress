<?php

/**
 * Plugin Name:       BookPlus
 * Plugin URI:        https://gravatar.cn/
 * Description:       A plus plugin for WordPress
 * Version:           1.0.0
 * Author:            A.wei
 * Author URI:        https://gravatar.cn/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bookplus
 * Domain Path:       /languages
 *
 * @package bookplus
 */

if (!defined('ABSPATH')) {
    exit;
}

class BookPlus
{
    public static $version = '1.0.0';
    public static $plugin_path = '';
    public static $plugin_url = '';
    public static $post_type = 'post';

    public static function plugin_init()
    {
        self::$plugin_path = plugin_dir_path(__FILE__);
        self::$plugin_url = plugin_dir_url(__FILE__);

        load_plugin_textdomain('bookplus', false, basename(dirname(__FILE__)) . '/languages');

        register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivation_hook'));
        register_activation_hook(__FILE__, array(__CLASS__, 'activation_hook'));

        add_action('admin_enqueue_scripts', [__CLASS__, 'admin_enqueue_scripts']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'wp_enqueue_scripts']);

        self::include_dependencies();
    }


    public static function activation_hook()
    {
    }

    public static function deactivation_hook()
    {
    }

    public static function wp_enqueue_scripts(){
        wp_enqueue_style('bookplus-fontend', BookPlus::$plugin_url . 'css/fontend.css', [], filemtime(BookPlus::$plugin_path . 'css/fontend.css'));
    }

    public static function admin_enqueue_scripts()
    {
        wp_enqueue_style('bookplus-admin', BookPlus::$plugin_url . 'css/admin.css', [], filemtime(BookPlus::$plugin_path . 'css/admin.css'));

        wp_enqueue_script('vuejs', BookPlus::$plugin_url . 'js/vue.min.js', [], BookPlus::$version, true);
        wp_enqueue_script('sweetalert', BookPlus::$plugin_url . 'js/sweetalert2.min.js', ['jquery'], BookPlus::$version, true);
        wp_enqueue_script('bookplus-admin', BookPlus::$plugin_url . 'js/admin.js', ['jquery', 'jquery-ui-sortable', 'wp-util'], filemtime(BookPlus::$plugin_path . 'js/admin.js'), true);
    }

    public static function include_dependencies()
    {
        // common
        include_once self::$plugin_path . 'includes/class.settings-api.php';
        include_once self::$plugin_path . 'includes/class.settings.php';
        include_once self::$plugin_path . 'includes/class.email.php';
        include_once self::$plugin_path . 'includes/class.link.php';

        // admins
        include_once self::$plugin_path . 'includes/class.auto-updates.php';
        include_once self::$plugin_path . 'includes/class.document.php';
        include_once self::$plugin_path . 'includes/class.ajax.php';
        include_once self::$plugin_path . 'includes/class.login.php';
        include_once self::$plugin_path . 'includes/class.editor.php';

        // frontend
        include_once self::$plugin_path . 'includes/class.front-end.php';

        // functions
        include_once self::$plugin_path . 'includes/functions.php';
    }
}

BookPlus::plugin_init();
