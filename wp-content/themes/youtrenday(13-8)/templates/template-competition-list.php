<?php



/**

 * Template Name: Competitions List

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

?>

<main id="site-content" role="main"> 

    <?php

    if (have_posts()) {  

        while (have_posts()) { 

            the_post();  ?>

            <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>"> 

                <header class="entry-header has-text-align-center pt-3">

					<div class="container">

						<?php the_title( '<h1 class="entry-title mb-0">', '</h1>' ); ?>

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

                                    <span class="d-none total_posts"><?php echo $loop_music->found_posts; ?></span>

                                    <span class="d-none posttype"><?php echo $posttype; ?></span>

                                    <?php while ( $loop_music->have_posts() ) : $loop_music->the_post(); ?>

                                        <div class="col-xs-12 col-lg-3 single-music"> 

                                            <?php 

                                            $musicMedia_from = get_post_meta(get_the_ID(), 'musicMedia_from', true);  

                                            $musicMedia_url = get_post_meta(get_the_ID(), 'musicMedia_url', true);  

                                            $media_uploaded_types = wp_check_filetype($musicMedia_url);

                                            $media_uploaded_type = $media_uploaded_types['type']; 

                                

                                            if( $musicMedia_from == 'media_system' ){

                                                if(  $media_uploaded_type == 'video/x-ms-asf' ||  

                                                    $media_uploaded_type == 'video/x-ms-wmv' || 

                                                    $media_uploaded_type == 'video/x-ms-wmx' || 

                                                    $media_uploaded_type == 'video/x-ms-wm' || 

                                                    $media_uploaded_type == 'video/avi' || 

                                                    $media_uploaded_type == 'video/divx' || 

                                                    $media_uploaded_type == 'video/x-flv' || 

                                                    $media_uploaded_type == 'video/quicktime' || 

                                                    $media_uploaded_type == 'video/mpeg' || 

                                                    $media_uploaded_type == 'video/mp4' || 

                                                    $media_uploaded_type == 'video/ogg' || 

                                                    $media_uploaded_type == 'video/webm' || 

                                                    $media_uploaded_type == 'video/x-matroska' || 

                                                    $media_uploaded_type == 'video/3gpp' || 

                                                    $media_uploaded_type == 'video/3gpp2' ){ ?> 

                                                        <video  width="255" height="170"  controls>

                                                            <source src="<?php echo $musicMedia_url; ?>?autoplay=0" type="<?php echo $media_uploaded_type; ?>">

                                                        </video>            

                                                <?php } elseif ($media_uploaded_type == 'audio/mp3' ||  

                                                    $media_uploaded_type == 'audio/mpeg' || 

                                                    $media_uploaded_type == 'audio/aac' || 

                                                    $media_uploaded_type == 'audio/x-realaudio' || 

                                                    $media_uploaded_type == 'audio/wav' ||  

                                                    $media_uploaded_type == 'audio/ogg' || 

                                                    $media_uploaded_type == 'audio/flac' || 

                                                    $media_uploaded_type == 'audio/midi' || 

                                                    $media_uploaded_type == 'audio/x-ms-wma' || 

                                                    $media_uploaded_type == 'audio/x-ms-wax' || 

                                                    $media_uploaded_type == 'audio/x-matroska' ){ ?> 

                                                        <audio controls class="pt-2"width="255" height="170" >

                                                            <source src="<?php echo $musicMedia_url; ?>"  >

                                                        </audio> 

                                                <?php } elseif ( $media_uploaded_type == 'image/jpeg' || 

                                                    $media_uploaded_type == 'image/gif' || 

                                                    $media_uploaded_type == 'image/png' || 

                                                    $media_uploaded_type == 'image/bmp' || 

                                                    $media_uploaded_type == 'image/tiff' || 

                                                    $media_uploaded_type == 'image/x-icon'  ){ ?> 

                                                        <img id="imageResult" src="<?php echo $musicMedia_url; ?>" alt="" class="img-fluid mx-auto" width="255" height="170" >

                                                <?php }

                                            }elseif( $musicMedia_from == 'youtube' ){  

                                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);

                                                $youtube_id = $match[1];

                                                // echo 'IDD = ' . $youtube_id;

                                                ?>

                                                    <iframe width="255" height="170" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe>

                                            <?php } ?>

                                            <div class="pindex">

                                                <div class="ptitle">

                                                    <a href="<?php the_permalink(); ?>" class="my-0"><h2 class="my-0"><?php the_title(); ?></h2></a>

                                                </div>   

                                            </div>

                                        </div>

                                    <?php endwhile;  

                                    wp_reset_postdata();

                                else:

                                    echo '<h2 class="text-center mt-0 w-100">There is no any Musics </h2>'; 

                                endif;

                                ?>   			

                            </div>    

                        </div> 

                    </div>

                </div>

            </article><!-- .post -->

    <?php }

    }

    ?></div>

</main><!-- #site-content --> 

<?php 

get_footer(); ?>

