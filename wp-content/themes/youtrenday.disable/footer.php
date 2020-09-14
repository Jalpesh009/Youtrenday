 
			<footer id="site-footer" role="contentinfo" class="shadow-lg bg-white rounded">
				<div class="container"> 
					<div class="footer-logo"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<?php  // Logo 1 
								if( have_rows('footer_options', 'option') ): 
									while ( have_rows('footer_options', 'option') ) : the_row();  
										$footer_circle_logo = get_sub_field('footer_circle_logo', 'option');
										$footer_logo = get_sub_field('footer_logo', 'option'); ?>
										<img width="90" height="90" src="<?php echo $footer_circle_logo['url']; ?>" class="123custom-logo d-inline"> 
										<?php // Logo 2 ?> 
										<img width="230" height="102" src="<?php echo $footer_logo['url']; ?>" class="loggedin-header-logo d-inline">		 
										<?php  
									endwhile; 
								endif; ?>
							</div>
						</div>
					</div>
					<div class="social-media">  
						<?php  // Logo 1 
						if( have_rows('footer_options', 'option') ): 
							while ( have_rows('footer_options', 'option') ) : the_row(); 
								if( have_rows('social_options', 'option') ): 
									while ( have_rows('social_options', 'option') ) : the_row();  
										$facebook_url = get_sub_field( 'facebook_url' ); 
										// $imdb_url = get_sub_field( 'imdb_url' ); 
										$youtube_url = get_sub_field( 'youtube_url' ); 
										$instagram_url = get_sub_field( 'instagram_url' ); ?>  
										<div class="landing-section">
											<div class="container container_pad">
												<ul class="social-menu">
												<?php if( !empty($facebook_url)) { ?> 
													<li class="sprite-facebook">
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
											</div>
										</div>
									<?php  
									endwhile; 
								endif; 
							endwhile; 
						endif; ?>

						<div class="custom-footer-menu text-center mb-4">
							<ul>
							<?php 
								wp_nav_menu(
									array(
										'container'  => '',
										'items_wrap' => '%3$s',
										'theme_location' => 'footer-menu',
									)
								);  	
								?>
							</ul>
						</div> 
					</div> 
				</div>  
			</footer><!-- #colophon -->
			<!-- </main> -->
		</div> 
		<!-- #page --> 
		<?php wp_footer(); ?>  
	</body>
</html>
