<?php
/**
 * Single post / page template.
 *
 * Reading-first layout: body copy sits on the plain L0 canvas (no glass
 * behind long-form text); only metadata, author box and comments use glass.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'parts/header' );
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'lg-single' ); ?>>
			<header class="single-header lg-container lg-section" style="padding-block-end:var(--spacing-lg)">
				<?php liquid_glass_breadcrumbs(); ?>

				<h1 class="entry-title"><?php the_title(); ?></h1>

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php
						liquid_glass_posted_on();
						liquid_glass_posted_by();
						?>
						<span class="reading-time"><?php echo esc_html( liquid_glass_reading_time() ); ?></span>
					</div>
				<?php endif; ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="single-featured lg-container">
					<?php the_post_thumbnail( 'large' ); ?>
				</figure>
			<?php endif; ?>

			<div class="entry-content lg-container lg-container--content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page links', 'liquid-glass' ) . '">' . esc_html__( 'Pages:', 'liquid-glass' ),
						'after'  => '</nav>',
					)
				);
				?>
			</div>

			<?php if ( 'post' === get_post_type() ) : ?>
				<footer class="single-footer lg-container lg-container--content">
					<?php if ( has_tag() ) : ?>
						<p class="entry-meta tags-row"><?php liquid_glass_entry_footer(); ?></p>
					<?php endif; ?>

					<section class="lg-author-card glass-surface" aria-label="<?php esc_attr_e( 'About the author', 'liquid-glass' ); ?>">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', '', array( 'class' => 'avatar avatar-64' ) ); ?>
						<div>
							<h2 class="text-large" style="margin:0"><?php the_author(); ?></h2>
							<p><?php echo esc_html( get_the_author_meta( 'description' ) ?: __( 'No biography has been written yet.', 'liquid-glass' ) ); ?></p>
							<a class="btn-ghost btn-sm" href="<?php echo esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ); ?>">
								<?php esc_html_e( 'View all articles', 'liquid-glass' ); ?>
							</a>
						</div>
					</section>

					<?php liquid_glass_related_posts(); ?>
				</footer>
			<?php endif; ?>

			<?php
			if ( is_singular( 'post' ) && ( comments_open() || get_comments_number() ) ) {
				?>
				<div class="lg-container lg-container--content">
					<?php comments_template(); ?>
				</div>
				<?php
			}
			?>
		</article>
		<?php
	endwhile;
	?>
</main>

<?php
get_template_part( 'parts/footer' );
get_footer();
