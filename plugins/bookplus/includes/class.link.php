<?php

class BookPlus_Link
{
    public static function init()
    {
        if (!BookPlus_Settings::get_option('link_manager')) {
            return false;
        }
        add_filter('pre_option_link_manager_enabled', '__return_true');
    }
}

BookPlus_Link::init();
