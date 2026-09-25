<?php
/**
 * Shared post loop card (PHP fallback used by index/archive/search).
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'glass-surface glass-card glass-card--hover lg-post-card lg-post-card--hover' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="post-card__body">
		<p class="entry-meta" style="margin:0">
			<?php liquid_glass_posted_on(); ?>
			<?php liquid_glass_posted_by(); ?>
		</p>

		<h2 class="post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>

		<p style="margin:0">
			<a class="btn-secondary btn-sm" href="<?php the_permalink(); ?>">
				<?php esc_html_e( 'Read article', 'liquid-glass' ); ?>
			</a>
		</p>
	</div>
</article>
