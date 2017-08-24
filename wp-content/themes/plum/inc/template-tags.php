<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package plum
 */

if ( ! function_exists( 'plum_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function plum_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'plum' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'plum' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'plum' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'plum_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function plum_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'plum' ); ?></h1>
		<div class="nav-links">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			  <div class="nav-previous col-md-6"><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail', array(120,120)); ?></a>
			<?php
				previous_post_link( '<span class="navl">%link</span></div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'plum' ) );
			endif;
			
			$prev_post = get_next_post(); //Variable overriden
			if (!empty( $prev_post )): ?>
			 <div class="nav-next col-md-6"> <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail', array(120,120)); ?></a>
			<?php 
				next_post_link(  '<span class="navl">%link</span>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'plum' ) ); 
				?>
				 </div> <?php
				endif;
			?>
			
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'plum_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function plum_posted_on() {
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
		_x( 'Posted on %s', 'post date', 'plum' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'plum' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}

function plum_posted_on_plum() {
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

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on title-font">' . $posted_on . '</span><span class="byline title-font"><i class="fa fa-user"></i> ' . $byline . '</span>';

}


endif;

if ( ! function_exists( 'plum_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function plum_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'plum' ) );
		if ( $categories_list && plum_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'plum' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'plum' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'plum' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'plum' ), __( '1 Comment', 'plum' ), __( '% Comments', 'plum' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'plum' ), '<span class="edit-link">', '</span>' );
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function plum_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'plum_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'plum_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so plum_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so plum_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'plum_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function plum_comment( $comment, $args, $depth ) {

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'plum' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'plum' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body row">
			<footer class="comment-meta">
				<div class="comment-author vcard col-md-2 col-sm-2 hidden-xs">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, 150 ); ?>
				</div><!-- .comment-author -->
				<div class="comment-metadata col-md-10 col-sm-10 col-xs-12">
					<?php printf( '%s', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf('%1$s', get_comment_date() ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'plum' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content col-md-10 col-sm-10 col-xs-12">
				<?php comment_text(); ?>
				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
			<?php edit_comment_link( __( 'Edit', 'plum' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for plum_comment()

/**
 * Flush out the transients used in plum_categorized_blog.
 */
function plum_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'plum_categories' );
}
add_action( 'edit_category', 'plum_category_transient_flusher' );
add_action( 'save_post',     'plum_category_transient_flusher' );
