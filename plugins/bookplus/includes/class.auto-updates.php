<?php

class BookPlus_AutoUpdates
{
    public static function init()
    {
        if (!BookPlus_Settings::get_option('minor_auto_updates')) {
            return false;
        }

        if (!defined('WP_AUTO_UPDATE_CORE')) {
            define('WP_AUTO_UPDATE_CORE', 'minor');
        }
        add_filter('pre_site_transient_update_core', [__CLASS__, 'last_checked_atm']);
    }


    public static function last_checked_atm()
    {
        global $wp_version;

        $current = new stdClass;
        $current->updates = array();
        $current->version_checked = $wp_version;
        $current->last_checked = time();

        return $current;
    }
}

BookPlus_AutoUpdates::init();
