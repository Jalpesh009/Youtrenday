<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package You_Tren_Day
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!-- <meta property="fb:admins" content="648419509334073"> -->
	<meta property="fb:app_id" content="648419509334073" />
	<!-- <meta property="og:locale" content="en_US"> -->
	<meta property="og:type" content="article"/>
	<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
	<?php if(is_page('home')){ ?>
		<meta name="og:url" />  
		<meta name="og:title" />
		<meta name="og:description" />
		<meta name="og:image" />
		<meta name="title" />
		<meta name="description" />
		<meta name="twitter:card" content="summary_large_image"> 
		<meta name="twitter:title" >
		<meta name="twitter:description"  > 
		<meta name="twitter:image" > 
	<?php } else { 

		$musicMedia_from = get_post_meta(get_the_ID(), 'musicMedia_from', true);  
		$musicMedia_url = get_post_meta(get_the_ID(), 'musicMedia_url', true);  
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);
		$youtube_id = '';
		if($match){
		    $youtube_id = $match[1]; 
		}
		// $thumb  = 'https://i.ytimg.com/vi/'. $youtube_id .'/maxresdefault.jpg';  
		$thumb = '';
        $youtube_id = '';
		if($match){
		    $youtube_id = $match[1]; 
		}
		if( $musicMedia_from == 'youtube' || $musicMedia_from == 'comp_from_yoututbe' ){ 
			// $thumb  = 'https://i.ytimg.com/vi/'. $youtube_id .'/maxresdefault.jpg'; 
			$thumb  = 'https://img.youtube.com/vi/'. $youtube_id .'/hqdefault.jpg';  
		} elseif( $musicMedia_from == 'soundcloud' || $musicMedia_from == 'comp_from_soundcloud' ){ 
			$thumb =   get_template_directory_uri(). '/assets/images/logo_soundcloud.png';
		} elseif( $musicMedia_from == 'spotify' ||  $musicMedia_from == 'comp_spotify' ){ 
			$thumb =   get_template_directory_uri(). '/assets/images/logo-spotify.png';
		} 
		if(get_post_type( get_the_ID() ) == 'competition'){

			$thumb  = get_the_post_thumbnail_url(get_the_ID() ,'full'); ;
	
		} ?>
		<meta name="og:image" content="<?php echo $thumb; ?>" />
		<meta name="og:url" content="<?php the_permalink(); ?>" />  
		<meta name="og:title" content="<?php the_title(); ?>" />
		<meta name="og:description" content="<?php echo strip_tags(get_the_excerpt(get_the_ID())); ?>" />
		<meta name="twitter:card" content="summary_large_image" /> 
		<meta name="twitter:title" content="<?php the_title(); ?>" />
		<meta name="twitter:description" content="<?php echo strip_tags(get_the_excerpt(get_the_ID())); ?>" /> 
		<meta name="twitter:image" content="<?php echo $thumb; ?>" /> 
	<?php } ?>
	

	<!-- Twitter Card data -->
	
	<?php wp_head(); ?>
</head>

<?php
$body_class = '';
if(is_user_logged_in()){
	$body_class = 'body_loggedin';
}else{
	$body_class = 'body_loggedout';
}  ?>
<body <?php body_class($body_class ); ?>>
 
