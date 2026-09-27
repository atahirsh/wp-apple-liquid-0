<?php
/**
 * Pattern: Hero.
 *
 * @package Liquid_Glass
 */

return array(
	'slug'          => 'hero',
	'title'         => esc_html__( 'Liquid Glass: Hero', 'liquid-glass' ),
	'description'   => esc_html__( 'Large display heading with a floating glass content surface over ambient light.', 'liquid-glass' ),
	'categories'    => array( 'liquid-glass', 'hero' ),
	'viewport_width' => 1200,
	'content'       => '<!-- wp:group {"className":"lg-section lg-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group lg-section lg-hero"><!-- wp:columns {"verticalAlignment":"center","className":"lg-hero__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center lg-hero__cols"><!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%"><!-- wp:paragraph {"className":"lg-badge"} -->
<p class="lg-badge">' . esc_html__( 'Introducing Liquid Glass', 'liquid-glass' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
<h1 class="wp-block-heading has-display-xl-font-size">' . esc_html__( 'Design that feels like light through glass.' ) . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lede"} -->
<p class="lede">' . esc_html__( 'A restrained, layered interface language for WordPress — translucent surfaces, real depth, and typography first. Install it, edit it, ship it.', 'liquid-glass' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#features">' . esc_html__( 'Explore features', 'liquid-glass' ) . '</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="' . esc_url( home_url( '/' ) ) . '?s=glass">' . esc_html__( 'Try the search', 'liquid-glass' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:group {"className":"glass-surface glass-card","style":{"spacing":{"padding":"var(--wp--preset--spacing--lg)"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group glass-surface glass-card has-padding"><!-- wp:image {"align":"center","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image aligncenter size-large"><img src="' . esc_url( get_template_directory_uri() . '/assets/images/hero-orb.svg' ) . '" alt="' . esc_attr__( 'Abstract refraction of light through layered glass', 'liquid-glass' ) . '"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","className":"entry-meta"} -->
<p class="has-text-align-center entry-meta">' . esc_html__( 'Every surface in this theme is a token-driven glass material.', 'liquid-glass' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
',
);
