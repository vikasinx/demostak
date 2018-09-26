<?php
/**
 * The sidebar containing the main widget area
 */

if ( is_active_sidebar( 'right_sidebar' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'right_sidebar' ); ?>
	</div>
<?php endif; ?>
