<?php
	function plum_customize_register_social( $wp_customize ) {
		// Social Icons
	$wp_customize->add_section('plum_social_section', array(
			'title' => __('Social Icons','plum'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','plum'),
					'facebook' => __('Facebook','plum'),
					'twitter' => __('Twitter','plum'),
					'google-plus' => __('Google Plus','plum'),
					'instagram' => __('Instagram','plum'),
					'rss' => __('RSS Feeds','plum'),
					'vine' => __('Vine','plum'),
					'vimeo-square' => __('Vimeo','plum'),
					'youtube' => __('Youtube','plum'),
					'flickr' => __('Flickr','plum'),
					'pinterest-p'	=> __('Pinterest', 'plum'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 4) ; $x++) :
			
		$wp_customize->add_setting(
			'plum_social_'.$x, array(
				'sanitize_callback' => 'plum_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'plum_social_'.$x, array(
					'settings' => 'plum_social_'.$x,
					'label' => __('Icon ','plum').$x,
					'section' => 'plum_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'plum_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'plum_social_url'.$x, array(
					'settings' => 'plum_social_url'.$x,
					'description' => __('Icon ','plum').$x.__(' Url','plum'),
					'section' => 'plum_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function plum_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr',
					'pinterest-p'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
}
add_action('customize_register', 'plum_customize_register_social');