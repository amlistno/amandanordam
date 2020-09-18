<?php
/**
 * Theme Options
 *
 * @package Alchemist
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alchemist_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'alchemist_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'alchemist' ),
		'priority' => 130,
	) );

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_latest_posts_title',
			'default'           => esc_html__( 'News', 'alchemist' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'alchemist' ),
			'section'           => 'alchemist_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'alchemist_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'alchemist' ),
		'panel' => 'alchemist_theme_options',
		)
	);

	/* Default Layout */
	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'alchemist' ),
			'section'           => 'alchemist_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'alchemist' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'alchemist' ),
			),
		)
	);

	/* Homepage Layout */
	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_homepage_layout',
			'default'           => 'no-sidebar',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'label'             => esc_html__( 'Homepage Layout', 'alchemist' ),
			'section'           => 'alchemist_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'alchemist' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'alchemist' ),
			),
		)
	);

	/* Blog/Archive Layout */
	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'label'             => esc_html__( 'Blog/Archive Layout', 'alchemist' ),
			'section'           => 'alchemist_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'alchemist' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'alchemist' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'alchemist_excerpt_options', array(
		'panel'     => 'alchemist_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'alchemist' ),
	) );

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 20 words', 'alchemist' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'alchemist' ),
			'section'  => 'alchemist_excerpt_options',
			'type'     => 'number',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_excerpt_more_text',
			'default'           => esc_html__( 'Continue Reading', 'alchemist' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'alchemist' ),
			'section'           => 'alchemist_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'alchemist_search_options', array(
		'panel'     => 'alchemist_theme_options',
		'title'     => esc_html__( 'Search Options', 'alchemist' ),
	) );

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_search_text',
			'default'           => esc_html__( 'Search', 'alchemist' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'alchemist' ),
			'section'           => 'alchemist_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'alchemist_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'alchemist' ),
		'panel'       => 'alchemist_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'alchemist' ),
	) );


	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_front_page_category',
			'sanitize_callback' => 'alchemist_sanitize_category_list',
			'custom_control'    => 'Alchemist_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'alchemist' ),
			'section'           => 'alchemist_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_recent_posts_heading',
			'default'           => esc_html__( 'From Our Blog', 'alchemist' ),
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'From Our Blog', 'alchemist' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'alchemist' ),
			'section'           => 'alchemist_homepage_options',
		)
	);
	
	//Menu Options
	$wp_customize->add_section( 'alchemist_menu_options', array(
		'title'       => esc_html__( 'Menu Options', 'alchemist' ),
		'panel'       => 'alchemist_theme_options',
	) );

	// Pagination Options.
	$pagination_type = get_theme_mod( 'alchemist_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'alchemist' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'alchemist_pagination_options', array(
		'description' => $nav_desc,
		'panel'       => 'alchemist_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'alchemist' ),
	) );

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'choices'           => alchemist_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'alchemist' ),
			'section'           => 'alchemist_pagination_options',
			'type'              => 'select',
		)
	);
}
add_action( 'customize_register', 'alchemist_theme_options' );