<?php
/**
 * Comments template.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

/*
 * Password-protected posts: show the core form, nothing else.
 */
if ( post_password_required() ) {
	return;
}
?>
<section class="comments-area glass-surface glass-panel" id="comments" aria-label="<?php esc_attr_e( 'Comments', 'liquid-glass' ); ?>">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-x-large">
			<?php
			$liquid_glass_count = get_comments_number();
			if ( '1' === (string) $liquid_glass_count ) {
				/* translators: %s: post title. */
				printf( esc_html__( 'One response to “%s”', 'liquid-glass' ), esc_html( get_the_title() ) );
			} else {
				/* translators: 1: comment count, 2: post title. */
				printf(
					esc_html( _n( '%1$s response to “%2$s”', '%1$s responses to “%2$s”', $liquid_glass_count, 'liquid-glass' ) ),
					esc_html( number_format_i18n( $liquid_glass_count ) ),
					esc_html( get_the_title() )
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 40,
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'class'     => 'lg-pagination',
				'prev_text' => esc_html__( 'Previous', 'liquid-glass' ),
				'next_text' => esc_html__( 'Next', 'liquid-glass' ),
			)
		);
		?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_form'         => 'comment-form',
			'title_reply'        => esc_html__( 'Leave a comment', 'liquid-glass' ),
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title text-x-large">',
			'title_reply_after'  => '</h2>',
			'logged_in_as'       => '<p class="logged-in-as">%s</p>',
		)
	);
	?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'liquid-glass' ); ?></p>
	<?php endif; ?>
</section>
