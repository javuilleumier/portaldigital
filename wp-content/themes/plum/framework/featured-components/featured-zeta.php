<?php if ( get_theme_mod('plum_zeta_enable') && is_front_page() ) : ?>
<div id="zeta">
	<div class="container zeta">
		<div class="section-title title-font">
			<?php echo esc_html( get_theme_mod('plum_zeta_title',__('Trending','plum')) ) ?>
		</div>
		
	    <div class="featured-grid-container">
	        <div class="fg-wrapper">
	            <?php
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 3, 
			        	'cat'  => esc_html( get_theme_mod('plum_zeta_cat',0) ),
			        	'ignore_sticky_posts' => 1,
			        	);
				        $loop = new WP_Query( $args );
				        while ( $loop->have_posts() ) : 
				        
				        	$loop->the_post(); 
				        	
				        	if ( has_post_thumbnail() ) :
				        		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'plum-pop-thumb' ); 
								$image_url = $image_data[0]; 
							else:
							
								$image_url = get_template_directory_uri()."/assets/images/placeholder2.jpg";	
							endif;		
				        	
				        ?>
						<div class="fg-item-container col-md-4 col-sm-4 col-xs-12">
							<div class="fg-item">
								<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
									<img src="<?php echo $image_url; ?>">
									<div class="post-details">
										<h3><?php the_title(); ?></h3>
									</div>
								</a>
								</div>
						</div>					
						 <?php endwhile; ?>
						 <?php wp_reset_query(); ?>	
						
		        </div>	        
	    </div>
	</div>	    
</div>	
<?php endif; ?>
