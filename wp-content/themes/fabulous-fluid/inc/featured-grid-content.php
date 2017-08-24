<?php
/**
 * The template for displaying the Featured Content
 *
 * @package Catch Themes
 * @subpackage Fabulous Fluid
 * @since Fabulous Fluid 0.2
 */

if( !function_exists( 'fabulous_fluid_featured_grid_content' ) ) :
/**
* Add Featured content.
*
* @uses action hook fabulous_fluid_before_content.
*
* @since Fabulous Fluid 0.2
*/
function fabulous_fluid_featured_grid_content() {
	//fabulous_fluid_flush_transients();
	global $post, $wp_query;

	// get data value from options
	$enable_content = apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_option' );
	$content_select = apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_type' );

	// Front page displays in Reading Settings
	$page_on_front 	= get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts');


	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content  ) ) {
		if ( ( !$featured_grid_content = get_transient( 'fabulous_fluid_featured_grid_content' ) ) ) {

			echo '<!-- refreshing cache -->';

			$featured_grid_content ='
				<div id="featured-grid-content" class="featured-posts ' . $content_select . '">
					<div class="wrapper">';
						// Select content
						if ( 'demo-content' == $content_select  && function_exists( 'fabulous_fluid_demo_grid_content' ) ) {
							$featured_grid_content .= fabulous_fluid_demo_grid_content();
						}
						elseif ( 'page-content' == $content_select  && function_exists( 'fabulous_fluid_grid_page_content' ) ) {
							$featured_grid_content .= fabulous_fluid_grid_page_content();
						}

			$featured_grid_content .='
					</div><!-- .wrapper -->
				</div><!-- .featured-posts -->

				<span id="loadMore" rel="1"';

			$quantity 	= apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_number' );

			if ( 'demo-content' != $content_select && 4 > $quantity ) {
				$featured_grid_content .=' style="display: none;"';
			}

			$featured_grid_content .='>
					' . esc_html( apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_loadmore' ) ) . '
				</span>';

			set_transient( 'fabulous_fluid_featured_grid_content', $featured_grid_content, 86940 );
		}

		echo $featured_grid_content;
	}
}
endif;
add_action( 'fabulous_fluid_after_header', 'fabulous_fluid_featured_grid_content', 30 );


if ( ! function_exists( 'fabulous_fluid_demo_grid_content' ) ) :
/**
 * This function to display featured posts content
 *
 * @get the data value from customizer options
 *
 * @since Fabulous Fluid 0.2
 *
 */
function fabulous_fluid_demo_grid_content() {
	$output ='
	<div class="row odd">
		<div class="col col-large">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">' . esc_html__( 'Farmers works in field everyday', 'fabulous-fluid' ) . '</a>
						</h2>
						<div class="meta-info">
						<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
						<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
					</div>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend... ', 'fabulous-fluid' ) . ' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) . '</a></span></p>
					</div><!-- .entry-content -->
				</div><!-- .text-holder -->
				<div class="img-holder">
					<img src="' . get_template_directory_uri() . '/' . 'images/grid-img1.jpg" alt="">
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-large -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">' . esc_html__( 'Old Monkey', 'fabulous-fluid' ) . '</a>
						</h2>

						<div class="meta-info">
						<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
						<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
					</div>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit a ', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div><!-- .entry-content -->
				</div><!-- .text-holder -->

				<div class="img-holder">
					<a href="#" class="post-thumbnail">
						<img src="' . get_template_directory_uri() . '/' . 'images/grid-img2.jpg" alt="">
					</a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">' . esc_html__( 'Natural Resources', 'fabulous-fluid' ) .'</a>
						</h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit a', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div><!-- .text-holder -->

				<div class="img-holder">
					<a href="#" class="post-thumbnail"><img src="' . get_template_directory_uri() . '/' . 'images/grid-img3.jpg" alt=""></a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->
	</div><!-- .row -->

	<div class="row even" style="display: none;">
		<div class="col col-large">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">' . esc_html__( 'Breath Taking Mountains', 'fabulous-fluid' ) .'</a>
						</h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) . '</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) . '</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend...', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div><!-- .text-holder -->

				<div class="img-holder">
					<img src="' . get_template_directory_uri() . '/' . 'images/grid-img4.jpg" alt="">
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-large -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">' . esc_html__( 'Fox<br/>Tales', 'fabulous-fluid' ) .'</a>
						</h2>

						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend...', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div><!-- .text-holder -->

				<div class="img-holder">
					<a href="#" class="post-thumbnail"><img src="' . get_template_directory_uri() . '/' . 'images/grid-img5.jpg" alt=""></a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">' . esc_html__( 'Northern Lights', 'fabulous-fluid' ) .'</a>
						</h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend...', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div>
				<div class="img-holder">
					<a href="#" class="post-thumbnail"><img src="' . get_template_directory_uri() . '/' . 'images/grid-img6.jpg" alt=""></a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->
	</div><!-- .row -->

	<div class="row odd" style="display: none;">
		<div class="col col-large">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">' . esc_html__( 'Farmers works in field everyday', 'fabulous-fluid' ) .'</a>
						</h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend... ', 'fabulous-fluid' ) . ' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) . '</a></span></p>
					</div><!-- .entry-content -->
				</div><!-- .text-holder -->

				<div class="img-holder">
					<img src="' . get_template_directory_uri() . '/' . 'images/grid-img7.jpg" alt="">
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-large -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">' . esc_html__( 'Old Monkey', 'fabulous-fluid' ) .'</a></h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend...', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div><!-- .text-holder -->

				<div class="img-holder">
					<a href="#" class="post-thumbnail"><img src="' . get_template_directory_uri() . '/' . 'images/grid-img8.jpg" alt=""></a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">' . esc_html__( 'Natural Resources', 'fabulous-fluid' ) .'</a></h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend...', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div><!-- .text-holder -->

				<div class="img-holder">
					<a href="#" class="post-thumbnail"><img src="' . get_template_directory_uri() . '/' . 'images/grid-img9.jpg" alt=""></a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->
	</div><!-- .row -->

	<div class="row even" style="display: none;">
		<div class="col col-large">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="#">Breath Taking Mountains</a>
						</h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend... ', 'fabulous-fluid' ) . ' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) . '</a></span></p>
					</div><!-- .entry-content -->
				</div><!-- .text-holder -->

				<div class="img-holder">
					<img src="' . get_template_directory_uri() . '/' . 'images/grid-img10.jpg" alt="">
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-large -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">' . esc_html__( 'Fox<br/>Tales', 'fabulous-fluid' ) .'</a></h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend...', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div>

				<div class="img-holder">
					<a href="#" class="post-thumbnail"><img src="' . get_template_directory_uri() . '/' . 'images/grid-img11.jpg" alt=""></a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->

		<div class="col col-small">
			<div class="post">
				<div class="text-holder">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">' . esc_html__( 'Northern Lights', 'fabulous-fluid' ) .'</a></h2>
						<div class="meta-info">
							<span class="category"><a href="#">' . esc_html__( 'Adventure', 'fabulous-fluid' ) .'</a></span>
							<span class="posted-on"><a href="#">' . esc_html__( '9 Oct, 2015', 'fabulous-fluid' ) .'</a></span>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem vitae nisi dignissim eleifend...', 'fabulous-fluid' ) .' <span class="readmore"><a href="#">' . esc_html__( 'Read More', 'fabulous-fluid' ) .'</a></span></p>
					</div>
				</div><!-- .text-holder -->

				<div class="img-holder">
					<a href="#" class="post-thumbnail"><img src="' . get_template_directory_uri() . '/' . 'images/grid-img12.jpg" alt=""></a>
				</div><!-- .img-holder -->
			</div><!-- .post -->
		</div><!-- .col-small -->
	</div><!-- .row -->
	';

	return $output;
}
endif; // fabulous_fluid_demo_grid_content


