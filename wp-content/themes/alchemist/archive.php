<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alchemist
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="archive-posts-wrapper">
				<?php $header_image = alchemist_featured_overall_image();

				if ( 'disable' === $header_image ) : ?>
					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
				<?php endif; ?>	
				<div class="section-content-wrapper <?php echo esc_attr( alchemist_get_posts_columns() ); ?>">
					<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content/content', get_post_format() );

					// End the loop.
					endwhile;

					alchemist_content_nav();?>
				</div><!-- .section-content-wrap -->
			</div><!-- .archive-posts-wrapper -->

		<?php
		else :
			get_template_part( 'template-parts/content/content', 'none' );

		endif;?>


		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>