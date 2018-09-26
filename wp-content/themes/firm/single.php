<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>
<div class="wrapper">
	<div class="wrap_inner">
		<div class="grid-container">
			<div class="grid-70 tablet-grid-70  mobile-grid-100">
				<div class="content-area">
					<?php
					
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/post/content');
					
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.

					?>
				</div>
			</div>
		</div>
			<div class="grid-30 tablet-grid-30  mobile-grid-100">
				<div class="sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
	</div>
</div>

<?php get_footer();
