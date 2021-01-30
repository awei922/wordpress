<?php
/**
 * Template Name: Front Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

            <?php
            global $post;
            $recent_posts = get_posts('numberposts=20&orderby=date');
            foreach( $recent_posts as $k=> $post ):
                if($k==0):
                    setup_postdata($post)
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_excerpt() ?>
                </div><!-- .entry-content -->

                <footer class="entry-meta">
                    <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-meta -->
            </article><!-- #post -->

            <?php
                endif;
            endforeach;
            ?>

            <article <?php post_class(); ?>>
                <div class="entry-content">
                    <h2><?php _e( 'Recent Posts'); ?></h2>
                    <ul>
                        <?php
                        foreach( $recent_posts as $k=> $post ):
                            if($k>0):
                                setup_postdata($post)
                        ?>
                            <li>
                                <span class="post-date"><?php echo esc_html( get_the_date() ); ?></span> &raquo;
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            </li>
                        <?php
                            endif;
                        endforeach;
                        ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink( get_option( 'page_for_posts' ))) ?>"><?php  _e('Read more...') ?></a>
                        </li>
                    </ul>
                </div><!-- .entry-content -->
            </article><!-- #post -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
