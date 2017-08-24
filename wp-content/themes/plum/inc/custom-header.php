<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package plum
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses plum_header_style()
 * @uses plum_admin_header_style()
 * @uses plum_admin_header_image()
 */
function plum_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'plum_custom_header_args', array(
		'default-image'          => get_template_directory_uri().'/assets/images/header.jpg',
		'default-text-color'     => '#ffffff',
		'height'				 => 600,
		'width'					 => 1440,
		'flex-height'            => true,
		'wp-head-callback'       => 'plum_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'plum_custom_header_setup' );

if ( ! function_exists( 'plum_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see plum_custom_header_setup().
 */
function plum_header_style() {
	
	if ((is_page() || is_single()) && has_post_thumbnail()) : 
	$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
	?>
	<style>
	#masthead {
			display: block;
			background-image: url(<?php echo $image_data[0] ?>);
			background-size: cover;
			background-position: center center;
			background-repeat: repeat;
		}
	</style>	
	<?php
		else : ?>
	<style>
		#masthead {
			display: block;
			background-image: url(<?php header_image(); ?>);
			background-size: <?php echo get_theme_mod('plum_himg_style','cover'); ?>;
			background-position-x: <?php echo get_theme_mod('plum_himg_align','center'); ?>;
			background-repeat: <?php echo  get_theme_mod('plum_himg_repeat') ? "repeat" : "no-repeat" ?>;
		}
	</style> <?php
		endif;	
		
}
endif; // plum_header_style