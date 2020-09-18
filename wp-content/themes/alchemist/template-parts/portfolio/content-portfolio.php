<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Alchemist
 */

$layout    = get_theme_mod( 'alchemist_portfolio_content_layout', 'layout-three' );
global $post;

$categories_list = get_the_category();

$classes = 'grid-item';
foreach ( $categories_list as $cat ) {
	$classes .= ' ' . $cat->slug ;
}
?>

<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class( esc_attr( $classes ) ); ?>>
	<div class="hentry-inner">
		<div class="post-thumbnail">
	        <a href="<?php the_permalink(); ?>">
	            <?php
				// Output the featured image.
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'alchemist-portfolio' );
				} else {
					echo alchemist_get_no_thumb_image( 'alchemist-portfolio' );
				}
				?>
	        </a>
	    </div>

		<div class="entry-container">
			<div class="inner-wrap">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?>
					<div class="entry-meta">
						<?php alchemist_entry_posted_on(); ?>
					</div>
				</header>
			</div>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
