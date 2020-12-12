<?php
/**
 * Template Name: Welcome
 * @package WordPress
 */
get_header();?>

<div class="section content">
	
	<div class="section-inner">

			<header class="archive-header">

                <div class="row">
                    <div class="col-mb-9">
                        <h1 class="archive-title">
                            <?php
                            $count_posts = wp_count_posts();
                            $count_comments = wp_count_comments();
                            printf('目前有 <em class="post-title">%s</em> 篇文章，并有 <em class="post-title">%s</em> 条评论和 <em class="post-title">%s</em> 个分类.',
                                $count_posts->publish, $count_comments->approved, count(get_categories(array('parent' => 0,'hide_empty'=>false))));
                            ?>
                            <p><?php _e('Get started', 'default' ); ?></p>
                        </h1>

                        <div class="archive-description">

                            <?php if(get_theme_mod('qq_url')): ?>
                                <a href="<?php echo esc_url(get_theme_mod('qq_url')) ?>" target="_blank" rel="nofollow"><span class="fa fa-2x fa-qq" ></span></a>
                            <?php endif; ?>

                            <?php if(get_theme_mod('wechat_image')): ?>
                                <a href="<?php echo esc_url(get_theme_mod('wechat_image')) ?>" target="_blank" rel="nofollow"><span class="fa fa-2x fa-wechat" ></span></a>
                            <?php endif; ?>

                            <?php if(get_theme_mod('email_url')): ?>
                                <a href="<?php echo esc_url(get_theme_mod('email_url')) ?>" target="_blank" rel="nofollow"><span class="fa fa-2x fa-envelope" ></span></a>
                            <?php endif; ?>

                            <?php if(get_theme_mod('github_url')): ?>
                                <a href="<?php echo esc_url(get_theme_mod('github_url')) ?>" target="_blank" rel="nofollow"><span class="fa fa-2x fa-github" ></span></a>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="col-mb-3">
                        <?php if ( get_theme_mod('wxPublic_image')) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('wxPublic_image')) ?>">
                        <?php endif; ?>
                    </div>
                </div>

			</header><!-- .archive-header -->

			<div class="post">
				<div class="post-content row has-small-font-size">

                    <section class="col-mb-4">
                        <h2 class="post-title pingbacks-title"><?php _e( 'Recent Posts', 'default' ); ?></h2>
                        <ul class="pingbacklist ">
                            <?php wp_get_archives(array('type'=>'postbypost','limit'=>5)); ?>
                            <li><a href="<?php echo esc_url( home_url() ); ?>/posts" rel="home"><?php _e('Read more...'); ?>  &raquo;</a></li>
                        </ul>
                    </section>
                    <section class="col-mb-5">
                        <h2 class="post-title pingbacks-title"><?php _e( 'Recent Comments', 'default' ); ?></h2>
                        <ul class="pingbacklist ">
                            <?php
                                $comments = get_comments(array( 'number' => 5 ));
                                foreach ( $comments as $comment ):?>
                                    <li>
                                        <a href="<?php the_permalink($comment->comment_post_ID); ?>#comment-<?php echo $comment->comment_ID; ?>">
                                            <?php echo esc_html(get_comment_author( $comment)) ?>
                                        </a> <?php echo esc_html(get_comment_excerpt( $comment )); ?>
                                    </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                    <section class="col-mb-3">
                        <h2 class="post-title pingbacks-title"><?php _e( 'Categories', 'default' ); ?></h2>
                        <ul class="pingbacklist ">
                            <?php
                            $categories = get_categories(array('parent' => 0,'hide_empty'=>false));
                            foreach ($categories as $category): ?>
                                <li><a href="<?php echo esc_url(get_category_link( $category )) ?>"><?php echo esc_html($category->name); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </section>

                    <?php
                    $bookmarks = get_bookmarks('orderby=date');
                    if (!empty($bookmarks)) : ?>
                        <section class="col-mb-12">
                            <div class="bookmarks">
                            <?php echo __('Bookmarks').'：';
                            foreach ($bookmarks as $bookmark): ?>
                                <a href="<?php echo esc_url($bookmark->link_url) ?>" title="<?php echo esc_attr($bookmark->link_description) ?>" target="_blank" >
                                    <?php echo esc_html($bookmark->link_name); ?>
                                </a>
                            <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>

				</div><!-- .post-content -->
			</div><!-- .post -->
	
	</div><!-- .section-inner -->
		
</div><!-- .content.section -->
	              	        
<?php get_footer(); ?>