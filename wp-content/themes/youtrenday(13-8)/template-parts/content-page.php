<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package You_Tren_Day
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('pb-5'); ?>> 
	
	<?php if( ! bp_current_component()   ){ ?> 
		<header class="entry-header has-text-align-center pt-3 hello">
			<div class="container">
				<?php the_title( '<h1 class="entry-title mb-4">', '</h1>' );  ?>
			</div><!-- .entry-header-inner -->
		</header><!-- .entry-header -->    
	<?php } ?> 
	<?php  if( bp_current_component() ){ ?>
		<?php the_content(); ?>  
	<?php  } else { ?>  
		<div class="post-inner thin">
			<div class="entry-content">
				<div class="container"> 
					<?php  if( !is_bbpress() ){ ?>
						<?php youtrenday_post_thumbnail(); ?>  
					<?php  }  ?>  
					
					<?php the_content(); ?>
				</div>
			</div><!-- .entry-content -->
		</div>
	<?php }  ?> 
	
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<div class="container">
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
			</div>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
		

</article><!-- #post-<?php the_ID(); ?> -->
