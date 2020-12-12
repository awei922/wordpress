<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		
		<meta http-equiv="Content-type" content="text/html;charset=<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
		 
		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(); ?>>

		<?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>

		<a class="skip-link button" href="#site-content"><?php _e( 'Skip to the content', 'iwata' ); ?></a>
	
		<header class="header section<?php if ( get_header_image() ) : ?> bg-image" style="background-image: url(<?php header_image(); ?>);<?php endif; ?>">
			
			<div class="cover bg-accent"></div>
		
			<div class="section-inner group">
						
				<?php if ( get_bloginfo( 'title' ) ) : ?>
			
					<h2 class="blog-title">
						<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
                        <span class="blog-description"><?php echo esc_attr( get_bloginfo( 'description' ) ); ?> </span>
					</h2>
					
				<?php endif; ?>
				
				<button type="button" class="search-toggle">
					<span class="fa fw fa-search"></span>
					<span class="screen-reader-text"><?php _e( 'Click to view the search field', 'iwata' ); ?></span>
				</button>
				
				<button type="button" class="nav-toggle hidden">
					<span class="screen-reader-text"><?php _e( 'Click to view the navigation', 'iwata' ); ?></span>
					<div class="bars">
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
					</div>
				</button><!-- .nav-toggle -->
				
				<ul class="main-menu">
					
					<?php 
					if ( has_nav_menu( 'primary' ) ) {

						$menu_args = array( 
							'container' 		=> '', 
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'primary'			
						);

						wp_nav_menu( $menu_args ); 
					
					} else {

						$list_pages_args = array(
							'container' => '',
							'title_li' 	=> ''
						);
					
						wp_list_pages( $list_pages_args );
						
					} ?>
					
				 </ul><!-- .main-menu -->
			
			</div><!-- .section-inner -->
							
		</header><!-- .header -->

		<main id="site-content">
            
            <form method="get" class="header-search section hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="section-inner">
                    <input class="search-field" type="search" placeholder="<?php _e( 'Type and press enter', 'iwata' ); ?>" name="s" />
                    <button type="submit" class="screen-reader-text"><?php _e( 'Search', 'iwata' ); ?></button>
                </div><!-- .section-inner -->
            </form><!-- .header-search -->

            <ul class="mobile-menu hidden">

                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( $menu_args );
                } else {
                    wp_list_pages( $list_pages_args );
                }
                ?>

            </ul><!-- .mobile-menu -->

            <form method="get" class="mobile-search section hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input class="search-field" type="search" placeholder="<?php _e( 'Type and press enter', 'iwata' ); ?>" name="s" />
                <a class="search-button" onclick="document.getElementById( 'search-form' ).submit(); return false;"><span class="fa fw fa-search"></span></a>
            </form><!-- .mobile-search -->

            <?php
            if ( function_exists('yoast_breadcrumb') ) :
                yoast_breadcrumb( '<p id="breadcrumbs" class="section-inner bg-light has-small-font-size">','</p>' );
            endif;
            ?>