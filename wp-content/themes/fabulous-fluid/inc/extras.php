<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fabulous Fluid
 */

function fabulous_fluid_get_option( $value ) {
	return get_theme_mod( $value, fabulous_fluid_get_default_theme_options( $value ) );
}
add_filter( 'fabulous_fluid_get_option', 'fabulous_fluid_get_option' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fabulous_fluid_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$classes[] = esc_attr( fabulous_fluid_get_theme_layout() );

	return $classes;
}
add_filter( 'body_class', 'fabulous_fluid_body_classes' );


if ( ! function_exists( 'fabulous_fluid_post_classes' ) ) :
	/**
	 * Adds journal post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since Clean Journal 1.0
	 */
	function fabulous_fluid_post_classes( $classes ) {
		if ( is_archive() || is_home() ) {
			//Load content layout from customizer options
			$contentlayout = apply_filters( 'fabulous_fluid_get_option', 'content_layout' );

			$classes[] = esc_attr( $contentlayout );
		}

		return $classes;
	}
endif; //fabulous_fluid_post_classes
add_filter( 'post_class', 'fabulous_fluid_post_classes' );



/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'fabulous_fluid_get_logo' ) ) :
	/**
	 * Get the logo
	 *
	 * @get logo from options
	 *
	 * @since Fabulous Fluid 0.1
	 */
	function fabulous_fluid_get_logo() {
		$output = '';
		//Checking Logo
		if ( has_custom_logo() ) {
			$output = '
			<div class="site-logo">'. get_custom_logo() . '</div><!-- #site-logo -->';
		}
		return $output;
	}
endif; // fabulous_fluid_get_logo


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, fabulous_fluid_customize_preview (see fabulous_fluid_customizer function: fabulous_fluid_customize_preview)
 *
 * @since  Fabulous Fluid 0.2
 */
function fabulous_fluid_flush_transients(){
	delete_transient( 'fabulous_fluid_featured_image' );

	delete_transient( 'fabulous_fluid_custom_css' );

	delete_transient( 'fabulous_fluid_footer_content' );

	delete_transient( 'fabulous_fluid_scrollup' );

	delete_transient( 'fabulous_fluid_featured_content' );

	delete_transient( 'fabulous_fluid_featured_grid_content' );

	delete_transient( 'fabulous_fluid_featured_slider' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'customize_save', 'fabulous_fluid_flush_transients' );


/**
 * Function to add search in Social Header Menu
 *
 * @return li menu items with search prepended
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'social' ) {
        return '<li><a href="javascript:void(0);" class="fa fa-search" id="social-search-anchor"></a></li>' . $items;
    }

    return $items;
}
add_filter('wp_nav_menu_items','fabulous_fluid_add_search_box_to_menu', 10, 2);


if ( ! function_exists( 'fabulous_fluid_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action fabulous_fluid_comment_section
	 *
	 * @since Fabulous Fluid Pro 1.0
	 */
	function fabulous_fluid_get_comment_section() {
		if ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}
}
endif;
add_action( 'fabulous_fluid_comment_section', 'fabulous_fluid_get_comment_section', 10 );


