<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Catch Themes
 * @subpackage Fabulous Fluid
 * @since Fabulous Fluid 0.2
 */


/**
 * Returns the default options for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_get_default_theme_options( $parameter = null ) {
	$default_theme_options = array(
		//Site Identity
		'hide_tagline'                                     => 0,

		//Header Image
		'enable_featured_header_image'                     => 'exclude-home-page-post',
		'featured_image_size'                              => 'full',
		'featured_header_image_url'                        => home_url( '/ ' ),
		'featured_header_image_alt'                        => '',
		'featured_header_image_base'                       => 0,

		//Navigation
		'primary_menu_disable'                             => 0,
		'primary_search_disable'                           => 1,
		'nav_full_width'                                   => 0,

		//Layout
		'theme_layout'                                     => 'right-sidebar',
		'content_layout'                                   => 'excerpt-image-left',
		'single_post_image_layout'                         => 'disable',

		//Breadcrumb Options
		'breadcrumb_option'                                => 0,
		'breadcrumb_onhomepage'                            => 0,
		'breadcrumb_seperator'                             => '&raquo;',

		//Custom CSS
		'custom_css'                                       => '',

		//Scrollup Options
		'disable_scrollup'                                 => 0,

		//Excerpt Options
		'excerpt_length'                                   => '30',
		'excerpt_more_text'                                => esc_html__( 'Read More ...', 'fabulous-fluid' ),

		//Homepage / Frontpage Settings
		'front_page_category'                              => '0',

		//Pagination Options
		'pagination_type'                                  => 'default',

		//Promotion Headline Options
		'promotion_headline_option'                        => 'disabled',
		'promotion_headline'                               => esc_html__( 'Fabulous Fluid is a Responsive WordPress Theme', 'fabulous-fluid' ),
		'promotion_subheadline'                            => esc_html__( 'This is promotion headline. You can edit this from Appearance -> Customize -> Theme Options -> Promotion Headline Options', 'fabulous-fluid' ),
		'promotion_headline_button'                        => esc_html__( 'Buy Now', 'fabulous-fluid' ),
		'promotion_headline_url'                           => '#',
		'promotion_headline_target'                        => 1,

		//Search Options
		'search_text'                                      => esc_html__( 'Search...', 'fabulous-fluid' ),

		'enable_jcf'                                       => 0,

		//Color
		'background_color'                                 => '#ffffff',
		'header_textcolor'                                 => '#ffffff',
		'tagline_color'                                    => '#eeeeee',

		//Featured Content Options
		'featured_content_option'                          => 'disabled',
		'featured_content_layout'                          => 'layout-five',
		'featured_content_position'                        => 1,
		'featured_content_headline'                        => '',
		'featured_content_subheadline'                     => '',
		'featured_content_type'                            => 'demo-content',
		'featured_content_number'                          => '5',
		'featured_content_show'                            => 'excerpt',

		//Featured Grid Content Options
		'featured_grid_content_option'                     => 'disabled',
		'featured_grid_content_type'                       => 'demo-content',
		'featured_grid_content_number'                     => '5',
		'featured_grid_content_show'                       => 'excerpt',
		'featured_grid_content_loadmore'                   => esc_html__( 'Load More', 'fabulous-fluid' ),

		//Featured Slider Options
		'featured_slider_option'                           => 'disabled',
		'featured_slide_transition_effect'                 => 'fadeout',
		'featured_slide_transition_delay'                  => '4',
		'featured_slide_transition_length'                 => '1',
		'featured_slider_image_loader'                     => 'wait',
		'featured_slider_type'                             => 'demo-featured-slider',
		'featured_slide_number'                            => '5',

		//Reset all settings
		'reset_all_settings'                               => 0,
	);

	if ( null == $parameter ) {
		return apply_filters( 'fabulous_fluid_default_theme_options', $default_theme_options );
	}
	else {
		if ( isset( $default_theme_options[ $parameter ] ) ) {
			return $default_theme_options[ $parameter ];
		};

		return false;
	}
}


/**
 * Returns an array of feature header enable options
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_enable_featured_header_image_options() {
	$enable_featured_header_image_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => esc_html__( 'Homepage / Frontpage', 'fabulous-fluid' ),
		),
		'exclude-homepage' 		=> array(
			'value'	=> 'exclude-home',
			'label' => esc_html__( 'Excluding Homepage', 'fabulous-fluid' ),
		),
		'exclude-home-page-post' 	=> array(
			'value' => 'exclude-home-page-post',
			'label' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'fabulous-fluid' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => esc_html__( 'Entire Site', 'fabulous-fluid' ),
		),
		'entire-site-page-post' 	=> array(
			'value' => 'entire-site-page-post',
			'label' => esc_html__( 'Entire Site, Page/Post Featured Image', 'fabulous-fluid' ),
		),
		'pages-posts' 	=> array(
			'value' => 'pages-posts',
			'label' => esc_html__( 'Pages and Posts', 'fabulous-fluid' ),
		),
		'disable'		=> array(
			'value' => 'disable',
			'label' => esc_html__( 'Disabled', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_enable_featured_header_image_options', $enable_featured_header_image_options );
}

/**
 * Returns an array of layout options registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => esc_html__( 'Primary Sidebar, Content', 'fabulous-fluid' ),
		),
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => esc_html__( 'Content, Primary Sidebar', 'fabulous-fluid' ),
		),
		'no-sidebar' => array(
			'value' => 'no-sidebar',
			'label' => esc_html__( 'No Sidebar ( Content Width )', 'fabulous-fluid' ),
		)
	);
	return apply_filters( 'fabulous_fluid_layouts', $layout_options );
}


/**
 * Returns an array of featured slider image loader options
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_slider_image_loaders() {
	$options = array(
		'true' => array(
			'value' 				=> 'true',
			'label' 				=> esc_html__( 'True', 'fabulous-fluid' ),
		),
		'wait' => array(
			'value' 				=> 'wait',
			'label' 				=> esc_html__( 'Wait', 'fabulous-fluid' ),
		),
		'false' => array(
			'value' 				=> 'false',
			'label' 				=> esc_html__( 'False', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_featured_slider_image_loaders', $options );
}

/**
 * Returns an array of content layout options registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-image-left' => array(
			'value' => 'excerpt-image-left',
			'label' => esc_html__( 'Show Excerpt (Excerpt Image Left)', 'fabulous-fluid' ),
		),
		'full-content' => array(
			'value' => 'full-content',
			'label' => esc_html__( 'Show Full Content (No Featured Image)', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_get_archive_content_layout', $layout_options );
}

/**
 * Returns an array of feature image size
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_image_size_options() {
	$featured_image_size_options = array(
		'featured-image'		=> array(
			'value' => 'featured-image',
			'label' => esc_html__( 'Featured Image', 'fabulous-fluid' ),
		),
		'slider'		=> array(
			'value' => 'slider',
			'label' => esc_html__( 'Slider', 'fabulous-fluid' ),
		),
		'full' 		=> array(
			'value'	=> 'full',
			'label' => esc_html__( 'Full Image', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_featured_image_size_options', $featured_image_size_options );
}

/**
 * Returns an array of pagination schemes registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_get_pagination_types() {
	$pagination_types = array(
		'default' => array(
			'value' => 'default',
			'label' => esc_html__( 'Default(Older Posts/Newer Posts)', 'fabulous-fluid' ),
		),
		'numeric' => array(
			'value' => 'numeric',
			'label' => esc_html__( 'Numeric', 'fabulous-fluid' ),
		),
		'infinite-scroll-click' => array(
			'value' => 'infinite-scroll-click',
			'label' => esc_html__( 'Infinite Scroll (Click)', 'fabulous-fluid' ),
		),
		'infinite-scroll-scroll' => array(
			'value' => 'infinite-scroll-scroll',
			'label' => esc_html__( 'Infinite Scroll (Scroll)', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_get_pagination_types', $pagination_types );
}


/**
 * Returns an array of content featured image size.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_single_post_image_layout_options() {
	$single_post_image_layout_options = array(
		'featured-image' => array(
			'value' => 'featured-image',
			'label' => esc_html__( 'Featured Image', 'fabulous-fluid' ),
		),
		'slider' => array(
			'value' => 'slider',
			'label' => esc_html__( 'Slider', 'fabulous-fluid' ),
		),
		'full-size' => array(
			'value' => 'full-size',
			'label' => esc_html__( 'Full size', 'fabulous-fluid' ),
		),
		'disable' => array(
			'value' => 'disable',
			'label' => esc_html__( 'Disabled', 'fabulous-fluid' ),
		),
	);
	return apply_filters( 'fabulous_fluid_single_post_image_layout_options', $single_post_image_layout_options );
}


/**
 * Returns an array of metabox layout options registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'fabulous-fluid-layout-option',
			'value' => 'default',
			'label' => esc_html__( 'Default', 'fabulous-fluid' ),
		),
		'left-sidebar' 	=> array(
			'id' 	=> 'fabulous-fluid-layout-option',
			'value' => 'left-sidebar',
			'label' => esc_html__( 'Primary Sidebar, Content', 'fabulous-fluid' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'fabulous-fluid-layout-option',
			'value' => 'right-sidebar',
			'label' => esc_html__( 'Content, Primary Sidebar', 'fabulous-fluid' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'fabulous-fluid-layout-option',
			'value' => 'no-sidebar',
			'label' => esc_html__( 'No Sidebar ( Content Width )', 'fabulous-fluid' ),
		)
	);
	return apply_filters( 'fabulous_fluid_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_metabox_header_featured_image_options() {
	$header_featured_image_options = array(
		'default' => array(
			'id'		=> 'fabulous-fluid-header-image',
			'value' 	=> 'default',
			'label' 	=> esc_html__( 'Default', 'fabulous-fluid' ),
		),
		'enable' => array(
			'id'		=> 'fabulous-fluid-header-image',
			'value' 	=> 'enable',
			'label' 	=> esc_html__( 'Enable', 'fabulous-fluid' ),
		),
		'disable' => array(
			'id'		=> 'fabulous-fluid-header-image',
			'value' 	=> 'disable',
			'label' 	=> esc_html__( 'Disable', 'fabulous-fluid' )
		)
	);
	return apply_filters( 'header_featured_image_options', $header_featured_image_options );
}


/**
 * Returns an array of metabox featured image options registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_metabox_featured_image_options() {
	$featured_image_options = array(
		'default' => array(
			'id'	=> 'fabulous-fluid-featured-image',
			'value' => 'default',
			'label' => esc_html__( 'Default', 'fabulous-fluid' ),
		),
		'featured-image'		=> array(
			'id'	=> 'fabulous-fluid-featured-image',
			'value' => 'featured-image',
			'label' => esc_html__( 'Featured Image', 'fabulous-fluid' ),
		),
		'slider'		=> array(
			'id'	=> 'fabulous-fluid-featured-image',
			'value' => 'slider',
			'label' => esc_html__( 'Slider', 'fabulous-fluid' ),
		),
		'full' 		=> array(
			'id'	=> 'fabulous-fluid-featured-image',
			'value'	=> 'full',
			'label' => esc_html__( 'Full Image', 'fabulous-fluid' ),
		),
		'disable' => array(
			'id' 	=> 'fabulous-fluid-featured-image',
			'value' => 'disable',
			'label' => esc_html__( 'Disable Image', 'fabulous-fluid' )
		)
	);
	return apply_filters( 'featured_image_options', $featured_image_options );
}

/**
 * Returns an array of featured content options registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_content_layout_options() {
	$featured_content_layout_option = array(
		'layout-four' 	=> array(
			'value' => 'layout-four',
			'label' => esc_html__( '4 columns', 'fabulous-fluid' ),
		),
		'layout-five' 	=> array(
			'value' => 'layout-five',
			'label' => esc_html__( '5 columns', 'fabulous-fluid' ),
		),
		'layout-six' 	=> array(
			'value' => 'layout-six',
			'label' => esc_html__( '6 columns', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_featured_content_layout_options', $featured_content_layout_option );
}

/**
 * Returns an array of featured content show registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_content_show() {
	$featured_content_show_option = array(
		'excerpt' 		=> array(
			'value'	=> 'excerpt',
			'label' => esc_html__( 'Show Excerpt', 'fabulous-fluid' ),
		),
		'full-content' 	=> array(
			'value' => 'full-content',
			'label' => esc_html__( 'Show Full Content', 'fabulous-fluid' ),
		),
		'hide-content' 	=> array(
			'value' => 'hide-content',
			'label' => esc_html__( 'Hide Content', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_featured_content_show', $featured_content_show_option );
}

/**
 * Returns an array of feature content types registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_content_types() {
	$featured_content_types = array(
		'demo-content' => array(
			'value' => 'demo-content',
			'label' => esc_html__( 'Demo Content', 'fabulous-fluid' ),
		),
		'page-content' => array(
			'value' => 'page-content',
			'label' => esc_html__( 'Page Content', 'fabulous-fluid' ),
		)
	);

	return apply_filters( 'fabulous_fluid_featured_content_types', $featured_content_types );
}

/**
 * Returns an array of slider layout options registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_slider_options() {
	$featured_slider_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => esc_html__( 'Homepage / Frontpage', 'fabulous-fluid' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => esc_html__( 'Entire Site', 'fabulous-fluid' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => esc_html__( 'Disabled', 'fabulous-fluid' ),
		),
	);

	return apply_filters( 'fabulous_fluid_featured_slider_options', $featured_slider_options );
}

/**
 * Returns an array of feature slider types registered for fabulous fluid.
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_slider_types() {
	$featured_slider_types = array(
		'demo-featured-slider' => array(
			'value' => 'demo-featured-slider',
			'label' => esc_html__( 'Demo Featured Slider', 'fabulous-fluid' ),
		),
		'featured-page-slider' => array(
			'value' => 'featured-page-slider',
			'label' => esc_html__( 'Featured Page Slider', 'fabulous-fluid' ),
		)
	);

	return apply_filters( 'fabulous_fluid_featured_slider_types', $featured_slider_types );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_featured_slide_transition_effects() {
	$featured_slide_transition_effects = array(
		'fade' 		=> array(
			'value'	=> 'fade',
			'label' => esc_html__( 'Fade', 'fabulous-fluid' ),
		),
		'fadeout' 	=> array(
			'value'	=> 'fadeout',
			'label' => esc_html__( 'Fade Out', 'fabulous-fluid' ),
		),
		'none' 		=> array(
			'value' => 'none',
			'label' => esc_html__( 'None', 'fabulous-fluid' ),
		),
		'scrollHorz'=> array(
			'value' => 'scrollHorz',
			'label' => esc_html__( 'Scroll Horizontal', 'fabulous-fluid' ),
		),
		'scrollVert'=> array(
			'value' => 'scrollVert',
			'label' => esc_html__( 'Scroll Vertical', 'fabulous-fluid' ),
		),
		'flipHorz'	=> array(
			'value' => 'flipHorz',
			'label' => esc_html__( 'Flip Horizontal', 'fabulous-fluid' ),
		),
		'flipVert'	=> array(
			'value' => 'flipVert',
			'label' => esc_html__( 'Flip Vertical', 'fabulous-fluid' ),
		),
		'tileSlide'	=> array(
			'value' => 'tileSlide',
			'label' => esc_html__( 'Tile Slide', 'fabulous-fluid' ),
		),
		'tileBlind'	=> array(
			'value' => 'tileBlind',
			'label' => esc_html__( 'Tile Blind', 'fabulous-fluid' ),
		),
		'shuffle'	=> array(
			'value' => 'shuffle',
			'label' => esc_html__( 'Shuffle', 'fabulous-fluid' ),
		)
	);

	return apply_filters( 'fabulous_fluid_featured_slide_transition_effects', $featured_slide_transition_effects );
}