<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function plum_custom_css_mods() {
	
	$custom_css = "";
	
	if ( get_theme_mod('plum_title_font') ) :
		$custom_css .= ".title-font, h1, h2, .section-title, .woocommerce ul.products li.product h3 { font-family: ".esc_html( get_theme_mod('plum_title_font','Droid Serif') )."; }";
	endif;
	
	if ( get_theme_mod('plum_body_font') ) :
		$custom_css .= "body, h2.site-description { font-family: ".esc_html( get_theme_mod('plum_body_font','Ubuntu') )."; }";
	endif;
	
	if ( get_header_textcolor() ) :
		$custom_css .= "#masthead .masthead-inner .site-branding .site-title a { color: #".get_header_textcolor()."; }";
	endif;
	
	
	if ( get_theme_mod('plum_header_desccolor','#FFFFFF') ) :
		$custom_css .= "#masthead .masthead-inner .site-branding .site-description { color: ".esc_html( get_theme_mod('plum_header_desccolor','#FFFFFF') )."; }";
	endif;
	//Check Jetpack is active
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) )
		$custom_css .= '.pagination { display: none; }';
	
	
	if ( !display_header_text() ) :
		$custom_css .= "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if  ( get_theme_mod('plum_header_image_style','default') == 'full-image' && ( is_home() || (is_page() && has_post_thumbnail()))) : 
		$custom_css .= "@media screen and (max-width: 767px) {
			#masthead #mobile-header-image { display: block; }
			#masthead {
			min-height: auto;
			padding-bottom: 90px;
			background-image: none !important; 
			
			}
		}";
		
	endif;
	
	if (strlen(get_bloginfo( 'name' )) > 25) :
		$custom_css .= "@media screen and (min-width: 768px) { #masthead .masthead-inner .site-branding .site-title { font-size: 18px; } }"; 
	endif;
	
	
	if ( get_theme_mod('plum_logo_resize') ) :
		$val = esc_html( get_theme_mod('plum_logo_resize') )/100;
		$custom_css .= "#masthead .custom-logo { transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
	endif;

	wp_add_inline_style( 'plum-main-theme-style', wp_strip_all_tags($custom_css) );
	
}

add_action('wp_enqueue_scripts', 'plum_custom_css_mods');