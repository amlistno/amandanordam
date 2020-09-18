<?php
/**
 * Header Media Options
 *
 * @package Alchemist
 */

function alchemist_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'alchemist' );

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_media_option',
			'default'           => 'entire-site',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'choices'           => array(
				'homepage'    => esc_html__( 'Homepage / Frontpage', 'alchemist' ),
				'entire-site' => esc_html__( 'Entire Site', 'alchemist' ),
				'disable'     => esc_html__( 'Disabled', 'alchemist' ),
			),
			'label'             => esc_html__( 'Enable on ', 'alchemist' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'alchemist_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'alchemist' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              		=> 'alchemist_header_media_content_position',
			'default'           		=> 'content-left',
			'sanitize_callback' 		=> 'alchemist_sanitize_select',
			'choices'           		=> array(
				'content-center' 		=> esc_html__( 'Center', 'alchemist' ),
				'content-right'  		=> esc_html__( 'Right', 'alchemist' ),
				'content-left'   		=> esc_html__( 'Left', 'alchemist' ),
			),
			'label'             => esc_html__( 'Content Position', 'alchemist' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_media_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Sub Title', 'alchemist' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_media_title',
			'default'           => esc_html__( 'High Value Corporation', 'alchemist' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'alchemist' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_media_text',
			'default'           => esc_html__( 'With all the biggest name in corportion, you\'ll be amazed to find the best design website.', 'alchemist' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'alchemist' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'alchemist' ),
			'section'           => 'header_image',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_media_url_text',
			'default'           => esc_html__( 'View Details', 'alchemist' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'alchemist' ),
			'section'           => 'header_image',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_header_url_target',
			'sanitize_callback' => 'alchemist_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'alchemist' ),
			'section'           => 'header_image',
			'custom_control'    => 'Alchemist_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'alchemist_header_media_options' );

