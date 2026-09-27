<?php
/**
 * Theme setup.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports and editor integrations.
 */
function liquid_glass_setup() {
	// Make textdomains translatable (loadable from languages/ too).
	load_theme_textdomain( 'liquid-glass', LIQUID_GLASS_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	// Editor styles that mirror the front end (tokens.css must cascade first).
	add_editor_style( 'assets/css/tokens.css' );
	add_editor_style( 'assets/css/base.css' );
	add_editor_style( 'assets/css/editor.css' );

	// Custom logo with sensible defaults for the glass header.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Fluid typography for supported core blocks.
	add_theme_support( 'fluid-typography' );

	// Widgets: legacy sidebar + three footer areas (rendered by parts/sidebar.php).
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'liquid-glass' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Shown next to blog archives and single posts when the layout is set to "Content and sidebar".', 'liquid-glass' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar(
			array(
				/* translators: %d: footer widget column number. */
				'name'          => sprintf( esc_html__( 'Footer %d', 'liquid-glass' ), $i ),
				'id'            => 'footer-' . $i,
				/* translators: %d: footer widget column number. */
				'description'   => sprintf( esc_html__( 'Column %1$d of the site footer widget area.', 'liquid-glass' ), $i ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'after_setup_theme', 'liquid_glass_setup' );

/**
 * Content width used by embeds, images and the editor.
 *
 * @return int
 */
function liquid_glass_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'liquid_glass_content_width', 720 );
}
add_action( 'after_setup_theme', 'liquid_glass_content_width', 0 );

/**
 * Enqueue the tiny head script that flips `no-js` → `js` before paint.
 * Everything visual works without JS; this only enables the collapsible
 * mobile drawer instead of the always-open static fallback.
 */
function liquid_glass_head_script() {
	wp_print_inline_script_tag(
		"document.documentElement.className=document.documentElement.className.replace('no-js','js');",
		array( 'id' => 'liquid-glass-head' )
	);
}
add_action( 'wp_head', 'liquid_glass_head_script', 1 );

/**
 * Register default template categories & post types for patterns.
 */
function liquid_glass_register_pattern_categories() {
	register_block_pattern_category(
		'liquid-glass',
		array( 'label' => esc_html__( 'Liquid Glass', 'liquid-glass' ) )
	);
	register_block_pattern_category(
		'hero',
		array( 'label' => esc_html__( 'Heroes', 'liquid-glass' ) )
	);
	register_block_pattern_category(
		'sections',
		array( 'label' => esc_html__( 'Sections', 'liquid-glass' ) )
	);
}
add_action( 'init', 'liquid_glass_register_pattern_categories' );

/**
 * Add helpful body classes: appearance mode hooks + header behaviour.
 *
 * @param array $classes Body classes.
 * @return array
 */
function liquid_glass_body_classes( $classes ) {
	if ( 'static' === get_theme_mod( 'lg_header_behavior', 'sticky' ) ) {
		$classes[] = 'lg-header-static';
	}

	return $classes;
}
add_filter( 'body_class', 'liquid_glass_body_classes' );

/**
 * Expose translated strings to the progressive-enhancement scripts.
 */
function liquid_glass_localize_scripts() {
	wp_localize_script(
		'liquid-glass-navigation',
		'lgNav',
		array(
			'strings' => array(
				'submenu' => esc_html__( 'submenu', 'liquid-glass' ),
				'menu'    => esc_html__( 'Menu', 'liquid-glass' ),
				'close'   => esc_html__( 'Close menu', 'liquid-glass' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'liquid_glass_localize_scripts', 20 );

/**
 * Register classic navigation menu locations (used by parts/header.php and
 * parts/footer.php). Block themes support these via the legacy menus UI.
 */
function liquid_glass_register_nav_menus() {
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'liquid-glass' ),
			'footer'  => esc_html__( 'Footer', 'liquid-glass' ),
		)
	);
}
add_action( 'init', 'liquid_glass_register_nav_menus' );
