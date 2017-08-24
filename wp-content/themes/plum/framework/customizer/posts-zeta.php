<?php 

function plum_customize_zeta( $wp_customize ) {	
	
	$wp_customize->add_section(
	    'plum_zeta_section',
	    array(
	        'title'     => __('Featured Posts','plum'),
	        'priority'  => 10,
	        'panel'     => 'plum_a_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'plum_zeta_enable',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_zeta_enable', array(
		    'settings' => 'plum_zeta_enable',
		    'label'    => __( 'Enable Featured Posts', 'plum' ),
		    'section'  => 'plum_zeta_section',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'plum_zeta_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'plum_zeta_title', array(
		    'settings' => 'plum_zeta_title',
		    'label'    => __( 'Title','plum' ),
		    'section'  => 'plum_zeta_section',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'plum_zeta_cat',
	    array( 'sanitize_callback' => 'plum_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Plum_WP_Customize_Category_Control(
	        $wp_customize,
	        'plum_zeta_cat',
	        array(
	            'label'    => __('Posts Category.','plum'),
	            'settings' => 'plum_zeta_cat',
	            'section'  => 'plum_zeta_section'
	        )
	    )
	);
}
add_action('customize_register', 'plum_customize_zeta');	