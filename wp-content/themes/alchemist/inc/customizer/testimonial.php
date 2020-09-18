<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Alchemist
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alchemist_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    alchemist_register_option( $wp_customize, array(
            'name'              => 'alchemist_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Alchemist_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Alchemist Theme, go %1$shere%2$s', 'alchemist' ),
                '<a href="javascript:wp.customize.section( \'alchemist_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'alchemist_testimonials', array(
            'panel'    => 'alchemist_theme_options',
            'title'    => esc_html__( 'Testimonials', 'alchemist' ),
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
            'name'              => 'alchemist_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Alchemist_Note_Control',
            'active_callback'   => 'alchemist_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'alchemist' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'alchemist_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    alchemist_register_option( $wp_customize, array(
            'name'              => 'alchemist_testimonial_option',
            'default'           => 'disabled',
            'active_callback'   => 'alchemist_is_ect_testimonial_active',
            'sanitize_callback' => 'alchemist_sanitize_select',
            'choices'           => alchemist_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'alchemist' ),
            'section'           => 'alchemist_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    alchemist_register_option( $wp_customize, array(
            'name'              => 'alchemist_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Alchemist_Note_Control',
            'active_callback'   => 'alchemist_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'alchemist' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'alchemist_testimonials',
            'type'              => 'description',
        )
    );

    alchemist_register_option( $wp_customize, array(
            'name'              => 'alchemist_testimonial_number',
            'default'           => '4',
            'sanitize_callback' => 'alchemist_sanitize_number_range',
            'active_callback'   => 'alchemist_is_testimonial_active',
            'label'             => esc_html__( 'Number of items to show', 'alchemist' ),
            'section'           => 'alchemist_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'alchemist_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        alchemist_register_option( $wp_customize, array(
                'name'              => 'alchemist_testimonial_cpt_' . $i,
                'sanitize_callback' => 'alchemist_sanitize_post',
                'active_callback'   => 'alchemist_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'alchemist' ) . ' ' . $i ,
                'section'           => 'alchemist_testimonials',
                'type'              => 'select',
                'choices'           => alchemist_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'alchemist_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'alchemist_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Alchemist 1.0
    */
    function alchemist_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'alchemist_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( alchemist_is_ect_testimonial_active( $control ) &&  alchemist_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'alchemist_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Alchemist 1.0
    */
    function alchemist_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'alchemist_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Alchemist 1.0
    */
    function alchemist_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;
