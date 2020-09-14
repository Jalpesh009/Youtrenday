<?php

/**
 * Template Name: Musics
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header();   
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
$user_id = get_current_user_id();
$user_info = get_userdata( get_current_user_id());

if( isset($_POST['delete_music']) &&  $_POST['delete_music'] == 'Delete' &&  'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {    
//    echo '<pre>';
//    print_r($_POST); 
//    echo '<pre>';
   wp_trash_post( $_POST['music_id'] );

//    exit;

}
?>
<main id="site-content" role="main"> 
    <?php
    if (have_posts()) {  
        while (have_posts()) {  the_post();  ?>
            <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>"> 
                <header class="entry-header has-text-align-center pt-3">
                    <div class="container">
                        <div class="row">
                           
                            <div class="col-md-12">
                            <?php  the_title( '<span class="entry-title mypost-list-title">', '</span>' ); ?>
                            <a href="<?php echo site_url('/add-music/'); ?>" class="add_new_btn for-button-style" > New post </a>
                            </div>  
                        </div>
                        
                    </div><!-- .entry-header-inner -->
                </header><!-- .entry-header -->
                    
                <div class="post-inner thin">
                    <div class="entry-content"> 
                        <div class="container user-profile-musics ">
                            <div class="row user-profile-single-music"> 
                                <?php  
                                $loop_music = new WP_Query( 
                                                        array( 
                                                            'post_type' => 'music', 
                                                            'author' => get_current_user_id(), 
                                                            'posts_per_page' => -1, 
                                                            'order'   => 'DESC',
                                                            'post_status' => 'publish'  
                                                        ));
                                if($loop_music->have_posts()): ?>
                                    <?php while ( $loop_music->have_posts() ) : $loop_music->the_post(); ?>
                                        <div class="col-xs-12 col-lg-3 single-music"> 
                                        <?php echo get_media_music_html(get_the_ID()); ?>
                                            <div class="pindex">
                                                <div class="ptitle"> 
                                                <a href="<?php the_permalink(); ?>" class="my-0"><h2 class="my-0"><?php the_title(); ?></h2></a>

                                                <div class="edit_del_music d-block mt-2 pt-2">

                                                    <a href="<?php echo site_url('/edit-music/') ?>?id=<?php the_ID(); ?>" class="d-inline edit_music_a">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                    </a>
                                                    <a href="javascript:void(0);" class="d-inline delete_music_a" data-toggle="modal" data-target="#modal_delete_music" data-postid="<?php echo get_the_ID(); ?>" data-posttitle="<?php echo get_the_title(); ?>" >
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a> 
                                    
                                                </div> 
                                                </div>   
                                            </div>
                                        </div>
                                    <?php endwhile;  
                                    wp_reset_postdata();
                                else:
                                    echo '<h2 class="text-center mt-0 w-100">There are currently no posts </h2>'; 
                                endif;
                                ?>   			
                            </div>    
                        </div> 
                    </div>
                </div>
            </article><!-- .post -->
        <?php }
    }
    ?> 

	<div class="modal fade" id="modal_delete_music" tabindex="-1" role="dialog" aria-labelledby="modal_2Labels" aria-hidden="true">
		<div class="modal-dialog" role="document"> 
			<div class="modal-content py-0"> 
				<div class="modal-header">
					<h5 class="modal-title m-0" id="modal_2Label">Delete Music</h5>
					<button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>
				<form  method="POST" id="delete_music_form" class="standard-form">
					<div class="modal-body">  
						 Are you sure want to delete <span class="music_title"></span>
					</div>
					<div class="modal-footer">
                        <input type="hidden" class="music_id" name="music_id"> 
                        <input type="hidden" name="action" value="new_post" /> 
                        <?php wp_nonce_field( 'new-post' ); ?> 
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                        <button type="submit" name="delete_music" class="btn btn-success" value="Delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main><!-- #site-content --> 
<?php 
	  
get_footer(); ?>
