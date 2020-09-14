<?php
/* Template Name: Loggedin Home*/
get_header();
if (!is_user_logged_in()) {
    wp_redirect( site_url('/')  );
    exit;
}
$userId = get_current_user_id(); 
$args_comp_videos = array(
    'post_type'  => 'competition',
    'order'  => 'DESC', 
    'orderby' => 'ID',
    'posts_per_page'  => 2,  
    'tax_query' => array( 
        array(
            'taxonomy' => 'competition_status',
            'field'    => 'slug',
            'terms'    => 'voting', 
        ),
    ),
);
$query_comp_videos = new WP_Query($args_comp_videos);  
// echo '<pre>';
// print_r($query_comp_videos);
// echo '</pre>';
?>
<main id="site-content" role="main"> 
    <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>">
        <div class="post-inner thin">
            <div class="entry-content">
                <div class="container user-profile-musics ">

                    <div class="row"> 
                        <div class="col-md-8 main all_Datas ">
                            <?php 
                            $video_tab = '';
                            $videoactive = '';
                            $allpostactive = '';
                            $data_toggle = '';
                            if($query_comp_videos->found_posts > 0){
                                $video_tab = '<li >
                                    <a href="#competition_videos" data-toggle="tab" class="paid_videos active" >Competition Videos </a>
                                </li>';
                                $videoactive = 'active ';
                                $allpostactive = '';
                            }else{
                                $videoactive = '';
                                $allpostactive = ' active';
                            } ?>
                            <ul class="nav nav-tabs profile-musics-tab home_tabs ml-0"> 
                                <li>
                                    <a href="#all_posts" data-toggle="tab" class="all_user_posts<?php echo $allpostactive;?>">All Posts</a>
                                </li>
                                <?php echo  $video_tab;?>
                            </ul>
                        
                            <div class="tab-content main_all_posts mt-4">   
                                <div id="all_posts" class="tab-pane  <?php echo  $allpostactive;?> mt-0">
                                    <?php 
                                    ?>
                                    <div class="row mt-0">
                                        <?php 
                                        $args_all_posts = array( 
                                            'post_type' => array('music', 'competition'), 
                                            'posts_per_page' => 2, 
                                            'order'   => 'DESC',
                                            'orderby' => 'ID',
                                            'post_status' => 'publish',
                                            'tax_query' => array(
                                                'relation' => 'OR',
                                                array(
                                                    'taxonomy' => 'competition_status',
                                                    'field'    => 'slug',
                                                    'terms'    => 'expired'
                                                ),
                                                array(
                                                    'taxonomy' => 'music_category', # default post category
                                                    'operator' => 'EXISTS'
                                                )
                                            )
                                        );
                                        $query_all_posts = new WP_Query($args_all_posts);   
                                        if($query_all_posts->have_posts()): 
                                            while ($query_all_posts->have_posts()) : $query_all_posts->the_post();  ?>
                                                 <div class="col-md-6 main_videos home_post">  
                                                    <?php echo show_home_postsdata( get_the_ID()); ?>
                                                </div>   
                                            <?php 
                                            endwhile;
                                            wp_reset_postdata(); 
                                        else: 
                                            echo '<h4 class="mt-0 w-100">There are currently no posts</h4>';
                                        endif; ?>       
                                    </div>
                                    <span class="d-none total_all_posts"><?php echo $query_all_posts->found_posts; ?></span>
                                    <div class="row ajax_allposts_home mb-5" id="ajax_allposts_home"></div>
                                    <div class=" justify-content-center all_post_loader d-none">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div> 
                                <div id="competition_videos" class="tab-pane <?php echo  $videoactive;?>  mt-0">
                                    
                                    <div class="row mt-0">
                                        <?php 
                                        $args_comp_videos = array(
                                            'post_type'  => 'competition_video',
                                            'order'  => 'DESC', 
                                            'orderby' => 'ID',
                                            'posts_per_page'  => 2,  
                                            'tax_query' => array( 
                                                array(
                                                    'taxonomy' => 'competitionvideo_status',
                                                    'field'    => 'slug',
                                                    'terms'    => 'voting', 
                                                ),
                                            ),
                                        );
                                        $query_comp_videos = new WP_Query($args_comp_videos);  
                                        if($query_comp_videos->have_posts()): 
                                            while ($query_comp_videos->have_posts()) : $query_comp_videos->the_post(); ?>
                                                <div class="col-md-6 main_videos home_video"> 
                                                    <?php echo show_home_postsdata( get_the_ID()); ?>
                                                </div>   
                                            <?php 
                                            endwhile;
                                            wp_reset_postdata(); 
                                        else: 
                                            echo '<h4 class="mt-0 w-100">There are currently no posts</h4>';
                                        endif;  ?>                                    
                                    </div>
                                    <span class="d-none total_comp_videos"><?php echo $query_comp_videos->found_posts; ?></span>
                                    <div class="row ajax_compvideos mb-5" id="ajax_compvideos"></div>
                                    <div class=" justify-content-center video_loader d-none">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div> 
                        <div class="col-md-4 sidebar mt-2 home-comp-details" id="home-comp-details">
                            
                            <?php  
                            $args_next_comp = array( 
                                'post_type' => 'competition', 
                                'posts_per_page' => 1, 
                                // 'order'   => 'DESC',
                                'meta_key' => 'comp_start_date',
                                'orderby' => 'meta_value_num',
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    'relation' => 'OR',
                                    array(
                                        'taxonomy' => 'competition_status',
                                        'field'    => 'slug',
                                        'terms'    => 'future',
                                    ),
                                    array(
                                        'taxonomy' => 'competition_status',
                                        'field'    => 'slug',
                                        'terms'    => 'running', 
                                    ),
                                    array(
                                        'taxonomy' => 'competition_status',
                                        'field'    => 'slug',
                                        'terms'    => 'voting', 
                                    ),
                                ),
                            );
                            $query_next_comp = new WP_Query($args_next_comp);  
