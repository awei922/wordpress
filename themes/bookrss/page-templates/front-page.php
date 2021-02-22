<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="entry-page-image">
                    <?php the_post_thumbnail(); ?>
                </div><!-- .entry-page-image -->
            <?php endif; ?>

			<?php
            global $wp_query;
            $wp_query->query(['posts_per_page'=>1]);
			while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'content'); ?>

			<?php endwhile; // End of the loop. ?>

            <a class="more-link" href="<?php echo esc_url(get_permalink( get_option( 'page_for_posts' ))) ?>"><?php  _e('Read more...') ?></a>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>
