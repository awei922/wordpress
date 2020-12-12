<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>
<div class="site-branding">
    <div class="wrap">

        <?php the_custom_logo(); ?>

        <div class="site-branding-text">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

            <?php
            $description = get_bloginfo( 'description', 'display' );

            if ( $description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $description; ?></p>
            <?php endif; ?>
        </div><!-- .site-branding-text -->

        <div class="site-branding-search">
            <?php get_search_form(); ?>
        </div><!-- .site-branding-search -->

        <?php if ( ( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : ?>
            <a href="#content" class="menu-scroll-down"><?php echo twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'twentyseventeen' ); ?></span></a>
        <?php endif; ?>

    </div><!-- .wrap -->
</div><!-- .site-branding -->
