<?php
/**
 * Template Name: Trends Cont'd
 */
get_header();
 
?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) {
        $i = 0;
        while (have_posts()) {
            $i++;
            if ($i > 1) {
                echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
            }
            the_post();  ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                <!-- Yash Code --> 
                <div class="container singing-content my-5">
                    <div class="row">
                        <div class="col-lg-3 col-xs-12 tends">
                            <h4 class="my-4 trends-title"><?php the_field('left_side_title'); ?></h4>
                            <ul class="m-0">
                                <li>
                                    <p> Mack 1,00,00,000 Trends</p>
                                </li>
                                <li>
                                    <p> Mack 1,00,00,000 Trends</p>
                                </li>
                                <li>
                                    <p> Mack 1,00,00,000 Trends</p>
                                </li>
                                <li>
                                    <p> Mack 1,00,00,000 Trends</p>
                                </li>
                                <li>
                                    <p> Mack 1,00,00,000 Trends</p>
                                </li>
                                <li>
                                    <p> Mack 1,00,00,000 Trends</p>
                                </li>
                            </ul> 
                        </div>

                        <div class="col-lg-6 col-xs-12 upload-video for-trends-page">
                            <div class="trends-search">
                                <form>
                                <input type="text" placeholder="Search.." name="search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
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

                <?php $music_terms = get_terms( array(
                    'taxonomy' => 'music_category',
                    'hide_empty' => false
                ) ); ?>
                <div class="trends-detail-page-categories for-desktop">
                    <div class="container">
                        <div class="row">
                            <?php if ( !empty($music_terms) ) { ?>
                                <div class="col-lg-12 d-flex trends-coutd-videos"> 
                                    <?php 
                                    foreach( $music_terms as $music_term ) {  
                                        
                                        $args_music =  array(
                                            'post_type' => 'music',
                                            'meta_key' => 'post_views_count',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' => -1, 
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
                                                // array(
                                                //     'before' => '4 weeks ago',
                                                //     'after' => '-3 weeks ago'
                                                // ),
                                                array(
                                                    'year' => date( 'Y' ),
                                                    'week' => date( 'W' ) -3,
                                                ),
                                                // 'relation'   => 'BETWEEN',
                                                // array(
                                                //     'before'      => '3 weeks ago',
                                                //     'after'      => '4 weeks ago',
                                                //     'relation' => 'BETWEEN'
 
                                                //     // 'compare'   => '>=',
                                                // ),
                                                // array(
                                                   
                                                //     // 'compare'   => '<=',
                                                // ),
                                                // array(
                                                //     'dayofweek' => array( 1, 7),
                                                //     'compare'   => 'BETWEEN',
                                                // ),
                                            ),
                                        ); 
                                        
                                        $query_music = new WP_Query( $args_music );
                                        // echo '<pre>';
                                        // print_r( $query_music);
                                        // echo '</pre>';
                                        if ($query_music->have_posts()) :
                                            while ($query_music->have_posts()) : $query_music->the_post();  
                                                echo '<pre>';
                                                print_r(the_title());
                                                echo '</pre>'; 
                                            endwhile;
                                            wp_reset_postdata();  
                                        endif;
                                        die;
                                        ?> 


                                        <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>">
                                            <h3><?php echo $music_term->name; ?></h3>
                                            <ul class="m-0 cat-music-list">
                                                <?php 
                                                $args_music =  array(
                                                    'post_type' => 'music',
                                                    'meta_key' => 'post_views_count',
                                                    'orderby' => 'meta_value_num',
                                                    'posts_per_page' => -1, 
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
                                                            'before' => '4 weeks ago',
                                                            'after' => '-3 weeks ago'
                                                        ),
                                                    ),
                                                ); 
                                                $query_music = new WP_Query( $args_music );
                                                echo '<pre>';
                                                print_r($query_music);
                                                echo '</pre>'; die;
                                                if ($query_music->have_posts()) :
                                                    while ($query_music->have_posts()) : $query_music->the_post();  ?>
                                                        <li class="post-<?php the_ID(); ?>">
                                                            <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>     -->
                                                            <a class="text-center text-dark d-block" href="<?php echo get_the_permalink(); ?>">
                                                                <?php 
                                                                    $title = get_the_title();
                                                                    $max = 30;
                                                                    if( strlen( $title ) > $max ) {
                                                                        echo substr( $title, 0, $max ). " &hellip;";
                                                                    } else {
                                                                        echo $title;
                                                                    } 
                                                                ?>
                                                            </a> 
                                                            <?php
                                                            $musicMedia_from = get_post_meta(get_the_ID(), 'musicMedia_from', true);  
                                                            $musicMedia_url = get_post_meta(get_the_ID(), 'musicMedia_url', true);  
                                                            $media_uploaded_types = wp_check_filetype($musicMedia_url);
                                                            $media_uploaded_type = $media_uploaded_types['type']; 
                                                        
                                                           /* if( $musicMedia_from == 'media_system' ){
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
                                                                    
                                                                    <video controls>
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
                                                                    <img id="imageResult" src="<?php echo $musicMedia_url; ?>" alt="" class="img-fluid mx-auto" >
                                                                <?php }
                                                            }elseif( $musicMedia_from == 'youtube' ){ 
                                                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);
                                                                $youtube_id = $match[1]; ?>
                                                                <iframe  src="http://www.youtube.com/embed/<?php echo $youtube_id; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe>
                                                            <?php } */ ?>  
                                                        </li>
                                                    <?php  
                                                    endwhile;
                                                    wp_reset_postdata(); 
                                                else:
                                                    echo '<h5 class="text-center mt-5 pt-3">No Music Found</h5>';
                                                endif; ?> 
                                            </ul>
                                            </div>
                                             
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div> 
                <?php /* 
                <div class="trends-detail-page-categories for-desktop">
                    <div class="container">
                        <div class="row">
                            <?php if ( !empty($music_terms) ) { ?>
                                <div class="col-lg-12 d-flex trends-coutd-videos"> 
                                    <?php 
                                    foreach( $music_terms as $music_term ) { 
                                        $args_music =  array(
                                            'post_type' => 'music',
                                            'meta_key' => 'post_views_count',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' => -1, 
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
                                                    // 'column' => 'post_date',
                                                    'after' => '1 week ago'
                                                ),
                                            ),
                                        ); 
                                        $query_music = new WP_Query( $args_music );
                                      
                                        if ($query_music->have_posts()) :
                                            while ($query_music->have_posts()) : $query_music->the_post(); 

                                            echo '<pre>';
                                            print_r(the_ID());
                                            echo '</pre>';
                                        endwhile;
                                        wp_reset_postdata();  
                                    endif; 
                                    die;?>
                                            
                                        <div class="trend-detail-trending-video <?php echo $music_term->slug; ?>">
                                            <h3><?php echo $music_term->name; ?></h3>
                                            <ul class="m-0 cat-music-list">
                                                <?php 
                                                $args_music =  array(
                                                    'post_type' => 'music',
                                                    'meta_key' => 'post_views_count',
                                                    'orderby' => 'meta_value_num',
                                                    'posts_per_page' => -1, 
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
                                                            'after' => '2 weeks ago'
                                                        ),
                                                    ),
                                                ); 
                                                $query_music = new WP_Query( $args_music );
                                                echo '<pre>';
                                                print_r($query_music);
                                                echo '</pre>'; die;
                                                if ($query_music->have_posts()) :
                                                    while ($query_music->have_posts()) : $query_music->the_post();  ?>
                                                        <li class="post-<?php the_ID(); ?>">
                                                            <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>     -->
                                                            <a class="text-center text-dark d-block" href="<?php echo get_the_permalink(); ?>">
                                                                <?php 
                                                                    $title = get_the_title();
                                                                    $max = 30;
                                                                    if( strlen( $title ) > $max ) {
                                                                        echo substr( $title, 0, $max ). " &hellip;";
                                                                    } else {
                                                                        echo $title;
                                                                    } 
                                                                ?>
                                                            </a> 
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
                                                                    
                                                                    <video controls>
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
                                                                    <img id="imageResult" src="<?php echo $musicMedia_url; ?>" alt="" class="img-fluid mx-auto" >
                                                                <?php }
                                                            }elseif( $musicMedia_from == 'youtube' ){ 
                                                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);
                                                                $youtube_id = $match[1]; ?>
                                                                <iframe  src="http://www.youtube.com/embed/<?php echo $youtube_id; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe>
                                                            <?php } ?> 

                                                        </li>
                                                    <?php  
                                                    endwhile;
                                                    wp_reset_postdata(); 
                                                else:
                                                    echo '<h5 class="text-center mt-5 pt-3">No Music Found</h5>';
                                                endif; ?> 
                                            </ul>
                                        </div>
                                        
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div> 
                  */ ?> 
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content --> 
<?php get_footer(); ?>
