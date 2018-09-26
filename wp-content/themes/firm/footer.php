<?php
/**
 * The template for displaying the footer
 */
?>
<footer>
	<div class="footer-inner">
		<div class="grid-container">
			<?php  
				if( is_active_sidebar( 'footer_sidebar' ) ) : ?>
					<div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
						<?php dynamic_sidebar( 'footer_sidebar' ); ?>
					</div>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
