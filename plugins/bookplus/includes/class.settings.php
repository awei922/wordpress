<?php


class BookPlus_Settings
{
    private static $settings_api;

    public static function settings_sections()
    {
        $sections = [
            'basics' => [
                'id' => 'bookplus_basics',
                'title' => __('Basic Settings', 'bookplus')
            ],
            'code' => [
                'id' => 'bookplus_code',
                'title' => __('Custom code', 'bookplus')
            ],
            'smtp' => [
                'id' => 'bookplus_smtp',
                'title' => __('SMTP Settings', 'bookplus')
            ],
        ];
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    public static function settings_fields()
    {
        $settings_sections = self::settings_sections();

        $settings_fields = [
            $settings_sections['basics']['id'] => [
                [
                    'name' => 'register_post_catalogs',
                    'label' => __('Register Post Catalogs', 'bookplus'),
                    'desc' => __('Register hierarchical posts to build catalogs', 'bookplus'),
                    'type' => 'checkbox',
                ],
                [
                    'name' => 'minor_auto_updates',
                    'label' => __('Minor Auto Updates', 'bookplus'),
                    'desc' => __('Enable minor automatic core updates, only security update', 'bookplus'),
                    'type' => 'checkbox',
                ],
                [
                    'name' => 'archive_display_excerpt',
                    'label' => __('Archive Show Excerpt', 'bookplus'),
                    'desc' => __('In archive and home page display the post excerpt', 'bookplus'),
                    'type' => 'checkbox',
                ],
                [
                    'name' => 'split_protected_posts',
                    'label' => __('Split Protected Posts', 'bookplus'),
                    'desc' => __('Password protected posts only the content after <code><--more--></code> require password', 'bookplus'),
                    'type' => 'checkbox',
                ],
                [
                    'name' => 'target_equal_blank',
                    'label' => __('Target Equal _Blank', 'bookplus'),
                    'desc' => __('The target property of tag <code>A</code> is set to <code>_blank</code> in the content', 'bookplus'),
                    'type' => 'checkbox',
                ],
                [
                    'name' => 'disable_block_editor',
                    'label' => __('Disable Block Editor', 'bookplus'),
                    'desc' => 'Disable gutenberg editor',
                    'type' => 'checkbox',
                ],
                [
                    'name' => 'limit_login_attempts',
                    'label' => __('<h2>Limit Login Attempts</h2>', 'bookplus'),
                    'desc' => 'Allowed',
                    'type' => 'checkbox',
                ],
                [
                    'name' => 'login_attempts_retries',
                    'label' => __('Login Attempts Retries', 'bookplus'),
                    'desc' => __('Number of retries allowed ', 'bookplus'),
                    'min' => 0,
                    'step' => 1,
                    'default' => 5,
                    'type' => 'number',
                    'sanitize_callback' => 'floatval'
                ],
                [
                    'name' => 'login_time_diff',
                    'label' => __('Login Time Diff', 'bookplus'),
                    'desc' => __('Time diff of retries allowed, Unit: minutes ', 'bookplus'),
                    'min' => 0,
                    'step' => 1,
                    'default' => 10,
                    'type' => 'number',
                    'sanitize_callback' => 'floatval'
                ],
            ],
            $settings_sections['code']['id'] => [
                [
                    'name' => 'header_code',
                    'label' => __('Header Code', 'bookplus'),
                    'placeholder' => __('Enter Code Snippet', 'bookplus'),
                    'desc' => __('Add header code snippet，e.g. css', 'bookplus'),
                    'size' => 'large',
                    'type' => 'textarea'
                ],

                [
                    'name' => 'footer_code',
                    'label' => __('Footer Code', 'bookplus'),
                    'placeholder' => __('Enter Code Snippet', 'bookplus'),
                    'desc' => __('Add footer code snippet，e.g. js', 'bookplus'),
                    'size' => 'large',
                    'type' => 'textarea'
                ],
            ],
            $settings_sections['smtp']['id'] => [
                [
                    'name' => 'smtp_from',
                    'label' => __('From Email Address', 'bookplus'),
                    'type' => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name' => 'smtp_from_name',
                    'label' => __('From Name', 'bookplus'),
                    'type' => 'text',
                    'default' => get_bloginfo('name'),
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name' => 'smtp_host',
                    'label' => __('SMTP Host', 'bookplus'),
                    'type' => 'text',
                    'default' => 'smtp.example.com',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name' => 'smtp_secure',
                    'label' => __('Type of Encryption', 'bookplus'),
                    'type' => 'radio',
                    'default' => 'ssl',
                    'options' => [
                        '' => 'None',
                        'ssl' => 'SSL',
                        'tls' => 'TLS'
                    ]
                ],
                [
                    'name' => 'smtp_port',
                    'label' => __('SMTP Port', 'bookplus'),
                    'desc' => __('Default port: 25, SSL: 465, TLS: 587', 'bookplus'),
                    'default' => 465,
                    'type' => 'number',
                    'sanitize_callback' => 'floatval'
                ],
                [
                    'name' => 'smtp_auth',
                    'label' => __('SMTP Authentication', 'bookplus'),
                    'type' => 'radio',
                    'default' => 1,
                    'options' => [
                        0 => 'No',
                        1 => 'Yes',
                    ]
                ],
                [
                    'name' => 'smtp_username',
                    'label' => __('SMTP Username', 'bookplus'),
                    'type' => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name' => 'smtp_password',
                    'label' => __('SMTP Password', 'bookplus'),
                    'type' => 'password',
                ],
                [
                    'name' => 'html',
                    'desc' => __('<strong>Test Email:</strong> Maybe you can click <a href="' . esc_url(wp_lostpassword_url()) . '" target="_blank">Lost your password?</a>', 'bookplus'),
                    'type' => 'html'
                ],
            ],
        ];

        return $settings_fields;
    }


    public static function init()
    {
        self::$settings_api = new BookPlus_Settings_API;

        add_action('admin_init', [__CLASS__, 'admin_init']);
        add_action('admin_menu', [__CLASS__, 'admin_menus']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);

        add_filter('plugin_action_links', array(__CLASS__, 'plugin_action_links'), 10, 2);
    }

    public static function admin_init()
    {
        //set the settings
        self::$settings_api->set_sections(self::settings_sections());
        self::$settings_api->set_fields(self::settings_fields());

        //initialize settings
        self::$settings_api->admin_init();
    }

    public static function admin_menus()
    {
        add_options_page(__('Bookplus Settings', 'bookplus'), __('Bookplus Settings', 'bookplus'), 'manage_options', 'bookplus_settings', [__CLASS__, 'page_settings']);
    }

    public static function plugin_action_links($links, $file)
    {
        if ($file == plugin_basename(BookPlus::$plugin_path . '/bookplus.php')) {
            $links[] = '<a href="' . esc_url(add_query_arg(['page' => 'bookplus_settings'], admin_url('options-general.php'))) . '">' . esc_html__('Settings', 'bookplus') . '</a>';
        }

        return $links;
    }

    public static function page_settings()
    {
        include_once BookPlus::$plugin_path . '/views/settings.php';
    }

    public static function enqueue_scripts($hook)
    {
        if ('settings_page_bookplus_settings' != $hook) {
            return false;
        }

        //css
        wp_enqueue_style('bookplus-admin', BookPlus::$plugin_url . 'css/admin.css', [], filemtime(BookPlus::$plugin_path . 'css/admin.css'));
    }

    public static function get_option($option, $section = '', $default = false)
    {
        if (empty($section)) {
            $settings_sections = self::settings_sections();
            $section = $settings_sections['basics']['id'];
        }

        $options = get_option($section, $default);

        if (isset($options[$option])) {
            return 'off' === $options[$option] ? false : ('on' === $options[$option] ? true : $options[$option]);
        }

        return $default;
    }
}

if (is_admin()) {
    BookPlus_Settings::init();
}

