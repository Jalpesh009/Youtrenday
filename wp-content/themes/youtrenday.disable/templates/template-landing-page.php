    <?php

/**
 * Template Name: Landing page
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header(); ?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) { 
        while (have_posts()) { 
            the_post();  ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">  
                <?php  if( have_rows('top_banner') ):
                    while ( have_rows('top_banner') ) : the_row();   
                        $title = get_sub_field('title');  ?>
                        <div class="landing-part"> 
                            <div class="container-fluid">
                                <h1><?php echo $title; ?></h1>  
                            </div>
                        </div>
                        <div class="video-section">
                            <div class="row p-0 m-0">
                                <?php
                                if( have_rows('videos') ):
                                    $i = 1;
                                    while ( have_rows('videos') ) : the_row();    
                                        $upload_video = get_sub_field('uplaod_video' );
                                        $upload_video_thumbnail = get_sub_field('upload_video_thumbnail' );
                                        $video_title = get_sub_field('video_title' );
                                        $video_subtitle = get_sub_field('video_subtitle' );
                                        $video_author = get_sub_field('video_author' );
                                        // echo '<pre>';
                                        // print_r($upload_video_thumbnail);
                                        // echo '</pre>';
                                        ?>
                                        <div class="col-xs-12 col-md-4 mx-0 px-0 main_item"> 
                                            <!-- onclick="this.paused?this.play():this.pause(); " --> 
                                            <input type="hidden" name="video_url" class="video_url" value="<?php echo $upload_video['url']; ?>" >
                                            <img src="<?php echo $upload_video_thumbnail['url']; ?>" alt="" class="thumb_image image_thumb" width="400" height="600">
                                            <video class="video" src="" width="400" height="600">
                                                <!-- <source src="<?php echo $upload_video['url']; ?>" type="video/mp4"> 
                                                 -->
                                            </video>
                                            <div class="play_pause_buttons"> 
                                                <i class="fa fa-play-circle-o pause_btn m-auto" aria-hidden="true"></i>  
                                            </div>
                                            <div class="overlayText">
                                                <div class="topText">
                                                    <span><?php echo $video_title; ?></span></br>
                                                    <?php if($video_subtitle && $video_author){ ?>
                                                    "<span><?php echo $video_subtitle; ?></span>" - <span><?php echo $video_author; ?></span>
                                                    <?php } ?>
                                                </div>  
                                            </div>  
                                        </div>  
                                    <?php $i++;
                                    endwhile; 
                                endif;  ?>
                            </div>
                        </div>
                    <?php   
                    endwhile; 
                    wp_reset_postdata(); 
                endif;  
                if( have_rows('newsletter_section') ):
                    while ( have_rows('newsletter_section') ) : the_row();  
                    $upload_background_image = get_sub_field('upload_background_image'); 
                    $bg_image = '';
                    if($upload_background_image){
                        $bg_image =  $upload_background_image['url'];
                    } 
                        $title = get_sub_field('title'); 
                        $sub_title = get_sub_field('sub_title'); 
                        $newsletter_form_shortcode = get_sub_field('newsletter_form_shortcode'); ?>
                        <div class="landing-subscribe" style="background-image: url('<?php echo $bg_image; ?>');">
                            <div class="container news-letter">
                                <?php if($title ) { ?>
                                    <h3> <?php echo  $title;  ?></h3>
                                <?php } if($sub_title ) { ?>
                                    <p> <?php echo  $sub_title;  ?></p>
                                <?php } if($newsletter_form_shortcode ) { 
                                    echo do_shortcode($newsletter_form_shortcode);
                                } ?> 
                            </div>
                        </div>
                       
                        <?php  
                    endwhile; 
                endif;
                if( have_rows('what_we_do_section') ):
                    while ( have_rows('what_we_do_section') ) : the_row();  
                        $title = get_sub_field('title'); 
                        $description = get_sub_field('description'); ?>
                        <div class="wwd-section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1><?php echo  $title; ?></h1>
                                        <?php echo  $description; ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                    endwhile; 
                endif;
                if( have_rows('testimonials_section') ):
                    while ( have_rows('testimonials_section') ) : the_row();  
                        $title = get_sub_field('title'); 
                        ?>
                <div class="client-testimonial-section">
                    <div class="container landing-testimonials">
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 single-testimonial-in-innr-custom-padding pt-0">  
                                <?php if($title ) { ?>
                                    <h1> <?php echo  $title;  ?> </h1>
                                <?php } ?>
                            </div>  
                        </div>
                        <div class="row testimonials_slider "> 
                            <?php 
                            $loop = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => -1 ));
                            if($loop->have_posts()):
                                while ( $loop->have_posts() ) : $loop->the_post();   
                                    $testimonial_author = get_field('testimonial_author'); ?>  
                                    <div class="col-xs-12 col-lg-6 bg-white m-4 p-2">  
                                        <div class="row h-100 bg-white mx-0 border1px">  
                                            <div class="col-3 my-auto p-0 img-sec">  
                                                <div class="border1px p-2 bg-white">  
                                                    <?php echo get_the_post_thumbnail( get_the_ID(), array( 100, 100) ); ?> 
                                                </div>
                                            </div>
                                            <div class="col-9 my-auto content-sec"> 
                                                <?php the_content(); ?>
                                                <h4><?php echo $testimonial_author; ?></h4>
                                            </div>  
                                        </div> 
                                    </div>  
                                <?php  
                                endwhile;   
                            endif; ?> 
                        </div>
                    </div> 
                </div>  
                <?php  
                    endwhile; 
                endif; 
                ?>
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content --> 
<?php get_footer(); ?>