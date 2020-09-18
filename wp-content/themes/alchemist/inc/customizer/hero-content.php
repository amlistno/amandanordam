<?php
/**
 * Hero Content Options
 *
 * @package Alchemist
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alchemist_hero_cont_options( $wp_customize ) {
	$wp_customize->add_section( 'alchemist_hero_cont_options', array(
			'title' => esc_html__( 'Hero Content Options', 'alchemist' ),
			'panel' => 'alchemist_theme_options',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_hero_cont_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'choices'           => alchemist_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'alchemist' ),
			'section'           => 'alchemist_hero_cont_options',
			'type'              => 'select',
		)
	);

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_hero_cont',
			'default'           => '0',
			'sanitize_callback' => 'alchemist_sanitize_post',
			'active_callback'   => 'alchemist_is_hero_cont_active',
			'label'             => esc_html__( 'Page', 'alchemist' ),
			'section'           => 'alchemist_hero_cont_options',
			'type'              => 'dropdown-pages',
		)
	);

}
add_action( 'customize_register', 'alchemist_hero_cont_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'alchemist_is_hero_cont_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Alchemist 1.0
	*/
	function alchemist_is_hero_cont_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'alchemist_hero_cont_visibility' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) &&	 'homepage' == $enable )
			);
	}
endif;
