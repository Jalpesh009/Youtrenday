<?php
/**
 * BuddyPress - Users Header
 *
 * @since 3.0.0
 * @version 3.0.0
 */
$current_user = wp_get_current_user(); 
if( bp_is_user_profile() ){  

}else{ ?>  
	<div class="user-profile-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 user-profile-name my-5"> 
					<div class="col-lg-8 col-md-6">
						<!-- <div id="item-header-avatar"> -->
						<a href="<?php bp_displayed_user_link(); ?>"> 
							<?php bp_displayed_user_avatar( 'type=full' ); ?> 
						</a>
						
					</div>
					<?php if ( is_user_logged_in()) {  ?>
						<div class="col-lg-2 col-md-3">
							<h3> <?php the_title();  ?> </h3>
						</div>
					
						<div class="col-lg-2 col-md-3">
							<!-- <div id="item-header-content">   -->
								<?php bp_nouveau_member_header_buttons( array( 'container_classes' => array( 'member-header-actions' ) ) ); ?>
								<?php if ( bp_is_my_profile() ) {   ?>  
									<div class="member-header-actions action">
										<div class="follow-button not-following generic-button">
											<a href="<?php echo site_url('/members/' .$current_user->user_login . '/profile/'); ?>" class="user-edit-follow for-button-style" >Visit Profile</a>
										</div>
									</div>
								<?php } ?>  
							<!-- </div>  -->
						</div>
					<?php } else{ ?>
						<div class="col-lg-4 col-md-6">
							<h3> <?php the_title();  ?> </h3>
						</div>
					<?php } ?>  
				</div>
			</div>
		</div>
	</div> 
<?php }  ?>