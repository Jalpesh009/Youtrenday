<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */
?>

	<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>
	<?php  if( !bp_is_user_profile('edit')){ ?>
		<div id="item-header" role="complementary" data-bp-item-id="<?php echo esc_attr( bp_displayed_user_id() ); ?>" data-bp-item-component="members" class="users-header single-headers">

			<?php bp_nouveau_member_header_template_part(); ?>

		</div><!-- #item-header -->
	<?php  } ?>
	<div class="bp-wrap">
		<?php  if(  bp_is_user_profile('edit')){ ?>
			<div class="page-template-template-edit-profile">

				<?php bp_nouveau_member_template_part(); ?>
			</div><!-- #item-header -->
		<?php  }else{ ?> 
			<?php bp_nouveau_member_template_part(); ?>
		<?php } ?>
		<?php /* if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

			<?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>

		<?php endif; */ ?>

		<!-- <div id="item-body" class="item-body"> -->

			

		<!-- </div> / -->
	<!-- </div>  -->

	<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
