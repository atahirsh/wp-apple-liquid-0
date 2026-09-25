<?php
/**
 * Asset enqueueing.
 *
 * Styles are split by responsibility and loaded in dependency order so the
 * token cascade always wins. Scripts are tiny, vanilla, deferred, and purely
 * progressive enhancement.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue front-end styles and scripts.
 */
function liquid_glass_enqueue_assets() {
	$version = LIQUID_GLASS_VERSION;

	// Order matters: tokens → base → components → blocks.
	wp_enqueue_style(
		'liquid-glass-tokens',
		LIQUID_GLASS_URI . '/assets/css/tokens.css',
		array(),
		$version
	);

	wp_enqueue_style(
		'liquid-glass-base',
		LIQUID_GLASS_URI . '/assets/css/base.css',
		array( 'liquid-glass-tokens' ),
		$version
	);

	wp_enqueue_style(
		'liquid-glass-components',
		LIQUID_GLASS_URI . '/assets/css/components.css',
		array( 'liquid-glass-base' ),
		$version
	);

	wp_enqueue_style(
		'liquid-glass-blocks',
		LIQUID_GLASS_URI . '/assets/css/blocks.css',
		array( 'liquid-glass-components' ),
		$version
	);

	// Navigation drawer + submenu accordions (enhancement only).
	wp_enqueue_script(
		'liquid-glass-navigation',
		LIQUID_GLASS_URI . '/assets/js/navigation.js',
		array(),
		$version,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Light/dark/auto appearance toggle + header scroll state.
	wp_enqueue_script(
		'liquid-glass-appearance',
		LIQUID_GLASS_URI . '/assets/js/appearance.js',
		array(),
		$version,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Threaded comments: only where comments are open on a singular view.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'liquid_glass_enqueue_assets' );

/**
 * Preconnect hints are unnecessary (zero external origins). Instead, mark the
 * ambient layer as decorative and keep lcp candidates eager.
 *
 * Adds loading="eager" + fetchpriority="high" to featured images in the main
 * query loop so the Largest Contentful Paint element is not lazy-loaded.
 *
 * @param string $html   Full HTML image tag.
 * @param int    $id     Attachment ID.
 * @return string
 */
function liquid_glass_high_priority_featured_image( $html, $id ) {
	if ( ! is_main_query() || ! in_the_loop() ) {
		return $html;
	}

	static $done = false;
	if ( $done ) {
		return $html;
	}
	$done = true;

	$html = str_replace( '<img ', '<img fetchpriority="high" ', $html );
	$html = preg_replace( '/\sloading=["\']lazy["\']/', '', $html );

	return $html;
}
add_filter( 'wp_get_attachment_image_html', 'liquid_glass_high_priority_featured_image', 10, 2 );
