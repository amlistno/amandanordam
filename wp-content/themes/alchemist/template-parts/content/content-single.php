<?php
/**
 * The template part for displaying single posts
 *
 * @package Alchemist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$header_image = alchemist_featured_overall_image();

	if ( 'disable' === $header_image ) :
		?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php if ( 'post' === get_post_type() ) :
				alchemist_entry_header();
			endif; ?>
		</header><!-- .entry-header -->
	<?php
	endif;
	?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'alchemist' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'alchemist' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php alchemist_entry_footer(); ?>

</article><!-- #post-## -->
