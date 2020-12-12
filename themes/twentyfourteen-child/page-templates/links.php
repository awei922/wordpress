<?php
/**
 * Template Name: 友情链接
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

    <div id="main-content" class="main-content">

        <?php
        if (is_front_page() && twentyfourteen_has_featured_posts()) {
            // Include the featured content template.
            get_template_part('featured-content');
        }
        ?>
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

                <?php
                // Start the Loop.
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php
                        // Page thumbnail and title.
                        twentyfourteen_post_thumbnail();
                        the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
                        ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            ?>
                            <!-- 友情链接 -->
                            <div class="page-links">
                                <?php
                                function get_the_link_items($id = null)
                                {
                                    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
                                    $default_ico = 'https://s.w.org/favicon.ico?2';
                                    $output = '';
                                    if (!empty($bookmarks)) {
                                        $output .= '<ul>';
                                        foreach ($bookmarks as $bookmark) {
                                            $output .= '<li><img src="' . $bookmark->link_url . '/favicon.ico" onerror="javascript:this.src=\'' . $default_ico . '\'" /><a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >' . $bookmark->link_name . '</a></li>';
                                        }
                                        $output .= '</ul><div class="clear"></div>';
                                    }
                                    return $output;
                                }

                                $linkcats = get_terms('link_category');
                                if (!empty($linkcats)) {
                                    foreach ($linkcats as $linkcat) {
                                        $result .= '<h3>' . $linkcat->name . '</h3>';
                                        if ($linkcat->description) $result .= '<blockquote>' . $linkcat->description . '</blockquote>';
                                        $result .= get_the_link_items($linkcat->term_id);
                                    }
                                } else {
                                    $result = get_the_link_items();
                                }
                                echo $result;
                                ?>
                            </div>
                            <!-- 友情链接 END-->
                            <?php

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfourteen') . '</span>',
                                    'after' => '</div>',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                                )
                            );

                            edit_post_link(__('Edit', 'twentyfourteen'), '<span class="edit-link">', '</span>');
                            ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post-## -->
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                endwhile;
                ?>

            </div><!-- #content -->
        </div><!-- #primary -->
        <?php get_sidebar('content'); ?>
    </div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
