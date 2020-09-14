<?php
/**
 * BuddyPress - Members Single Profile Edit
 *
 * @since 3.0.0
 * @version 3.1.0
 */
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
$currentUser_id = get_current_user_id(); 
bp_nouveau_xprofile_hook( 'before', 'edit_content' ); 
$current_user = wp_get_current_user();
$user_id = bp_displayed_user_id();

$city = get_user_meta( $user_id, 'user_cust_city'  );
  
$user_about = BP_XProfile_ProfileData::get_value_byid( 20, $user_id ); 
$user_birthdate = BP_XProfile_ProfileData::get_value_byid( 39, $user_id );
$b_first_name = BP_XProfile_ProfileData::get_value_byid( 1, $user_id );
$user  = get_userdata($user_id); 
$first_name = '';
if( $b_first_name){ 
	$first_name = $b_first_name;
}else{
	$first_name = $user->first_name ;
}


$last_name = BP_XProfile_ProfileData::get_value_byid( 13, $user_id );
$phone = BP_XProfile_ProfileData::get_value_byid( 40, $user_id ); 
$date1 = strtotime($user_birthdate);   
$date2 =  strtotime(date("Y-m-d H:i:s" ));
$diff = abs($date2 - $date1);
$years = floor($diff / (365*60*60*24));     
?> 
<div class="profile-edit profile edit buddypress bp-nouveau bbp-user-page single singular bbpress mt-0">
	<div class="post-inner thin profile-page-content pb-5"> 
		<div class="profil-page-profile pt-4 pb-md-5">
			<div class="container">
			  
				<!-- <img class="polygon-clip-hexagon" src="http://www.albiorixtech.com/wp-content/uploads/2020/03/blog7.jpg"> </br> -->
				<div class="user_pic_img mx-auto">  
					<?php bp_displayed_user_avatar( 'type=full' ); ?> 
				 
					<!-- <div class="image_overlay">
						<button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modal_image_upload">
							
						</button>
					</div> -->
					<?php if (is_user_logged_in() && ($currentUser_id == $user_id )){  ?>
						<div class="middle_user_profilepic">
							<div class="text_user_profilepic">
								<button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modal_image_upload">
									<i class="fa fa-camera py-2" aria-hidden="true"></i></br>Change Profile Photo
								</button>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div> 
	</div>

	<div class="offset-lg-3 offset-sm-2 col-lg-6 col-sm-7 boxed custom-box-shadow mx-auto">
		<div class="row about-content change_password pb-4 mb-2">    
			<div class="col-xs-1">  
				<?php if (is_user_logged_in() && ($currentUser_id == $user_id )){  ?>
					<div class="edit_user_modal pull-right"> 
						<button type="button" class="btn btn-primary border-0" data-toggle="modal" data-target="#modal_password_reset">
							<i class="fa fa-edit edit-ico-btn"></i>
						</button>
					</div>  
				<?php } ?>
			</div>  
		</div>  
		
		<div class="row">

			<?php  
			$col_1_cls = ""; 
			$col_2_cls = "col-md-12"; 
			$args_video  = array( 
				'post_type' => 'competition_video',
				'posts_per_page' => 3,
				'author' => bp_displayed_user_id(), 
				'meta_query' => array(
					array(
						'key'     => 'compVideo_plan_type',
						'value'   => 'paid_plan',
						'compare' => '=',
					),
				),  
			);
			$query_video = new WP_Query($args_video);   
			$query_video_total = $query_video->found_posts;   
			if($query_video_total > 0){ 
				$col_1_cls = "col-md-4"; 
				$col_2_cls = "col-md-6"; 
				echo '<div class="'. $col_1_cls .' pt-0"> <div class="competititon_badges text-center"> <div class="single_badge">';
				if($query_video->have_posts()):  
					while ($query_video->have_posts()) : $query_video->the_post();
						echo '<img src="' .site_url(). '/wp-content/uploads/2020/07/comp-badge-e1595831087724.png" class="paidv_badge">';
					endwhile; wp_reset_query();
				endif; 
				echo '</div> </div> </div>  ';
			}
			?> 
			<div class="<?php echo $col_2_cls; ?>">  
				<div class="top_profil_info text-center pt-0">
					<p class="name_title" >
						<span class="name_span_title bold"><?php echo ucfirst($first_name); ?></span> 
					</p> 
					<div class="short-desc">
						<?php if( $user_about){  ?>
							<p class="Description_short"><?php echo stripslashes($user_about); ?></p> 
						<?php }  ?>
						<div id="accordion" class="accordion">
							<div class="card-cust mb-0">
								<div class="card-header-cust collapsed" data-toggle="collapse" href="#collapseOne">
									<a class="card-title">
										Read in Full
									</a> 
								</div>
								<div id="collapseOne" class="card-body collapse p-2" data-parent="#accordion" >
									<p class="small"><?php echo stripslashes($user_about) ; ?></p> 
								</div> 
							</div>
						</div>  
					</div> 
				</div>
			</div>  
		</div>
	</div> 
	<div class="container-fluid custom-table-edit-profile">
		<div class="row ">
			<div class="col-sm-12 col-md-12 col-lg-6"> 
				<div class="user_musics">
					<div class="music-content edit-profile-box-border p-custom">
						<div class="row">   
							<div class="col-lg-11 px-3"> 
								<h3 class="mt-0">PHOTOS</h3> 
							</div>
							<?php if (is_user_logged_in() && ($currentUser_id == $user_id )){  ?>
								<div class="col-lg-1">  
									<div class="edit_user_modal pull-right"> 
										<a href="<?php echo site_url('/add-music/'); ?>" class="add_new_btn for-button-style text-center" > New post </a>  
									</div>  
								</div> 
							<?php } ?>
							<div class="col-md-12 pt-3"> 
							
								<?php $user_info = get_userdata($user_id ); ?> 
								<div class="row user-profile-single-music mt-0"> 
									<?php  
									$loop_music = new WP_Query( 
															array( 
																'post_type' => 'music', 
																'author' => $user_id , 
																'posts_per_page' => 6, 
																'order'   => 'DESC',
																'post_status' => 'publish'  
															));
									if($loop_music->have_posts()): ?>
										<span class="d-none total_mc_edt_user"><?php echo $loop_music->found_posts; ?></span>
										<?php while ( $loop_music->have_posts() ) : $loop_music->the_post(); ?>
											<div class="col-xs-12 col-lg-4 single_mc_edt_user"> 
												<?php echo get_media_music_html(get_the_ID()); ?>
												<div class="pindex">
													<div class="ptitle">
														<a href="<?php the_permalink(); ?>" class="my-0"><h2 class="my-0"><?php the_title(); ?></h2></a>
													</div>   
												</div>
											</div>
										<?php endwhile;  
										wp_reset_postdata();
									else:
										echo '<h2 class="text-center mt-0 w-100">There are currently no posts</h2>'; 
									endif;
									?>   			
								</div>   
							 
								<?php if ( (is_user_logged_in() && ($currentUser_id == $user_id )) && $loop_music->found_posts > 6 ){ ?>
									<div class="row home-page w-100 my-3 mx-0"> 
										<div class="blog-design mx-auto text-center"> 
											<a href="<?php echo site_url('/my-post/'); ?>" class="more-blogs px-5  for-button-style " > <i class="fa fa-plus text-danger" aria-hidden="true"></i> </a>
										</div>
									</div>
								<?php }   ?>
							</div>  
						</div>  
					</div>
				</div> 
			</div> 

			<div class="col-sm-12 col-md-12 col-lg-6">
				<div class="about">
					<div class="about-content edit-profile-box-border p-custom">
						<div class="row">   
							<div class="col-xs-11 px-3"> 
								<h3 class="mt-0">Required Profile </h3> 
							</div>
							<?php if (is_user_logged_in() && ($currentUser_id == $user_id )){  ?>
								<div class="col-xs-1">  
									<div class="edit_user_modal pull-right"> 
										<button type="button" class="btn btn-primary border-0" data-toggle="modal" data-target="#modal_1">
											<i class="fa fa-edit edit-ico-btn"></i>
										</button>
									</div>  
								</div> 
							<?php }   ?>
							<div class="col-md-12">  
								<table class="text-uppercase"> 
									<?php 
									/* if ( bp_has_profile( 'exclude_fields=39,20' ) ) :
										while ( bp_profile_groups() ) : bp_the_profile_group();
											bp_nouveau_xprofile_hook( 'before', 'field_content' ); 
											while ( bp_profile_fields() ) :
												bp_the_profile_field(); 
												$field_name = bp_get_the_profile_field_name(); ?> 
												<tr>
													<td><p><?php bp_the_profile_field_name(); ?></p></td>
													<td><?php bp_the_profile_field_value(); ?></td>
												</tr>
											<?php endwhile;
											bp_nouveau_xprofile_hook( 'after', 'field_content' );
										endwhile;  
									endif; */ 
									?>
									<tr>
										<td><p>FIRST NAME</p></td>
										<td><p><?php echo $first_name; ?><p></td>
									</tr>
									<tr>
										<td><p>LAST NAME</p></td>
										<td><p><?php echo $last_name; ?><p></td>
									</tr>
									<tr>
										<td><p>PHONE</p></td>
										<td><p><?php echo $phone; ?><p></td>
									</tr>
									<tr>
										<td><p>Email</p></td>
										<td><p><?php echo bp_get_displayed_user_email(); ?><p></td>
									</tr>
								</table>
							</div>
						</div>  
					</div>
				</div>
				<div class="required-profile about-content">
					<div class="rprofile-content edit-profile-box-border p-custom"> 
						<div class="row">  
							<div class="col-xs-11 pl-3 pr-5"> 
								<h3 class="mt-0">ABOUT
									<!-- <span class="about-text">(This will show on your profile and can be adjusted later)</span> -->
								</h3>
							</div>
							<?php if (is_user_logged_in() && ($currentUser_id == $user_id )){  ?>
								<div class="col-xs-1">  
									<div class="edit_user_modal pull-right">  
										<button type="button" class="btn btn-primary border-0" data-toggle="modal" data-target="#modal_2">
											<i class="fa fa-edit edit-ico-btn"></i>
										</button> 
									</div>  
								</div> 
							<?php }   ?>
							<div class="col-md-12">  
								<p><?php echo stripslashes($user_about); ?></p>
							</div>
						</div>   
					</div>
				</div>
			</div>
		</div> 
	</div> 
	<div class="modal modal_image_upload fade pt-3" id="modal_image_upload" tabindex="-1" role="dialog" aria-labelledby="modal_3Labels" aria-hidden="true">
		<div class="modal-dialog " role="document">  
			<div class="d-none justify-content-center text-center update_user_image">
				<div class="spinner-border" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
			<div class="modal-content p-2">  
				<div class="modal-header border-0 pt-lg-0 pt-md-0"> 
					<button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>
				<div class="panel panel-default"> 
					<div class="panel-body"> 
						<div class="row">
							<div class="col-md-12 text-center ">
								<div id="upload-demo" class="w-100"></div>
							</div>
							<div class="mx-auto pt-0 col-md-5 user_img_upload" style="padding-top:30px;">
								<span class="select_image mb-3">SELECT AN IMAGE</span> 
								<input type="file" id="upload" class="img_upload" accept="image/png, image/jpeg, image/jpg"> 
								<button class="for-button-style upload-result" data-userid="<?php echo $user_id;  ?>">UPDATE IMAGE</button>
							</div> 
							 
						</div> 
					</div>
				</div>
			</div> 
			
		</div>
	</div> 
	<div class="modal modal_password_reset fade pt-3" id="modal_password_reset" tabindex="-1" role="dialog" aria-labelledby="modal_3Labels" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"> 
			<div class="modal-content py-0"> 
				<div class="modal-header">
					<h5 class="modal-title m-0" id="modal_1Label">Change Password</h5>
					<button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>
				<form action="" method="post" id="profile-change-password-form" class="standard-form mb-5 ">
					<div class="modal-body">     
						<?php echo do_shortcode('[changepassword_form]');  
						$user = wp_get_current_user();
						if (!in_array( 'administrator', (array) $user->roles ) ) { ?>
							<hr>
							<button type="" class="delete_account_cls border-0 bg-white m-0" name="delete-account" data-toggle="modal" data-target="#modal_delete_account">
								<h3 class="m-0 delete-account-text">Delete Account</h3>
							</button>  
						<?php } ?> 
					</div>
					<div class="modal-footer">
						<button type="button" class="for-button-style" data-dismiss="modal">Close</button> 
						<input type="submit" value="Change Password" class="for-button-style" name="change_password">
					</div> 
				</form>
			</div>
		</div>
	</div> 
	<div class="modal fade modal_delete_account pt-3" id="modal_delete_account" tabindex="-1" role="dialog" aria-labelledby="modal_1Label" aria-hidden="true">
		<div class="modal-dialog " role="document"> 
			<div class="modal-content py-0"> 
				<div class="modal-header">
					<h5 class="modal-title m-0" id="modal_1Label">Delete Account</h5>
					<button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>
				<form action="" method="post" id="profile-delete-account-form" class="standard-form mb-5 ">
					<div class="modal-body">      
						<h5 class="text-center">Are you sure want to delete your account?</h5> 
					</div>
					<div class="modal-footer">
						<button type="button" class="for-button-style" data-dismiss="modal">Close</button> 
						<input type="submit" value="Delete Account" class="for-button-style" name="edit_delete_account">
					</div> 
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade edit_profile_modal pt-3" id="modal_1" tabindex="-1" role="dialog" aria-labelledby="modal_1Label" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"> 
			<div class="modal-content py-0"> 
				<div class="modal-header">
					<h5 class="modal-title m-0" id="modal_1Label">Basic Info</h5>
					<button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>
				<form action=" " method="post" id="profile-edit-form1" class="standard-form profile-edit <?php bp_the_profile_group_slug(); ?>">
					<div class="modal-body">   
						<input type="hidden" name="edi_user_id" value="<?php echo $user_id; ?>">
						<div class="row">	
							<div class="editfield col-md-12 field_1 field_first-name required-field visibility-public field_type_textbox">
								<fieldset>  								
									<legend id="field_1-1"> First Name <span class="bp-required-field-label">(required)</span>		</legend> 
									<input id="field_1" name="field_1" type="text" value="<?php echo $first_name; ?>" aria-required="true" aria-labelledby="field_1-1" aria-describedby="field_1-3"> 
								</fieldset>
							</div>
						</div> 
						<div class="row">	
							<div class="editfield col-md-12 field_13 field_last-name required-field visibility-public alt field_type_textbox">
								<fieldset> 
									<legend id="field_13-1">Last Name </legend>
									<input id="field_13" name="field_13" type="text" value="<?php echo $last_name; ?>" aria-required="true" aria-labelledby="field_13-1" aria-describedby="field_13-3">  
								</fieldset>
							</div> 
						</div>
						<div class="row">	
							<div class="editfield col-md-12 field_40 field_phone optional-field visibility-public field_type_telephone">
								<fieldset>  <legend id="field_40-1"> Phone</legend> 
									<input id="field_40" name="field_40" type="tel" value="<?php echo $phone; ?>" aria-labelledby="field_40-1" aria-describedby="field_40-3"> 
								</fieldset>
							</div> 
						</div>
						<?php 
						/* if ( bp_has_profile( 'exclude_fields=20,39'  ) ) :
							while ( bp_profile_groups() ) : bp_the_profile_group();
								bp_nouveau_xprofile_hook( 'before', 'field_content' ); 
								while ( bp_profile_fields() ) :
									bp_the_profile_field(); ?>
									
									<div class="row">	
										<div<?php bp_field_css_class( 'editfield col-md-12' ); ?> >
											<fieldset> 
												<?php
												$field_name = bp_get_the_profile_field_name();
												$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() ); 
												$field_type->edit_field_html(); ?> 
											</fieldset>
										</div> 
									</div> 
								<?php endwhile;
								bp_nouveau_xprofile_hook( 'after', 'field_content' ); ?>
								<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_field_ids(); ?>" /> 
								<?php
							endwhile;  
						endif; */ ?>  
						<!-- <div class="row">	
							<div class="editfield col-md-12">
								<fieldset> 				
									<legend id="email">Email</legend>
									<input type="email" name="email" id="email" value="<?php echo esc_attr( bp_get_displayed_user_email() ); ?>" class="settings-input" <?php bp_form_field_attributes( 'email' ); ?>/>

								</fieldset>
							</div> 
						</div>  -->
						 
					</div>
					<div class="modal-footer">
						<button type="button" class="for-button-style" data-dismiss="modal">Close</button>  
						<?php bp_nouveau_submit_button( 'member-profile-edit' ); ?>
					</div>
				</form>
					
			</div>
		</div>
	</div>

	<div class="modal edit_about_modal fade pt-3" id="modal_2" tabindex="-1" role="dialog" aria-labelledby="modal_2Labels" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"> 
			<div class="modal-content py-0"> 
				<div class="modal-header">
					<h5 class="modal-title m-0" id="modal_2Label">About</h5>
					<button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>
				<form action=" " method="post" id="profile-edit-form" class="standard-form profile-edit <?php bp_the_profile_group_slug(); ?>">
					<div class="modal-body">  
						<input type="hidden" name="editabout_user_id" value="<?php echo $user_id; ?>">
						<?php  
						/* if ( bp_has_profile( 'profile_group_id=2&exclude_fields=15,39'  ) ) :
							while ( bp_profile_groups() ) : bp_the_profile_group();  	 						
							bp_nouveau_xprofile_hook( 'before', 'field_content' ); 
								while ( bp_profile_fields() ) :
									bp_the_profile_field(); ?>

									<div<?php bp_field_css_class( 'editfield' ); ?>>
										<fieldset> 
											<?php
											$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
											$field_type->edit_field_html(); ?> 
										</fieldset>
									</div> 
								<?php 
								endwhile;
								bp_nouveau_xprofile_hook( 'after', 'field_content' ); ?>
									<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_field_ids(); ?>" /> 
								<?php 								
							endwhile;   
						endif; */ ?> 
						<div class="editfield field_20 field_about-me-this-will-show-on-your-profile-and-can-be-adjusted-later optional-field visibility-public field_type_textarea">
							<fieldset> 
								<legend id="field_20-1">About me (This will show on your profile and can be adjusted later)					</legend> 
								<textarea id="field_20" name="field_20" cols="40" rows="5" aria-labelledby="field_20-1" aria-describedby="field_20-3"><?php echo stripslashes($user_about); ?></textarea>
 
							</fieldset>
						</div>  
					</div>
					<div class="modal-footer">
						<button type="button" class="for-button-style" data-dismiss="modal">Close</button> 
						<?php // bp_nouveau_submit_button( 'member-profile-edit' ); ?>
						<div class="submit">
						<input type="submit" name="profile-about-edit-submit" id="profile-about-edit-submit" value="Save Changes" class="for-button-style">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
<?php bp_nouveau_xprofile_hook( 'after', 'edit_content' );