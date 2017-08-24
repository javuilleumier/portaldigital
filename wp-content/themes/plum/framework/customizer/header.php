<?php
function plum_customize_register_header( $wp_customize ) {	
	//Header Sections
	$wp_customize->add_panel(
	    'plum_header_panel',
	    array(
	        'title'     => __('Header Settings','plum'),
	        'priority'  => 30,
	    )
	);
	
	$wp_customize->add_section(
	    'plum_header_options',
	    array(
	        'title'     => __('Header Image on Phones','plum'),
	        'priority'  => 90,
	        'panel' => 'plum_header_panel',
	    )
	);
	
	$wp_customize->add_setting(
		'plum_header_image_style',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'plum_sanitize_hil' 
			)
	);
	
	$wp_customize->add_control(
		'plum_header_image_style',array(
				'label' => __('Choose Image Layout','plum'),
				'description' => __('By Default The Header Image Scales responsively on mobile phones and works as a background image. If you want your full header image to appear, choose full-image in the setting below. For More Control over header image, consider Plum Pro Version.	','plum'),
				'settings' => 'plum_header_image_style',
				'section'  => 'plum_header_options',
				'type' => 'select',
				'choices' => array(
					'default' => __('Default','plum'),
					'full-image' => __('Full Image','plum'),
				),
			)
	);
	
	$wp_customize->get_section('header_image')->panel = 'plum_header_panel';
	
	function plum_sanitize_hil($input) {
		if ( in_array($input, array('default','full-image') ) )
			return $input;
		else
			return '';	
	}
}
add_action('customize_register','plum_customize_register_header');	