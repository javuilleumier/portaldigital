<div class="masthead-inner">
				<div class="site-branding col-md-6 col-sm-6 col-xs-12">
					<?php if ( plum_has_logo() ) : ?>
					<div id="site-logo">
						<?php plum_logo(); ?>
					</div>
					<div id="text-title-desc">
					<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div>
					<?php else : ?>
					
					<div id="text-title-desc">
					<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div>
					<?php endif; ?>
				</div>
				
				<div class="social-icons col-md-6 col-sm-6 col-xs-12">
					<?php get_template_part('modules/social/social', 'fa'); ?>	 
				</div>
				
			</div>