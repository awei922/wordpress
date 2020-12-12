<?php
/**
 * Single Posts Template
 *
 * @file           single.php
 * @package        Responsive
 * @author         CyberChimps
 * @copyright      2020 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 * @since          available since Release 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

Responsive\responsive_wrapper_top(); // before wrapper content hook.
// Elementor `single` location.
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	Responsive\responsive_wrapper();

	while ( have_posts() ) :
		the_post();
		get_template_part( 'partials/single/layout', get_post_type() );
		comments_template();
	endwhile;

	?>

			</main><!-- end of #primary -->

	<?php
    if (strpos(get_the_category_list(), 'docs') !== false):
        ?>

        <aside id="secondary" class="widget-area <?php echo esc_attr( implode( ' ', responsive_get_sidebar_classes() ) ); ?>" role="complementary" <?php responsive_schema_markup( 'sidebar' ); ?>>
            <section class="widget-wrapper widget_recent_entries">
                <?php
                global $post;
                $the_ID = $post->ID;

                $categories = get_the_category();
                foreach ($categories as $category):
                    ?>
                    <h2 class="widget-title"><?php echo esc_html($category->cat_name); ?></h2>
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
        </aside>

    <?php
    else:
	    get_sidebar();
    endif;
	Responsive\responsive_wrapper_close();
}
	Responsive\responsive_wrapper_end(); // after wrapper hook.
	get_footer();
?>
