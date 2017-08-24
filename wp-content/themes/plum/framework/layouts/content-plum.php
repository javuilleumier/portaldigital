<?php
/**
 * @package Plum
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 grid grid_2_column plum'); ?>>
	<div class="plum-container">
		<div class="featured-thumb col-md-12">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('plum-pop-thumb'); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
			<?php endif; ?>
		</div><!--.featured-thumb-->
			
		<div class="out-thumb col-md-12">
			<header class="entry-header">
				<div class="postdate title-font">
					<span class="day"><?php echo date_i18n(the_time('d')); ?></span>
					<span class="month"><?php echo date_i18n(the_time('M')); ?></span>
	            </div>
	            
				<h1 class="entry-title body-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->
	</div>				
</article><!-- #post-## -->