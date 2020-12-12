<?php

/**
 * Parent style.css
 */
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/**
 * Add a custom CSS
 */
function theme_custom_login()
{
    echo '<style>#login h1{display: none}</style>';
}

add_action('login_head', 'theme_custom_login');


/**
 * Open links
 */
add_filter('pre_option_link_manager_enabled', '__return_true');


/**
 * Customize Register
 * @param $wp_customize
 */
function theme_customize_register($wp_customize)
{
    $wp_customize->add_section('theme_options', array(
        'title' => __('Theme Options'),
        'priority' => 50
    ));

    //qq_url
    $wp_customize->add_setting('qq_url', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control('qq_url', array(
        'label' => __('QQ链接'),
        'section' => 'theme_options'
    ));

    //email_url
    $wp_customize->add_setting('email_url', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control('email_url', array(
        'label' => __('Email链接'),
        'section' => 'theme_options'
    ));

    //github_url
    $wp_customize->add_setting('github_url', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control('github_url', array(
        'label' => __('GitHub链接'),
        'section' => 'theme_options'
    ));

    //icp_num
    $wp_customize->add_setting('icp_num', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control('icp_num', array(
        'label' => __('ICP备案号'),
        'section' => 'theme_options'
    ));

    //statistics
    $wp_customize->add_setting('statistics', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control('statistics', array(
        'label' => __('统计代码'),
        'section' => 'theme_options',
        'type' => 'textarea'
    ));

    //wechat_image
    $wp_customize->add_setting('wechat_image', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wechat_image', array(
        'label' => __('WeChat二维码'),
        'section' => 'theme_options'
    )));

    //wxPublic_image
    $wp_customize->add_setting('wxPublic_image', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wxPublic_image', array(
        'label' => __('微信公众号二维码'),
        'section' => 'theme_options'
    )));
}

add_action('customize_register', 'theme_customize_register');

/**
 * Custom Post Content
 *
 * @param $content
 * @return string
 */
function theme_custom_post_content($content)
{
    global $post;

    //if post password
    if (post_password_required($post)) {
        $content = explode('<!--more-->', $post->post_content)[0] . $content . (get_theme_mod('wxPublic_image') ? '<blockquote><center><b>请扫描获取密码</b><br/><img width="150" src="' . esc_url(get_theme_mod('wxPublic_image')) . '"></center></blockquote>' : '');
    }

    //auto blank
    $content = str_replace('<a', '<a target="_blank" rel="nofollow"', $content);
    return $content;
}

add_filter('the_content', 'theme_custom_post_content');


/* ---------------------------------------------------------------------------------------------
   SET EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */

if (!function_exists('iwata_custom_excerpt_length')) {
    function iwata_custom_excerpt_length($length)
    {
        return 50;
    }

    add_filter('excerpt_length', 'iwata_custom_excerpt_length', 999);
}

/* ---------------------------------------------------------------------------------------------
   POST META FUNCTION
   --------------------------------------------------------------------------------------------- */
if (!function_exists('iwata_post_meta')) {
    function iwata_post_meta()
    { ?>

        <?php if (get_post_type() == 'post' || comments_open() || current_user_can('edit_posts')) : ?>

        <div class="post-meta">

            <?php if (get_post_type() == 'post') : ?>
                <p class="post-author">
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><span
                                class="fa fw fa-user"></span><?php echo esc_html(get_the_author_meta('display_name')); ?>
                        &nbsp;</a>
                </p>
            <?php endif; ?>

            <?php if (is_sticky()) : ?>
                <p class="post-sticky is-sticky"><span
                            class="fa fw fa-thumb-tack"></span><?php echo __('Sticky', 'iwata') . '<span> ' . __('Post', 'iwata') . '</span>'; ?>
                </p>
            <?php endif; ?>

            <?php if (get_post_type() == 'post') : ?>
                <p class="post-date"><a href="<?php the_permalink(); ?>"><span
                                class="fa fw fa-calendar"></span><?php the_time(get_option('date_format')); ?></a></p>
            <?php endif; ?>

            <?php if (comments_open()) : ?>
                <p class="post-comments">
                    <?php comments_popup_link('<span class="fa fw fa-comment"></span>' . __('Add Comment', 'iwata'), '<span class="fa fw fa-comment"></span>1 ' . __('Comment', 'iwata'), '<span class="fa fw fa-comment"></span>% ' . __('Comments', 'iwata')); ?>
                </p>
            <?php endif; ?>

            <?php edit_post_link('<span class="fa fw fa-cog"></span>' . __('Edit', 'iwata'), '<p class="post-edit">', '</p>'); ?>

        </div><!-- .post-meta -->

    <?php
    endif;
    }
}