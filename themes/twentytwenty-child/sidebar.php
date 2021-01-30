<?php
/**
 * The main sidebar template file
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Prologe
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Check if Sidebar has widgets.
if (   ! is_active_sidebar( 'left-sidebar'  )
	&& ! is_active_sidebar( 'right-sidebar' ) 
	&& ! is_active_sidebar( 'blog-sidebar' )
	)
	return;

$prologe_lite_blog_layout = esc_attr(get_theme_mod( 'prologe_lite_blog_layout', 'default' ) );
$prologe_lite_single_layout = get_theme_mod( 'prologe_lite_single_layout', 'single-right' );

// Use the sidebar that relates to the page type being viewed
if ( is_page_template( 'templates/template-left.php' ) ) {
		
		echo '<aside id="left-sidebar" class="col-lg-4 order-4 order-lg-1 widget-area clear">';	
			dynamic_sidebar( 'left-sidebar' );		
		echo '</aside>';	

} elseif ( is_page_template( 'templates/template-right.php' ) ) {
		
		echo '<aside id="right-sidebar" class="col-lg-4 widget-area clear">';  
			dynamic_sidebar( 'right-sidebar' );
		echo '</aside>';	
	
// Skip to the blog sidebar for blog and archives if we are not on a page template
} else {
		
		// Blog left or right sidebars
		if ( 'default-left' === $prologe_lite_blog_layout ||  'single-left' === $prologe_lite_single_layout ) {	
				echo '<aside id="blog-sidebar" class="col-lg-4 order-4 order-lg-1 widget-area clear">';	
					dynamic_sidebar( 'blog-sidebar' );		
				echo '</aside>';	
		} else {
			echo '<aside id="blog-sidebar" class="col-lg-4 widget-area clear">';	
				dynamic_sidebar( 'blog-sidebar' );		
			echo '</aside>';			
		}
	} 
	
?>
