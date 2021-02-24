<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

    <main id="site-content" role="main">

        <div class="container">

            <div class="row">

                <div class="col-mb-12 col-8">

                    <?php

                    if (!get_the_content()) {
                        global $wp_query;
                        $wp_query->query(['posts_per_page' => 1]);
                    }

                    if ( have_posts() ) {

                        $i = 0;

                        while ( have_posts() ) {
                            $i++;
                            if ( $i > 1 ) {
                                echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
                            }
                            the_post();

                            get_template_part( 'template-parts/content', get_post_type() );

                        }
                    } elseif ( is_search() ) {
                        ?>

                        <div class="no-search-results-form section-inner thin">

                            <?php
                            get_search_form(
                                array(
                                    'label' => __( 'search again', 'twentytwenty' ),
                                )
                            );
                            ?>

                        </div><!-- .no-search-results -->

                    <?php } ?>

                    <hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />

                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                        <div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

                            <div class="entry-content">

                                <?php if (function_exists('the_recent_posts')) {
                                    the_recent_posts();
                                } ?>

                            </div><!-- .entry-content -->

                        </div><!-- .post-inner -->

                    </article><!-- .post -->

                </div>

                <?php get_sidebar(); ?>

            </div>

        </div>

    </main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
