<?php
/**
 * Template tags — small, escaped helpers used by template parts.
 *
 * All output is escaped at render time. Icons are inline SVG (no icon font,
 * no library). Functions are pluggable-style guarded with function_exists()
 * so a child theme can override them.
 *
 * @package Liquid_Glass
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'liquid_glass_get_icon_svg' ) ) {
	/**
	 * Return an inline SVG icon from the built-in set.
	 *
	 * Icons follow Apple visual principles: 24px grid, ~1.5 stroke weight,
	 * rounded joins, optical centering. Output is static markup — safe to
	 * echo directly.
	 *
	 * @param string $name  Icon name.
	 * @param array  $args  { Optional. Attributes.
	 *     @type string $label Accessible label. Empty = aria-hidden decorative.
	 *     @type string $class Extra classes.
	 * }
	 * @return string SVG markup.
	 */
	function liquid_glass_get_icon_svg( $name, $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'label' => '',
				'class' => '',
			)
		);

		$paths = array(
			'search'    => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.8-3.8"/>',
			'close'     => '<path d="M6 6l12 12M18 6L6 18"/>',
			'menu'      => '<path d="M4 7h16M4 12h16M4 17h16"/>',
			'chevron'   => '<path d="m9 5 7 7-7 7"/>',
			'sun'       => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.9 4.9l1.5 1.5m11.2 11.2 1.5 1.5M2 12h2m16 0h2M4.9 19.1l1.5-1.5M17.6 6.4l1.5-1.5"/>',
			'moon'      => '<path d="M20 14.5A8.5 8.5 0 1 1 9.5 4a7 7 0 0 0 10.5 10.5Z"/>',
			'contrast'  => '<circle cx="12" cy="12" r="8.5"/><path d="M12 3.5a8.5 8.5 0 0 1 0 17Z" fill="currentColor" stroke="none"/>',
			'arrow'     => '<path d="M4 12h16m-6-6 6 6-6 6"/>',
			'check'     => '<path d="m5 13 4 4L19 7"/>',
			'heart'     => '<path d="M12 20s-7.5-4.6-9.3-9A5.2 5.2 0 0 1 12 6.7 5.2 5.2 0 0 1 21.3 11c-1.8 4.4-9.3 9-9.3 9Z"/>',
			'sparkles'  => '<path d="M12 4l1.7 4.3L18 10l-4.3 1.7L12 16l-1.7-4.3L6 10l4.3-1.7L12 4Zm6.5 9 .9 2.1 2.1.9-2.1.9-.9 2.1-.9-2.1-2.1-.9 2.1-.9.9-2.1Z"/>',
			'globe'     => '<circle cx="12" cy="12" r="8.5"/><path d="M3.5 12h17M12 3.5c2.5 2.4 3.8 5.3 3.8 8.5S14.5 18.1 12 20.5c-2.5-2.4-3.8-5.3-3.8-8.5S9.5 5.9 12 3.5Z"/>',
			'security'  => '<path d="M12 3 5 6v5c0 4.6 3 8 7 10 4-2 7-5.4 7-10V6l-7-3Z"/><path d="m9.5 12 1.8 1.8 3.5-3.6"/>',
			'speed'     => '<path d="M12 20a8 8 0 1 1 8-8"/><path d="M12 12l4.5-3.5"/>',
			'layers'    => '<path d="m12 4 8 4-8 4-8-4 8-4Z"/><path d="m4 12 8 4 8-4M4 16l8 4 8-4"/>',
			'pen'       => '<path d="M4 20h4L20 8l-4-4L4 16v4Z"/><path d="m13.5 6.5 4 4"/>',
			'mail'      => '<rect x="3.5" y="5.5" width="17" height="13" rx="2.5"/><path d="m4.5 7.5 7.5 5.5 7.5-5.5"/>',
			'calendar'  => '<rect x="3.5" y="5.5" width="17" height="15" rx="2.5"/><path d="M3.5 10h17M8 3.5v4m8-4v4"/>',
			'user'      => '<circle cx="12" cy="8.5" r="3.8"/><path d="M5 20c1.3-3.3 4-5 7-5s5.7 1.7 7 5"/>',
			'chat'      => '<path d="M20 12.5c0 3.6-3.6 6.5-8 6.5-1 0-2-.2-2.9-.5L5 20l1-3.2C4.8 15.4 4 14 4 12.5 4 8.9 7.6 6 12 6s8 2.9 8 6.5Z"/>',
			'home'      => '<path d="m4 11 8-7 8 7"/><path d="M6 9.5V20h12V9.5"/><path d="M10 20v-5h4v5"/>',
		);

		$name = isset( $paths[ $name ] ) ? $name : 'chevron';

		$attributes = 'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"';

		if ( '' === $args['label'] ) {
			$attributes .= ' aria-hidden="true" focusable="false"';
		} else {
			$attributes .= ' role="img" aria-label="' . esc_attr( $args['label'] ) . '"';
		}

		if ( '' !== $args['class'] ) {
			$attributes .= ' class="' . esc_attr( $args['class'] ) . '"';
		}

		return '<svg ' . $attributes . '>' . $paths[ $name ] . '</svg>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static whitelisted SVG paths.
	}
}

