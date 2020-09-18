<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Alchemist
 */
?>

<?php
$sidebar = alchemist_get_sidebar_id();

if ( '' === $sidebar ) {
    return;
}
?>

<aside id="secondary" class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- .sidebar .widget-area -->
