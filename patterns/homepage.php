<?php
/**
 * Pattern: Homepage (hero + features + featured posts + CTA).
 *
 * @package Liquid_Glass
 */

return array(
	'slug'          => 'homepage',
	'title'         => esc_html__( 'Liquid Glass: Homepage', 'liquid-glass' ),
	'description'   => esc_html__( 'Full homepage: hero, feature grid, latest articles and a closing call to action.', 'liquid-glass' ),
	'categories'    => array( 'liquid-glass', 'hero', 'sections' ),
	'viewport_width' => 1200,
	'content'       => '<!-- wp:pattern {"slug":"liquid-glass/hero"} /-->

<!-- wp:pattern {"slug":"liquid-glass/features"} /-->

<!-- wp:pattern {"slug":"liquid-glass/latest-articles"} /-->

<!-- wp:pattern {"slug":"liquid-glass/call-to-action"} /-->
',
);
