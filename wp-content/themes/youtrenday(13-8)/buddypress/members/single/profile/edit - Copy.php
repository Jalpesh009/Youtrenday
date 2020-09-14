<?php
/**
 * BuddyPress - Members Single Profile Edit
 *
 * @since 3.0.0
 * @version 3.1.0
 */

bp_nouveau_xprofile_hook( 'before', 'edit_content' ); 
$current_user = wp_get_current_user();
$user_id = get_current_user_id();
$city = get_user_meta( $user_id, 'user_cust_city'  );
 
// $field_value = bp_get_profile_field_data( array(
// 	'field' => 20,
// 	'user_id' => $user_id,
// 	'profile_group_id' => 2
//   ) );
$user_about = BP_XProfile_ProfileData::get_value_byid( 20, $user_id );
// echo 'Field data = ' . $daata;
?> 
	<div class="post-inner thin profile-page-content pb-5" style="background-image: url(<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/reg.png' ); ?>);"> 
		<div class="profil-page-profile pb-5 pt-1">
			<div class="container">
				<p class="my-4">
					Your new profile photo has been rejected. Please submit a photo respecting the general conditions of use
				</p> 
				<button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modal_image_upload">
					<img class="polygon-clip-hexagon" src="http://www.albiorixtech.com/wp-content/uploads/2020/03/blog7.jpg"> 
				</button>
			</div>
		</div> 
	</div>

	<div class="offset-lg-3 offset-sm-2 col-lg-6 col-sm-7 boxed custom-box-shadow">
		<div class="top_profil_info text-center">
			<p class="name_title" >
				<span class="name_span_title bold"><?php echo  $current_user->user_firstname; ?></span> 
			</p>
			<p class="info_title"  >
				<span class="info_span_age gray">
					<i class="fa fa-circle gray" aria-hidden="true"></i> 25 ans 
				</span> 
				<span class="info_span_location gray">
					<i class="fa fa-map-marker gray" aria-hidden="true"></i> <?php echo $city[0]; ?> 
				</span>
			</p> 
			<div class="short-desc">
				<p class="Description_short"><?php echo $user_about; ?></p> 
				<p class="voir_plus"  >
					<div id="accordion" class="accordion">
						<div class="card-cust mb-0">
							<div class="card-header-cust collapsed" data-toggle="collapse" href="#collapseOne">
								<a class="card-title">
									Reat in Full
								</a> 
							</div>
							<div id="collapseOne" class="card-body collapse p-2" data-parent="#accordion" >
								<p class="small"><?php echo $user_about; ?></p> 
							</div> 
						</div>
					</div> 
				</p> 
			</div> 
		</div>
	</div> 
	<div class="container custom-table-edit-profile">
		<div class="row ">
		
			<div class="col-xs-12 col-lg-8 mx-auto">
				<div class="about">
					<div class="about-content edit-profile-box-border p-custom">
						<h3>Required Profile </h3>
						<p class="pull-right"> 
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_1">
								<i class="fa fa-edit edit-ico-btn"></i>
							</button>
						</p> 
						<table class="text-uppercase"> 
							<?php 
							if ( bp_has_profile( 'exclude_fields=20' ) ) :
								while ( bp_profile_groups() ) : bp_the_profile_group();
									bp_nouveau_xprofile_hook( 'before', 'field_content' ); 
									while ( bp_profile_fields() ) :
										bp_the_profile_field(); 
										$field_name = bp_get_the_profile_field_name(); ?> 
										<tr>
											<td><p><?php bp_the_profile_field_name(); ?></p></td>
											<td><p><?php bp_the_profile_field_value(); ?></td>
										</tr>
									<?php endwhile;
									bp_nouveau_xprofile_hook( 'after', 'field_content' );
								endwhile;  
							endif;
							  ?>
						</table>
					</div>
				</div>
				<div class="required-profile">
					<div class="rprofile-content edit-profile-box-border p-custom">
						<h3>ABOUT<span class="about-text">(This will show on your profile and can be adjusted later)</span></h3>
						<p class="pull-right">
						 	<p><?php echo $user_about; ?></p>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_2">
								<i class="fa fa-edit edit-ico-btn"></i>
							</button>
						</p>
					</div>
				</div>
			</div>
		</div> 
	</div> 

	<div class="modal fade edit_profile_modal" id="modal_1" tabindex="-1" role="dialog" aria-labelledby="modal_1Label" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"> 
			<div class="modal-content"> 
				<div class="modal-header">
					<h5 class="modal-title m-0" id="modal_1Label">Basic Info</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action=" " method="post" id="profile-edit-form1" class="standard-form profile-edit <?php bp_the_profile_group_slug(); ?>">
					<div class="modal-body">   
						<?php 
						if ( bp_has_profile( 'exclude_fields=20'  ) ) :
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
						endif; ?>  
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Close</button> 
						<?php bp_nouveau_submit_button( 'member-profile-edit' ); ?>
					</div>
				</form>
					
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal_2" tabindex="-1" role="dialog" aria-labelledby="modal_2Labels" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"> 
			<div class="modal-content"> 
				<div class="modal-header">
					<h5 class="modal-title m-0" id="modal_2Label">About</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action=" " method="post" id="profile-edit-form" class="standard-form profile-edit <?php bp_the_profile_group_slug(); ?>">
					<div class="modal-body">  
						<?php  
						if ( bp_has_profile( 'profile_group_id=2&exclude_fields=15,39'  ) ) :
							while ( bp_profile_groups() ) : bp_the_profile_group();  	 						bp_nouveau_xprofile_hook( 'before', 'field_content' ); 
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
						endif; ?> 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Close</button> 
						<?php bp_nouveau_submit_button( 'member-profile-edit' ); ?>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal_image_upload" tabindex="-1" role="dialog" aria-labelledby="modal_3Labels" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"> 
			<div class="modal-content"> 
				
				<div class="panel panel-default">
					<div class="panel-heading">Image Upluad</div>
						<div class="panel-body"> 
							<div class="row">
								<div class="col-md-4 text-center">
									<div id="upload-demo" style="width:350px"></div>
								</div>
								<div class="col-md-4" style="padding-top:30px;">
									<strong>Select Image:</strong>
									<br/>
									<input type="file" id="upload">
									<br/>
									<button class="btn btn-success upload-result">Upload Image</button>
								</div>
								<div class="col-md-4" style="">
									<div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>
								</div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
bp_nouveau_xprofile_hook( 'after', 'edit_content' );
