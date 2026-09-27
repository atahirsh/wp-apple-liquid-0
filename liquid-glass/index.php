<?php
/**
 * The main template — final fallback in the WordPress template hierarchy.
 *
 * Renders the blog-style card grid for any query that no more specific
 * template handles.
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
				if ( is_home() && ! is_front_page() ) {
					single_post_title();
				} elseif ( is_home() ) {
					esc_html_e( 'Latest articles', 'liquid-glass' );
				} else {
					esc_html_e( 'Everything', 'liquid-glass' );
				}
				?>
			</h1>
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
			<p><?php esc_html_e( 'Nothing was found here yet.', 'liquid-glass' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_template_part( 'parts/footer' );
get_footer();
