<?php

/**
 * Template Name: Edit Music
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header();   
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
}  
?>
<main id="site-content" role="main"> 
    <?php
    if (have_posts()) {  
        while (have_posts()) { 
            the_post();  ?>
            <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>"> 
                <header class="entry-header has-text-align-center pt-3">
					<div class="container">
						<?php the_title( '<h1 class="entry-title mb-4">', '</h1>' ); ?>
					</div><!-- .entry-header-inner -->
				</header><!-- .entry-header -->
				 
				<div class="post-inner thin">
					<div class="entry-content">
						<div class="w-70 rounded">
                            <div class="container">
                            
                                <div class="row buddypress ">
                                    <div class="col-md-12 mx-auto buddypress-wrap p-lg-5">
                                        <?php  
                                        $post_id=$_GET['id']; 
                                        if( $post_id){
                                            $entry_id = get_post_meta($post_id , "gf_entry_id", true ); 
                                            $entry = GFAPI::get_entry($entry_id);  
                                            gravity_form(4, false, false, false, array('music_title'=>$entry[10], 'music_description'=>$entry[14], 'music_tax'=>$entry[12], 'music_upload_from'=>$entry[11], 'music_upload_url'=>$entry[15],'music_soundcloud_url'=>$entry[17],'music_spotify_url'=>$entry[16]), false); 
                                        } ?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article><!-- .post -->
    <?php }
    }
    ?></div>
</main><!-- #site-content --> 
<script >
jQuery(document).ready(function ($){ 
    $('.js-example-basic-multiple').select2();
	$('.select2_select .gfield_select').select2();
});
</script>
<?php 
get_footer(); ?>
