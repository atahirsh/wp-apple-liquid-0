<?php
/**
 * Page template.
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
		<article <?php post_class( 'lg-page' ); ?>>
			<header class="page-header lg-container lg-section" style="padding-block-end:var(--spacing-lg)">
				<?php liquid_glass_breadcrumbs(); ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

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

			<?php
			if ( comments_open() || get_comments_number() ) {
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
