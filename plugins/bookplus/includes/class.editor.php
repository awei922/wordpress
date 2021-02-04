<?php

class BookPlus_Editor
{
    public static function init()
    {
        self::disable_gutenberg();

        add_filter('mce_buttons', [__CLASS__, 'more_buttons'], 10, 2);
    }

    public static function more_buttons($mce_buttons, $editor_id)
    {
        $buttons = $mce_buttons;
        $length = count($buttons);

        $mce_buttons[$length - 1] = 'wp_code';
        $mce_buttons[] = $buttons[$length - 1];

        return $mce_buttons;
    }

    public static function disable_gutenberg()
    {
        if (!BookPlus_Settings::get_option('disable_block_editor')) {
            return false;
        }

        add_filter('use_block_editor_for_post_type', '__return_false', 100);
        add_filter('gutenberg_can_edit_post_type', '__return_false', 100);

        remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
    }
}

BookPlus_Editor::init();
