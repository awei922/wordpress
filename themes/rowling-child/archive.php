<?php get_header(); ?>

<div class="wrapper section-inner group">
			
	<div class="content">

		<?php

		$archive_title = '';
		$archive_subtitle = '';
		$archive_description = get_the_archive_description();

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		if ( $paged > 1 || is_archive() || is_search() ) {

			if ( is_search() ) {
				$archive_title = sprintf( __( 'Search results: "%s"', 'rowling' ), get_search_query() );
			} else {
				$archive_title = get_the_archive_title();
			}

			$archive_subtitle = __( 'Page', 'rowling' ) . ' ' . $paged . '<span class="sep">/</span>' . $wp_query->max_num_pages;

		}
			
		if ( $archive_title || $archive_subtitle || $archive_description ) : ?>
		
			<div class="archive-header">

				<div class="group archive-header-inner">

					<?php if ( $archive_title ) : ?>
						<h1 class="archive-title">
                            <?php
                            if ( function_exists('yoast_breadcrumb') ) :
                                yoast_breadcrumb();
                            else:
                                echo wp_kses_post( $archive_title );
                            endif;
                            ?>
                        </h1>
					<?php endif; ?>
					
					<?php if ( $archive_subtitle ) : ?>
						<p class="archive-subtitle"><?php echo wp_kses_post( $archive_subtitle ); ?></p>
					<?php endif; ?>

				</div><!-- .group -->
				
			</div><!-- .archive-header -->
						
		<?php endif; ?>
																							                    
		<?php if ( have_posts() ) :
            global $cat;
            $sub_categories = get_categories(array('parent' => $cat));

            if ( $sub_categories ) :?>
		
			<div class="posts widget widget_archive" id="posts">

                <?php foreach ($sub_categories as $sub_category): ?>

                    <article <?php post_class( 'post' ); ?>>

                        <header class="post-header">

                            <h2 class="post-title">
                                <a href="<?php echo esc_url(get_category_link( $sub_category )) ?>"><span class="fa fw fa-folder"></span>
                                    <?php echo esc_html($sub_category->name); ?> &raquo;
                                </a>
                            </h2>

                        </header><!-- .post-header -->

                    </article><!-- .post -->

                <?php endforeach; ?>
	        	                    			
			</div><!-- .posts -->

            <?php endif; ?>

			<article class="post single single-post widget">

                <div class="post-header">

                    <h1 class="post-title"><?php echo wp_kses_post( $archive_title ); ?></h1>

                    <div class="post-meta">

                        <?php if ( $archive_description ) : ?>
                            <div class="archive-description"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
                        <?php endif; ?>
                        
                    </div><!-- .post-meta -->

                </div><!-- .post-header -->
			
				<div class="post-inner">
			
					<div class="post-content entry-content widget-content">

                        <ul>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <li class="clear">

                                    <a href="<?php the_permalink(); ?>" target="_blank"><span class="fa fw fa-file-alt"></span>
                                        <?php the_title(); ?>
                                    </a>

                                    <?php
                                    if ( comments_open() ) {
                                        comments_popup_link(__('<span class="fa fw fa-comment"> 0', 'rowling'), __('<span class="fa fw fa-comment"> 1', 'rowling'), __('<span class="fa fw fa-comment"> %', 'rowling'),'" target="_blank');
                                    }
                                    ?>

                                    <p class="archive-subtitle"><?php the_time( get_option( 'date_format' ) ); ?></p>

                                </li>

                            <?php endwhile; ?>
                        </ul>
					
					</div><!-- .post-content -->
				
				</div><!-- .post-inner -->
				
			</article><!-- .post -->

            <?php get_template_part( 'pagination' );?>

		<?php endif; ?>
		
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
</div><!-- .wrapper.section-inner -->
	              	        
<?php get_footer(); ?>