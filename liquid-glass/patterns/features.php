<?php
/**
 * Pattern: Features grid.
 *
 * @package Liquid_Glass
 */

return array(
	'slug'           => 'features',
	'title'          => esc_html__( 'Liquid Glass: Features', 'liquid-glass' ),
	'description'    => esc_html__( 'Three-column feature grid on restrained glass cards.', 'liquid-glass' ),
	'categories'     => array( 'liquid-glass', 'features' ),
	'viewport_width' => 1200,
	'content'        => '<!-- wp:group {"className":"lg-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group lg-section"><!-- wp:heading {"textAlign":"center","level":2,"className":"lg-section-title"} -->
<h2 class="wp-block-heading has-text-align-center lg-section-title">Designed with intent</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"lg-section-lead"} -->
<p class="has-text-align-center lg-section-lead">Every surface, shadow and transition is part of one coherent material system.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"className":"lg-feature-grid"} -->
<div class="wp-block-columns lg-feature-grid"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"glass-card lg-feature-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group glass-card lg-feature-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Layered depth</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Six deliberate material layers communicate hierarchy — glass is used sparingly, never decoratively.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"glass-card lg-feature-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group glass-card lg-feature-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Accessible by default</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>WCAG 2.2 AA contrast, visible focus states, semantic landmarks and full reduced-motion support.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"glass-card lg-feature-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group glass-card lg-feature-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Zero dependencies</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>No page builders, no icon fonts, no jQuery. Native Gutenberg, native WordPress, tiny footprint.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
',
);
