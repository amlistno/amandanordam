<?php
/**
 * Displays Header Right Navigation
 *
 * @package Alchemist
 */
?>

<button id="primary-menu-toggle" class="menu-primary-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
	<?php
	echo alchemist_get_svg( array( 'icon' => 'bars' ) );
	echo alchemist_get_svg( array( 'icon' => 'close' ) );
	?>
	<span class="menu-label"><?php echo esc_html__( 'Menu', 'alchemist' ); ?></span>
</button>

	<div id="site-primary-menu" class="site-primary-menu">
		<?php 
			if ( has_nav_menu( 'menu-1' ) ) : ?>
			<nav id="site-primary-navigation" class="main-navigation site-navigation custom-primary-menu" role="navigation" aria-label="<?php echo esc_html( 'Menu', 'alchemist' ); ?>">
				<?php wp_nav_menu( array(
					'theme_location'	=> 'menu-1',
					'container_class'	=> 'primary-menu-container',
					'menu_class'		=> 'primary-menu',
				) ); ?>
			</nav><!-- #site-primary-navigation.custom-primary-menu -->
		<?php else : ?>
			<nav id="site-primary-navigation" class="main-navigation site-navigation default-page-menu" role="navigation" aria-label="<?php echo esc_html( 'Menu', 'alchemist' ); ?>">
				<?php wp_page_menu(
					array(
						'menu_class' => 'primary-menu-container',
						'before'     => '<ul id="primary-page-menu" class="primary-menu">',
						'after'      => '</ul>',
					)
				); ?>
			</nav><!-- #site-primary-navigation.default-page-menu -->
		<?php endif; ?>
		
		<?php if ( has_nav_menu( 'social-primary' ) ) : ?>
			<div id="primary-menu-social" class="primary-menu-social">
				<nav id="social-primary-navigation-top" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Social Menu', 'alchemist' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social-primary',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>' . alchemist_get_svg( array( 'icon' => 'chain' ) ),
						) );
					?>
				</nav><!-- #social-primary-navigation -->
			</div>
		<?php endif; ?>
		
		<div class="primary-search-wrapper">
			<div id="search-container-main">
				<button id="search-toggle-main" class="menu-search-main-toggle">
					<?php
					echo alchemist_get_svg( array( 'icon' => 'search' ) );
					echo alchemist_get_svg( array( 'icon' => 'close' ) );
					echo '<span class="menu-label-prefix">'. esc_attr__( 'Search ', 'alchemist' ) . '</span>';
					?>
				</button>

	        	<div class="search-container">
	            	<?php get_search_form(); ?>
	            </div><!-- .search-container -->
			</div><!-- #search-social-container -->
		</div><!-- .primary-search-wrapper -->
	</div><!-- #site-primary-menu -->
