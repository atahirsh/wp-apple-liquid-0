<?php
/**
 * Footer template part (Layer 2 surface, minimal treatment).
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;
?>
<footer class="site-footer">
	<div class="lg-container">
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="widget-area" role="region" aria-label="<?php esc_attr_e( 'Footer widgets', 'liquid-glass' ); ?>">
				<?php
				for ( $liquid_glass_i = 1; $liquid_glass_i <= 3; $liquid_glass_i++ ) {
					dynamic_sidebar( 'footer-' . $liquid_glass_i );
				}
				?>
			</div>
		<?php endif; ?>

		<div class="lg-footer-bottom">
			<p class="site-copyright">
				<?php
				/* translators: 1: opening link to the site, 2: closing link tag, 3: year. */
				echo wp_kses_post(
					sprintf(
						__( '© %3$s %1$s%2$s — All rights reserved.', 'liquid-glass' ),
						'<a href="' . esc_url( home_url( '/' ) ) . '">',
						'</a>',
						gmdate( 'Y' )
					)
				);
				?>
			</p>

			<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'liquid-glass' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<p class="theme-credit">
				<?php
				/* translators: %s: theme name. */
				printf( esc_html__( 'Built with %s', 'liquid-glass' ), 'Liquid Glass' );
				?>
			</p>
		</div>
	</div>
</footer>
