<?php
/**
 * The template for displaying testimonial items
 *
 * @package Alchemist
 */
?>

<?php
$enable = get_theme_mod( 'alchemist_testimonial_option', 'disabled' );

if ( ! alchemist_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

// Get Jetpack options for testimonial.
$jetpack_defaults = array(
	'page-title' => esc_html__( 'Testimonials', 'alchemist' ),
);

// Get Jetpack options for testimonial.
$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );

$headline = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'alchemist' );

$subheadline = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';


$layouts = 1;

$classes[] = 'section testimonial-content-section';

$classes[] = 'layout-one';

if ( ! $headline && ! $subheadline ) {
	$classes[] = 'no-headline';
}

?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">

	<?php if ( $headline || $subheadline ) : ?>
		<div class="section-heading-wrapper testimonial-content-section-headline">
		<?php if ( $subheadline ) : ?>
			<div class="taxonomy-description-wrapper section-subtitle">
				<?php
	            $subheadline = apply_filters( 'the_content', $subheadline );
	            echo str_replace( ']]>', ']]&gt;', $subheadline );
                ?>
			</div><!-- .taxonomy-description-wrapper -->
		<?php endif; ?>
		<?php if ( $headline ) : ?>
			<div class="section-title-wrapper">
				<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
			</div><!-- .section-title-wrapper -->
		<?php endif; ?>

		</div><!-- .section-heading-wrapper -->
	<?php endif; ?>

		<div class="section-content-wrapper testimonial-content-wrapper">

			<!-- empty element for pager links -->
			<div id="testimonial-slider-pager" class="cycle-pager"></div>

			<div class="cycle-slideshow"
				data-cycle-log="false"
				data-cycle-pause-on-hover="true"
				data-cycle-swipe="true"
				data-cycle-auto-height=container
				data-cycle-loader=false
				data-cycle-slides=".testimonial_slider_wrap"
				data-cycle-pager="#testimonial-slider-pager"
				data-cycle-prev="#testimonial-slider-prev"
				data-cycle-next="#testimonial-slider-next"
				>

				<!-- prev/next links -->
			<button id="testimonial-slider-prev" class="cycle-prev" aria-label="Previous">
				<span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'alchemist' ); ?></span><?php echo alchemist_get_svg( array( 'icon' => 'angle-down' ) ); ?>
			</button>

			<button id="testimonial-slider-next" class="cycle-next" aria-label="Next">
				<span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'alchemist' ); ?></span><?php echo alchemist_get_svg( array( 'icon' => 'angle-down' ) ); ?>
			</button>

				<div class="testimonial_slider_wrap">

			<?php
				get_template_part( 'template-parts/testimonial/post-types', 'testimonial' );
			?>

				</div><!-- .testimonial_slider_wrap -->
			</div><!-- .cycle-slideshow -->
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
