<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package plum
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */ 
function plum_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
	    'type'           => 'click',
	    'footer_widgets' => true,
	    'container'      => 'main',
	    'render'		 => 'plum_jetpack_render_posts',
	    'posts_per_page' => 6,
	    'wrapper' 		 => false,
	) );
}
add_action( 'after_setup_theme', 'plum_jetpack_setup' );

function plum_jetpack_render_posts() {
		while( have_posts() ) {
	    the_post();
	    do_action('plum_blog_layout'); 
	}
}

function plum_filter_jetpack_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = __( 'Load more...', 'plum' );
 
    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'plum_filter_jetpack_infinite_scroll_js_settings' );