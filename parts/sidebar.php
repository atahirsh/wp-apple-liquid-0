<?php
/**
 * Sidebar template part.
 *
 * Rendered by templates with the "with-sidebar" layout when the legacy
 * `sidebar-1` widget area contains widgets.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="widget-area glass-surface glass-panel lg-sidebar" id="secondary" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'liquid-glass' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
