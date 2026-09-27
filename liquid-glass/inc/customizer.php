<?php
/**
 * Customizer — theme options that are not covered by theme.json.
 *
 * Colors and typography are handled natively by the Site Editor through
 * theme.json; the panels below expose the remaining Liquid Glass options:
 * accent color, ambient background, corner radius scale, header behavior
 * and default appearance. All values are sanitized on input and escaped /
 * validated on output (see liquid_glass_custom_styles()).
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function liquid_glass_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Panel.
	$wp_customize->add_panel(
		'liquid_glass_options',
		array(
			'title'       => esc_html__( 'Liquid Glass', 'liquid-glass' ),
			'description' => esc_html__( 'Accent color, background, glass shape and header behavior.', 'liquid-glass' ),
			'priority'    => 30,
		)
	);

	/* ---- Section: Appearance ------------------------------------------ */
	$wp_customize->add_section(
		'liquid_glass_appearance',
		array(
			'title' => esc_html__( 'Appearance', 'liquid-glass' ),
			'panel' => 'liquid_glass_options',
		)
	);

	$wp_customize->add_setting(
		'lg_accent_color',
		array(
			'default'           => '#0071e3',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'lg_accent_color',
			array(
				'label'       => esc_html__( 'Accent color', 'liquid-glass' ),
				'description' => esc_html__( 'Buttons, links, focus rings and highlights.', 'liquid-glass' ),
				'section'     => 'liquid_glass_appearance',
			)
		)
	);

	$wp_customize->add_setting(
		'lg_page_background',
		array(
			'default'           => '#f2f3f6',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'lg_page_background',
			array(
				'label'       => esc_html__( 'Page background (light mode)', 'liquid-glass' ),
				'description' => esc_html__( 'The Layer-0 canvas behind every surface.', 'liquid-glass' ),
				'section'     => 'liquid_glass_appearance',
			)
		)
	);

	$wp_customize->add_setting(
		'lg_ambient_background',
		array(
			'default'           => 'enabled',
			'sanitize_callback' => 'liquid_glass_sanitize_choice',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'lg_ambient_background',
		array(
			'label'   => esc_html__( 'Ambient illumination', 'liquid-glass' ),
			'type'    => 'select',
			'section' => 'liquid_glass_appearance',
			'choices' => array(
				'enabled'  => esc_html__( 'Enabled', 'liquid-glass' ),
				'disabled' => esc_html__( 'Disabled (flat background)', 'liquid-glass' ),
			),
		)
	);

	$wp_customize->add_setting(
		'lg_default_appearance',
		array(
			'default'           => 'auto',
			'sanitize_callback' => 'liquid_glass_sanitize_choice',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'lg_default_appearance',
		array(
			'label'       => esc_html__( 'Default appearance', 'liquid-glass' ),
			'description' => esc_html__( 'Visitors can still override this with the header toggle.', 'liquid-glass' ),
			'type'        => 'select',
			'section'     => 'liquid_glass_appearance',
			'choices'     => array(
				'auto'  => esc_html__( 'Follow system', 'liquid-glass' ),
				'light' => esc_html__( 'Light', 'liquid-glass' ),
				'dark'  => esc_html__( 'Dark', 'liquid-glass' ),
			),
		)
	);

	/* ---- Section: Shape & layout -------------------------------------- */
	$wp_customize->add_section(
		'liquid_glass_shape',
		array(
			'title' => esc_html__( 'Shape & layout', 'liquid-glass' ),
			'panel' => 'liquid_glass_options',
		)
	);

	$wp_customize->add_setting(
		'lg_radius_scale',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'liquid_glass_sanitize_choice',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'lg_radius_scale',
		array(
			'label'       => esc_html__( 'Corner radius', 'liquid-glass' ),
			'description' => esc_html__( 'Scales every rounded surface at once.', 'liquid-glass' ),
			'type'        => 'select',
			'section'     => 'liquid_glass_shape',
			'choices'     => array(
				'flat'    => esc_html__( 'Flat (subtle)', 'liquid-glass' ),
				'default' => esc_html__( 'Default', 'liquid-glass' ),
				'soft'    => esc_html__( 'Soft', 'liquid-glass' ),
				'round'   => esc_html__( 'Round', 'liquid-glass' ),
			),
		)
	);

	$wp_customize->add_setting(
		'lg_content_width',
		array(
			'default'           => 720,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'lg_content_width',
		array(
			'label'       => esc_html__( 'Content width (px)', 'liquid-glass' ),
			'description' => esc_html__( 'Reading column width. 640–860 px recommended.', 'liquid-glass' ),
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 560,
				'max'  => 960,
				'step' => 20,
			),
			'section' => 'liquid_glass_shape',
		)
	);

	/* ---- Section: Header ---------------------------------------------- */
	$wp_customize->add_section(
		'liquid_glass_header',
		array(
			'title' => esc_html__( 'Header', 'liquid-glass' ),
			'panel' => 'liquid_glass_options',
		)
	);

	$wp_customize->add_setting(
		'lg_header_behavior',
		array(
			'default'           => 'sticky',
			'sanitize_callback' => 'liquid_glass_sanitize_choice',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'lg_header_behavior',
		array(
			'label'   => esc_html__( 'Header behavior', 'liquid-glass' ),
			'type'    => 'select',
			'section' => 'liquid_glass_header',
			'choices' => array(
				'sticky' => esc_html__( 'Sticky (floats while scrolling)', 'liquid-glass' ),
				'static' => esc_html__( 'Static (scrolls away)', 'liquid-glass' ),
			),
		)
	);
}
add_action( 'customize_register', 'liquid_glass_customize_register' );

/**
 * Sanitize a value against a fixed set of allowed choices.
 *
 * Settings declare choices inline, so validate against known-safe lists via
 * the `liquid_glass_allowed_choices` filter.
 *
 * @param string                       $value   Raw value.
 * @param WP_Customize_Setting|string  $setting Setting object or ID.
 * @return string Sanitized value.
 */
function liquid_glass_sanitize_choice( $value, $setting = '' ) {
	$id = is_object( $setting ) && property_exists( $setting, 'id' ) ? $setting->id : (string) $setting;

	$defaults = array(
		'lg_ambient_background'  => array( 'enabled', 'disabled' ),
		'lg_default_appearance'  => array( 'auto', 'light', 'dark' ),
		'lg_radius_scale'        => array( 'flat', 'default', 'soft', 'round' ),
		'lg_header_behavior'     => array( 'sticky', 'static' ),
	);

	$allowed = isset( $defaults[ $id ] ) ? $defaults[ $id ] : array();

	/**
	 * Filter the allowed choices for a Liquid Glass select setting.
	 *
	 * @param array  $allowed Allowed values.
	 * @param string $id      Theme mod ID.
	 */
	$allowed = apply_filters( 'liquid_glass_allowed_choices', $allowed, $id );

	if ( in_array( $value, $allowed, true ) ) {
		return $value;
	}

	// Fall back to the setting default when available.
	if ( is_object( $setting ) && method_exists( $setting, 'customize_value' ) ) {
		return $setting->customize_value();
	}

	return $value;
}

/**
 * Derive hover/active tints from a hex color without external libraries.
 *
 * @param string $hex   Hex color (#rgb or #rrggbb).
 * @param int    $percent Positive lightens, negative darkens (-100..100).
 * @return string Hex color.
 */
function liquid_glass_adjust_brightness( $hex, $percent ) {
	$hex  = ltrim( $hex, '#' );
	$long = strlen( $hex );

	if ( 3 === $long ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	if ( 6 !== $long || ! ctype_xdigit( $hex ) ) {
		return $hex;
	}

	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );

	$target = $percent < 0 ? 0 : 255;
	$factor = abs( $percent ) / 100;

	$r = (int) round( $r + ( $target - $r ) * $factor );
	$g = (int) round( $g + ( $target - $g ) * $factor );
	$b = (int) round( $b + ( $target - $b ) * $factor );

	return sprintf( '#%02x%02x%02x', max( 0, min( 255, $r ) ), max( 0, min( 255, $g ) ), max( 0, min( 255, $b ) ) );
}

/**
 * Emit Customizer-driven CSS custom properties.
 *
 * Every value is validated before printing: colors must match a strict hex
 * regex, numbers are cast to int, enums compared against whitelists.
 */
function liquid_glass_custom_styles() {
	$accent = get_theme_mod( 'lg_accent_color', '#0071e3' );
	if ( ! preg_match( '/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', (string) $accent ) ) {
		$accent = '#0071e3';
	}

	$background = get_theme_mod( 'lg_page_background', '#f2f3f6' );
	if ( ! preg_match( '/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', (string) $background ) ) {
		$background = '#f2f3f6';
	}

	$radius_scale = get_theme_mod( 'lg_radius_scale', 'default' );
	$radius_map   = array(
		'flat'    => array( '4px', '8px', '12px', '16px', '999px' ),
		'default' => array( '10px', '14px', '20px', '28px', '999px' ),
		'soft'    => array( '14px', '20px', '28px', '36px', '999px' ),
		'round'   => array( '20px', '28px', '40px', '56px', '999px' ),
	);
	if ( ! isset( $radius_map[ $radius_scale ] ) ) {
		$radius_scale = 'default';
	}
	list( $r_sm, $r_md, $r_lg, $r_xl, $r_pill ) = $radius_map[ $radius_scale ];

	$content_width = absint( get_theme_mod( 'lg_content_width', 720 ) );
	$content_width = max( 560, min( 960, $content_width ? $content_width : 720 ) );

	$ambient_disabled = 'disabled' === get_theme_mod( 'lg_ambient_background', 'enabled' );

	$accent_rgb                = liquid_glass_hex_to_rgb( $accent );
	$accent_hover              = liquid_glass_adjust_brightness( $accent, 12 );
	$accent_active             = liquid_glass_adjust_brightness( $accent, -12 );
	$accent_soft               = $accent_rgb
		? sprintf( 'rgba(%1$d, %2$d, %3$d, 0.1)', $accent_rgb[0], $accent_rgb[1], $accent_rgb[2] )
		: 'rgba(0, 113, 227, 0.1)';
	$focus_ring                = $accent_rgb
		? sprintf( 'rgba(%1$d, %2$d, %3$d, 0.4)', $accent_rgb[0], $accent_rgb[1], $accent_rgb[2] )
		: 'rgba(0, 113, 227, 0.4)';

	$css = ':root{'
		. '--accent:' . esc_attr( $accent ) . ';'
		. '--accent-hover:' . esc_attr( $accent_hover ) . ';'
		. '--accent-active:' . esc_attr( $accent_active ) . ';'
		. '--accent-soft:' . esc_attr( $accent_soft ) . ';'
		. '--focus-ring:0 0 0 3px ' . esc_attr( $focus_ring ) . ';'
		. '--page-background:' . esc_attr( $background ) . ';'
		. '--glass-radius-sm:' . esc_attr( $r_sm ) . ';'
		. '--glass-radius-md:' . esc_attr( $r_md ) . ';'
		. '--glass-radius-lg:' . esc_attr( $r_lg ) . ';'
		. '--glass-radius-xl:' . esc_attr( $r_xl ) . ';'
		. '--glass-radius-pill:' . esc_attr( $r_pill ) . ';'
		. '--content-width:' . (int) $content_width . 'px;'
		. '}';

	if ( $ambient_disabled ) {
		$css .= '.lg-ambient{display:none;}';
	}

	echo '<style id="liquid-glass-custom">' . wp_strip_all_tags( $css ) . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Values validated above; static CSS text.
}
add_action( 'wp_head', 'liquid_glass_custom_styles', 5 );

/**
 * Convert hex to an [ r, g, b ] array.
 *
 * @param string $hex Hex color.
 * @return array|null
 */
function liquid_glass_hex_to_rgb( $hex ) {
	$hex = ltrim( (string) $hex, '#' );

	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	if ( 6 !== strlen( $hex ) || ! ctype_xdigit( $hex ) ) {
		return null;
	}

	return array(
		hexdec( substr( $hex, 0, 2 ) ),
		hexdec( substr( $hex, 2, 2 ) ),
		hexdec( substr( $hex, 4, 2 ) ),
	);
}

/**
 * Live preview for postMessage color settings.
 */
function liquid_glass_customize_preview_js() {
	wp_add_inline_script(
		'liquid-glass-appearance',
		"( function () {
	if ( ! window.wp || ! wp.customize ) { return; }
	function bind( id, prop ) {
		wp.customize( id, function( value ) {
			value.bind( function( to ) {
				document.documentElement.style.setProperty( prop, to );
			} );
		} );
	}
	bind( 'lg_accent_color', '--accent' );
	bind( 'lg_page_background', '--page-background' );
}() );"
	);
}
add_action( 'customize_preview_init', 'liquid_glass_customize_preview_js' );
