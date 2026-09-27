<?php
/**
 * Front page (static homepage).
 *
 * Displays the page content set as "Homepage" under Settings → Reading.
 * A fresh install shows the bundled `Liquid Glass — Homepage` pattern so
 * the design system is demonstrated with editable blocks, not hard-coded
 * PHP. The demo block is removed automatically the first time the user
 * edits the page in Gutenberg.
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
		<?php if ( ! get_the_content() ) : ?>
			<!-- wp:pattern {"slug":"liquid-glass/homepage"} /-->
		<?php else : ?>
			<?php the_content(); ?>
		<?php endif; ?>
	<?php endwhile; ?>
</main>

<?php
get_template_part( 'parts/footer' );
get_footer();
