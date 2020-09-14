<?php

/**
 * Template Name: Create Music
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header();  
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
// $user = wp_get_current_user();
//  $roles = ( array ) $user->roles; 
// if($roles[0] == 'administrator'){ 
    ?>
    <main id="site-content" role="main" > 
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
                                        the_content();
                                        // echo do_shortcode('[gravityform id="1" title="false"]') ?>
                                            <?php  /*
                                            if ( is_wp_error( $form_error ) ) {  
                                                foreach ( $form_error->get_error_messages() as $error ) {
                                                    echo '<div class="alert alert-danger" role="alert">'; 
                                                    echo '<strong>ERROR </strong> : ' ;
                                                    echo '<span>'. $error . '</span><br/>';
                                                    echo '</div>';
                                                } 
                                            
                                            } ?>
                                            <form method='POST' enctype="multipart/form-data" class="standard-form" id="uploadForm">
                                                <div class="form-group row">
                                                    <label for="music_title" class="col-sm-3">Music Title</label>
                                                    <div class="col-sm-9"> 
                                                        <input type='text' name='music_title' id='music_title'  class="form-control-plaintext"  />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="music_content" class="col-sm-3"> Music Content</label>
                                                    <div class="col-sm-9"> 
                                                        <textarea name='music_content' id='music_content' rows='4' cols='20'class="form-control-plaintext" value=""></textarea> 
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="music_content" class="col-sm-3"> Music Category</label>
                                                    <div class="col-sm-9"> 
                                                        <?php $taxonomies = get_terms( array(
                                                            'taxonomy' => 'music_category',
                                                            'hide_empty' => false
                                                        ) );
                                                        // echo '<pre>';
                                                        // print_r( $taxonomies );
                                                        // echo '</pre>'; 
                                                        if ( !empty($taxonomies) ) :
                                                            $output = '<select class="js-example-basic-multiple" name="music_cats[]" multiple="multiple">';
                                                            foreach( $taxonomies as $category ) {
                                                                if( $category->parent == 0 ) {
                                                                    // $output.= '<optgroup label="'. esc_attr( $category->name ) .'">';
                                                                    // foreach( $taxonomies as $subcategory ) {
                                                                        // if($subcategory->parent == $category->term_id) {
                                                                        $output.= '<option value="'. esc_attr( $category->term_id ) .'">
                                                                            '. $category->name .'</option>';
                                                                        // }
                                                                    // }
                                                                    // $output.='</optgroup>';
                                                                }
                                                            }
                                                            $output.='</select>';
                                                            echo $output;
                                                        endif; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="media_system" class="col-sm-3">Upload Media From</label>
                                                    <div class="col-sm-6">  
                                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn btn-secondary py-3 active">
                                                                <input type="radio"  name="media_from" id="media_system" autocomplete="off" value="media_system" checked>Media From Your Computer
                                                            </label>
                                                            <label class="btn btn-secondary py-3">
                                                                <input type="radio" name="media_from" id="youtube" autocomplete="off" value="youtube"> Youtube
                                                            </label> 
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="form-group row upload_media">
                                                    <label class="col-sm-3">Upload Media</label>
                                                    <div class="col-sm-6 ">  
                                                        <div class="input-group  rounded-pill shadow-sm choose_file from_system">
                                                            <input id="upload" type="file" name='upload_ImgVideoAudio' onchange="readURL(this);" class=" form-control-plaintext">
                                                            <input id="uploaded_file" type="hidden" name='uploaded_ImgVideoAudio' class=" form-control-plaintext">

                                                            <label id="upload-label" class="font-weight-light text-muted">Choose file</label>
                                                            
                                                            <div class="input-group-append upload_button">
                                                                <label for="upload" class="btn btn-light m-0 rounded-pill px-3 pt-2 pb-2  bg-secondary "> <i class="fa fa-cloud-upload mr-2 text-white"></i><small class="text-white">Choose file</small></label>
                                                            </div>
                                                        </div>  

                                                        <div class="input-group from_youtube">
                                                            <input id="youtube_url" type="text" name="youtube_url" class=" form-control-plaintext" placeholder="Youtube URL"> 
                                                        </div>  

                                                    </div>  
                                                    <div class="col-sm-3">  
                                                        <div class="image-area">
                                                            <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-none" width="165" height="150">

                                                            <video src="" type="video/*" id="videoMp3Result"  class="d-none" controls width="165" height="150">
                                                                <!-- <source src="" type="video/mp4">  -->
                                                            </video>  
                                                            
                                                            <iframe id="youtubeResult" class="d-none" width="165" height="150" src="" frameborder="0" allowfullscreen>
                                                            </iframe> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                                
                                                <div class="form-group row">
                                                    <div class="col-sm-12"> 
                                                        <div class="submit create-music-btn"> 
                                                            <input type="submit" name="submit_music" class="btn btn-primary" id="signup_submit" value="Create Music">
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="action" value="new_post" /> 
                                                <?php wp_nonce_field( 'new-post' ); ?> 
                                            </form>
                                            <?php */ ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article><!-- .post -->
        <?php }
        }
        ?> 
    </main><!-- #site-content --> 
    <script >
        jQuery(document).ready(function ($){ 
            $('.js-example-basic-multiple').select2();
            $('.select2_select .gfield_select').select2();
        });
    </script>
<?php 
// } else{
//     wp_redirect( site_url('home') );
// }
get_footer(); ?>
