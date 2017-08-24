<?php
/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Pixgraphy
 * @since Pixgraphy 1.0
 */
$pixgraphy_settings = pixgraphy_get_theme_options();
if($pixgraphy_settings['pixgraphy_photography_layout'] == 'photography_layout' && !is_page() && !is_single()){
	if( is_404()  || is_search() || is_archive()):
		if($pixgraphy_settings['pixgraphy_photography_layout'] == 'photography_layout'){
			if(class_exists('WooCommerce') && (is_shop() || is_product_category())){ ?>
			</div> <!-- end .container -->
			<?php }else{
				if(is_404()){ ?>
				</div> <!-- end .container -->
				<?php }
				// silence is golden
			}
		}else{?>
		</div> <!-- end .container -->
		<?php }
	else: ?>
	</div> <!-- end #main -->
	<?php
	endif;
}else{?>
</div> <!-- end .container -->
<?php
} ?>
</div> <!-- end #content -->
<!-- Footer Start ============================================= -->
<footer id="colophon" class="site-footer clearfix">
<?php
if(class_exists('Pixgraphy_Plus_Features')){
	do_action('pixgraphy_footer_column');
} ?>
<div class="site-info" <?php if($pixgraphy_settings['pixgraphy-img-upload-footer-image'] !=''){?>style="background-image:url('<?php echo esc_url($pixgraphy_settings['pixgraphy-img-upload-footer-image']); ?>');" <?php } ?>>
	<div class="container">
	<?php if(!empty($pixgraphy_settings['pixgraphy-footer-logo']) || !empty($pixgraphy_settings['pixgraphy-footer-title'])):?>
		<div id="site-branding">
			<?php
			if(!empty($pixgraphy_settings['pixgraphy-footer-title'])): ?>
				<h2 id="site-title">
					<a href="<?php echo esc_url($pixgraphy_settings['pixgraphy-footer-link']);?>" title="<?php echo esc_html($pixgraphy_settings['pixgraphy-footer-title']);?>"><?php echo esc_html($pixgraphy_settings['pixgraphy-footer-title']);?></a>
				</h2>
				<!-- end #site-title -->
			<?php endif; ?>
		</div>
		<!-- end #site-branding -->	
		<?php endif;
		if($pixgraphy_settings['pixgraphy_buttom_social_icons'] == 0):
			do_action('social_links');
		endif;
		if(class_exists('Pixgraphy_Plus_Features')){
			do_action('pixgraphy_footer_menu');
		}	
		do_action('pixgraphy_sitegenerator_footer'); ?>
			<div style="clear:both;"></div>
		</div> <!-- end .container -->
	</div> <!-- end .site-info -->
	<?php
		$disable_scroll = $pixgraphy_settings['pixgraphy_scroll'];
		if($disable_scroll == 0):?>
	<div class="go-to-top"><a title="<?php esc_html_e('Go to Top','pixgraphy');?>" href="#masthead"><i class="fa fa-angle-double-up"></i></a></div> <!-- end .go-to-top -->
	<?php endif; ?>
</footer> <!-- end #colophon -->
</div> <!-- end #page -->
<?php wp_footer(); ?>
</body>
</html>