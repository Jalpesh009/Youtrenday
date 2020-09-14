<?php
/**
 * Template Name: Contact Us
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header(); ?>
<main id="site-content" role="main">
	<?php
	if ( have_posts() ) {
		$i = 0;
		while ( have_posts() ) { 
			the_post(); 
			$banner_image = get_field('banner_image'); 
			$bg_image = '';
			if($banner_image){
				$bg_image =  $banner_image['url'];
			} ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('pb-5'); ?> style="background-image: url('<?php echo $bg_image; ?>');"> 
				<header class="entry-header has-text-align-center pt-3">
					<div class="container">
						<?php the_title( '<h1 class="entry-title mb-4">', '</h1>' ); ?>
					</div><!-- .entry-header-inner -->
				</header><!-- .entry-header --> 
				<div class="post-inner thin">
					<div class="entry-content">
						<div class="w-70 rounded bg-white">
							<div class="form_cls py-lg-3 px-lg-5 mx-lg-5 ">
								<?php
								the_content(); 
							
								?>
							</div>
						</div>
					</div><!-- .entry-content -->
				</div><!-- .post-inner -->
				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'youtrenday' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php 
		} 
	}
	?> 
</main><!-- #site-content --> 
<?php get_footer(); ?>