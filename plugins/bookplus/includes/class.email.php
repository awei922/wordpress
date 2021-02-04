<?php

class BookPlus_Email
{
    private static $options;

    public static function init()
    {
        $settings_sections = BookPlus_Settings::settings_sections();
        self::$options = get_option($settings_sections['smtp']['id']);
        if (empty(self::$options)) {
            return false;
        }

        add_action('phpmailer_init', [__CLASS__, 'mail_smtp']);
    }

    public static function mail_smtp($phpmailer)
    {
        $options = self::$options;

        $phpmailer->From = isset($options['smtp_from']) ? $options['smtp_from'] : '';
        $phpmailer->FromName = isset($options['smtp_from_name']) ? $options['smtp_from_name'] : '';
        $phpmailer->Host = isset($options['smtp_host']) ? $options['smtp_host'] : '';
        $phpmailer->SMTPSecure = isset($options['smtp_secure']) ? $options['smtp_secure'] : '';
        $phpmailer->Port = isset($options['smtp_port']) ? intval($options['smtp_port']) : 25;
        $phpmailer->Username = isset($options['smtp_username']) ? $options['smtp_username'] : '';
        $phpmailer->Password = isset($options['smtp_password']) ? $options['smtp_password'] : '';
        $phpmailer->SMTPAuth = isset($options['smtp_auth']) ? intval($options['smtp_auth']) : false;
        $phpmailer->IsSMTP();
    }
}

BookPlus_Email::init();
