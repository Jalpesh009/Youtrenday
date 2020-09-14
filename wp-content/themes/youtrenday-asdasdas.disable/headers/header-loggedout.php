
<?php if(!is_page('landing-page')){  ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-light static-top py-0">   
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
<?php } else { ?> 
	<div class="container"> 
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
<?php } ?>