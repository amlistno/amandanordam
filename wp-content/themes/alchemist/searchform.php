<?php
/**
 * Template for displaying search forms in Alchemist
 *
 * @package Alchemist
 */
?>

<?php $search_text = get_theme_mod( 'alchemist_search_text', esc_html__( 'Search', 'alchemist' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'alchemist' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><?php echo alchemist_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'alchemist' ); ?></span></button>
</form>
