<?php
/**
 * Pattern: Call to action.
 *
 * @package Liquid_Glass
 */

return array(
	'slug'           => 'call-to-action',
	'title'          => esc_html__( 'Liquid Glass: Call to Action', 'liquid-glass' ),
	'description'    => esc_html__( 'Centered closing call to action on a floating glass panel.', 'liquid-glass' ),
	'categories'     => array( 'liquid-glass', 'cta', 'banner' ),
	'viewport_width' => 1200,
	'content'        => '<!-- wp:group {"className":"lg-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group lg-section"><!-- wp:group {"className":"glass-panel lg-cta","layout":{"type":"constrained"},"contentAlign":"center"} -->
<div class="wp-block-group glass-panel lg-cta"><!-- wp:heading {"textAlign":"center","level":2,"className":"lg-section-title"} -->
<h2 class="wp-block-heading has-text-align-center lg-section-title">Start building something refined</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"lg-section-lead"} -->
<p class="has-text-align-center lg-section-lead">Assemble pages from block patterns, set your accent colour in the Customizer, and ship.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-lg-glass-primary"} -->
<div class="wp-block-button is-style-lg-glass-primary"><a class="wp-block-button__link wp-element-button" href="#">Get started</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-lg-glass-secondary"} -->
<div class="wp-block-button is-style-lg-glass-secondary"><a class="wp-block-button__link wp-element-button" href="#">Learn more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
',
);
