<?php
/* Template Name: Winners*/
get_header();
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
$userId = get_current_user_id(); ?>
<main id="site-content" role="main">
    <?php
    // if (have_posts()) {
    //     while (have_posts()) {
    // the_post();  
    ?>
    <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>">
        <div class="post-inner thin">
            <div class="entry-content">
                <div class="container user-profile-musics ">
                    <h1 class="entry-title mb-4">Winners</h1>
 
                    <?php 
                    $args = array( 
                        'post_type' =>  'competition', 
                        'posts_per_page' => -1, 
                        'order'   => 'DESC',
                        'post_status' => 'publish', 
                    );
                    $query = new WP_Query($args);  
                    if($query->have_posts()): 
                        while ($query->have_posts()) : $query->the_post();
                            $competition = $post; ?> 
                            <div class="winner-page-winner-list mb-5">
                                <h4><?php the_title(); ?></h4>
                                <div class="row">
                                    <?php  
                                    $args_video = array( 
                                        'post_type' =>  'competition_video', 
                                        'posts_per_page' => -1, 
                                        // 'order'   => 'DESC',
                                        'meta_key' => 'post_total_points',
                                        'orderby' => 'meta_value_num', 
                                        'post_status' => 'publish',
                                        'meta_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'key'     => 'compVideo_from_competition',
                                                'value'   => $competition->ID,
                                                'compare' => '=',
                                            ),
                                            array(
                                                'key'     => 'post_total_points',
                                                'value'   => 0,
                                                'type'    => 'numeric',
                                                'compare' => '>',
                                            ),
                                        ),
                                    );
                                    $query_video = new WP_Query($args_video);  
                                    $not_duplicate = array();
                                    if($query_video->have_posts()): 
                                        // $i = 1;
                                        while ($query_video->have_posts()) : $query_video->the_post(); 
                                            $author_id = $post->post_author;  
                                            if ( !in_array( $author_id, $not_duplicate ) ) {
                                                $not_duplicate[] = $author_id;  
                                            }
                                            // $competition_video = $post;
                                             
                                            // $points = get_post_meta($competition_video->ID, 'post_total_points', true);
                                            // $author_id=$competition_video->post_author; 
										    // $author_obj = get_user_by('id', $author_id); 
                                            // $post_data = '<a data-authorid="'. $author_id .'" data-totalpoints="'. $points .'" data-postid="' . $competition_video->ID . '" href="' . home_url( '/members/' . bp_core_get_username( $author_id ) . '/profile/' ) .'"><img src="' .esc_url( get_avatar_url( $author_id  )). '"></img></a>';
                                              /* if( $i == 1 ){   ?>
                                                  <div class="col-x-12 col-md-3 d-flex align-items-center first-winner">
                                                     <?php echo  $post_data; ?>
                                                  </div>
                                            <?php   } if( $i >= 2  && $i <= 3) {   
                                            //     echo ( $i == 2  ) ? '<div class="col-x-12 col-md-2 second-third-winner d-flex align-items-center align-self-center">' : '';    
                                            //     echo $post_data;  
                                            //     echo ( $i == 3 ) ? '</div>' : '';
                                            // } if( $i > 3 ) { 
                                            //     echo ( $i == 4  ) ? '<div class="col-x-12 col-md-7 rest-winners d-flex align-items-center ">' : '';  
                                            //     echo $post_data;  
                                            //     echo ( $i == 10 ) ? '</div>' : '';
                                            // } 
                                            // $i++; */
                                        endwhile;  
                                    endif;
                                    
                                    // echo '<pre>'; 
                                    // print_r($not_duplicate);
                                    // echo '</pre>';
                                    if($not_duplicate ) { 
                                        $i = 1;
                                        foreach($not_duplicate as $key => $value){  
                                            if($key <= 9){ 
                                                $post_data = '<a data-authorid="'. $value .'"  href="' . home_url( '/members/' . bp_core_get_username( $value ) . '/profile/' ) .'"><img src="' .esc_url( get_avatar_url( $value  )). '"></img></a>';
                                                if( $i == 1 ){   ?>
                                                    <div class="col-x-12 col-md-3 d-flex align-items-center first-winner">
                                                        <?php echo  $post_data; ?>
                                                    </div>
                                                <?php   } if( $i >= 2  && $i <= 3) {   
                                                    echo ( $i == 2  ) ? '<div class="col-x-12 col-md-2 second-third-winner d-flex align-items-center align-self-center">' : '';    
                                                    echo $post_data;  
                                                    echo ( $i == 3 ) ? '</div>' : '';
                                                } if( $i > 3 ) { 
                                                    echo ( $i == 4  ) ? '<div class="col-x-12 col-md-7 rest-winners d-flex align-items-center ">' : '';  
                                                    echo $post_data;  
                                                    echo ( $i == 10 ) ? '</div>' : '';
                                                }
                                            }
                                            $i++;
                                        }
                                    }else{
                                        echo '<div class="col-md-12"><h6>There are currently no winners</h6></div>';
                                    }
                                    ?>     
                                </div>
                            </div>     
                        <?php 
                        endwhile; 
                    else:
                        echo "There is no Winners.";
                    endif;   ?>   
 
                </div>
            </div>
        </div>
    </article><!-- .post -->
    <?php // }
    //} 
    ?>
</main><!-- #site-content -->
<?php get_footer(); ?>