<div class="container"> 
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
			<div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 justify-content-end profile_section">
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
			<div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 navbar menu_section">
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