<?php //echo  get_the_content( ); ?>
<div id="page" class="site"> 
	<header id="masthead" class="site-header header">
		<?php if(is_user_logged_in() && !is_page('landing-page') ){ ?>
			<div class="container loggedin-header"> 
				<div class="header-logo"> 
					<?php  // Logo 1 
					if( have_rows('header_options', 'option') ): 
						while ( have_rows('header_options', 'option') ) : the_row();   
							$header_logo = get_sub_field('header_logo', 'option'); ?>
							<a class="header-logo-link d-table mx-auto" href="<?php echo site_url(); ?>">
								<img width="230" height="118" src="<?php echo $header_logo['url']; ?>" class="loggedin-header-logo d-block mx-auto">
							</a>    
							<?php  
						endwhile; 
					endif; ?> 
				</div>
			</div> 
			<nav class="navbar-expand-lg navbar-dark bg-light static-top">   
				<?php $current_user = wp_get_current_user(); ?> 
				<div class="container"> 
					<div class="row header-with-profile">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 justify-content-end profile_section">
							<?php if(is_user_logged_in() ){ 
								$current_user = wp_get_current_user(); ?>  
								<div class="side-menu">
									
									<svg class="clip-svg">
										<defs>
											<clipPath id="polygon-clip-hexagon" clipPathUnits="objectBoundingBox">
											<polygon points="0.5 0, 1 0.25, 1 0.75, 0.5 1, 0 0.75, 0 0.25" />
											</clipPath>
										</defs>
									</svg> 
									<a href="javascript:void(0);" onclick="openNav()">
										<img src="<?php echo get_avatar_url($current_user->ID); ?>" alt="demo-clip-heptagon" class="polygon-clip-hexagon d-block mx-lg-0  mx-sm-auto my-2" width="50" height="50">
									</a>
									<!-- <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>  -->
								</div>
							<?php } ?>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 navbar menu_section d-block text-right">
							<button id="ChangeToggle" class="navbar-toggler collapsed mx-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
								<div class="open-icon"> 
									<i class="fa fa-align-justify text-danger" aria-hidden="true"></i>
								</div>  
								<div class="close-icon"> 
									<i class="fa fa-times text-danger" aria-hidden="true"></i> 
								</div>
							</button>
							<?php 
							// Desktop menu
							wp_nav_menu(
								array(
								'container' => 'div' ,
								'container_class'   => 'collapse navbar-collapse desktop_menu',
								'container_id'      => 'navbarResponsive',
								'items_wrap' => '<ul class="navbar-nav header_menu ">%3$s</ul>',
								'menu_class' => 'nav-item ',
								'menu_id' => 'mymenu',
								'theme_location' => 'header_loggedin' 
								)
							); ?>
									
							
						</div> 
						<?php 
						// MObile menu
						wp_nav_menu(
							array(
							'container' => 'div' ,
							'container_class'   => 'collapse navbar-collapse mobile_menu mx-3 px-4',
							'container_id'      => 'navbarResponsive',
							'items_wrap' => '<ul class="navbar-nav header_menu ">%3$s</ul>',
							'menu_class' => 'nav-item ',
							'menu_id' => 'mymenu',
							'theme_location' => 'header_loggedin' 
							)
						); ?> 
					</div>  
				</div>   
			</nav>   
		<?php }else if(is_page('landing-page') || is_front_page()){ ?>
			<div class="container landing-header"> 
				<div class="footer-logo">
					<div class="row">
						<div class="col-md-12 text-center">
							<?php  // Logo 1 
							if( have_rows('header_options', 'option') ): 
								while ( have_rows('header_options', 'option') ) : the_row();  
									$header_circle_logo = get_sub_field('header_circle_logo', 'option');
									$header_logo = get_sub_field('header_logo', 'option'); ?>
									<a class="d-inline" href="<?php echo site_url(); ?>"> 
										<img width="90" height="90" src="<?php echo $header_circle_logo['url']; ?>" class="custom-logo d-inline ">	
									</a>
									<?php // Logo 2 ?> 
									<a class="header-logo-link d-inline" href="<?php echo site_url(); ?>"> 
										<img width="230" height="102" src="<?php echo $header_logo['url']; ?>" class="loggedin-header-logo d-inline">	
									</a> 	 
									<?php  
								endwhile; 
							endif; ?> 
						</div>
					</div> 
				</div>
			</div>   
		<?php }else { ?>
			<nav class="navbar navbar-expand-lg navbar-dark bg-light static-top loggedout-header py-0">   
				<div class="container"> 
				
					<?php  // Logo 1 
					if( have_rows('header_options', 'option') ): 
						while ( have_rows('header_options', 'option') ) : the_row();   
							$header_circle_logo = get_sub_field('header_circle_logo', 'option'); ?>
							<a class="navbar-brand p-0" href="<?php echo site_url(); ?>">
								<img width="90" height="90" src="<?php echo $header_circle_logo['url']; ?>" class="custom-logo">
							</a>    
							<?php  
						endwhile; 
					endif; ?> 
					<button id="ChangeToggle" class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> 
						<div class="open-icon"> 
							<i class="fa fa-align-justify text-danger" aria-hidden="true"></i>
						</div>  
						<div class="close-icon"> 
							<i class="fa fa-times text-danger" aria-hidden="true"></i> 
						</div>
					</button> 
					<?php 
					wp_nav_menu(
						array(
						'container' => 'div' ,
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'navbarResponsive',
						'items_wrap' => '<ul class="navbar-nav ml-auto header_menu mobile_menu">%3$s</ul>',
						'menu_class' => 'nav-item ',
						'menu_id' => 'mymenu',
						'theme_location' => 'header_loggedout' 
						)
					); 
					?> 
				</div>   
			</nav>
		<?php } ?>  
	</header><!-- #masthead -->
	<!-- <main id="site-content" role="main"> -->
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<?php 
		wp_nav_menu(
			array(
			'container' => false,  
			'items_wrap' => '<ul class=" " >%3$s</ul>',
			'menu_class' => '', 
			'theme_location' => 'header_profile_menu' 
			)
		); ?>
	</div>  
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "175px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>