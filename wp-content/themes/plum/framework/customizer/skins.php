<?php	
function plum_customize_register_skins( $wp_customize ) {
	
	$wp_customize->get_section('colors')->title = __('Theme Skin & Colors','plum');
	$wp_customize->get_control('header_textcolor')->label = __('Site Title Color','plum');
	
	$wp_customize->add_setting('plum_header_desccolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'plum_header_desccolor', array(
			'label' => __('Site Tagline Color','plum'),
			'section' => 'colors',
			'settings' => 'plum_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting(
		'plum_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'plum_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(Plum)','plum'),
					'orange' =>  __('Orange','plum'),
					'green' => __('Green','plum'),
					);
	
	$wp_customize->add_control(
		'plum_skin',array(
				'settings' => 'plum_skin',
				'section'  => 'colors',
				'label' => __('Choose Skin','plum'),
				'description' => __('Free Version of Plum Supports 3 Different Skin Colors.','plum'),
				'type' => 'select',
				'choices' => $skins,
			)
	);
	
	function plum_sanitize_skin( $input ) {
		if ( in_array($input, array('default','orange','green') ) )
			return $input;
		else
			return '';
	}
}
add_action('customize_register', 'plum_customize_register_skins');
 