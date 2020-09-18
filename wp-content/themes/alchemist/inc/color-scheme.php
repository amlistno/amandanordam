<?php
/**
 * Customizer functionality
 *
 * @package Alchemist
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Alchemist 1.0
 *
 * @see alchemist_header_style()
 */
function alchemist_custom_header_and_background() {
	$default_bg_color   = 'ffffff';
	$default_text_color = '111111';

	/**
	 * Filter the arguments used when adding 'custom-background' support in Persona.
	 *
	 * @since Alchemist 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'alchemist_custom_background_args', array(
		'default-color' => $default_bg_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Persona.
	 *
	 * @since Alchemist 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'alchemist_custom_header_args', array(
		'default-image'      	 => get_parent_theme_file_uri( '/assets/images/header-image.jpg' ),
		'default-text-color'     => $default_text_color,
		'width'                  => 1920,
		'height'                 => 822,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'alchemist_header_style',
		'video'                  => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-image.jpg',
			'thumbnail_url' => '%s/assets/images/header-image-275x155.jpg',
			'description'   => esc_html__( 'Default Header Image', 'alchemist' ),
		),
	) );
}
add_action( 'after_setup_theme', 'alchemist_custom_header_and_background' );

if ( ! function_exists( 'alchemist_header_style' ) ) :
	/**
	 * Styles the header text displayed on the site.
	 *
	 * Create your own alchemist_header_style() function to override in a child theme.
	 *
	 * @since Alchemist 1.0
	 *
	 * @see alchemist_custom_header_and_background().
	 */
	function alchemist_header_style() {

		$header_image = alchemist_featured_overall_image();

	    if ( 'disable' !== $header_image ) : ?>
	        <style type="text/css" rel="header-image">
	            .custom-header:before {
	                background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center top;
					background-repeat: no-repeat;
					background-size: cover;
					content: "";
					display: block;
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					z-index: -1;
	            }
	        </style>
	    <?php
	    endif;

	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		$header_text_color = get_header_textcolor();
		$default_color     = '111111';

		$header_text_ninty_three_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.93)', alchemist_hex2rgb( $header_text_color ) );

		if ( $default_color !== $header_text_color ) :
		?>
		<style type="text/css" id="alchemist-header-css">
		.site-title a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}

		.site-description {
		 	color: <?php echo esc_attr( $header_text_ninty_three_color ); ?>;
		}
		</style>
	<?php
		endif;
	} else {
		?>
		<style type="text/css" id="alchemist-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-identity {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
		</style>
	<?php
	}
}
endif; // alchemist_header_style

/**
 * Customize video play/pause button in the custom header.
 *
 * @param array $settings header video settings.
 */
function alchemist_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'alchemist' ) . '</span>' . alchemist_get_svg( array(
		'icon' => 'play',
	) );
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'alchemist' ) . '</span>' . alchemist_get_svg( array(
		'icon' => 'pause',
	) );

	$enable = get_theme_mod( 'alchemist_header_enable_media_on_mobile' );

    // Enable header video on mobile devices
    if ( $enable ) {
		$settings['minWidth']  = 100;
		$settings['minHeight'] = 100;
    }

	return $settings;
}
add_filter( 'header_video_settings', 'alchemist_video_controls' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Alchemist 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function alchemist_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Alchemsit 1.0
 */
function alchemist_customize_control_js() {
	wp_enqueue_style( 'alchemist-custom-controls-css', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'alchemist_customize_control_js' );