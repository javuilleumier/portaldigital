<?php
/**
 * @package plum
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">		
		<div class="entry-meta">
			<?php plum_posted_on_plum(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
			
			
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'plum' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php plum_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
	<?php plum_post_nav(); ?>
</article><!-- #post-## -->
