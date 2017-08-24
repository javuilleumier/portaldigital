<?php
	function plum_customize_register_layouts( $wp_customize ) {
	// Layout and Design
	$wp_customize->add_panel( 'plum_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','plum'),
	) );
	
	$wp_customize->add_section(
	    'plum_design_options',
	    array(
	        'title'     => __('Blog Layout','plum'),
	        'priority'  => 0,
	        'panel'     => 'plum_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'plum_blog_layout',
		array( 'sanitize_callback' => 'plum_sanitize_blog_layout' )
	);
	
	function plum_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','plum','plum_3_column') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'plum_blog_layout',array(
				'label' => __('Select Layout','plum'),
				'description' => __('Use 3 Column Layouts, only after disabling sidebar for the page.','plum'),
				'settings' => 'plum_blog_layout',
				'section'  => 'plum_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','plum'),
						'plum' => __('Plum Theme Layout','plum'),
						'plum_3_column' => __('Plum Theme Layout (3 Columns)','plum'),
						'grid_2_column' => __('Grid - 2 Column','plum'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'plum_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','plum'),
	        'priority'  => 0,
	        'panel'     => 'plum_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'plum_disable_sidebar',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_disable_sidebar', array(
		    'settings' => 'plum_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','plum' ),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'plum_disable_sidebar_home',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_disable_sidebar_home', array(
		    'settings' => 'plum_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','plum' ),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'plum_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'plum_disable_sidebar_front',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_disable_sidebar_front', array(
		    'settings' => 'plum_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','plum' ),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'plum_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'plum_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'plum_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'plum_sidebar_width', array(
		    'settings' => 'plum_sidebar_width',
		    'label'    => __( 'Sidebar Width','plum' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','plum'),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'plum_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function plum_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('plum_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	function plum_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'plum_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','plum'),
    	'description'	=> __('Enter your Own Copyright Text.','plum'),
    	'priority'		=> 11,
    	'panel'			=> 'plum_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'plum_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'plum_footer_text',
	        array(
	            'section' => 'plum_custom_footer',
	            'settings' => 'plum_footer_text',
	            'type' => 'text'
	        )
	);	
	
}
add_action('customize_register', 'plum_customize_register_layouts');
 