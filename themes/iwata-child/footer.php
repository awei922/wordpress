</main><!-- #site-content -->

<footer class="section footer">
	
	<div class="section-inner">
		
		<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'site_name' ); ?></a>.
            <?php if(get_theme_mod('icp_num')): ?>
                <a href="http://www.beian.miit.gov.cn" target="_blank" rel="nofollow"> <?php echo esc_html(get_theme_mod('icp_num')) ?></a>.
            <?php endif; ?>
        </p>
				 
		<p class="credits">
            <?php _e( 'Theme by', 'iwata' ); ?> <a href="https://www.andersnoren.se" target="_blank" rel="nofollow">Anders Nor&eacute;n</a> & <a href="https://wpfaq.cn">A.wei</a>
        </p>
		
		<a href="#" class="to-the-top"><span class="fa fw fa-arrow-up"></span><span class="screen-reader-text"><?php _e( 'Go back to the top', 'iwata' ); ?></span></a>
				
	</div><!-- .section-inner -->
	
</footer><!-- .footer.section -->

<?php wp_footer(); ?>

<?php echo get_theme_mod('statistics'); ?>

</body>
</html>