<?php
/**
 * The main template file
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
			<div class="grid-70 tablet-grid-70  mobile-grid-100">
				<div class="content-area">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
						<div class="blog-content">
							<?php if (has_post_thumbnail( $post->ID ) ): ?>
								<div class="post-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
								</div>
								<?php endif; ?>
								<div class="blog-title">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
								<div class="post-meta">
									<span class="post-date"><?php echo get_the_date(); ?></span>			
									<span class="comment-count"> • Comments(<?php echo get_comments_number(); ?>)</span>
									<span class="post-author">  • By <?php the_author_meta('display_name'); ?></span>
								</div>
							
							<?php the_excerpt(); ?>
							<div class="readmore">
								<a href="<?php the_permalink(); ?>">Read More >></a>
							</div>
						</div>					
								
					<?php endwhile;  ?>

					<!-- Add the pagination functions here. -->
					<div class="pagination">
						<div class="nav-previous alignleft"><?php next_posts_link( ' Older posts' ); ?></div>
						<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts ' ); ?></div>

						<?php else : ?>
						<p><?php _e('Sorry, no posts availabel.'); ?></p>
						<?php endif; ?>
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
</div>

<?php get_footer();?>