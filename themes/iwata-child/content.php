<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

	$post_format = get_post_format() ? get_post_format() : 'standard';

	if ( $post_format === 'standard' ) :
	
		if ( has_post_thumbnail() && ! post_password_required() && is_singular()) : ?>
		
			<figure class="featured-media">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure><!-- .featured-media -->
		
		<?php endif; ?>
		
		<div class="post-header">

            <h2 class="post-title">
                <a href="<?php the_permalink(); ?>"><span class="fa fw fa-file-text"></span>
                    <?php the_title(); ?>
                </a>
            </h2>

            <time><?php the_time(get_option('date_format')); ?></time>
					
		</div><!-- .post-header -->

		<div class="post-content">
			<?php //the_excerpt(); ?>
		</div><!-- .post-content -->

	<?php elseif ( in_array( $post_format, array( 'quote', 'aside', 'image' ) ) ) : ?>

		<div class="post-content entry-content">
			<?php the_content(); ?>
		</div><!-- .post-content -->

		<?php iwata_post_meta(); ?>

	<?php endif; ?>

</div><!-- .post -->