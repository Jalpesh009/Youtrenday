<?php
/**
 * Template Name: Landing
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */ 
 
get_header(); 
if ( is_user_logged_in()) {
    wp_redirect( site_url('/home') );
    exit;
}
?>
<main id="site-content" role="main">
    <?php
	if ( have_posts() ) { 
		while ( have_posts() ) {  the_post(); ?>
            <article <?php post_class('landing-logout'); ?> id="post-<?php the_ID(); ?>">  
                <div class="container">
                    <div class="row ">

                        <div class="col-xs-12 col-md-6 col-lg-3 ">
                            <div class="landing-text">

                                <h4><?php the_field('landing_banner_text'); ?></h4>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-3 p-0">
                            <div class="landing-image">
                            <?php $b_image = get_field('landing_banner_image'); ?>
                            <img src="<?php echo $b_image['url']; ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6 mt-3">
                            <div class="login-form-landingpage">
                                <div class="px-5"> 
                                    <?php custom_wpshow_error_messages(); ?>
                                    <form id="wp_login_form" action="" method="post"> 
                                        <label class="my-username">Email</label> 
                                        <input type="text" name="email" class="text mb-2" value=""> 

                                        <label class="my-password">Password</label>  
                                        <input type="password" name="password" class="text mb-2" value="">  

                                        <label><span class="hey">Remember me</span></label> 
                                        <input class="myremember mb-3" name="rememberme" type="checkbox" value="forever">  
                                        
                                        <input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/>
                                        <div class="login-submit mt-1"><input type="submit" id="submitbtn" class="for-button-style" name="submit" value="Login"></div> 
                                    </form>
                                    
                                        <!-- social media login button code  -->
                                    <div class="entry-content">
                                        <div class="rounded bg-white"> 
                                            <h5 class="text-center mt-2">Or connect with</h5>
                                            <div class="upper-social text-center" >
                                                <div class="social-coonecting "><?php // echo do_shortcode('[miniorange_social_login]');?>
                                                </div> 
                                                <div class="social-coonecting "><?php echo do_shortcode('[nextend_social_login]');?>
                                                </div>
                                            </div>
                                            <p class="no-account mb-0">Don't have an Account<a href="<?php echo site_url('register'); ?>">Sign Up</a></p> 
                                            <p class="no-account mb-0"><a href="<?php echo site_url('wp-login.php?action=lostpassword'); ?>">Forgot password?</a></p>
                                        </div> 
                                    </div> 
                                
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>

            </article><!-- .post -->
    <?php } 
	}
	?>
</main><!-- #site-content --> 
<?php get_footer(); ?>
