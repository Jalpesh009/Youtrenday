<?php
/**
 * Template Name: Home Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header(); 
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
?>

<main id="site-content" role="main" class="home-page">
 	<article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>">
		<div class="custom-banner">
			<?php 
				$banner_image = get_field('banner_image'); 
				// echo '<pre>';
				// print_r($banner_image);
				// echo '</pre>';
				if($banner_image){
					echo '<img src="'. $banner_image['url'] .' " class="w-100" >';
				}else{
					echo '<img src="'. get_template_directory_uri().'/assets/images/portrait-of-a-girl.jpg ' .' " class="w-100">';
				}
			?> 
			<div class="landing-section"> 
				<div class="container container_pad" id="top-banner"> 
					<h1 class="landing-sec-title mb-4"><?php bloginfo( 'name' ); ?></h1>
					<div class="social-media"> 
					<?php   
						if( have_rows('footer_options', 'option') ): 
							while ( have_rows('footer_options', 'option') ) : the_row(); 
								if( have_rows('social_options', 'option') ): 
									while ( have_rows('social_options', 'option') ) : the_row();  
										$facebook_url = get_sub_field( 'facebook_url' ); 
										// $imdb_url = get_sub_field( 'imdb_url' ); 
										$youtube_url = get_sub_field( 'youtube_url' ); 
										$instagram_url = get_sub_field( 'instagram_url' ); ?>					
										<ul class="social-menu float-left">
											<?php if( !empty($facebook_url)) { ?> 
												<li class="sprite-facebook pl-0">
													<a class="mk-social-facebook" title="Facebook" href="<?php echo $facebook_url; ?>">
														<i class="fa fa-facebook-official"></i><span>Facebook</span>
													</a>
												</li>      
											<?php } if(!empty($youtube_url)) { ?>              
												<li class="sprite-youtube">
													<a class="mk-social-youtube" title="You Tube" href="<?php echo $youtube_url; ?>">
														<i class="fa fa-youtube-play"></i><span>You Tube</span>
													</a>
												</li>        
											<?php } if( !empty($instagram_url)) { ?>      
												<li class="sprite-instagram">
													<a title="Instagram" href="<?php echo $instagram_url; ?>">
														<i class="fa fa-instagram"></i><span>Instagram</span>
													</a>
												</li>    
											<?php } ?>       
										</ul>         
										<?php  
									endwhile; 
								endif; 
							endwhile; 
						endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="user-design container">
			<h1>User Detail</h1>
			<div class="row">
			<?php
				$users = get_users(array(
					// 'meta_key' => 'last_name',
					// 'orderby' => 'rand',
					'number'  => 6 // limit
				));
				foreach($users as $user){ 
					$id = $user->ID;
					$user_meta = get_user_meta($id); ?>
					<div class="col-xs-12 col-md-3 col-lg-2 user-box">
						<div class="user-box-shadow">
							<img src="<?php echo get_avatar_url($user->ID, ['size' => '51']); ?>">
							<div class="user-detail">
								<h6><?php echo $user->user_nicename; ?></h6>
							</div>
						</div> 
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="blog-design container"> 
			<!-- Latest Blogs Section  -->
			<div class="row">		
				<div class="blog-list col-md-5 col-xs-12">
				<h1>Latest blogs</h1>
					<div class="menu-categories-container">
						<ul>
						<?php
						$terms = get_terms(
							array(
								'taxonomy'   => 'blog_category',
								'hide_empty' => false,
							)
						);  
						if ( ! empty( $terms ) && is_array( $terms ) ) { 
							foreach ( $terms as $term ) { ?>
								<li><a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
									<?php echo $term->name; ?>
								</a></li>
								<?php
							}
						} 
						?>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">		
					<?php 
					$loop = new WP_Query( array( 'post_type' => 'blog', 'posts_per_page' => 3 ));
					if($loop->have_posts()):
						while ( $loop->have_posts() ) : $loop->the_post(); ?> 
							<div class="pindex">
								<div class="ptitle">
								<span class="publish_date"><?php echo get_the_date(); ?></span>
								<h2><?php echo get_the_title(); ?></h2>
								<span><?php $string = strip_tags(get_the_content()); ?>
								<?php the_excerpt(); ?></span>
								</div>   
							</div>  
						<?php endwhile;  
					else:
						echo "No posts found!";
					endif;
					?> 
				</div>
				<?php
				wp_reset_postdata();?>
			</div> 
			<div class="row">
				<div class="col-md-7 offset-md-5">		
					<a href="<?php echo site_url('blogs'); ?>" class="btn btn-default more-blogs for-button-style">More Blogs</a>
				</div>
			</div> 
			<!-- End Latest BLogs Section -->
		</div>
	</article><!-- .post -->
</main><!-- #site-content -->
 

<?php get_footer(); ?>

