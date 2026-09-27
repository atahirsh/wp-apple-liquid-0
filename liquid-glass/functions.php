<?php
/**
 * Liquid Glass theme functions, constants and module loader.
 *
 * The theme is a standard WordPress block (FSE) theme. Optional features
 * live in /inc so each concern can be read, replaced or removed from a
 * child theme independently.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

define( 'LIQUID_GLASS_VERSION', '1.0.0' );
define( 'LIQUID_GLASS_DIR', get_template_directory() );
define( 'LIQUID_GLASS_URI', get_template_directory_uri() );

require LIQUID_GLASS_DIR . '/inc/setup.php';
require LIQUID_GLASS_DIR . '/inc/enqueue.php';
require LIQUID_GLASS_DIR . '/inc/customizer.php';
require LIQUID_GLASS_DIR . '/inc/template-tags.php';
require LIQUID_GLASS_DIR . '/inc/block-patterns.php';
