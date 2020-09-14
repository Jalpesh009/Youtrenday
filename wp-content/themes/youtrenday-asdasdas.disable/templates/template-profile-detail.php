<?php
/**
 * Template Name: Profile Detail
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header();
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 

$current_user = wp_get_current_user(); 
?>
<main id="site-content" role="main">
    <?php
	if ( have_posts() ) { 
		while ( have_posts() ) { 
			the_post();  ?>
            <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>">
				<div class="post-inner thin"> 
					<div class="user-profile-page">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 user-profile-name my-5">
									<?php if ( $current_user ) {   ?>  
										<div class="col-lg-8 col-md-6">
											<img src="<?php echo get_avatar_url($current_user->ID); ?>" class="rounded-circle">
										</div>
										<div class="col-lg-2 col-md-3">
											<h3> <?php echo $current_user->user_nicename; ?> </h3>
										</div>
									<?php } ?>  
									<div class="col-lg-2 col-md-3">
										<a href="<?php echo site_url('edit-profile'); ?>"> Contact </a>
									</div>
								</div>
							</div>
						</div>
					</div>
				 
					<?php get_posts_shortcode("music"); ?>
						
				</div>
            </article><!-- .post -->
    <?php } 
	}
	?>
</main><!-- #site-content --> 
<?php get_footer(); ?>
