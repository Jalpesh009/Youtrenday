<?php
/**
 * Template Name: Trends Cont'd
 */
get_header();
 
?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) { 
        while (have_posts()) { 
            the_post();  ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                <!-- Yash Code --> 
                <div class="container singing-content my-5">
                    <div class="row">
                        <div class="col-lg-3 col-xs-12 tends">
                            <h4 class="my-4 trends-title"><?php the_field('left_side_title'); ?></h4>
                            <ul class="m-0">
                                <?php 
                                $args_video = array( 
                                    'post_type' => array('music', 'competition' ), 
                                    'posts_per_page' => 5, 
                                    'order'   => 'DESC', 
                                    'orderby' => 'ID', 
                                    'post_status' => 'publish',  
                                    'date_query' => array(   
                                        array(
                                            'after'     => array(
                                                'year'  => date("Y"),
                                                'month' => date("m") - 1,
                                                'day'   => 1,
                                            ), 
                                            'before'    => array(
                                                'year'  => date("Y"),
                                                'month' => date("m") - 1,
                                                'day'   => date("t"),
                                            ),
                                            'inclusive' => true,
                                        ), 
                                    ),
                                );
                                $query_video = new WP_Query($args_video);   
                                if($query_video->have_posts()): 
                                    $i = 1;
                                    while ($query_video->have_posts()) : $query_video->the_post(); 
                                        $author_id = $post->post_author; 
                                        $author_obj = get_user_by('id', $author_id);
                                        // echo '<pre>';
                                        // print_r($author_obj->data->display_name );
                                        // echo '</pre>';  ?>
                                        <li class="leader-board-li post-<?php the_ID(); ?>">
                                            <p><a href="<?php echo home_url( '/members/' . bp_core_get_username( $author_id ) . '/profile/' ); ?>"><?php echo ucfirst($author_obj->data->display_name); ?></a></p>
                                        </li>
                                        <?php 
                                    endwhile; 
                                    // wp_reset_query();
                                endif; ?>
                            </ul> 
                        </div>

                        <div class="col-lg-6 col-xs-12 upload-video for-trends-page">
                            <div class="trends-search">
                                <form>
                                    <input type="text" placeholder="Search.." name="search">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form> 
                            </div> 
                            <?php 
                        $args =  array(
                            'post_type' => 'music',
                            'meta_key' => 'post_views_count',
                            'orderby' => 'meta_value_num',
                            'posts_per_page' =>1, 
                            // 'order' => 'DESC',
                        );
                        $query = new WP_Query( $args );
                        if ($query->have_posts()) { 
                            while ($query->have_posts()) : $query->the_post(); ?> 
                                <div class="single-music py-2">
                                     
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
                                            <video class="sfv_videos " width="100%" height="400" controls>
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
                                            <audio controls class="pt-2">
                                                <source src="<?php echo $musicMedia_url; ?>"  >
                                            </audio> 
                                        <?php } elseif ( $media_uploaded_type == 'image/jpeg' || 
                                                        $media_uploaded_type == 'image/gif' || 
                                                        $media_uploaded_type == 'image/png' || 
                                                        $media_uploaded_type == 'image/bmp' || 
                                                        $media_uploaded_type == 'image/tiff' || 
                                                        $media_uploaded_type == 'image/x-icon'  ){ ?> 
                                            <img id="imageResult" src="<?php echo $musicMedia_url; ?>" alt="" class="img-fluid d-block mx-auto pt-2" >
                                       <?php }
                                    }elseif( $musicMedia_from == 'youtube'  ){  
                                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);
                                        $youtube_id = $match[1]; ?>  
                                        <iframe class="sfv_videos " width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe>
                                       
                                    <?php }elseif( $musicMedia_from == 'soundcloud'  ){ ?> 
                                        <div class="embed-responsive">   
                                            <?php echo do_shortcode("[soundcloud url=". $musicMedia_url ." width='100%'  iframe='true' /]"); ?>    
                                        </div>  
                                   <?php } elseif( $musicMedia_from == 'spotify' ){ ?>
                                    <?php  
                                        $str = '';
                                        if(strpos($musicMedia_url, '/album/') !== false){
                                            $str = str_replace("/album/","/embed/album/",$musicMedia_url); 
                                        }  else if(strpos($musicMedia_url, '/embed/track/') !== false){
                                            $str =  $musicMedia_url ; 
                                        }  else if(strpos($musicMedia_url, '/playlist/') !== false){
                                            $str = str_replace("/playlist/","/embed/playlist/",$musicMedia_url); 
                                        } else if(strpos($musicMedia_url, '/track/') !== false){  
                                            $str = str_replace("/track/","/embed/track/",$musicMedia_url); 
                                        }
                                        ?>
                                        <div class="embed-responsive embed-responsive-16by9">   
                                            <iframe class="embed-responsive-item" width="100%" height="400" src="<?php  echo $str; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe>  
                                        </div> 
                                    <?php }   ?>
                                </div> 
                            <?php endwhile;
                            wp_reset_postdata(); 
                        } ?>
                        </div> 
                        <div class="col-lg-3 col-xs-12 upload-self pb-4">
                            <h4 class="my-4 trends-title"><?php echo get_field('right_side_title'); ?></h4>
                            <?php  
                            global $wpdb; 
                            $wp_user_search = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users ORDER BY ID"); 
                            $adminArray = array(); 
                            foreach ( $wp_user_search as $userid ) {
                                $curID = $userid->ID;
                                $curuser = get_userdata($curID);
                                $user_level = $curuser->user_level;
                                if($user_level >= 8){
                                    $adminArray[] = $curID;
                                }
                            }
                            $upload_sponsored_video = get_field('upload_sponsored_video', 'user_'.$adminArray[0]);
                            
                            if($upload_sponsored_video['type'] == 'video') { ?> 
                                <video width="560" height="200" controls>
                                    <source src="<?php echo $upload_sponsored_video['url']; ?>?autoplay=0" >
                                </video>     
                            <?php }elseif ($upload_sponsored_video['type'] == 'audio') { ?>
                                <audio controls class="mt-4">
                                    <source src="<?php echo $upload_sponsored_video['url']; ?>" type="audio/mpeg">
                                </audio> 
                            <?php }elseif ($upload_sponsored_video['type'] == 'image') { ?>
                                <img src="<?php echo $upload_sponsored_video['url']; ?>" >
                            <?php } ?>     
                        </div>
                    </div> 
                </div> 

                <?php 
                $total_music_terms = get_terms( array(
                    'taxonomy' => 'music_category',
                    'hide_empty' => false,  
                ) );
                $music_terms = get_terms( array(
                    'taxonomy' => 'music_category',
                    'hide_empty' => false,  
                    'number' => 4
                ) ); ?>
                <div class="trends-detail-page-categories for-desktop">
                    <div class="container">
                        <div class="musics-data-row">
                            <?php  $musctax_arr = []; 
                            if ( !empty($music_terms) ) { ?>
                                <div class="musics-data" id="week_4_0">  
                                    <?php  
                                    foreach( $music_terms as $music_term ) {  
                                        $musctax_arr[] =  $music_term->term_id;
                                        $args_music =  array(
                                            'post_type' => 'music',
                                            'meta_key' => 'post_views_count',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' => 1, 
                                            'order' => 'DESC', 
                                            'post_status' => 'publish',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'music_category',
                                                    'field'    => 'term_id',
                                                    'terms'    => $music_term->term_id,
                                                ),
                                            ), 
                                            'date_query' => array( 
                                                array(
                                                    'year' => date( 'Y' ),
                                                    'week' => date( 'W' ) - 4,
                                                ), 
                                            ),
                                        ); 
                                        $query_music = new WP_Query( $args_music ); 
                                        if ($query_music->have_posts()) :
                                           
                                            while ($query_music->have_posts()) :                    
                                                $query_music->the_post();  ?> 
                                                <div class="trends-coutd-videos" id="<?php echo $music_term->term_id; ?>">   
                                                    <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>">
                                                        <h3><?php echo $music_term->name; ?></h3>
                                                        <ul class="m-0"> 
                                                            <li class="post-<?php the_ID(); ?>">  
                                                                <?php echo get_media_music_html(get_the_ID() ); ?>
                                                            </li> 
                                                        </ul>
                                                    </div> 
                                                </div>
                                                <?php   
                                               
                                            endwhile;
                                            wp_reset_postdata(); 
                                        else: ?>
                                            <div class="trends-coutd-videos">   
                                                <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>">
                                                    <h3><?php echo $music_term->name; ?></h3>
                                                    <ul class="m-0"> 
                                                        <li class="no-post d-flex" >
                                                            <div class="cat-music-list">
                                                                <h5 class="text-center mt-5 pt-4 w-100">No Music Found</h5>
                                                            </div> 
                                                        </li>
                                                    </ul>    
                                                </div> 
                                            </div> 
                                            <?php 
                                        endif;  
                                       
                                    }  ?>
                                </div>
                                <div class="musics-data" id="week_3_0">  
                                    <?php  
                                    foreach( $music_terms as $music_term ) { 
                                        $args_music =  array(
                                            'post_type' => 'music',
                                            'meta_key' => 'post_views_count',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' => 1, 
                                            'order' => 'DESC', 
                                            'post_status' => 'publish',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'music_category',
                                                    'field'    => 'term_id',
                                                    'terms'    => $music_term->term_id,
                                                ),
                                            ), 
                                            'date_query' => array( 
                                                array(
                                                    'year' => date( 'Y' ),
                                                    'week' => date( 'W' ) - 3,
                                                ), 
                                            ),
                                        ); 
                                        $query_music = new WP_Query( $args_music ); 
                                        if ($query_music->have_posts()) :
                                           
                                            while ($query_music->have_posts()) :                    
                                                $query_music->the_post();  ?> 
                                                <div class="trends-coutd-videos">   
                                                    <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>"> 
                                                        <ul class="m-0"> 
                                                            <li class="post-<?php the_ID(); ?>"> 
                                                                <?php echo get_media_music_html(get_the_ID()); ?>
                                                            </li> 
                                                        </ul>
                                                    </div> 
                                                </div>
                                                <?php   
                                               
                                            endwhile;
                                            wp_reset_postdata(); 
                                        else: ?>
                                            <div class="trends-coutd-videos">   
                                                <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>"> 
                                                    <ul class="m-0"> 
                                                        <li class="no-post d-flex" >
                                                            <div class="cat-music-list">
                                                                <h5 class="text-center mt-5 pt-4 w-100">No Music Found</h5>
                                                            </div> 
                                                        </li>
                                                    </ul>    
                                                </div> 
                                            </div> 
                                            <?php 
                                        endif;  
                                         
                                    } ?>
                                </div> 
                                <div class="musics-data" id="week_2_0">  
                                    <?php  
                                    foreach( $music_terms as $music_term ) { 
                                        $args_music =  array(
                                            'post_type' => 'music',
                                            'meta_key' => 'post_views_count',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' => 1, 
                                            'order' => 'DESC', 
                                            'post_status' => 'publish',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'music_category',
                                                    'field'    => 'term_id',
                                                    'terms'    => $music_term->term_id,
                                                ),
                                            ), 
                                            'date_query' => array( 
                                                array(
                                                    'year' => date( 'Y' ),
                                                    'week' => date( 'W' ) - 2,
                                                ), 
                                            ),
                                        ); 
                                        $query_music = new WP_Query( $args_music ); 
                                        if ($query_music->have_posts()) :
                                           
                                            while ($query_music->have_posts()) :                    
                                                $query_music->the_post();  ?> 
                                                <div class="trends-coutd-videos">   
                                                    <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>"> 
                                                        <ul class="m-0"> 
                                                            <li class="post-<?php the_ID(); ?>"> 
                                                                <?php echo get_media_music_html(get_the_ID()); ?>
                                                            </li> 
                                                        </ul>
                                                    </div> 
                                                </div>
                                                <?php   
                                               
                                            endwhile;
                                            wp_reset_postdata(); 
                                        else: ?>
                                            <div class="trends-coutd-videos">   
                                                <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>"> 
                                                    <ul class="m-0"> 
                                                        <li class="no-post d-flex" >
                                                            <div class="cat-music-list">
                                                                <h5 class="text-center mt-5 pt-4 w-100">No Music Found</h5>
                                                            </div> 
                                                        </li>
                                                    </ul>    
                                                </div> 
                                            </div> 
                                            <?php 
                                        endif;   
                                    } ?>
                                </div> 
                                <div class="musics-data" id="week_1_0">  
                                    <?php  
                                    foreach( $music_terms as $music_term ) { 
                                        $args_music =  array(
                                            'post_type' => 'music',
                                            'meta_key' => 'post_views_count',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' => 1, 
                                            'order' => 'DESC', 
                                            'post_status' => 'publish',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'music_category',
                                                    'field'    => 'term_id',
                                                    'terms'    => $music_term->term_id,
                                                ),
                                            ), 
                                            'date_query' => array( 
                                                array(
                                                    'year' => date( 'Y' ),
                                                    'week' => date( 'W' ) - 1,
                                                ), 
                                            ),
                                        ); 
                                        $query_music = new WP_Query( $args_music ); 
                                        if ($query_music->have_posts()) :
                                           
                                            while ($query_music->have_posts()) :                    
                                                $query_music->the_post();  ?> 
                                                <div class="trends-coutd-videos">   
                                                    <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>"> 
                                                        <ul class="m-0"> 
                                                            <li class="post-<?php the_ID(); ?>"> 
                                                                <?php echo get_media_music_html(get_the_ID()); ?>
                                                            </li> 
                                                        </ul>
                                                    </div> 
                                                </div>
                                                <?php   
                                               
                                            endwhile;
                                            wp_reset_postdata(); 
                                        else: ?>
                                            <div class="trends-coutd-videos">   
                                                <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>"> 
                                                    <ul class="m-0"> 
                                                        <li class="no-post d-flex" >
                                                            <div class="cat-music-list">
                                                                <h5 class="text-center mt-5 pt-4 w-100">No Music Found</h5>
                                                            </div> 
                                                        </li>
                                                    </ul>    
                                                </div> 
                                            </div> 
                                            <?php 
                                        endif;   
                                    } ?>
                                </div> 
                            <?php } ?>
                            <input type="hidden" class="musc_arr" name="musc_arr" value="<?php echo implode(",", $musctax_arr); ?>">
                        </div> 
                        <div class="musics-data-row" id="ajax_musCat"></div>
                        <?php  $total_music_tax = sizeof($total_music_terms);  ?>
                        <span class="d-none total_cats"><?php echo $total_music_tax; ?></span>
                        <?php if ( $total_music_tax > 4 ){ ?>
                            <div class="row home-page w-100 my-5"> 
                                <div class="blog-design mx-auto text-center"> 
                                    <button class="more-blogs px-5 py-3 load_musCat" id="load_more_categories" > <i class="fa fa-plus text-danger" aria-hidden="true"></i> </button>
                                </div>
                            </div> 
                        <?php } ?>
                        
                    </div>
                </div> 
                
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content --> 
<?php get_footer(); ?>
