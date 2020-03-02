<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Urchenko Technologies
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.0.0
 */

if ( ! function_exists( 'skywp_post_thumbnail' ) ) :
	/**
	 * Function display image posted
	 */
	function skywp_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$image_cropped_size = 'skywp-post-large';

		if ( is_singular() ) :

			the_post_thumbnail( $image_cropped_size, ['alt' => the_title_attribute( ['echo' => false,] )] );
		
		endif; // End is_singular().

		if ( is_archive() || is_home() || is_search() ) :
		
			if ( get_theme_mod( 'skywp_post_style', 'default' ) == 'masonry' ) {
				$image_cropped_size = 'skywp-post-masonry';
			} else {
				if ( get_theme_mod( 'skywp_post_number_columns', 'one' ) == 'one' ) {
					$image_cropped_size = 'skywp-post-large';
				} else {
					$image_cropped_size = 'skywp-post-medium';
				}
			} ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">

				<?php the_post_thumbnail( $image_cropped_size, ['alt' => the_title_attribute( ['echo' => false,] )] ); ?>
			</a>

		<?php
		endif; // End is_archive().
	}
endif;


if ( ! function_exists( 'skywp_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function skywp_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'skywp' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'skywp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'skywp' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'skywp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'skywp' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'skywp' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
