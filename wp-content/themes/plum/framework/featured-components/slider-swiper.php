<?php
/* The Template to Render the Slider
* works only if user has RT slider plugin activated.
*
*/

//Define all Variables.
$count = esc_html( rt_slider::fetch('count') );
?>
<div id="slider-bg">
	<div class="container slider-container-wrapper">
		<div class="slider-container theme-default">
	            <div class="swiper-wrapper">
	            <?php
	            for ( $i = 1; $i <= $count; $i++ ) :

					$url = esc_url( rt_slider::fetch('url', $i ) );
					$img = esc_url( rt_slider::fetch('img', $i ) );
					$title = esc_html( rt_slider::fetch('title', $i ) );
					$desc = esc_html( rt_slider::fetch('desc', $i) );
					$button = esc_html( rt_slider::fetch('cta_button', $i) );
					 
					
					?>
					<div class="swiper-slide">
		            	<a href="<?php echo $url; ?>">
		            		<img src="<?php echo $img ?>" data-thumb="<?php echo $img ?>" title="<?php echo $title." - ".$desc ?>" />
		            	</a>
		            	<div class="slidecaption">
			                
			                <?php if ($title) : ?>
				                <div class="slide-title"><?php echo $title ?></div>
				                <div class="slide-desc"><span><?php echo $desc ?></span></div>
				            <?php endif; ?> 
				            <?php if ($button) : ?>
				                <div class="slide-cta"><span><?php echo $button ?></span></div>
				               <?php endif; ?>
						</div>
		            </div>
	             <?php endfor; ?>
	               
	            </div>
	            <div class="swiper-pagination swiper-pagination-white"></div>

				<div class="swiper-button-next slidernext swiper-button-white"></div>
				<div class="swiper-button-prev sliderprev swiper-button-white"></div>
	        </div>
	</div> 
</div>   