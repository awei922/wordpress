		</main><!-- #site-content -->

		<footer class="credits">
					
			<div class="section-inner">
				
				<a href="#" class="to-the-top">
					<div class="fa fw fa-angle-up"></div>
					<span class="screen-reader-text"><?php _e( 'To the top', 'rowling' ); ?></span>
				</a>
				
				<p class="copyright">
                    &copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'title' ) ); ?></a>.
                    <a href="http://www.beian.miit.gov.cn" target="_blank" rel="nofollow"> 粤ICP备14048036号</a>.
                </p>
				
				<p class="attribution">
                    <?php printf( __( 'Theme by %s', 'rowling' ), '<a href="https://www.andersnoren.se" target="_blank" rel="nofollow">Anders Nor&eacute;n</a>' ); ?> & <a href="https://wpfaq.cn">A.wei</a>
                </p>
				
			</div><!-- .section-inner -->
			
		</footer><!-- .credits -->

		<?php wp_footer(); ?>

        <script>
            //百度统计
            var _hmt = _hmt || [];
            (function () {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?96d91412aff9543cd8e022f381d8bf1c";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>

        </body>
	
</html>