if ( ! function_exists( 'liquid_glass_posted_on' ) ) {
	/**
	 * Print the post date with a machine-readable <time>.
	 */
	function liquid_glass_posted_on() {
		printf(
			'<span class="posted-on"><span class="screen-reader-text">%1$s </span><time class="entry-date published updated" datetime="%2$s">%3$s</time></span>',
			esc_html__( 'Posted on', 'liquid-glass' ),
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);
	}
}

if ( ! function_exists( 'liquid_glass_posted_by' ) ) {
	/**
	 * Print the author byline.
	 */
	function liquid_glass_posted_by() {
		printf(
			'<span class="byline"><span class="screen-reader-text">%1$s </span><span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></span>',
			esc_html__( 'By', 'liquid-glass' ),
			esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
}

if ( ! function_exists( 'liquid_glass_entry_footer' ) ) {
	/**
	 * Print categories, tags and comment link for post formats in PHP loops.
	 */
	function liquid_glass_entry_footer() {
		if ( has_category() ) {
			printf(
				'<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html__( 'Categories:', 'liquid-glass' ),
				wp_kses_post( get_the_category_list( ', ' ) )
			);
		}

		$tags = get_the_tags();
		if ( $tags ) {
			printf(
				'<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html__( 'Tags:', 'liquid-glass' ),
				wp_kses_post(
					get_the_tag_list(
						'',
						', ',
						''
					)
				)
			);
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link();
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'liquid_glass_breadcrumbs' ) ) {
	/**
	 * Render an accessible breadcrumb trail for singular views.
	 *
	 * Designed to coexist with SEO plugins: if a breadcrumb is already being
	 * output by an SEO plugin via its shortcode/template function, disable
	 * this one through the `liquid_glass_breadcrumbs_enabled` filter.
	 */
	function liquid_glass_breadcrumbs() {
		/**
		 * Allow disabling the built-in breadcrumbs (e.g. when an SEO plugin
		 * already renders them).
		 *
		 * @param bool $enabled Whether to print breadcrumbs. Default true on singular.
		 */
		if ( ! apply_filters( 'liquid_glass_breadcrumbs_enabled', is_singular() && ! is_front_page() ) ) {
			return;
		}

		$items   = array();
		$items[] = array(
			'label' => __( 'Home', 'liquid-glass' ),
			'url'   => home_url( '/' ),
		);

		if ( is_singular( 'post' ) ) {
			$blog_id = (int) get_option( 'page_for_posts' );
			if ( $blog_id ) {
				$items[] = array(
					'label' => get_the_title( $blog_id ),
					'url'   => (string) get_permalink( $blog_id ),
				);
			}

			$categories = get_the_category();
			if ( $categories ) {
				$items[] = array(
					'label' => $categories[0]->name,
					'url'   => (string) get_category_link( $categories[0] ),
				);
			}
		} elseif ( is_page() ) {
			$ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );
			foreach ( $ancestors as $ancestor ) {
				$items[] = array(
					'label' => get_the_title( (int) $ancestor ),
					'url'   => (string) get_permalink( (int) $ancestor ),
				);
			}
		}

		$items[] = array(
			'label' => wp_strip_all_tags( get_the_title() ),
			'url'   => '',
		);

		echo '<nav class="lg-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'liquid-glass' ) . '"><ol>';

		$last = count( $items ) - 1;
		foreach ( $items as $index => $item ) {
			echo '<li>';
			if ( '' === $item['url'] || $index === $last ) {
				printf( '<span aria-current="page">%s</span>', esc_html( $item['label'] ) );
			} else {
				printf( '<a href="%1$s">%2$s</a>', esc_url( $item['url'] ), esc_html( $item['label'] ) );
			}
			echo '</li>';
		}

		echo '</ol></nav>';
	}
}

if ( ! function_exists( 'liquid_glass_related_posts' ) ) {
	/**
	 * Render related posts (same category, fallback same tags) as glass cards.
	 *
	 * Uses WP_Query — no direct database access.
	 *
	 * @param int $count Number of related posts to show.
	 */
	function liquid_glass_related_posts( $count = 3 ) {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		$categories = wp_get_post_categories( get_the_ID() );
		$tags       = wp_get_post_tags( get_the_ID(), array( 'fields' => 'ids' ) );

		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => (int) $count,
			'post__not_in'        => array( get_the_ID() ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		if ( $categories ) {
			$query_args['category__in'] = $categories;
		} elseif ( $tags ) {
			$query_args['tag__in'] = $tags;
		} else {
			return; // Nothing to relate.
		}

		$related = new WP_Query( $query_args );

		if ( ! $related->have_posts() ) {
			wp_reset_postdata();
			return;
		}

		echo '<section class="lg-related" aria-labelledby="lg-related-heading">';
		printf(
			'<h2 id="lg-related-heading" class="text-x-large">%s</h2>',
			esc_html__( 'Related articles', 'liquid-glass' )
		);
		echo '<div class="lg-related__grid">';

		while ( $related->have_posts() ) {
			$related->the_post();
			?>
			<article class="glass-surface glass-card lg-post-card lg-post-card--hover">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-card__media">
						<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
					</div>
				<?php endif; ?>
				<div class="post-card__body">
					<h3 class="post-card__title text-x-large">
						<a href="<?php the_permalink(); ?>" class="lg-card-link"><?php the_title(); ?></a>
					</h3>
					<p class="post-card__excerpt">
						<?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
					</p>
					<p class="entry-meta" style="margin:0">
						<?php liquid_glass_posted_on(); ?>
					</p>
				</div>
			</article>
			<?php
		}

		echo '</div></section>';
		wp_reset_postdata();
	}
}

if ( ! function_exists( 'liquid_glass_reading_time' ) ) {
	/**
	 * Estimated reading time (~238 wpm), cached per post.
	 *
	 * @return string Translated reading-time string.
	 */
	function liquid_glass_reading_time() {
		$post_id = get_the_ID();
		$count   = get_transient( 'lg_readtime_' . $post_id );

		if ( false === $count ) {
			$content = wp_strip_all_tags( get_post_field( 'post_content', $post_id ) );
			$count   = max( 1, (int) ceil( str_word_count( $content ) / 238 ) );
			set_transient( 'lg_readtime_' . $post_id, $count, DAY_IN_SECONDS );
		}

		/* translators: %d: number of minutes. */
		return sprintf( _n( '%d min read', '%d min read', $count, 'liquid-glass' ), $count );
	}
}

if ( ! function_exists( 'liquid_glass_appearance_toggle' ) ) {
	/**
	 * Render the light/dark/auto toggle button for the header.
	 */
	function liquid_glass_appearance_toggle() {
		$default = get_theme_mod( 'lg_default_appearance', 'auto' );
		$allowed = array( 'auto', 'light', 'dark' );
		if ( ! in_array( $default, $allowed, true ) ) {
			$default = 'auto';
		}
		?>
		<button
			type="button"
			class="lg-icon-button glass-button--secondary lg-appearance-toggle"
			data-state="<?php echo esc_attr( $default ); ?>"
			aria-label="<?php esc_attr_e( 'Switch appearance: automatic, light or dark', 'liquid-glass' ); ?>"
		>
			<span class="icon-auto"><?php echo liquid_glass_get_icon_svg( 'contrast' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG. ?></span>
			<span class="icon-light"><?php echo liquid_glass_get_icon_svg( 'sun' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG. ?></span>
			<span class="icon-dark"><?php echo liquid_glass_get_icon_svg( 'moon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG. ?></span>
		</button>
		<?php
	}
}
