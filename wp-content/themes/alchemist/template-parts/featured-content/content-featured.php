<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Alchemist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry' ); ?>>
	<div class="hentry-inner">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php
			$thumbnail = 'post-thumbnail';

			the_post_thumbnail( $thumbnail );
			?>
		</a></div>
		<?php endif; ?>

		<?php 
			$title = 'entry-title';
		 ?>
		<div class="entry-container product-container">
			<header class="entry-header">

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				<div class="entry-meta">
				<?php 
			 		echo alchemist_entry_category_date();		
			 	?>
				</div><!-- .entry-meta -->
			</header>

			<?php
				$excerpt = get_the_excerpt();

				echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			?>

		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
