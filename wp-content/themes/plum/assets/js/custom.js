jQuery(document).ready( function() {
/*
	jQuery('#searchicon').click(function() {
		jQuery('#jumbosearch').fadeIn();
		jQuery('#jumbosearch input').focus();
	});
	jQuery('#jumbosearch .closeicon').click(function() {
		jQuery('#jumbosearch').fadeOut();
	});
	jQuery('body').keydown(function(e){
	    
	    if(e.keyCode == 27){
	        jQuery('#jumbosearch').fadeOut();
	    }
	});
*/
		
	jQuery('#site-navigation ul.menu').slicknav({
		label: 'Menu',
		duration: 1000,
		prependTo:'#slickmenu'
	});	
	
	jQuery('#site-navigation div.menu > ul').slicknav({
		label: 'Menu',
		duration: 1000,
		prependTo:'#slickmenu'
	});	
	
	jQuery('#searchicon').click(function(){
		jQuery('.masthead-container').animate({
			'top': '-110px'
			},300, function() {
				jQuery('#jumbosearch').fadeIn();
			});
	});
	
	jQuery('#jumbosearch .closeicon').click(function() {
		jQuery('#jumbosearch').fadeOut(function(){
			jQuery('.masthead-container').animate({
			'top': '0px'
			},300 );
		});
	});
	
	jQuery('body').keydown(function(e){
	    
	    if(e.keyCode == 27){
	        jQuery('#jumbosearch').fadeOut(function(){
				jQuery('.masthead-container').animate({
				'top': '0px'
				},300 );
			});
	    }
	});
	
	
});


//SLIDER
jQuery(function(){
  var mySlider = jQuery('.slider-container').swiper({
        pagination: '.swiper-pagination',
        paginationClickable: '.swiper-pagination',
        nextButton: '.sliderext',
        prevButton: '.sliderprev',
        spaceBetween: 30,
        autoplay: 2500,
        effect: 'fade'
    });		
});		
	