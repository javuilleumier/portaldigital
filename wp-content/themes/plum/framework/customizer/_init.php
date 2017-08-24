<?php
/**
 * plum Theme Customizer
 *
 * @package plum
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function plum_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';		
	$wp_customize->get_section( 'title_tagline')->title = __( 'Title, Tagline & Logo', 'plum' );
	
	$wp_customize->add_panel( 'plum_a_fcp_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Content Areas',
	    'description'    => '',
	) );
}
add_action( 'customize_register', 'plum_customize_register' );


require_once get_template_directory().'/framework/customizer/_googlefonts.php';
require_once get_template_directory().'/framework/customizer/_sanitization.php';
require_once get_template_directory().'/framework/customizer/header.php';
require_once get_template_directory().'/framework/customizer/layouts.php';
require_once get_template_directory().'/framework/customizer/posts-eta.php';
require_once get_template_directory().'/framework/customizer/posts-zeta.php';
require_once get_template_directory().'/framework/customizer/skins.php';
require_once get_template_directory().'/framework/customizer/social-icons.php';
require_once get_template_directory().'/framework/customizer/misc-scripts.php';


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function plum_customize_preview_js() {
	wp_enqueue_script( 'plum_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'plum_customize_preview_js' );
