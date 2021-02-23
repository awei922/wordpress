<?php
if ( ! is_active_sidebar( 'sidebar-0' ) ) {
	return;
}
?>

<aside id="secondary" class="col-offset-1 col-3 kit-hidden-tb widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar' ); ?>">
	<?php dynamic_sidebar( 'sidebar-0' ); ?>
</aside><!-- #secondary -->