// echo '<pre>';
// print_r($query_next_comp);
// echo '</pre>';
                            if($query_next_comp->have_posts()):  
                                $i=0;
                                while ($query_next_comp->have_posts()) : $query_next_comp->the_post(); 
                                    if( $i == 0 ){ 
                                        $comp_start_date =  get_field('comp_start_date', get_the_ID()) ;
                                        $comp_start_date1 = date_create( $comp_start_date);
                                        $counter_startdate = date_format($comp_start_date1,"F j, Y H:i:s");   

                                        $comp_end_date = get_field('comp_end_date', get_the_ID());                                               
                                        $comp_end_date1 = date_create( $comp_end_date);
                                        $counter_enddate = date_format($comp_end_date1,"F j, Y H:i:s");   

                                        $comp_voting_date = get_field('comp_voting_date', get_the_ID());                                         
                                        $comp_voting_date1 = date_create( $comp_voting_date);
                                        $comp_votingdate = date_format($comp_voting_date1,"F j, Y H:i:s");   

                                        $date_now = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) ); 
                                        // $date_now1 = date_create( $date_now);
                                        // $current_now = date_format($date_now1,"F j, Y H:i:s");   
                                        if(  $date_now <= $comp_voting_date  ){  ?> 
                                            <div class="upcoming-comp bg-light common_sidebar_cls">
                                                <h4>Next Weeks Competition</h4>
                                                <a href="<?php echo site_url('competition-detail'); ?>" class="join-now text-white d-inline-block for-button-style">Join Now</a>
                                                <div class="next_week_comp">
                                                    <?php  if(  $date_now >= $comp_start_date &&  $date_now <= $comp_end_date){  ?>
                                                        <p> Registration Ends - Voting Starts </p> 
                                                        <script>
                                                            jQuery(document).ready(function ($){  
                                                                countDownTimer("<?php echo $counter_enddate; ?>" );  
                                                            }) ;
                                                        </script>
                                                    <?php } else if(  $date_now <= $comp_start_date   ){ ?>
                                                        <p> Starts in </p> 
                                                        <script>
                                                            jQuery(document).ready(function ($){  
                                                                countDownTimer("<?php echo $counter_startdate; ?>" );  
                                                            }) ;
                                                        </script>
                                                    <?php }  else if(  $date_now >= $comp_end_date  ){ ?>
                                                        <p> Winner picked – Registration begins </p> 
                                                        <script>
                                                            jQuery(document).ready(function ($){  
                                                                countDownTimer("<?php echo $comp_votingdate; ?>" );  
                                                            }) ;
                                                        </script>
                                                    <?php }   ?>
                                                    <div class=" countDown d-none" id="countDown_homePage"> </div> 
                                                </div>
                                            
                                            </div>
                                            <?php 
                                        } 
                                    }
                                    $i++;
                                endwhile;
                                wp_reset_postdata(); 
                            endif;  ?>
                            
                            <?php 
                            if( have_rows('home_sidebar_options') ): 
                                while ( have_rows('home_sidebar_options') ) : the_row(); 
                                    $prizes_description = get_sub_field('prizes_description'); 
                                    $past_winner_text = get_sub_field('past_winner_text');  ?> 
                                    <div class="prize bg-light common_sidebar_cls">
                                        <h4>Prizes</h4>
                                        <p><?php echo $prizes_description; ?></p>
                                    </div>
                                  
                                    <?php  
                                    // $user_arr = array();
                                    $args = array( 
                                        'post_type' =>  'competition', 
                                        'posts_per_page' => 1, 
                                        'order'   => 'DESC',
                                        'post_status' => 'publish',
                                        'tax_query' => array( 
                                            array(
                                                'taxonomy' => 'competition_status',
                                                'field'    => 'slug',
                                                'terms'    => 'expired'
                                            ), 
                                        )
                                    );
                                    $query = new WP_Query($args);  
                                    if($query->have_posts()): 
                                        while ($query->have_posts()) : $query->the_post(); 
                                            $competition = $post; 
                     
                                            $args_video = array( 
                                                'post_type' =>  'competition_video', 
                                                'posts_per_page' => 1, 
                                                // 'order'   => 'DESC',
                                                'meta_key' => 'post_total_points',
                                                'orderby' => 'meta_value_num',
                                                'orderby'   => 'meta_value_num', 
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
                                            if($query_video->have_posts()): 
                                                $i = 1;
                                                while ($query_video->have_posts()) : $query_video->the_post(); 
                                                    $competition_video = $post;
                                                    // echo $post->ID;
                                                    // $user_arr[] = $competition_video->post_author;
                                                    $user_id = $competition_video->post_author; 
                                                    $userData = get_userdata($user_id );
                                                    $user_gender = BP_XProfile_ProfileData::get_value_byid( 15, $user_id );
                                                    $username = ucwords($userData->display_name);
                                                    
                                                    if($user_gender == "Male"){ 
                                                        $u_heshe = "He";
                                                        $u_hisher = "his";
                                                        $u_himher = "him"; 
                                                    }else if($user_gender == "Female"){ 
                                                        $u_heshe = "She";
                                                        $u_hisher = "her";
                                                        $u_himher = "her";
                                                    } 
                                                    $past_winner_text = str_replace("{winner_name}",$username, $past_winner_text); 
                                                    $past_winner_text = str_replace("{winner_his_her}",$u_hisher, $past_winner_text); 
                                                    $past_winner_text = str_replace("{winner_he_she}",$u_heshe, $past_winner_text); 
                                                    $past_winner_text = str_replace("{winner_him_her}",$u_himher, $past_winner_text); ?>
                                                    <div class="past-winner-firstSection bg-light common_sidebar_cls">
                                                    <h4>Past Winner</h4>
                                                    <div class="past_winner_first d-inline">
                                                        <div class="winner_imag_info_first d-inline-block"> 
                                                            <img src="<?php echo esc_url( get_avatar_url( $user_id  )); ?>">
                                                            <div class="winner_info_first"> 
                                                                <p><?php  echo $past_winner_text; ?></p>  
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            <?php endwhile; 
                                            
                                            endif;
                                        endwhile;  
                                        wp_reset_postdata(); 
                                    endif;    
                                 endwhile; 
                            endif; ?> 
                                    
                            <!-- <div class="past-winner-section bg-light common_sidebar_cls"> 
                                <div class="past-winner d-inline">
                                    <div class="winner_imag_info d-inline-block">
                                        <img src="https://dev.youtrenday.com/wp-content/uploads/2020/06/11591015431760.jpg">
                                        <div class="winner-info">
                                            <h5> Alexendra beck </h5>
                                            <p>this will be where the winner of the last competition will be. the last competition will be </p> 
                                            <p>this will be where the winner of the last competition will be. the last competition will be</p>
                                        </div>
                                    </div>
                                    <div class="past-winner-social"> 
                                        <ul>
                                            <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i> youtrenday</a></li>
                                            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i> youtrenday</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> youtrenday</a></li>
                                            <li><a href="#"><i class="fa fa-spotify" aria-hidden="true"></i> youtrenday</a></li>
                                        </ul> 
                                    </div>
                                </div>
                            </div> -->
                        </div>  
                    </div>
                        
                </div>
            </div>
    </article><!-- .post -->
    
    <div class="modal fade share_post_modal" id="share_post_modal" tabindex="-1" role="dialog" aria-labelledby="modal_sharepost_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content py-0"> 
                <div class="modal-header px-0">
                    <h5 class="modal-title m-0" id="modal_sharepost_label">Share with</h5>
                    <button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body px-0">   
                    <div class="social_sharePost">   
                        <input type="hidden" name="share_postid" id="share_postid">
                        <input type="hidden" name="share_userid" id="share_userid">
                       
                       <?php ?> <a class="social-sharing-icon social-sharing-icon-facebook" data-network="facebook" data-id="" data-title="" data-desc="" data-image="" target="_new" ><i class="fa fa-facebook"></i></a>
                       
                        <!-- <a class="fb_share" value="SHARE"> <i class="fa fa-facebook"></i>
                        </a> -->
                        
                        <a  class="social-sharing-icon social-sharing-icon-twitter " id="twitter-wjs" data-network="twitter" data-id="" data-url="" data-title="" data-desc="" data-image=""  target="_new"  data-size="large"><i class="fa fa-twitter"></i>  </a>
                            
                        <!-- <a class="social-sharing-icon social-sharing-icon-instagram" data-network="instagram" target="_new" ><i class="fa fa-instagram"></i></a> -->

                        <a class="social-sharing-icon social-sharing-icon-pinterest" data-network="pinterest" data-id="" data-url="" data-title="" data-desc="" data-image="" target="_new" ><i class="fa fa-pinterest"></i></a>

                        <a class="social-sharing-icon social-sharing-icon-reddit" data-network="reddit" data-id="" data-url="" data-title="" data-desc="" data-image="" target="_new" ><i class="fa fa-reddit"></i></a>  
                            
                    </div>
                </div> 
            </div>
        </div>
    </div>  
</main><!-- #site-content -->   
<?php get_footer(); ?>
<style>
    .sidebar { 
        height: 100%;
        min-height: 100%;
        overflow: auto;
        position: -webkit-sticky;
        position: sticky;
        top: 5%;
    } 
    .main { 
        height: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
    } 
    .main,
    .sidebar { 
        background-color: #fff;
        border-radius: 10px; 
        padding: 15px;
    } 
    .wrapper {
        display: flex;
        justify-content: space-between;
    }
</style>