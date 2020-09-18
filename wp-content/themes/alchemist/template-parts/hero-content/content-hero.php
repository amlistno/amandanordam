<?php
/**
 * The template used for displaying hero content
 *
 * @package Alchemist
 */
?>

<?php
$enable_section = get_theme_mod( 'alchemist_hero_cont_visibility', 'disabled' );

if ( ! alchemist_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type', 'hero' );