if ( ! function_exists( 'fabulous_fluid_grid_page_content' ) ) :
/**
 * This function to display featured page content
 *
 * @since Fabulous Fluid 0.2
 */
function fabulous_fluid_grid_page_content( ) {
	global $post;

	$quantity 	= apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_number' );

	$output = '';

   	$number_of_page 			= 0; 		// for number of pages

	$page_list					= array();	// list of valid pages ids

	//Get valid pages
	for( $i = 1; $i <= $quantity; $i++ ){
		if( apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_page_' . $i ) && apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_page_' . $i ) > 0 ) {
			$number_of_page++;

			$page_list	=	array_merge( $page_list, array( apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_page_' . $i ) ) );
		}

	}
	if ( !empty( $page_list ) && $number_of_page > 0 ) {
		$loop = new WP_Query( array(
                    'posts_per_page' 		=> $number_of_page,
                    'post__in'       		=> $page_list,
                    'orderby'        		=> 'post__in',
                    'post_type'				=> 'page',
                ));

		$show_content    = apply_filters( 'fabulous_fluid_get_option', 'featured_grid_content_show' );

		$i = 1;

		$j = 1;
		$output .= '<div class="row odd">';

		while ( $loop->have_posts()) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			$class      = 'col col-small';
			$image_size = 'post-thumbnail';

			if ( 1 == $i%3 ) {
				$class      = 'col col-large';
				$image_size = 'fabulous-fluid-grid-large';
			}

			$output .= '
				<div class="' . $class . '">';

				$output .= '
					<div id="featured-page-' . $i . '" class="post">';

				$output .= '
					<div class="text-holder">
						<header class="entry-header">
							<h2 class="entry-title">
								<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h2>
							<div class="meta-info">
								' .  fabulous_fluid_grid_content_meta() . '
							</div>
						</header><!-- .entry-header -->';

						if ( 'excerpt' == $show_content ) {
							$excerpt = get_the_excerpt();

							$output .= '<div class="entry-content excerpt"><p>' . $excerpt . '</p></div><!-- .entry-content.excerpt -->';
						}
						elseif ( 'full-content' == $show_content ) {
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
						$output .= '
					</div><!-- .text-holder -->

					<div class="img-holder">
						<a href="' . esc_url( get_permalink() ) . '">';
						if ( has_post_thumbnail() ) {
							$output .= get_the_post_thumbnail( $post->ID, $image_size, array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
						}
						else {
							//Default no image
							$image = '<img class="no-image" src="'.get_template_directory_uri().'/images/no-featured-image-420x283.jpg" >';

							if ( 'fabulous-fluid-grid-large' == $image_size ) {
								$image = '<img class="no-image" src="'.get_template_directory_uri().'/images/no-featured-image-840x565.jpg" >';
							}

							// First Image from content
							$first_image = fabulous_fluid_get_first_image( $post->ID, $image_size, array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

							if ( '' != $first_image ) {
								$image = $first_image;
							}

							$output .= $image;
						}

						$output .= '
						</a>
					</div><!-- .img-holder -->
				</div><!-- #featured-post-'. $i .'.post -->';

				$output .= '
				</div><!-- .col-large.col-small -->';

			if ( 0 == $i%3 ) {
				$j++;

				$class = ( 0 == $j%2 ) ? 'even' : 'odd';
				$output .= '
			</div><!-- .row -->

			<div class="row ' . $class .'" style="display: none;">';
			}

			$i++;
		}

		$output .= '</div><!-- .row -->';

		wp_reset_query();
	}

	return $output;
}
endif; // fabulous_fluid_grid_page_content