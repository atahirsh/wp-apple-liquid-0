<?php
/**
 * Archive template — categories, tags, authors, dates, post types and any
 * custom taxonomy archive all inherit from this file via the hierarchy.
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
			<?php if ( is_category() || is_tag() || is_author() ) : ?>
				<p class="lg-badge" style="margin:0 0 var(--spacing-sm)"><?php echo esc_html( get_queried_object()->name ); ?></p>
			<?php endif; ?>

			<h1 class="archive-title"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>

			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
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
			<p><?php esc_html_e( 'No posts were found in this archive.', 'liquid-glass' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_template_part( 'parts/footer' );
get_footer();
