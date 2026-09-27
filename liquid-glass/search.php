<?php
/**
 * Search results template.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'parts/header' );
?>

<main id="primary" class="site-main">
	<div class="lg-container lg-section">
		<header class="lg-archive-header">
			<h1 class="archive-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search results for “%s”', 'liquid-glass' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
				?>
			</h1>

			<form class="lg-search-field glass-surface" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="padding:var(--spacing-sm); margin-block-end:var(--spacing-xl)">
				<label class="lg-visually-hidden" for="lg-search-page-input"><?php esc_html_e( 'Search', 'liquid-glass' ); ?></label>
				<input type="search" id="lg-search-page-input" class="search-field glass-control" name="s" placeholder="<?php esc_attr_e( 'Search the site', 'liquid-glass' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
				<button type="submit" class="btn-primary btn-sm"><?php esc_html_e( 'Search', 'liquid-glass' ); ?></button>
			</form>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="lg-query-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content' );
				endwhile;
				?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'class'     => 'lg-pagination',
					'mid_size'  => 1,
					'prev_text' => esc_html__( 'Previous', 'liquid-glass' ),
					'next_text' => esc_html__( 'Next', 'liquid-glass' ),
				)
			);
			?>
		<?php else : ?>
			<div class="glass-surface glass-panel" role="alert">
				<p><strong><?php esc_html_e( 'Nothing matched your search.', 'liquid-glass' ); ?></strong></p>
				<p><?php esc_html_e( 'Try different keywords or browse the latest articles below.', 'liquid-glass' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_template_part( 'parts/footer' );
get_footer();
