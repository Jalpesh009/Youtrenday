<?php 
/** 
* Template Name: Sign In
*/ 
get_header();  
// if($_POST) { 

// 	global $wpdb;  
// 	//We shall SQL escape all inputs 
// 	$username = $wpdb->escape($_REQUEST['username']); 
// 	$password = $wpdb->escape($_REQUEST['password']); 
// 	$remember = $wpdb->escape($_REQUEST['rememberme']); 

// 	if($remember) 
// 		$remember = "true"; 
// 	else $remember = "false"; 

// 		$login_data = array(); 
// 		$login_data['user_login'] = $username; 
// 		$login_data['user_password'] = $password; 
// 		$login_data['remember'] = $remember; 

// 		$user_verify = wp_signon( $login_data, false ); 

// 	if ( is_wp_error($user_verify) ) { 
// 		echo '<span class="mine">Invlaid Login Details</span>'; 
// 	} else { 
// 		echo "<script type='text/javascript'>window.location.href='". home_url('/home-loggedin/') ."'</script>"; 
// 		exit(); 
// 	}  
// } 

?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) { 
        while (have_posts()) { 
			the_post();  
			$banner_image = get_field('banner_image'); 
			$bg_image = '';
			if($banner_image){
				$bg_image =  $banner_image['url'];
			} 
			?>  
			<article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>" style="background-image: url('<?php echo $bg_image; ?>');">  
				<header class="entry-header has-text-align-center pt-3">
					<div class="container">
						<?php the_title( '<h1 class="entry-title mb-4">', '</h1>' ); ?>
					</div><!-- .entry-header-inner -->
				</header><!-- .entry-header -->
				<div class="entry-content">
					<div class="w-50 rounded bg-white"> 
						<div class="custom-login py-lg-3 px-lg-5 mx-lg-5 "> 
							<?php custom_wpshow_error_messages(); ?>
							<form id="wp_login_form" action="" method="post"> 
								<label class="my-username" >Username</label> 
								<input type="text" name="username" class="text mb-3" value=""> 
								<label class="my-password" >Password</label> 
								<input type="password" name="password" class="text mb-3" value=""> 
								<label><span class="hey">Remember me</span></label> 
								<input class="myremember mb-3" name="rememberme" type="checkbox" value="forever"> 
								<input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/> 
								<div class="login-submit mt-2">
									<input type="submit" class="for-button-style" id="submitbtn" name="submit" value="Login">
								</div>

							</form>
							
						</div> 
					</div> 
				</div> 
				<h4 class="text-center mb-4">OR</h4>
				<div class="entry-content">
					<div class="w-50 rounded bg-white"> 
						<div class="upper-social text-center" >
							<div class="social-coonecting pt-3"><?php echo do_shortcode('[miniorange_social_login]');?>
							</div>
						</div>
					</div> 
				</div> 
			</article><!-- .post -->
    <?php }
    } ?>
</main><!-- #site-content -->
<?php get_footer(); ?>

