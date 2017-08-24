<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Fabulous Fluid
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function fabulous_fluid_jetpack_setup() {
	/**
     * Setup Infinite Scroll using JetPack if navigation type is set
     */
    $pagination_type = apply_filters( 'fabulous_fluid_get_option', 'pagination_type' );

    if( 'infinite-scroll-click' == $pagination_type ) {
        add_theme_support( 'infinite-scroll', array(
            'type'      => 'click',
            'container' => 'main',
			'render'    => 'fabulous_fluid_infinite_scroll_render',
			'footer'    => 'page',
        ) );
    }
    else if ( 'infinite-scroll-scroll' == $pagination_type ) {
        //Override infinite scroll disable scroll option
        update_option('infinite_scroll', true);

        add_theme_support( 'infinite-scroll', array(
            'type'      => 'scroll',
			'container' => 'main',
			'render'    => 'fabulous_fluid_infinite_scroll_render',
			'footer'    => 'page',
        ) );
    }

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'fabulous_fluid_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function fabulous_fluid_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
