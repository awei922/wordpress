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

				<?php if ( $archive_description ) : ?>
					<div class="archive-description"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
				<?php endif; ?>
				
			</div><!-- .archive-header -->
						
		<?php endif; ?>
																							                    
		<?php if ( have_posts() ) : ?>
		
			<div class="posts" id="posts">
					
				<?php 
				while ( have_posts() ) : the_post(); 
		    	
		    		get_template_part( 'content', get_post_format() );
		    			        		            
				endwhile; 
				?>
	        	                    			
			</div><!-- .posts -->
		
			<?php
			
			get_template_part( 'pagination' );
		
		elseif ( is_search() ) : 

			?>

			<article class="post single single-post">
			
				<div class="post-inner">
			
					<div class="post-content entry-content">
					
						<p><?php _e( 'No results. Try again, would you kindly?', 'rowling' ); ?></p>
						
						<?php get_search_form(); ?>
					
					</div><!-- .post-content -->
				
				</div><!-- .post-inner -->
				
			</article><!-- .post -->

		<?php endif; ?>
		
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
</div><!-- .wrapper.section-inner -->
	              	        
<?php get_footer(); ?>