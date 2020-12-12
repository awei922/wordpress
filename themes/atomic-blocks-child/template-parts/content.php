<?php
/**
 * The template used for displaying standard post content
 *
 * @package Atomic Blocks
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content">
        <?php
            if(is_single()){
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs"><i class="fa fa-home"></i> ', '</p>');
                }
            }
        ?>
		<header class="entry-header">
			<?php if( is_single() ) { ?>	
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
			<?php } else { ?>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
			<?php } ?>
			
			<?php atomic_blocks_post_byline(); ?>

            <span class="entry-byline"><?php if ( function_exists('the_views') ) : the_views(); endif?></span>
        </header>
		
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="featured-image">
				<?php if ( is_single() ) { ?>
					<?php the_post_thumbnail( 'atomic-blocks-featured-image' ); ?>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'atomic-blocks-featured-image' ); ?></a>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="entry-content">

			<?php
			// Get the content
			if(!is_single()){
                the_excerpt( esc_html__( 'Read More', 'atomic-blocks' ) );
            }else{ ?>

                <?php
                    the_content( esc_html__( 'Read More', 'atomic-blocks' ) );
                ?>

			<?php
            }
			// Post pagination links
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atomic-blocks' ),
				'after'  => '</div>',
			) );

			if ( is_single()  ) {
	        	// Post meta sidebar
	        	get_template_part( 'template-parts/content-meta' );

				// Author profile box
				atomic_blocks_author_box();

				// Post navigations
				if( is_single() ) {
					if( get_next_post() || get_previous_post() ) {
						atomic_blocks_post_navs();
				} }

				// Comments template
				comments_template();
			} ?>
		</div><!-- .entry-content -->
	</div><!-- .post-content-->

</article><!-- #post-## -->
