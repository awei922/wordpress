<?php

/**
 * Plugin Name:       BookPlus
 * Plugin URI:        https://gravatar.cn/
 * Description:       A post catalog plugin for WordPress
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

        self::include_dependencies();
    }


    public static function activation_hook()
    {
    }

    public static function deactivation_hook()
    {
    }

    public static function include_dependencies()
    {
        // common
        include_once self::$plugin_path . 'includes/class.settings-api.php';
        include_once self::$plugin_path . 'includes/class.settings.php';
        include_once self::$plugin_path . 'includes/class.email.php';

        // admins
        include_once self::$plugin_path . 'includes/class.auto-updates.php';
        include_once self::$plugin_path . 'includes/class.post-catalogs.php';
        include_once self::$plugin_path . 'includes/class.ajax.php';
        include_once self::$plugin_path . 'includes/class.login.php';
        include_once self::$plugin_path . 'includes/class.editor.php';

        // frontend
        include_once self::$plugin_path . 'includes/class.front-end.php';
        include_once self::$plugin_path . 'functions.php';
    }
}

BookPlus::plugin_init();
