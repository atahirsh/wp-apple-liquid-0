<?php
/**
 * Header template part.
 *
 * Floating glass header (Layer 4): full-width translucent bar with a
 * contained row: branding · wp_nav_menu() · search · appearance toggle.
 * Menu assignment: Appearance → Menus → "Primary" location (or the
 * `liquid_glass_primary_menu` filter to select by slug/ID).
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="lg-ambient" aria-hidden="true"></div>

<header class="site-header glass-header">
	<div class="header-bar" aria-hidden="true"></div>

	<div class="header-inner lg-container">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lg-brand-link"><?php bloginfo( 'name' ); ?></a>
				</p>
			<?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation glass-navigation" aria-label="<?php esc_attr_e( 'Primary', 'liquid-glass' ); ?>">
			<?php
			$liquid_glass_menu_id = apply_filters( 'liquid_glass_primary_menu', 0 );

			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'menu'            => $liquid_glass_menu_id ? $liquid_glass_menu_id : '',
					'container'       => false,
					'menu_class'      => 'primary-menu',
					'menu_id'         => 'primary-menu',
					'fallback_cb'     => 'wp_page_menu',
					'depth'           => 3,
					'link_before'     => '<span>',
					'link_after'      => '</span>',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				)
			);
			?>
		</nav>

		<div class="lg-controls">
			<form class="lg-search-field" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="lg-visually-hidden" for="lg-header-search"><?php esc_html_e( 'Search', 'liquid-glass' ); ?></label>
				<input type="search" id="lg-header-search" class="search-field glass-control" name="s" placeholder="<?php esc_attr_e( 'Search', 'liquid-glass' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
				<button type="submit" class="lg-icon-button glass-button--secondary" aria-label="<?php esc_attr_e( 'Submit search', 'liquid-glass' ); ?>">
					<?php echo liquid_glass_get_icon_svg( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG. ?>
				</button>

			<?php liquid_glass_appearance_toggle(); ?>

			<button
				type="button"
				class="menu-toggle lg-icon-button glass-button--secondary"
				aria-controls="site-navigation"
				aria-expanded="false"
			>
				<span class="icon-menu"><?php echo liquid_glass_get_icon_svg( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG. ?></span>
				<span class="icon-close"><?php echo liquid_glass_get_icon_svg( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG. ?></span>
				<span class="lg-visually-hidden"><?php esc_html_e( 'Menu', 'liquid-glass' ); ?></span>
			</button>
		</div>
	</div>
</header>

<div class="mobile-nav-overlay" aria-hidden="true"></div>
