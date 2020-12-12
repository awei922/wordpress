<?php get_header(); ?>

    <div class="section content">

        <div class="section-inner">

            <?php

            $archive_title = get_the_archive_title();
            $archive_description = get_the_archive_description();

            if ( $archive_title || $archive_description ) : ?>

                <header class="archive-header">

                    <?php if ( $archive_title ) : ?>
                        <h1 class="archive-title"><?php echo $archive_title; ?></h1>
                    <?php endif; ?>

                    <?php if ( $archive_description ) : ?>
                        <div class="archive-description"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
                    <?php endif; ?>

                </header><!-- .archive-header -->

            <?php endif; ?>

            <?php
            global $cat;
            $sub_categories = get_categories(array('parent' => $cat,'hide_empty' => 0, 'order' => 'DESC'));
            if ( !$sub_categories ) : ?>

                <?php if ( have_posts() ) : ?>

                    <div class="posts" id="posts">

                        <?php
                        while ( have_posts() ) : the_post();

                            get_template_part( 'content', get_post_format() );

                        endwhile;
                        ?>

                    </div><!-- .posts -->

                    <?php get_template_part( 'pagination' ); ?>

                <?php else: ?>

                    <div class="post">
                        <div class="post-content">
                            <p><?php _e( 'You can give it another try through the search form below.', 'iwata' ); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .post-content -->
                    </div><!-- .post -->

                <?php endif; ?>

            <?php else: ?>

                <div class="post">
                    <div class="post-content row">

                        <?php foreach ($sub_categories as $sub_category): ?>
                            <div class="col-mb-6">
                                <h2 class="post-title"><a href="<?php echo esc_url(get_category_link( $sub_category )) ?>"><?php echo esc_html($sub_category->name); ?> &raquo;</a></h2>
                                <ul>
                                    <?php
                                    $cat_posts = get_posts(array('category' => $sub_category->cat_ID,'numberposts' => 5,'order' => 'ASC',));
                                    foreach ($cat_posts as $cat_post): ?>
                                        <li><a href="<?php the_permalink($cat_post) ?>"><?php echo esc_html($cat_post->post_title); ?></a></li>
                                    <?php endforeach;; ?>
                                    <li>...</li>
                                </ul>
                            </div>
                        <?php endforeach; ?>

                    </div><!-- .post-content -->
                </div><!-- .post -->

            <?php endif; ?>

        </div><!-- .section-inner -->

    </div><!-- .content.section -->

<?php get_footer(); ?>