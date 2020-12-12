<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'twentyseventeen' ); ?>">
    <?php if (is_single() && strpos(get_the_category_list(), 'docs') !== false):?>
        <section class="widget">
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
                                <svg t="1592214382148" class="icon" viewBox="0 0 1024 1024" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg" p-id="8124" width="200" height="200">
                                    <path d="M576 272V0H176C149.4 0 128 21.4 128 48v928c0 26.6 21.4 48 48 48h672c26.6 0 48-21.4 48-48V320H624c-26.4 0-48-21.6-48-48z m128 472c0 13.2-10.8 24-24 24H344c-13.2 0-24-10.8-24-24v-16c0-13.2 10.8-24 24-24h336c13.2 0 24 10.8 24 24v16z m0-128c0 13.2-10.8 24-24 24H344c-13.2 0-24-10.8-24-24v-16c0-13.2 10.8-24 24-24h336c13.2 0 24 10.8 24 24v16z m0-144v16c0 13.2-10.8 24-24 24H344c-13.2 0-24-10.8-24-24v-16c0-13.2 10.8-24 24-24h336c13.2 0 24 10.8 24 24z m192-228.2v12.2H640V0h12.2c12.8 0 25 5 34 14l195.8 196c9 9 14 21.2 14 33.8z"
                                          fill="" p-id="8125"></path>
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </section>
    <?php
    else:
        dynamic_sidebar( 'sidebar-1' );
    endif
    ?>
</aside><!-- #secondary -->
