<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<div class="wrapper">
	<div class="wrap_inner">		
			<header class="page-header">
				<div class="grid-container">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</div>
			</header>
		<div class="grid-container">
			<div class="grid-100 tablet-grid-100  mobile-grid-100">
				<div class="content-area">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
						<div class="page-content">
							<?php the_content(); ?>
						</div>					
								
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer();?>
