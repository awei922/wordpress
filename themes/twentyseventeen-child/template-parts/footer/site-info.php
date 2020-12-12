<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>
<div class="site-info">
    <span>© <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>.
        <a href="http://www.beian.miit.gov.cn" target="_blank" rel="nofollow"> 粤ICP备20056374号</a>
    </span>

    <?php
    if (function_exists('the_privacy_policy_link')) {
        the_privacy_policy_link('<span role="separator" aria-hidden="true"></span>', '');
    }
    ?>

    <a class="alignright imprint" href="#masthead">
        <?php
        /* translators: %s: HTML character for up arrow */
        printf(__('Up %s', 'twentytwenty'), '<span class="arrow" aria-hidden="true">&uarr;</span>');
        ?>
    </a><!-- .to-the-top -->
</div><!-- .site-info -->
