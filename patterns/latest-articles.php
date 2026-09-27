<?php
/**
 * Pattern: Latest articles (Query Loop).
 *
 * @package Liquid_Glass
 */

return array(
	'slug'           => 'latest-articles',
	'title'          => esc_html__( 'Liquid Glass: Latest Articles', 'liquid-glass' ),
	'description'    => esc_html__( 'Query-loop grid of the latest posts as glass post cards.', 'liquid-glass' ),
	'categories'     => array( 'liquid-glass', 'query-loop', 'banner' ),
	'viewport_width' => 1200,
	'content'        => '<!-- wp:group {"className":"lg-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group lg-section"><!-- wp:heading {"textAlign":"center","level":2,"className":"lg-section-title"} -->
<h2 class="wp-block-heading has-text-align-center lg-section-title">Latest articles</h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":7,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"className":"lg-post-grid"} -->
<div class="wp-block-query lg-post-grid"><!-- wp:post-template -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:group {"className":"glass-card lg-post-card__body","layout":{"type":"constrained"}} -->
<div class="wp-block-group glass-card lg-post-card__body"><!-- wp:post-date {"fontSize":"small"} /-->

<!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-excerpt {"excerptLength":24} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query-no-pagination -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">More articles coming soon.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-pagination --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
',
);
