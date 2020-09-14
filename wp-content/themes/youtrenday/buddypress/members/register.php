<?php
/**
 * BuddyPress - Members Register
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 * @version 3.0.0
 */

?>
<header class="entry-header has-text-align-center pt-3">
	<div class="container">
		<h1 class="entry-title mb-0"><?php the_title(); ?></h1>			
	</div><!-- .entry-header-inner -->
</header>
<div class="post-inner thin">
	<div class="entry-content">  
		<div class="w-70 rounded bg-white">
			<div id="buddypress" class="buddypress-wrap extended-default-reg  py-lg-3 px-lg-4 mx-lg-2 ">
				<?php 
				do_action( 'bp_before_register_page' ); ?>
				<div class="page register-page" id="register-page">

					<form action="" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
						<div class="register-section" id="profile-details-section"> 
							
								<?php 
								if ( 'registration-disabled' == bp_get_current_signup_step() ) : ?>
									<div id="template-notices" role="alert" aria-atomic="true">
										<?php do_action( 'template_notices' ); ?> 
									</div> 
									<?php do_action( 'bp_before_registration_disabled' ); ?>
									<p><?php _e( 'User registration is currently not allowed.', 'buddypress' ); ?></p>
									<?php 
									do_action( 'bp_after_registration_disabled' ); ?>
								<?php endif;   
								if ( 'request-details' == bp_get_current_signup_step() ) : ?> 
									<div id="template-notices" role="alert" aria-atomic="true">
										<?php do_action( 'template_notices' ); ?> 
									</div> 
									<!-- <p><?php // _e( 'Registering for this site is easy. Just fill in the fields below, and we\'ll get a new account set up for you in no time.', 'buddypress' ); ?></p> -->
										<?php do_action( 'bp_after_account_details_fields' );  ?>

									<div class="form-row">
										<?php 
										/***** Extra Profile Details for first 3 fields******/ 
										if ( bp_is_active( 'xprofile' ) ) :  
											do_action( 'bp_before_signup_profile_fields' ); ?> 
											
												<?php 
												if ( bp_has_profile( array( 'profile_group_id' => 1, 'fetch_field_data' => false , 'exclude_fields' => '40' ) ) ) : 
													while ( bp_profile_groups() ) : bp_the_profile_group(); 
														while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
															<!-- <div <?php //bp_field_css_class( 'editfield' ); ?>> -->
															<div class="form-group col-md-6 px-3">
																<fieldset> 
																	<?php
																	$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
																	$field_type->edit_field_html();  
																	do_action( 'bp_custom_profile_edit_fields' ); ?> 
																</fieldset>
															</div> 
														<?php endwhile; ?> 
														
													<?php 
													endwhile; 
												endif;  
												do_action( 'bp_signup_profile_fields' ); ?> 
											
											<?php do_action( 'bp_after_signup_profile_fields' ); ?> 
										<?php endif;  
										do_action( 'bp_before_account_details_fields' ); ?> 

										<?php // signup username
										do_action( 'bp_signup_username_errors' ); ?>
										<input type="hidden" name="signup_username" id="signup_username" value="<?php bp_signup_username_value(); ?>" <?php bp_form_field_attributes( 'username' ); ?>/>
										
										<?php // signup email ?>
										<div class="form-group col-md-6 px-3">  
											<fieldset>  			
												<legend id="signup_email"><?php _e( 'Email', 'buddypress' ); ?><?php _e( '(required)', 'buddypress' ); ?></legend> 
												<?php do_action( 'bp_signup_email_errors' ); ?> 
												<input type="email" name="signup_email" id="signup_email" value="<?php bp_signup_email_value(); ?>" <?php bp_form_field_attributes( 'email' ); ?>/>
											</fieldset>
										</div>
										
										<?php // signup password ?>
										<div class="form-group col-md-6 px-3"> 
											<fieldset>  			
												<legend id="signup_password"><?php _e( 'Password', 'buddypress' ); ?></legend> 
												<?php  do_action( 'bp_signup_password_errors' ); ?>			
												<input type="password" name="signup_password" id="signup_password" value="" class="password-entry" <?php bp_form_field_attributes( 'password' ); ?>/>
												<div id="pass-strength-result"></div>
											</fieldset>
										</div>

										<?php // signup Confirm password ?>
										<div class="form-group col-md-6 px-3"> 
											<fieldset>  			
												<legend id="signup_password_confirm"><?php _e( 'Confirm Password', 'buddypress' ); ?></legend> 
												<?php do_action( 'bp_signup_password_confirm_errors' ); ?>			
												<input type="password" name="signup_password_confirm" id="signup_password_confirm" value="" class="password-entry-confirm" <?php bp_form_field_attributes( 'password' ); ?>/>
											</fieldset>
										</div> 
										<?php do_action( 'bp_account_details_fields' ); ?>  
										<?php do_action( 'bp_after_account_details_fields' );  
										
										/***** Extra Profile Details for last 3 fields******/ 
										if ( bp_is_active( 'xprofile' ) ) : 
										$col_class = ""; ?> 
											<?php do_action( 'bp_before_signup_profile_fields' ); ?>  
												<?php  
												if ( bp_has_profile( array( 'profile_group_id' => 2, 'fetch_field_data' => false ) ) ) : 
													while ( bp_profile_groups() ) : bp_the_profile_group();   
														while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
															<!-- <div <?php // bp_field_css_class( 'editfield' ); ?>> -->
															<?php														
															$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() ); 
															if( $field_type->name == 'Multi-line Text Area') { 
																$col_class = "col-md-12 px-3 mb-0";
															}else{
																$col_class = "col-md-6 px-3";
															}
															?>
															<div class="form-group <?php echo $col_class; ?>">
																<fieldset> 
																	<?php 
																	$field_type->edit_field_html();   
																	// echo "<pre>";
																	// print_r($field_type->name);
																	// echo '</pre>'; 
																	do_action( 'bp_custom_profile_edit_fields' ); ?> 
																</fieldset>
															</div>
													<?php endwhile; ?>
												
													<?php 
													endwhile; 
												endif;   
												if ( bp_has_profile( ) ) : ?>
													<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_field_ids(); ?>" />  
													<?php 
												endif;    
												do_action( 'bp_signup_profile_fields' ); ?> 
											
											<?php do_action( 'bp_after_signup_profile_fields' ); 
										endif;   
										do_action( 'bp_before_registration_submit_buttons' ); ?> 
										<div class="form-group col-md-12 px-3">
											<label>By clicking Sign Up, you agree to our <a href="<?php echo site_url('privacy-policy'); ?>"> Privacy policy </a> and <a href="<?php echo site_url('terms-conditions'); ?>">Terms & Conditions</a>.</label>
										</div>
									</div>
									<div class="submit">
										<input type="submit" class="for-button-style" name="signup_submit" id="signup_submit" value="<?php esc_attr_e( 'Submit', 'buddypress' ); ?>" />
									</div> 
									<?php 
									do_action( 'bp_after_registration_submit_buttons' ); 
									wp_nonce_field( 'bp_new_signup' ); ?> 
								<?php endif; // request-details signup step ?>
								<?php if ( 'completed-confirmation' == bp_get_current_signup_step() ) : ?>
									<div id="template-notices" role="alert" aria-atomic="true">
										<?php  do_action( 'template_notices' ); ?>
									</div>
									<?php do_action( 'bp_before_registration_confirmed' ); ?>
									<div id="template-notices" role="alert" aria-atomic="true">
										<?php if ( bp_registration_needs_activation() ) : ?>
											<p><?php _e( 'You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your address. Pease check the junk folder.', 'buddypress' ); ?></p>
										<?php else : ?>
											<p><?php _e( 'You have successfully created your account! Please log in using the username and password you have just created.', 'buddypress' ); ?></p>
										<?php endif; ?>
									</div>
									<?php do_action( 'bp_after_registration_confirmed' );  						
								endif; // completed-confirmation signup step   
								do_action( 'bp_custom_signup_steps' ); ?> 
						
						</div><!-- #profile-details-section --> 
					</form> 		
				</div> 
				<?php do_action( 'bp_after_register_page' ); ?> 
			</div><!-- #buddypress -->
		</div> 
	</div>
