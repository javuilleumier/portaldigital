<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fabulous Fluid
 */

if ( ! function_exists( 'fabulous_fluid_the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function fabulous_fluid_the_posts_navigation() {
	global $wp_query, $post;

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
		return;
	}

	$pagination_type = apply_filters( 'fabulous_fluid_get_option', 'pagination_type' );

	/**
	 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
	 * if it's active then disable pagination
	 */
	if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
		return false;
	}

	/*$classes = $pagination_type;

	if ( 'numeric' == $pagination_type && function_exists( 'wp_pagenavi' ) ) {
		$classes .= ' wp-pagenavi';
	}*/
	?>

	<div class="main-pagination clear">
		<?php
			/**
			 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
			 */
			if ( 'numeric' == $pagination_type && function_exists( 'wp_pagenavi' ) ) {
				echo '<nav class="navigation pagination-pagenavi" role="navigation">';
					wp_pagenavi();
				echo '</nav><!-- .pagination-pagenavi -->';
            }
            elseif ( 'numeric' == $pagination_type && function_exists( 'the_posts_pagination' ) ) {
				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Previous page', 'fabulous-fluid' ),
					'next_text'          => esc_html__( 'Next page', 'fabulous-fluid' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'fabulous-fluid' ) . ' </span>',
				) );
			}
            else {
				the_posts_navigation();
            }
        ?>
	</div><!-- .main-pagination -->
	<?php
}
endif;

if ( ! function_exists( 'fabulous_fluid_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fabulous_fluid_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'fabulous-fluid' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'fabulous-fluid' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'fabulous_fluid_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function fabulous_fluid_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'fabulous-fluid' ) );
		if ( $categories_list && fabulous_fluid_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'fabulous-fluid' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'fabulous-fluid' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'fabulous-fluid' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'fabulous-fluid' ), esc_html__( '1 Comment', 'fabulous-fluid' ), esc_html__( '% Comments', 'fabulous-fluid' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'fabulous-fluid' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fabulous_fluid_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'fabulous_fluid_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'fabulous_fluid_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so fabulous_fluid_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so fabulous_fluid_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in fabulous_fluid_categorized_blog.
 */
function fabulous_fluid_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'fabulous_fluid_categories' );
}
add_action( 'edit_category', 'fabulous_fluid_category_transient_flusher' );
add_action( 'save_post',     'fabulous_fluid_category_transient_flusher' );

if ( ! function_exists( 'fabulous_fluid_grid_content_meta' ) ) :
/**
 * Prints HTML with meta information (the categories and posted on) for grid content
 */
function fabulous_fluid_grid_content_meta() {
	$output = '';

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'fabulous-fluid' ) );

	if ( $categories_list && fabulous_fluid_categorized_blog() ) {
		$output .= '<span class="category">' . $categories_list . '</span>';
	}

	$output .= '<span class="posted-on">' . esc_html( get_the_date() ) . '</span>';

	return $output;
}
endif;
