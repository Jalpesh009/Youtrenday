<?php
/**
 * Template Name: Blog Template
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>
<main id="site-content" role="main">
	<article <?php post_class('pb-4'); ?> id="post-<?php the_ID(); ?>">
		<header class="entry-header has-text-align-center pt-3">
			<div class="container">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div><!-- .entry-header-inner -->
		</header><!-- .entry-header -->
		<div class="entry-content">
			<div class="container mb-0">  
				<?php  
				$loop = new WP_Query( 
					array( 
						'post_type' => 'blog', 
						'posts_per_page' => 6, 
						'paged' => get_query_var('paged') ? get_query_var('paged') : 1   
						) 
					); 
				$i = 0; ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
				<div class="pindex row <?php if($i % 2 == 0){ echo "blog-page"; } ?>">
					<?php if($i % 2 == 0){ ?>
						<div class="pimage col-lg-6 col-xs-12 p-lg-0">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?></a>
							<?php }else{  
								$featured_video = get_post_meta(get_the_ID() , 'featured_video_uploading', true); 
								if( $video = wp_get_attachment_url($featured_video)) {  
									echo '<div class="embed-responsive embed-responsive-16by9"><video class="sfv_videos embed-responsive-item" id="sfv_video_'. get_the_ID() .'" controls="" src="'.$video.'" style="max-width:100%;display:block;"></video></div>';
								}
							} ?> 
						</div>
						<div class="ptitle col-lg-6 col-xs-12">
							<div class="date"><?php echo get_the_date(); ?></div>
							<h2><?php echo get_the_title(); ?></h2>
							<span><?php $string = strip_tags(get_the_content()); ?>
								<?php 
								
								if(strlen($string) > 80)
								{
									$stringCut = substr($string, 0, 300);
									//$link = get_the_permalink();
									$stringCut .= '... <a href="'.get_the_permalink().'">Read More</a>';
								} else {
									$stringCut = $string;
								}
								echo $stringCut;
							?></span>
						</div>
					<?php } else{ ?>
						<div class="ptitle col-lg-6 col-xs-12">
							<div class="date"><?php echo get_the_date(); ?></div>
							<h2><?php echo get_the_title(); ?></h2>
							<span><?php $string = strip_tags(get_the_content()); ?>
								<?php 
								
								if(strlen($string) > 80)
								{
									$stringCut = substr($string, 0, 300);
									//$link = get_the_permalink();
									$stringCut .= '... <a href="'.get_the_permalink().'">Read More</a>';
								} else {
									$stringCut = $string;
								}
								echo $stringCut;
							?></span>
						</div>
						<div class="pimage col-lg-6 col-xs-12 p-lg-0">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?></a>
							<?php }else{  
								$featured_video = get_post_meta(get_the_ID() , 'featured_video_uploading', true); 
								if( $video = wp_get_attachment_url($featured_video)) {  
									echo '<div class="embed-responsive embed-responsive-16by9"><video class="sfv_videos embed-responsive-item" id="sfv_video_'. get_the_ID() .'" controls="" src="'.$video.'" style="max-width:100%;display:block;"></video></div>'; 
								}
							} ?> 
						</div>
					<?php } ?> 
				</div> 
				<?php wp_reset_postdata(); 
					$i++;
					endwhile; ?>
				<div class="pagination">
					<?php
					$big = 999999999; // need an unlikely integer
						echo paginate_links( array(
						'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $loop->max_num_pages
					) );

					wp_reset_postdata();
				?>
				</div>
			</div>
		</div>
	</article><!-- .post -->
</main> 

<?php get_footer(); ?>