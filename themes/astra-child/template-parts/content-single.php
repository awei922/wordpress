<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

?>

<?php astra_entry_before(); ?>

<article
    <?php
    echo astra_attr(
        'article-single',
        array(
            'id'    => 'post-' . get_the_id(),
            'class' => join( ' ', get_post_class() ),
        )
    );
    ?>
>

    <?php astra_entry_top(); ?>

    <?php astra_entry_content_single(); ?>

    <?php astra_entry_bottom(); ?>

    <?php if (is_single() && strpos(get_the_category_list(), 'docs') !== false): ?>
        <section class="widget widget_recent_entries" style="margin-top: 4em;border-top: 1px solid #eee">
            <?php
            global $post;
            $the_ID = $post->ID;

            $categories = get_the_category();
            foreach ($categories as $category):
                ?>
                <h3 class="widget-title">&raquo;<?php echo esc_html($category->cat_name); ?></h3>
                <ul>
                    <?php
                    $posts = get_posts('order=ASC&numberposts=100&category=' . $category->cat_ID);
                    foreach ($posts as $post):
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" <?php if ($the_ID == get_the_ID()): ?> class="current-item" <?php endif; ?>>
                                <svg t="1603793803676" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1942" width="14" height="14"><path d="M768 981.333333H256c-72.533333 0-128-55.466667-128-128V170.666667c0-72.533333 55.466667-128 128-128h341.333333c12.8 0 21.333333 4.266667 29.866667 12.8l256 256c8.533333 8.533333 12.8 17.066667 12.8 29.866666v512c0 72.533333-55.466667 128-128 128zM256 128c-25.6 0-42.666667 17.066667-42.666667 42.666667v682.666666c0 25.6 17.066667 42.666667 42.666667 42.666667h512c25.6 0 42.666667-17.066667 42.666667-42.666667V358.4L580.266667 128H256z" p-id="1943"></path><path d="M853.333333 384h-256c-25.6 0-42.666667-17.066667-42.666666-42.666667V85.333333c0-25.6 17.066667-42.666667 42.666666-42.666666s42.666667 17.066667 42.666667 42.666666v213.333334h213.333333c25.6 0 42.666667 17.066667 42.666667 42.666666s-17.066667 42.666667-42.666667 42.666667zM682.666667 597.333333H341.333333c-25.6 0-42.666667-17.066667-42.666666-42.666666s17.066667-42.666667 42.666666-42.666667h341.333334c25.6 0 42.666667 17.066667 42.666666 42.666667s-17.066667 42.666667-42.666666 42.666666zM682.666667 768H341.333333c-25.6 0-42.666667-17.066667-42.666666-42.666667s17.066667-42.666667 42.666666-42.666666h341.333334c25.6 0 42.666667 17.066667 42.666666 42.666666s-17.066667 42.666667-42.666666 42.666667zM426.666667 426.666667H341.333333c-25.6 0-42.666667-17.066667-42.666666-42.666667s17.066667-42.666667 42.666666-42.666667h85.333334c25.6 0 42.666667 17.066667 42.666666 42.666667s-17.066667 42.666667-42.666666 42.666667z" p-id="1944"></path></svg>
                                <?php the_title(); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

</article><!-- #post-## -->

<?php astra_entry_after(); ?>
