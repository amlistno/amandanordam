<?php
/**
 * Featured Slider Options
 *
 * @package Alchemist
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alchemist_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'alchemist_featured_slider', array(
			'panel' => 'alchemist_theme_options',
			'title' => esc_html__( 'Featured Slider', 'alchemist' ),
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'choices'           => alchemist_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'alchemist' ),
			'section'           => 'alchemist_featured_slider',
			'type'              => 'select',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'alchemist_sanitize_number_range',

			'active_callback'   => 'alchemist_is_slider_active',	
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'alchemist' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'alchemist' ),
			'section'           => 'alchemist_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'alchemist_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {

		// Page Sliders
		alchemist_register_option( $wp_customize, array(
				'name'              =>'alchemist_slider_page_' . $i,
				'sanitize_callback' => 'alchemist_sanitize_post',
				'active_callback'   => 'alchemist_is_slider_active',
				'label'             => esc_html__( 'Page', 'alchemist' ) . ' # ' . $i,
				'section'           => 'alchemist_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	}
}
add_action( 'customize_register', 'alchemist_slider_options' );

/** Active Callback Functions */

if( ! function_exists( 'alchemist_is_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* @since Alchemist Pro 1.0
	*/
	function alchemist_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'alchemist_slider_option' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is or is not selected type
		return ( alchemist_check_section( $enable ) );
	}
endif;
