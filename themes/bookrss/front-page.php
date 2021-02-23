<?php
/**
 * Template Name: Front Page Template
 */

get_header();
?>

    <main id="site-content" role="main">

        <div class="container">

            <div class="row">

                <div class="col-mb-12 col-8">

                    <?php
                    global $wp_query;
                    $wp_query->query(['posts_per_page'=>1]);

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
                    }
                    ?>

                    <hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />

                    <article <?php post_class(); ?>>

                        <div class="post-inner thin">

                            <div class="entry-content">

                                <h2><?php _e( 'Recent Posts'); ?></h2>

                                <ul>
                                    <?php
                                    global $wp_query;
                                    $wp_query->query(['posts_per_page'=>10]);

                                    while ( have_posts() ) {
                                        the_post();
                                        ?>
                                        <li>
                                            <span class="post-date"><?php echo esc_html(get_the_date()); ?>&raquo;</span>
                                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a class="more-link" href="<?php echo esc_url(get_permalink( get_option( 'page_for_posts' ))) ?>"><?php  _e('Read more...') ?></a>
                                    </li>
                                </ul>

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