</div>
<?php 
	$banner_image = get_field('banner_image'); 
	$bg_image = '';
	if($banner_image){
		$bg_image =  $banner_image['url'];
	} ?>  
<style>
	.bp_register {
		background-image: url('<?php echo $bg_image; ?>'); 
	} 

</style>
<script>
	jQuery(document).ready(function($)
	{ 
		jQuery('#field_39_day option:contains("----")').text('DD');
		jQuery('#field_39_month option:contains("----")').text('MM');
		jQuery('#field_39_year option:contains("----")').text('YY');  
		var i = 1;
		jQuery("#field_39_month option").each( function( ) { 
			if($(this).val() != ''){
				if (i < 10){ 
					$(this).text("0" + i);
				}else{
					$(this).text(i);
				}
				i++;
			}
		});
		
	  
		// jQuery('#signup_submit').attr('value', 'Submit');
		// jQuery('.field_1').addClass('width-50 float-left');
		// jQuery('.field_14').addClass('width-50 float-left');
		// jQuery('.field_13').addClass('width-50 float-right');
		// jQuery('.field_15').addClass('width-50 float-left');
		// jQuery('.field_39').addClass('width-50 float-left');
		// jQuery('.field_20').addClass('width-100 float-left');

		//alert(jQuery('#signup_email').val());
		jQuery('#signup_submit').click(function()
		{
			var firstname = jQuery('#field_1').val();
			var lastname = jQuery('#field_13').val();
			var username = firstname + ' ' + lastname; 
			
			jQuery('#signup_username').attr('value', firstname);
		});
		// jQuery("input[name='field_15']").change(function(){
		//     jQuery(".option-label.checked").removeClass("checked");
		//     if(jQuery(this).prop("checked")){
		//         jQuery(this).parent().addClass('checked');
		//     }
		// });
		$(".buddypress-wrap .standard-form fieldset input, .buddypress-wrap .standard-form fieldset textarea,.buddypress-wrap .standard-form fieldset select").change(function () { 
			if ($(this).val() != '') {
				// $(this).css("border", "5px solid blue !important");
				$(this).attr('style', 'border: 1px solid #499de6 !important');
			} 
			else if ($(this).val() == '') { 
				$(this).attr('style', 'border: 1px solid rgba(230, 102, 103, 0.5) !important');
			} 
		}) ; 
	});	

</script>