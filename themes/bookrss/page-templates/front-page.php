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
        global $post;
        $recent_posts = get_posts('numberposts=20&orderby=date');
        foreach( $recent_posts as $k=> $post ):
            if($k==0):
                setup_postdata($post)
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
                    <?php the_post_thumbnail(); ?>
                <?php endif; ?>
                <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            </header>

            <div class="entry-content">
                <?php the_excerpt() ?>
            </div><!-- .entry-content -->
            <footer class="entry-meta">
                <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
            </footer><!-- .entry-meta -->
        </article><!-- #post -->

        <?php
            endif;
        endforeach;
        ?>

    </div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>
