<?php

if (!function_exists('get_list_catalogs')) {
    function get_list_catalogs()
    {
        return BookPlus_FrontEnd::list_catalogs();
    }
}

if (!function_exists('get_nav_catalog')) {
    function get_nav_catalog()
    {
        return BookPlus_FrontEnd::nav_catalog();
    }
}


