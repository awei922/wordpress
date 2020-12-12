<?php get_header(); ?>

<div class="wrapper section-inner group">
	
	<div class="content">
												        
		<?php 
		if ( have_posts() ) : 
			while ( have_posts() ) : 
			
				the_post(); 
				?>
		
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'single single-post group' ); ?>>
					
					<div class="post-header">
											
						<?php if ( is_singular() ) : ?>
							<p class="post-categories">
                                <?php
                                if ( function_exists('yoast_breadcrumb') ) :
                                    yoast_breadcrumb();
                                else:
                                    the_category( ', ' );
                                endif;
                                ?>
                            </p>
							<?php 
						endif;
						
						the_title( '<h1 class="post-title">', '</h1>' );
						
						if ( is_singular() ) :

							$author_id = get_the_author_meta( 'ID' );
							$author_posts_url = get_author_posts_url( $author_id );
							
							?>
						
							<div class="post-meta">

								<span class="resp"><?php _e( 'Posted', 'rowling' ); ?></span> <span class="post-meta-author"><?php _e( 'by', 'rowling' ); ?> <a href="<?php echo esc_url( $author_posts_url ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span> <span class="post-meta-date"><?php _e( 'on', 'rowling' ); ?> <a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span> <?php edit_post_link(__( 'Edit', 'rowling' ), ' &mdash; ' ); ?>

								<?php if ( comments_open() && ! post_password_required() ) : ?>
									<span class="post-comments">
										<?php
										comments_popup_link(
											'<span class="fa fw fa-comment"></span>0<span class="resp"> ' . __( 'Comments', 'rowling' ) . '</span>', 
											'<span class="fa fw fa-comment"></span>1<span class="resp"> ' . __( 'Comment', 'rowling' ) . '</span>', 
											'<span class="fa fw fa-comment"></span>%<span class="resp"> ' . __( 'Comments', 'rowling' ) . '</span>'
										); 
										?>
									</span>
								<?php endif; ?>

							</div><!-- .post-meta -->

						<?php endif; ?>
						
					</div><!-- .post-header -->
					
					<?php 

					$post_format = get_post_format() ? get_post_format() : 'standard';

					if ( $post_format == 'gallery' && ! post_password_required() ) :
					
						rowling_flexslider( 'post-image' );
						
					elseif ( has_post_thumbnail() && ! post_password_required() ) : ?>
			
						<figure class="post-image">
								
							<?php 
								
							the_post_thumbnail( 'post-image' );

							$image_caption = get_the_post_thumbnail_caption( $post->ID );
							
							if ( $image_caption ) : ?>
								<div class="post-image-caption"><span class="fa fw fa-camera"></span><?php echo wpautop( $image_caption ); ?></div>
							<?php endif; ?>
							
						</figure><!-- .post-image -->
							
						<?php 
					endif;
					
					if ( is_single() ) {
						rowling_related_posts();
					}

					?>
							
					<div class="post-inner">
		
						<div class="post-content entry-content">
						
							<?php 
							
							the_content();
							
							wp_link_pages( array(
								'before'           => '<p class="page-links"><span class="title">' . __( 'Pages:', 'rowling' ) . '</span>',
								'after'            => '</p>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'separator'        => '',
								'pagelink'         => '%',
								'echo'             => 1
							) ); 

							?>
						
						</div><!-- .post-content -->

						<?php if ( is_single() ) : ?>

							<?php the_tags( '<div class="post-tags">', '', '</div>' ); ?>
							
							<div class="post-author">
								
								<a class="avatar" href="<?php echo $author_posts_url; ?>">
									<?php echo get_avatar( $author_id, 100 ); ?>
								</a>
								
								<h4 class="title"><a href="<?php echo $author_posts_url; ?>"><?php the_author_meta( 'display_name' ); ?></a></h4>

								<?php

								$author_description = get_the_author_meta( 'description' );

								if ( $author_description ) : ?>

									<div class="post-author-description">
										<?php echo wpautop( $author_description ); ?>
									</div><!-- .post-author-description -->

								<?php endif; ?>

							</div><!-- .post-author -->

							<?php rowling_related_posts(); ?>
						
						<?php endif; ?>
										
					</div><!-- .post-inner -->
					
				</article><!-- .post -->
				
				<?php 
				
				comments_template( '', true );
			
			endwhile; 
		endif; 
		?>
	
	</div><!-- .content -->
	
	<?php get_sidebar(); ?>
	
</div><!-- .wrapper -->
		
<?php get_footer(); ?>