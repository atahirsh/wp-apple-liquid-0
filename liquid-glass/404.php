<?php
/**
 * 404 template.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'parts/header' );
?>

<main id="primary" class="site-main">
	<div class="lg-container lg-section lg-container--content" style="text-align:center">
		<div class="glass-surface glass-panel" style="padding:var(--spacing-2xl) var(--spacing-xl)">
			<p class="lg-badge" style="margin:0 auto var(--spacing-md)"><?php esc_html_e( 'Error 404', 'liquid-glass' ); ?></p>
			<h1 class="entry-title"><?php esc_html_e( 'This page could not be found', 'liquid-glass' ); ?></h1>
			<p class="lede" style="margin-inline:auto"><?php esc_html_e( 'The link may be broken, or the page may have moved. Try a search or head back to the beginning.', 'liquid-glass' ); ?></p>

			<form class="lg-search-field" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="justify-content:center; margin-block:var(--spacing-lg)">
				<label class="lg-visually-hidden" for="lg-404-search"><?php esc_html_e( 'Search', 'liquid-glass' ); ?></label>
				<input type="search" id="lg-404-search" class="search-field glass-control" name="s" placeholder="<?php esc_attr_e( 'Search the site', 'liquid-glass' ); ?>" style="max-width:320px">
				<button type="submit" class="btn-primary btn-sm"><?php esc_html_e( 'Search', 'liquid-glass' ); ?></button>
			</form>

			<p>
				<a class="btn-secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to homepage', 'liquid-glass' ); ?></a>
			</p>
		</div>
	</div>
</main>

<?php
get_template_part( 'parts/footer' );
get_footer();
