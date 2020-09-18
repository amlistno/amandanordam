<?php
/**
* The template for adding Service Settings in Customizer
*
 * @package Alchemist
*/

function alchemist_service_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
    alchemist_register_option( $wp_customize, array(
            'name'              => 'alchemist_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Alchemist_Note_Control',
            'label'             => sprintf( esc_html__( 'For Service Options for Alchemist Theme, go %1$shere%2$s', 'alchemist' ),
                 '<a href="javascript:wp.customize.section( \'alchemist_service\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'ect_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'alchemist_service', array(
			'panel'    => 'alchemist_theme_options',
			'title'    => esc_html__( 'Service', 'alchemist' ),
		)
	);

	$action = 'install-plugin';
    $slug   = 'essential-content-types';

    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => $action,
                'plugin' => $slug
            ),
            admin_url( 'update.php' )
        ),
        $action . '_' . $slug
    );

    alchemist_register_option( $wp_customize, array(
            'name'              => 'alchemist_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Alchemist_Note_Control',
            'active_callback'   => 'alchemist_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'alchemist' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'alchemist_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	alchemist_register_option( $wp_customize, array(
			'name'              => 'alchemist_service_option',
			'default'           => 'disabled',
			'active_callback'   => 'alchemist_is_ect_services_active',
			'sanitize_callback' => 'alchemist_sanitize_select',
			'choices'           => alchemist_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'alchemist' ),
			'section'           => 'alchemist_service',
			'type'              => 'select',
		)
	);

	alchemist_register_option( $wp_customize, array(
            'name'              => 'alchemist_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Alchemist_Note_Control',
            'active_callback'   => 'alchemist_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'alchemist' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'alchemist_service',
            'type'              => 'description',
        )
    );

	alchemist_register_option( $wp_customize, array(
				'name'              => 'alchemist_service_number',
				'default'           => 3,
				'sanitize_callback' => 'alchemist_sanitize_number_range',
				'active_callback'   => 'alchemist_is_service_active',
				'description'       => esc_html__( 'Save and refresh the page if No. of Service is changed', 'alchemist' ),
				'input_attrs'       => array(
					'style' => 'width: 100px;',
					'min'   => 0,
				),
				'label'             => esc_html__( 'No of Service', 'alchemist' ),
				'section'           => 'alchemist_service',
				'type'              => 'number',
		)
	);

	$number = get_theme_mod( 'alchemist_service_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		//for CPT
		alchemist_register_option( $wp_customize, array(
				'name'              => 'alchemist_service_cpt_' . $i,
				'sanitize_callback' => 'alchemist_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'alchemist_is_service_active',
				'label'             => esc_html__( 'Service ', 'alchemist' ) . ' ' . $i ,
				'section'           => 'alchemist_service',
				'type'              => 'select',
				'choices'           => alchemist_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'alchemist_service_options' );

if ( ! function_exists( 'alchemist_is_service_active' ) ) :
	/**
	* Return true if service is active
	*
	* @since Alchemist 1.0
	*/
	function alchemist_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'alchemist_service_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( alchemist_is_ect_services_active( $control ) &&  alchemist_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'alchemist_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Alchemist 1.0
    */
    function alchemist_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'alchemist_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Alchemist 1.0
    */
    function alchemist_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;