<?php get_header(); ?>

<div class="section content">
	
	<div class="section-inner">

		<?php 

		$archive_title = get_the_archive_title();
		$archive_description = get_the_archive_description();

		if ( $archive_title || $archive_description ) : ?>

			<header class="archive-header">
			
				<?php if ( $archive_title ) : ?>
					<h1 class="archive-title">
                        <?php
                        if ( function_exists('yoast_breadcrumb') ) :
                            yoast_breadcrumb( );
                        else:
                            echo $archive_title;
                        endif;
                        ?>
                    </h1>
				<?php endif; ?>
				
				<?php if ( $archive_description ) : ?>
					<div class="archive-description"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
				<?php endif; ?>
				
			</header><!-- .archive-header -->

		<?php endif; ?>
																	                    
		<?php if ( have_posts() ) : ?>
		
			<div class="posts" id="posts">
								
				<?php 
				while ( have_posts() ) : the_post();
				
					get_template_part( 'content', get_post_format() );
													
				endwhile; 
				?>

			</div><!-- .posts -->
								
		<?php elseif ( is_search() ) : ?>

			<div class="post">
				<div class="post-content">
					<p><?php _e( 'You can give it another try through the search form below.', 'iwata' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .post-content -->
			</div><!-- .post -->

		<?php endif; ?>
		
		<?php get_template_part( 'pagination' ); ?>
	
	</div><!-- .section-inner -->
		
</div><!-- .content.section -->
	              	        
<?php get_footer(); ?>