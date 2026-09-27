<?php
/**
 * Block patterns.
 *
 * Patterns live in /patterns as PHP files registered through
 * register_block_pattern() so their content can use translation functions
 * and conditional logic (something raw .html pattern files cannot do).
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register all bundled patterns.
 */
function liquid_glass_register_patterns() {
	$directory = LIQUID_GLASS_DIR . '/patterns';

	$files = glob( $directory . '/*.php' );
	if ( ! $files ) {
		return;
	}

	foreach ( $files as $file ) {
		$data = require $file;

		if ( ! is_array( $data ) || empty( $data['slug'] ) || empty( $data['content'] ) ) {
			continue;
		}

		register_block_pattern(
			'liquid-glass/' . $data['slug'],
			array(
				'title'       => $data['title'],
				'description' => isset( $data['description'] ) ? $data['description'] : '',
				'categories'  => isset( $data['categories'] ) ? $data['categories'] : array( 'liquid-glass' ),
				'viewportWidth' => isset( $data['viewport_width'] ) ? (int) $data['viewport_width'] : 1200,
				'content'     => $data['content'],
			)
		);
	}
}
add_action( 'init', 'liquid_glass_register_patterns' );
