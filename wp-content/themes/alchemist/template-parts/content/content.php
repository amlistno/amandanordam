<?php
/**
 * The template part for displaying content
 *
 * @package Alchemist
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-wrapper">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php
					$columns = alchemist_get_posts_columns();
					$thumbnail = 'post-thumbnail';

					if ( 'layout-one' === $columns ) {
						$thumbnail = 'alchemist-blog';
						$layout  = alchemist_get_theme_layout();

						if ( 'no-sidebar-full-width' === $layout ) {
							$thumbnail = 'alchemist-slider';
						}
					}

					the_post_thumbnail( $thumbnail );
					?>
				</a>
			</div>
		<?php endif; ?>

		<div class="entry-container">
			<header class="entry-header">
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky-post"><?php esc_html_e( 'Featured', 'alchemist' ); ?></span>
				<?php endif; ?>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php echo alchemist_entry_category_date(); ?>

			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<div class="entry-footer">
				<div class="entry-meta">
					<?php
						alchemist_edit_link();
					?>
				</div>
			</div>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article><!-- #post-## -->
