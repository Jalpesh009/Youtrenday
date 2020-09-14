<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package You_Tren_Day
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			youtrenday_posted_on();
			youtrenday_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php youtrenday_post_thumbnail(); ?>
	
		<div class="entry-summary">
			<div class="container">		
				<?php the_excerpt(); ?>
			</div>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<div class="container">		
				<?php youtrenday_entry_footer(); ?>
			</div>
		</footer><!-- .entry-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->
