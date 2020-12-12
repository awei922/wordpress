<?php get_header(); ?>

<div class="section content">
	
	<div class="section-inner">

        <header class="archive-header">
            <h1 class="archive-title">
                <?php
                if ( function_exists('yoast_breadcrumb') ) :
                    yoast_breadcrumb( );
                endif;
                ?>
            </h1>
        </header><!-- .archive-header -->
											        
		<?php 
		if ( have_posts() ) : 
			while ( have_posts() ) : 
			
				the_post(); 

				?>
			
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'single' ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="featured-media">	
							<?php the_post_thumbnail(); ?>
						</figure><!-- .featured-media -->
					<?php endif; ?>
					
					<div class="post-header">
						
						<?php
						the_title( '<h1 class="post-title">', '</h1>' );
						iwata_post_meta();
						?>
								
					</div><!-- .post-header -->
					
					<div class="post-content entry-content">
						<?php 
						the_content(); 
						edit_post_link();
						?>
					</div><!-- .post-content -->
					
					<?php 
				
					wp_link_pages( array(
						'after'            => '</p>',
						'before'           => '<p class="page-links"><span class="title">' . __( 'Pages:', 'iwata' ) . '</span>',
						'echo'             => 1,
						'link_after'       => '</span>',
						'link_before'      => '<span>',
						'pagelink'         => '%',
						'separator'        => '',
					) );

					if ( is_single() ) : ?>
					
						<div class="post-meta bottom">
										
							<?php if ( has_category() ) : ?>
							
								<p><span class="fa fw fa-folder"></span><?php the_category( ', ' ); ?></p>
							
							<?php endif; ?>
							
							<?php if ( has_tag() ) : ?>
									
								<p class="post-tags"><?php the_tags( '<span class="fa fw fa-tags"></span>', ', ', '' ); ?></p>
							
							<?php endif; ?>
							
						</div><!-- .post-meta.bottom -->
					
						<div class="post-navigation group">
						
							<?php
							$prev_post = get_previous_post();
							$next_post = get_next_post();
							
							if ( $next_post ) : ?>
								<a class="prev-post" href="<?php the_permalink( $next_post->ID ); ?>">
									<p><?php _e( 'Previous Post', 'iwata' ); ?></p>
									<h4><?php echo get_the_title( $next_post ); ?></h4>
								</a>
							<?php endif; ?>
							
							<?php if ( $prev_post ): ?>
								<a class="next-post" href="<?php the_permalink( $prev_post->ID ); ?>">
									<p><?php _e( 'Next Post', 'iwata' ); ?></p>
									<h4><?php echo get_the_title( $prev_post ); ?></h4>
								</a>
							<?php endif; ?>

						</div><!-- .post-navigation -->

					<?php endif; ?>
				
				</div><!-- .post -->
																				
				<?php
			endwhile; 
		endif; 
		?>
		
	</div><!-- .section-inner -->
	
</div><!-- .content -->

<?php 

$post_type = get_post_type();

// Output comments wrapper if it's a post, or if comments are open, or if there's a comment number – and check for password
if ( ( $post_type == 'post' || comments_open() || get_comments_number() ) && ! post_password_required() ) : ?>

	<div class="comments-section section">
		
		<div class="section-inner">
								
			<?php comments_template( '', true ); ?>
		
		</div><!-- .section-inner --> 

	</div><!-- .comments-section -->

<?php endif; ?>
		
<?php get_footer(); ?>