if ( ! function_exists( 'fabulous_fluid_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_custom_css() {
		//fabulous_fluid_flush_transients();

		if ( ( !$fabulous_fluid_custom_css = get_transient( 'fabulous_fluid_custom_css' ) ) ) {
			$defaults = fabulous_fluid_get_default_theme_options();

			//Hide Tagline using CSS
			$hide_tagline = apply_filters( 'fabulous_fluid_get_option', 'hide_tagline' );
			if ( $hide_tagline ) {
				$fabulous_fluid_custom_css	.=  ".site-description { position: absolute; clip: rect(1px 1px 1px 1px); }". "\n";
			}

			//Basic Color Options
			$background_color = get_background_color();

			if( $defaults[ 'background_color' ] != $background_color ) {
				$fabulous_fluid_custom_css	.=  "body.custom-background { background-color: #". esc_attr( $background_color ) ."; }". "\n";
			}

			//Header Text Color
			$header_text_color = get_header_textcolor();

			if ( 'blank' == $header_text_color && !has_custom_logo() ) {
				$fabulous_fluid_custom_css	.=  ".site-header .site-branding { position: absolute !important; clip: rect(1px 1px 1px 1px); }". "\n";
			}
			elseif ( $defaults[ 'header_textcolor' ] != $header_text_color ) {
				$fabulous_fluid_custom_css	.=  ".site-branding .site-title a, .site-branding .site-description { color: #".  esc_attr ( $header_text_color ) ."; }". "\n";
			}

			// This will hide header text when logo is enabled
			if ( ! display_header_text() ) {
				$fabulous_fluid_custom_css    .=  ".site-title a, .site-description { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px); }". "\n";
			}

			//Tagline Color
			$tagline_color = apply_filters( 'fabulous_fluid_get_option', 'tagline_color' );
			if( $defaults[ 'tagline_color' ] != $tagline_color ) {
				$fabulous_fluid_custom_css	.=  ".site-branding .site-description { color: ".  esc_attr( $tagline_color ) ."; }". "\n";
			}

			//Custom CSS Option
			$options['custom_css'] 	 = apply_filters( 'fabulous_fluid_get_option', 'custom_css' );

			if( !empty( $options['custom_css'] ) ) {
				$fabulous_fluid_custom_css	.=  $options[ 'custom_css'] . "\n";
			}

			if ( '' != $fabulous_fluid_custom_css ){
				echo '<!-- refreshing cache -->' . "\n";

				$fabulous_fluid_custom_css = '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen" rel="ct-custom-css">' . "\n" . $fabulous_fluid_custom_css;

				$fabulous_fluid_custom_css .= '</style>' . "\n";
			}

			set_transient( 'fabulous_fluid_custom_css', $fabulous_fluid_custom_css, 86940 );
		}

		echo $fabulous_fluid_custom_css;
	}
endif; //fabulous_fluid_custom_css
add_action( 'wp_head', 'fabulous_fluid_custom_css', 101  );


if ( ! function_exists( 'fabulous_fluid_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply fabulous-fluid your own fabulous_fluid_content_image(), and that function will be used instead.
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_content_image() {
		if( is_singular() ) {
			global $post, $wp_query;

			// Get Page ID outside Loop
			$page_id = $wp_query->get_queried_object_id();
			if( $post ) {
		 		if ( is_attachment() ) {
					$parent = $post->post_parent;
					$individual_featured_image = get_post_meta( $parent,'fabulous-fluid-featured-image', true );
				} else {
					$individual_featured_image = get_post_meta( $page_id,'fabulous-fluid-featured-image', true );
				}
			}

			if( empty( $individual_featured_image ) ) {
				$individual_featured_image = 'default';
			}

			// Getting data from Theme Options
			$featured_image = apply_filters( 'fabulous_fluid_get_option', 'single_post_image_layout' );

			if ( ( 'disable' == $individual_featured_image  || '' == get_the_post_thumbnail() || ( $individual_featured_image=='default' && 'disable' == $featured_image ) ) ) {
				echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
				return false;
			}
			else {
				$class = '';

				if ( 'default' == $individual_featured_image ) {
					$class = $featured_image;
				}
				else {
					$class = 'from-metabox ' . $individual_featured_image;
				}

				?>
				<figure class="featured-image <?php echo $class; ?>">
	                <?php
					if ( 'featured-image' == $individual_featured_image  || ( $individual_featured_image=='default' && 'featured-image' == $featured_image  ) ) {
						the_post_thumbnail( 'fabulous-fluid-single' );
					}
					else if ( 'slider' == $individual_featured_image  || ( $individual_featured_image=='default' && 'slider-image-size' == $featured_image  ) ) {
						the_post_thumbnail( 'fabulous-fluid-slider' );
					}
					else {
						the_post_thumbnail( 'full' );
					} ?>
		        </figure><!-- .featured-image -->
		   	<?php
			}
		}
		else {
			$featured_image = apply_filters( 'fabulous_fluid_get_option', 'content_layout' );
			$theme_layout 	= apply_filters( 'fabulous_fluid_get_option', 'theme_layout' );


			if ( has_post_thumbnail() && 'full-content' != $featured_image ) {
			?>
				<figure class="featured-image">
	            	<a rel="bookmark" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
			        </a>
		        </figure>
		   	<?php
			}
		}
	}
endif; //fabulous_fluid_content_image
add_action( 'fabulous_fluid_before_entry_container', 'fabulous_fluid_content_image', 10 );


if ( ! function_exists( 'fabulous_fluid_header_social_search' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action fabulous_fluid_after action
	 * @uses set_transient and delete_transient
	 */
	function fabulous_fluid_header_social_search() {
		echo '
		<div id="social-search-inline" style="display:none;">
			<div class="wrapper">';
				get_search_form();
		echo '
			</div><!-- .wrapper -->
		</div><!-- #social-search-inline -->';
	}
}
add_action( 'fabulous_fluid_after', 'fabulous_fluid_header_social_search', 10 );



if ( ! function_exists( 'fabulous_fluid_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action fabulous_fluid_after action
	 * @uses set_transient and delete_transient
	 */
	function fabulous_fluid_scrollup() {
		//fabulous_fluid_flush_transients();
		if ( !$fabulous_fluid_scrollup = get_transient( 'fabulous_fluid_scrollup' ) ) {

			// get the data value from theme options
			echo '<!-- refreshing cache -->';

			$disable_scrollup = apply_filters( 'fabulous_fluid_get_option', 'disable_scrollup' );

			if ( '1' != $disable_scrollup ) {
				$fabulous_fluid_scrollup =  '<a href="#masthead" id="scrollup" class="genericon"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'fabulous-fluid' ) . '</span></a>' ;
			}

			set_transient( 'fabulous_fluid_scrollup', $fabulous_fluid_scrollup, 86940 );
		}
		echo $fabulous_fluid_scrollup;
	}
}
add_action( 'fabulous_fluid_after', 'fabulous_fluid_scrollup', 20 );


if ( ! function_exists( 'fabulous_fluid_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_excerpt_length( $length ) {
		// Getting data from Customizer Options
		$length	= apply_filters( 'fabulous_fluid_get_option', 'excerpt_length' );
		return $length;
	}
endif; //fabulous_fluid_excerpt_length
add_filter( 'excerpt_length', 'fabulous_fluid_excerpt_length', 999 );


if ( ! function_exists( 'fabulous_fluid_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_continue_reading() {
		// Getting data from Customizer Options
		$more_tag_text	= apply_filters( 'fabulous_fluid_get_option', 'excerpt_more_text' );

		return ' <span class="readmore"><a href="'. esc_url( get_permalink() ) . '">' . $more_tag_text . '</a></span>';
	}
endif; //fabulous_fluid_continue_reading
add_filter( 'excerpt_more', 'fabulous_fluid_continue_reading' );


/**
 * Alter the query for the main loop in homepage
 *
 * @action pre_get_posts
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_alter_home( $query ){
	if( $query->is_main_query() && $query->is_home() ) {
		$cats = apply_filters( 'fabulous_fluid_get_option', 'front_page_category' );

	    $quantity = apply_filters( 'fabulous_fluid_get_option', 'featured_slide_number' );

		$post_list	= array();	// list of valid post ids

		for( $i = 1; $i <= $quantity; $i++ ){
			if( apply_filters( 'fabulous_fluid_get_option', 'featured_slider_post_' ) && apply_filters( 'fabulous_fluid_get_option', 'featured_slider_post_' ) > 0 ){
				$post_list	=	array_merge( $post_list, array( apply_filters( 'fabulous_fluid_get_option', 'featured_slider_post_' ) ) );
			}
		}

	    if ( '1' == apply_filters( 'fabulous_fluid_get_option', 'exclude_slider_post' ) && !empty( $post_list ) ) {
			$query->query_vars['post__not_in'] = $post_list;
		}
		if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts','fabulous_fluid_alter_home' );


if ( ! function_exists( 'fabulous_fluid_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses get_theme_mod, get_post_meta
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_get_theme_layout() {
		$id = '';

		// Set $id as Shop Page id for WooCommerce Pages excluding cart and checkout
		if ( class_exists( 'woocommerce' ) && is_woocommerce() ) {
			$id = get_option( 'woocommerce_shop_page_id' );
		}
		else {
		    global $post, $wp_query;

		    // Front page displays in Reading Settings
			$page_on_front  = get_option('page_on_front') ;
			$page_for_posts = get_option('page_for_posts');

			// Get Page ID outside Loop
			$page_id = $wp_query->get_queried_object_id();

			// Blog Page or Front Page setting in Reading Settings
			if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
		        $id = $page_id;
		    }
		    else if ( is_singular() ) {
		 		if ( is_attachment() ) {
					$id = $post->post_parent;
				}
				else {
					$id = $post->ID;
				}
			}
		}

		//Get appropriate metabox value of layout
		if ( '' != $id ) {
			$layout = get_post_meta( $id, 'fabulous-fluid-layout-option', true );
		}
		else {
			$layout = 'default';
		}

		//check empty and load default
		if ( empty( $layout ) || 'default' == $layout ) {
			if ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
				$layout = apply_filters( 'fabulous_fluid_get_option', 'woocommerce_layout' );
			}
			else {
				$layout = apply_filters( 'fabulous_fluid_get_option', 'theme_layout' );
			}
		}

		return $layout;
	}
endif; //fabulous_fluid_get_theme_layout

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @param [string/array] $src Boolean set true to return src
 * @return [string] image html
 *
 * @since Fabulous Fluid 0.1
 */

function fabulous_fluid_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="pngfix wp-post-image" src="'. $first_img .'">';
	}

	return false;
}


/**
 * Migrate Custom CSS to WordPress core Custom CSS
 *
 * Runs if version number saved in theme_mod "custom_css_version" doesn't match current theme version.
 */
function fabulous_fluid_custom_css_migrate(){
	$ver = get_theme_mod( 'custom_css_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}
	
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
	    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
	    
	    /**
		 * Get Theme Options Values
		 */
	    $custom_css = apply_filters( 'fabulous_fluid_get_option', 'custom_css' );

	    if ( '' != $custom_css ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $custom_css );
	        if ( ! is_wp_error( $return ) ) {
	            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
	            remove_theme_mod( 'custom_css' );

	            // Update to match custom_css_version so that script is not executed continously
				set_theme_mod( 'custom_css_version', '4.7' );
	        }
	    }
	}
}
add_action( 'after_setup_theme', 'fabulous_fluid_custom_css_migrate' );