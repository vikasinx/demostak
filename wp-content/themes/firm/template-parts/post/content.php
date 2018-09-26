<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (has_post_thumbnail( $post->ID ) ): ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<?php endif; ?>
		<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' );	?>
		</header>
		<div class="post-meta">
			<span class="post-date"><?php the_date(); ?></span>			
			<span class="comment-count"> • Comments(<?php echo get_comments_number(); ?>)</span>
			<span class="post-author">  • By <?php the_author_meta('display_name'); ?></span>
		</div>

	<div class="entry-content">
		<?php  the_content(); ?>
		<div class="next_prev_wrapper">
			<div class="prev_post"> 
				<?php previous_post_link(); ?>
			</div>    
			<div class="next_post">
				<?php next_post_link(); ?>
			</div>
		</div>
		
	</div>
</article>
