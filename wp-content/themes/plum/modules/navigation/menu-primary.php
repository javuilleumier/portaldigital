<div id="slickmenu"></div>
<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class="container">
		<?php 
		if (has_nav_menu(  'primary' ) && !get_theme_mod('plum_disable_nav_desc', true) ) :
			$walker = new Plum_Menu_With_Description; 
		elseif( !has_nav_menu(  'primary' ) ):
			$walker = '';
		else :
			$walker = new Plum_Menu_With_Icon;
		endif;
			wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) );  ?>
	</div>
</nav><!-- #site-navigation -->