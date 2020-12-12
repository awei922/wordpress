<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package OceanWP WordPress theme
 */

// Retunr if full width or full screen.
if ( in_array( oceanwp_post_layout(), array( 'full-screen', 'full-width' ), true ) ) {
	return;
} ?>

<?php do_action( 'ocean_before_sidebar' ); ?>

<aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary"<?php oceanwp_schema_markup( 'sidebar' ); ?> role="complementary" aria-label="<?php esc_attr_e( 'Primary Sidebar', 'oceanwp' ); ?>">

	<?php do_action( 'ocean_before_sidebar_inner' ); ?>

	<div id="right-sidebar-inner" class="clr">

		<?php
		$sidebar = oceanwp_get_sidebar();
		if ( $sidebar ) {
            if (is_single() && strpos(get_the_category_list(), 'docs') !== false):
                ?>
                <section class="widget widget_recent_entries">
                    <?php
                    global $post;
                    $the_ID = $post->ID;

                    $categories = get_the_category();
                    foreach ($categories as $category):
                        ?>
                        <h3 class="widget-title"><?php echo esc_html($category->cat_name); ?></h3>
                        <ul>
                            <?php
                            $posts = get_posts('order=ASC&numberposts=20&category=' . $category->cat_ID);
                            foreach ($posts as $post):
                                ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" <?php if ($the_ID == get_the_ID()): ?> class="current-item" <?php endif; ?>>
                                        <?php the_title(); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </section>
        <?php
            else:
                dynamic_sidebar( $sidebar );
            endif;
		}
		?>

	</div><!-- #sidebar-inner -->

	<?php do_action( 'ocean_after_sidebar_inner' ); ?>

</aside><!-- #right-sidebar -->

<?php do_action( 'ocean_after_sidebar' ); ?>
