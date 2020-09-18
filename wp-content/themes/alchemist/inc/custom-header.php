<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Alchemist
 */

if ( ! function_exists( 'alchemist_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own alchemist_featured_image(), and that function will be used instead.
	 *
	 * @since Audioman Pro 1.0
	 */
	function alchemist_featured_image() {
		if ( is_header_video_active() && has_header_video() ) {
			return true;
		}
		$thumbnail = 'alchemist-custom-header-single';

		if ( is_header_video_active() && has_header_video() ) {
			return true;
		} else {
			return get_header_image();
		}
	} // alchemist_featured_image
endif;

if ( ! function_exists( 'alchemist_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own alchemist_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Audioman Pro 1.0
	 */
	function alchemist_featured_overall_image() {
		$enable = get_theme_mod( 'alchemist_header_media_option', 'entire-site' );

		// Check Homepage
		if ( ( 'homepage' === $enable && is_front_page() ) || 'entire-site' === $enable ) {
			// Check Entire Site
			return alchemist_featured_image();
		}

		return 'disable';
	} // alchemist_featured_overall_image
endif;

if ( ! function_exists( 'alchemist_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since Audioman Pro 1.0
	 */
	function alchemist_header_media_text() {

		if ( ! alchemist_has_header_media_text() ) {
			// Bail early if header media text is disabled on front page
			return false;
		}

		$content_position = get_theme_mod( 'alchemist_header_media_content_position', 'content-left' );
		$text_align  = 'text-aligned-left';

		$classes[] = 'custom-header-content';
		$classes[] = 'sections';
		$classes[] = 'header-media-section';
		$classes[] = $content_position;
		$classes[] = $text_align;

		?>

		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="entry-container">

				<?php if ( is_front_page() ) : ?>
				<?php alchemist_header_sub_title( '<div class="sub-title"><span>', '</span></div>' ); ?>
				<?php endif; ?>

				<?php if( !( is_singular() && ! is_page() ) ){
					alchemist_header_title( '<h2 class="entry-title">', '</h2>' );
				} ?>

				<?php alchemist_header_description(); ?>

				<?php if ( is_front_page() ) :
					$header_media_url      = get_theme_mod( 'alchemist_header_media_url', '#' );
					$header_media_url_text = get_theme_mod( 'alchemist_header_media_url_text', esc_html__( 'View Details', 'alchemist' ) );
				?>

					<?php if ( $header_media_url_text ) : ?>
						<a class="more-link" href="<?php echo esc_url( $header_media_url ); ?>" target="<?php echo esc_attr( get_theme_mod( 'alchemist_header_url_target' ) ) ? '_blank' : '_self'; ?>">

							<span class="more-button"><?php echo esc_html( $header_media_url_text ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $header_media_url_text ); ?></span></span>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div> <!-- .entry-container -->
		</div><!-- .custom-header-content -->
		<?php
	} // alchemist_header_media_text.
endif;

if ( ! function_exists( 'alchemist_has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * @since Audioman Pro 1.0
	 */
	function alchemist_has_header_media_text() {
		$header_image = alchemist_featured_overall_image();

		if ( is_front_page() ) {
			$header_media_sub_title    	= is_singular() ? '' : get_theme_mod( 'alchemist_header_media_sub_title');
			$header_media_title    		= get_theme_mod( 'alchemist_header_media_title', esc_html__( 'High Value Corporation', 'alchemist' ) );
			$header_media_text     		= get_theme_mod( 'alchemist_header_media_text', esc_html__( 'With all the biggest name in corportion, you\'ll be amazed to find the best design website.', 'alchemist' ) );
			$header_media_url      		= get_theme_mod( 'alchemist_header_media_url', '#' );
			$header_media_url_text 		= get_theme_mod( 'alchemist_header_media_url_text', esc_html__( 'View Details', 'alchemist' ) );

			if ( ! $header_media_sub_title && ! $header_media_title && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) {
				// Bail early if header media text is disabled
				return false;
			}
		} elseif ( 'disable' === $header_image ) {
			return false;
		}

		return true;
	} // alchemist_has_header_media_text.
endif;

if ( ! function_exists( 'alchemist_header_sub_title' ) ) :
	/**
	 * Display header media text
	 */
	function alchemist_header_sub_title( $before = '', $after = '' ) {
		if ( is_front_page() ) {
			$header_media_sub_title = ( is_singular() && ! is_front_page() ) ? '' : get_theme_mod( 'alchemist_header_media_sub_title' );
			if ( $header_media_sub_title ) {
				echo $before . wp_kses_post( $header_media_sub_title ) . $after;
			}
		}  elseif ( is_singular() ) {
			if ( is_page() ) {
				if( ! get_theme_mod( 'alchemist_single_page_title' ) ) {
					the_title( $before, $after );
				}
			} else {
				the_title( $before, $after );
			}
		} elseif ( is_404() ) {
			echo $before . esc_html__( 'Nothing Found', 'alchemist' ) . $after;
		} elseif ( is_search() ) {
			/* translators: %s: search query. */
			echo $before . sprintf( esc_html__( 'Search Results for: %s', 'alchemist' ), '<span>' . get_search_query() . '</span>' ) . $after;
		} else {
			the_archive_title( $before, $after );
		}
	}
endif;

if ( ! function_exists( 'alchemist_header_title' ) ) :
	/**
	 * Display header media text
	 */
	function alchemist_header_title( $before = '', $after = '' ) {
		if ( is_front_page() ) {
			$header_media_title = get_theme_mod( 'alchemist_header_media_title', esc_html__( 'High Value
Corporation', 'alchemist' ) );
			if ( $header_media_title ) {
				echo $before . wp_kses_post( $header_media_title ) . $after;
			}
		}  elseif ( is_singular() ) {
			if ( is_page() ) {
				if( ! get_theme_mod( 'alchemist_single_page_title' ) ) {
					the_title( $before, $after );
				}
			} else {
				the_title( $before, $after );
			}
		} elseif ( is_404() ) {
			echo $before . esc_html__( 'Nothing Found', 'alchemist' ) . $after;
		} elseif ( is_search() ) {
			/* translators: %s: search query. */
			echo $before . sprintf( esc_html__( 'Search Results for: %s', 'alchemist' ), '<span>' . get_search_query() . '</span>' ) . $after;
		} else {
			the_archive_title( $before, $after );
		}
	}
endif;

if ( ! function_exists( 'alchemist_header_description' ) ) :
	/**
	 * Display header media description
	 */
	function alchemist_header_description( $before = '', $after = '' ) {
		if ( is_front_page() ) {
			echo $before . '<p class="site-header-text">' . wp_kses_post( get_theme_mod( 'alchemist_header_media_text', esc_html__( 'With all the biggest name in corportion, you\'ll be amazed to find the best design website.', 'alchemist' ) ) ) . '</p>' . $after;
		} elseif ( is_singular() && ! is_page() ) {
			echo $before . '<div class="entry-header"><div class="entry-meta">';
				alchemist_entry_posted_on();
			echo '</div><!-- .entry-meta -->';
			echo '<div class="entry-title">';
				alchemist_header_title();
			echo '</div><!-- .entry-title --></div>' . $after;
		} elseif ( is_404() ) {
			echo $before . $after;
		} else {
			the_archive_description( $before, $after );
		}
	}
endif;
