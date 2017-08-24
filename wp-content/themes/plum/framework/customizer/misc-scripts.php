<?php

function plum_customize_register_misc( $wp_customize ) {
		//help and support section
	$wp_customize->add_section(
	    'plum_sec_h',
	    array(
	        'title'     => __('-> Plum Help & Support!!','plum'),
	        'priority'  => 10,
	    )
	);
	
	$wp_customize->add_setting(
			'plum_h',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Plum_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'plum_h',
	        array(
	            'label' => __('Free Help & Support','plum'),
	            'description' => __('<a href="https://inkhive.com/contact-us/" target="_blank">Contact Us</a> and help us make Plum a better theme with Feature Requests, Bug Reports or for any other help you need. <br /> <br />. We Generally Respond to Free theme support emails in 24 to 48 hours. <br/> <br/> We would Recommend to <a href="https://inkhive.com/product/plum/" target="_blank">Read the FAQs</a> as well.','plum'),
	            'section' => 'plum_sec_h',
	            'settings' => 'plum_h',			       
	        )
		)
	);
	
	//Upgrade to Pro
	$wp_customize->add_section(
	    'plum_sec_pro',
	    array(
	        'title'     => __('-> Upgrade to Plum Pro Version','plum'),
	        'priority'  => 10,
	    )
	);
	
	$wp_customize->add_setting(
			'plum_pro',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Plum_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'plum_pro',
	        array(
	            'label' => __('Unlock More Features','plum'),
	            'description' => __('
	            			Plum Plus comes with so many features that you will fall in love with the theme. We have added everything everyone requested for and so much more. Here is a small list of what Plum Plus includes<br/><br/>
	            			<ul>
	            			<li> - Improved Mobile Friendliness</li>
	            			<li> - Custom Header Images for Posts & Pages</li>
	            			<li> - Advanced Slider</li>
	            			<li> - More Featured Areas</li>
	            			<li> - <strong>Unlimited Colors & Skins</strong></li>
	            			<li> - Improved SEO Friendliness</li>
							<li> - Custom Options for Pages</li>
							<li> - Multiple Blog Layouts</li>
							<li> - 30+ Social Icons</li>
							<li> - 650+ Google Fonts</li>
							<li> - and much more</li></ul><br/>
	            			To know more or to purchase, visit <a href="https://inkhive.com/product/plum-plus/">Plum Plus.</a> 
							','plum'),
	            'section' => 'plum_sec_pro',
	            'settings' => 'plum_pro',			       
	        )
		)
	);
}
add_action('customize_register', 'plum_customize_register_misc');