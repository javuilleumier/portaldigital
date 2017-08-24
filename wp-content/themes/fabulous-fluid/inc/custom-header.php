<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Fabulous Fluid
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses fabulous_fluid_header_style()
 */
function fabulous_fluid_custom_header_setup() {

	$header_text_color = fabulous_fluid_get_default_theme_options( 'header_textcolor' );

	add_theme_support( 'custom-header', apply_filters( 'fabulous_fluid_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => $header_text_color,
		'height'                 => 720,
		'width'                  => 1680,
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'fabulous_fluid_custom_header_setup' );


if ( ! function_exists( 'fabulous_fluid_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own fabulous_fluid_featured_image(), and that function will be used instead.
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_featured_image() {
		$header_image 			= get_header_image();

		$options['featured_header_image_url'] = apply_filters( 'fabulous_fluid_get_option', 'featured_header_image_url' );

		$options['featured_header_image_base'] = apply_filters( 'fabulous_fluid_get_option', 'featured_header_image_base' );

		$options['featured_header_image_alt'] = apply_filters( 'fabulous_fluid_get_option', 'featured_header_image_alt' );

		$options['featured_header_image_url'] = apply_filters( 'fabulous_fluid_get_option', 'featured_header_image_url' );

		//Support Random Header Image
		if ( is_random_header_image() ) {
			delete_transient( 'fabulous_fluid_featured_image' );
		}

		if ( !$fabulous_fluid_featured_image = get_transient( 'fabulous_fluid_featured_image' ) ) {

			echo '<!-- refreshing cache -->';

			if ( '' != $header_image  ) {

				// Header Image Link and Target
				if ( !empty( $options['featured_header_image_url'] ) ) {
					//support for qtranslate custom link
					if ( function_exists( 'qtrans_convertURL' ) ) {
						$link = qtrans_convertURL( $options['featured_header_image_url'] );
					}
					else {
						$link = esc_url( $options['featured_header_image_url'] );
					}
					//Checking Link Target
					if ( !empty( $options['featured_header_image_base'] ) )  {
						$target = '_blank';
					}
					else {
						$target = '_self';
					}
				}
				else {
					$link = '';
					$target = '';
				}

				// Header Image Title/Alt
				if ( !empty( $options['featured_header_image_alt'] ) ) {
					$title = esc_attr( $options['featured_header_image_alt'] );
				}
				else {
					$title = '';
				}

				// Header Image
				$feat_image = '<img class="wp-post-image" alt="' . esc_attr( $title ) . '" src="'.esc_url(  $header_image ).'" />';

				$fabulous_fluid_featured_image = '<div id="header-featured-image" class="site-header-image">
					<div class="wrapper">';
					// Header Image Link
					if ( !empty( $options['featured_header_image_url'] ) ) :
						$fabulous_fluid_featured_image .= '<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'" target="' . $target . '">' . $feat_image . '</a>';
					else:
						// if empty featured_header_image on theme options, display default
						$fabulous_fluid_featured_image .= $feat_image;
					endif;
				$fabulous_fluid_featured_image .= '</div><!-- .wrapper -->
				</div><!-- #header-featured-image -->';
			}

			set_transient( 'fabulous_fluid_featured_image', $fabulous_fluid_featured_image, 86940 );
		}

		echo $fabulous_fluid_featured_image;

	} // fabulous_fluid_featured_image
endif;


if ( ! function_exists( 'fabulous_fluid_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own fabulous_fluid_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_featured_page_post_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		$page_for_posts = get_option('page_for_posts');

		if ( is_home() && $page_for_posts == $page_id ) {
			$header_page_id = $page_id;
		}
		else {
			$header_page_id = $post->ID;
		}

		if( has_post_thumbnail( $header_page_id ) ) {

			$featured_header_image_url	= apply_filters( 'fabulous_fluid_get_option', 'featured_header_image_url' );

			$featured_header_image_base	= apply_filters( 'fabulous_fluid_get_option', 'featured_header_image_base' );

			if ( '' != $featured_header_image_url ) {
				//support for qtranslate custom link
				if ( function_exists( 'qtrans_convertURL' ) ) {
					$link = qtrans_convertURL( $featured_header_image_url );
				}
				else {
					$link = esc_url( $featured_header_image_url );
				}
				//Checking Link Target
				if ( '1' == $featured_header_image_base ) {
					$target = '_blank';
				}
				else {
					$target = '_self';
				}
			}
			else {
				$link = '';
				$target = '';
			}

			$featured_header_image_alt	= apply_filters( 'fabulous_fluid_get_option', 'featured_header_image_alt' );

			// Header Image Title/Alt
			if ( '' != $featured_header_image_alt ) {
				$title = esc_attr( $featured_header_image_alt );
			}
			else {
				$title = '';
			}

			$featured_image_size	= apply_filters( 'fabulous_fluid_get_option', 'featured_image_size' );


			if ( 'slider' ==  $featured_image_size ) {
				$feat_image = get_the_post_thumbnail( $header_page_id, 'fabulous-fluid-slider', array('id' => 'main-feat-img'));
			}
			else if ( 'full' ==  $featured_image_size ) {
				$feat_image = get_the_post_thumbnail( $header_page_id, 'full', array('id' => 'main-feat-img'));
			}
			else {
				$feat_image = get_the_post_thumbnail( $header_page_id, null, array('id' => 'main-feat-img'));
			}

			$fabulous_fluid_featured_image = '<div id="header-featured-image" class =' . $featured_image_size . '>';
				// Header Image Link
				if ( '' != $featured_header_image_url ) :
					$fabulous_fluid_featured_image .= '<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'" target="' . $target . '">' . $feat_image . '</a>';
				else:
					// if empty featured_header_image on theme options, display default
					$fabulous_fluid_featured_image .= $feat_image;
				endif;
			$fabulous_fluid_featured_image .= '</div><!-- #header-featured-image -->';

			echo $fabulous_fluid_featured_image;
		}
		else {
			fabulous_fluid_featured_image();
		}
	} // fabulous_fluid_featured_page_post_image
endif;


if ( ! function_exists( 'fabulous_fluid_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own fabulous_fluid_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_featured_overall_image() {
		global $post, $wp_query;

		$enableheaderimage= apply_filters( 'fabulous_fluid_get_option', 'enable_featured_header_image' );

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		$page_for_posts = get_option( 'page_for_posts' );

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_page() || is_single() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'fabulous-fluid-header-image', true );

			if ( 'disable' == $individual_featured_image  || ( 'default' == $individual_featured_image  && 'disable' == $enableheaderimage  ) ) {
				echo '<!-- Page/Post Disable Header Image -->';
				return;
			}
			elseif ( 'enable' == $individual_featured_image  && 'disabled' == $enableheaderimage  ) {
				fabulous_fluid_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' == $enableheaderimage  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				fabulous_fluid_featured_image();
			}
		}
		// Check Excluding Homepage
		if ( 'exclude-home' == $enableheaderimage  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			}
			else {
				fabulous_fluid_featured_image();
			}
		}
		elseif ( 'exclude-home-page-post' == $enableheaderimage  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			}
			elseif ( is_page() || is_single() ) {
				fabulous_fluid_featured_page_post_image();
			}
			else {
				fabulous_fluid_featured_image();
			}
		}
		// Check Entire Site
		elseif ( 'entire-site' == $enableheaderimage  ) {
			fabulous_fluid_featured_image();
		}
		// Check Entire Site (Post/Page)
		elseif ( 'entire-site-page-post' == $enableheaderimage  ) {
			if ( is_page() || is_single() || ( is_home() && $page_for_posts == $page_id ) ) {
				fabulous_fluid_featured_page_post_image();
			}
			else {
				fabulous_fluid_featured_image();
			}
		}
		// Check Page/Post
		elseif ( 'pages-posts' == $enableheaderimage  ) {
			if ( is_page() || is_single() ) {
				fabulous_fluid_featured_page_post_image();
			}
		}
		else {
			echo '<!-- Disable Header Image -->';
		}
	} // fabulous_fluid_featured_overall_image
endif;


if ( ! function_exists( 'fabulous_fluid_featured_image_display' ) ) :
	/**
	 * Display Featured Header Image
	 *
	 * @since Fabulous Fluid 0.2
	 */
	function fabulous_fluid_featured_image_display() {
		fabulous_fluid_featured_overall_image();
	} // fabulous_fluid_featured_image_display
endif;
add_action( 'fabulous_fluid_after_header', 'fabulous_fluid_featured_image_display', 10 );