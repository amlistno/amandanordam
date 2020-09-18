<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Alchemist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php
		$show_content = get_theme_mod( 'alchemist_testimonial_show', 'excerpt' ); ?>
		<div class="entry-container">
			<?php if ( 'excerpt' === $show_content  ) : ?>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
			<?php elseif ( 'full-content' === $show_content ) : ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</div><!-- .entry-container -->

		<?php 
			$position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); 
			$show_title = get_theme_mod( 'alchemist_testimonial_display_title', 1 );
		?>

		<?php if ( has_post_thumbnail() || $show_title || $position ) : ?>
			<div class="hentry-inner-header">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="testimonial-thumbnail post-thumbnail">
						<?php the_post_thumbnail( 'alchemist-testimonial' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_title || $position ) : ?>
				<header class="entry-header">
					<?php if ( $show_title ) {
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						}
					?>
					<?php if ( $position ) : ?>
						<p class="entry-meta"><span class="position">
							<?php echo esc_html( $position ); ?></span>
						</p>
					<?php endif; ?>
				</header>
				<?php endif; ?>
			</div><!-- .hentry-inner-header -->
		<?php endif;?>
	</div><!-- .hentry-inner -->
</article>

