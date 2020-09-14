<?php 
get_header(); 
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
$term_id = get_queried_object_id(); 
$current_term = get_term_by('term_id', $term_id, get_query_var('taxonomy'));  
// echo '<pre>';
// print_r($current_term->name);
// echo '</pre>';
// die;
?>
<main id="site-content" role="main"> 
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
        <!-- Yash Code --> 
        <div class="container singing-content my-5">
            <div class="row">
                <div class="col-lg-9 col-xs-12 m ain">
                    <div class="row">
                        <div class="col-lg-4 col-xs-12  ">
                            <ul class="nav nav-tabs profile-musics-tab home_tabs ml-0 mt-0"> 
                                <li class="mt-0">
                                    <a href="#monthly_posts" data-toggle="tab" class="mothly_posts_tab">Monthly</a>
                                </li>
                                <li class="mt-0">
                                    <a href="#all_time_posts" data-toggle="tab" class="all_times_posts_tab active">All-Time</a>
                                </li> 
                            </ul>
                            <div class="tab-content main_all_posts mt-4">  
                                <div class="col-lg-12 col-md-12 tends tab-pane " id="monthly_posts">
                                    <h4 class="trends-title">Leader Board</h4>
                                    <ul class="m-0">
                                        <?php 
                                        $args_monthly = array( 
                                            'post_type' => array('music', 'competition_video' ),   
                                            'meta_key' => 'post_total_points',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' =>-1,  
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
                                        $query_monthly = new WP_Query($args_monthly);   
                                        $not_duplicate = array();
                                        if($query_monthly->have_posts()): 
                                        
                                            while ($query_monthly->have_posts()) : $query_monthly->the_post(); 
                                                $author_id = $post->post_author;  
                                                if ( !in_array( $author_id, $not_duplicate ) ) {
                                                    $not_duplicate[] = $author_id;  
                                                }
                                            endwhile; 
                                            wp_reset_query();
                                        
                                        endif; 
                                        $leaderData =  trend_leader_data( $not_duplicate); 
                                        foreach($leaderData as $key => $value){ 
                                            $userId = $value['userid'];
                                            $total_points = $value['total_points']; 
                                            $user_info = get_userdata($userId); 
                                            if($key <=5 ){ ?>  
                                                <li class="leader-board-li">
                                                    <div class="single_user" >
                                                    <a href="<?php echo home_url( '/members/' . bp_core_get_username( $userId ) . '/profile/' ); ?>" class="ml-0"><?php echo ucfirst($user_info->display_name); ?></a>
                                                    <span class="total_point_span float-right"><?php echo $total_points .' Trend-its'; ?></span>
                                                    </div>
                                                </li>
                                        <?php }
                                        } ?> 
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12 tends tab-pane active" id="all_time_posts">
                                    <h4 class="trends-title">Leader Board</h4>
                                    <ul class="m-0">
                                        <?php 
                                        $args_all = array( 
                                            'post_type' => array('music', 'competition_video' ),   
                                            'meta_key' => 'post_total_points',
                                            'orderby' => 'meta_value_num',
                                            'posts_per_page' =>-1,  
                                            'post_status' => 'publish',    
                                        );
                                        $query_all = new WP_Query($args_all);   
                                        $do_not_duplicate = array();
                                        if($query_all->have_posts()): 
                                        
                                            while ($query_all->have_posts()) : $query_all->the_post(); 
                                                $author_id = $post->post_author;  
                                                if ( !in_array( $author_id, $do_not_duplicate ) ) {
                                                    $do_not_duplicate[] = $author_id;  
                                                }
                                            endwhile; 
                                            // wp_reset_query();
                                        endif;  
                                        $leaderData =  trend_leader_data( $do_not_duplicate); 
                                        foreach($leaderData as $key => $value){ 
                                            $userId = $value['userid'];
                                            $total_points = $value['total_points']; 
                                            $user_info = get_userdata($userId); 
                                            if($key <=5 ){ ?>  
                                                <li class="leader-board-li">
                                                    <div class="single_user" >
                                                    <a href="<?php echo home_url( '/members/' . bp_core_get_username( $userId ) . '/profile/' ); ?>" class="ml-0"><?php echo ucfirst($user_info->display_name); ?></a>
                                                    <span class="total_point_span float-right"><?php echo $total_points .' Trend-its'; ?></span>
                                                    </div>
                                                </li>
                                        <?php }
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xs-12 upload-video for-trends-page">
                            <div class="trends-search">
                                <form>
                                    <input type="text" placeholder="Search.." name="search">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form> 
                            </div>  
                            <h1 class="my-5 py-4 entry-title"><?php echo $current_term->name?></h1>
                        </div>  
                    </div>
                    <div class="row"> 
                        <div class="col-md-11 main music-category-posts "> 
                            <ul class="nav nav-tabs profile-musics-tab category_tabs ml-0"> 
                                <li>
                                    <a href="#recent_posts" data-toggle="tab" class="recent_posts active">Recent Posts</a>
                                </li>
                                <li >
                                    <a href="#popular_posts" data-toggle="tab" class="popular_posts" >Popular Posts</a>
                                </li>
                            </ul>
                            <span class="d-none current_term_id"><?php echo $term_id; ?></span>    
                            <div class="tab-content main_all_posts  main_all_catPosts mt-4">   
                                <div id="recent_posts" class="tab-pane active mt-0"> 
                                    <div class="row mt-0">
                                        <?php // Recent Posts
                                        $args_recent = array( 
                                            'post_type' => 'music', 
                                            'posts_per_page' => 2, 
                                            'order'   => 'DESC',
                                            'orderby' => 'ID',
                                            'post_status' => 'publish',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'music_category',
                                                    'field'    => 'term_id',
                                                    'terms'    => $term_id ,                                       
                                                ),
                                            ), 
                                        );
                                        $query_recent = new WP_Query($args_recent); 
                                        if($query_recent->have_posts()):  
                                            while ($query_recent->have_posts()) : $query_recent->the_post(); ?>  
                                                <div class="col-md-12 main_videos recent_cat_post ">  
                                                    <?php  // echo get_home_mediaall_html( get_the_ID());
                                                    echo show_home_postsdata( get_the_ID()); ?>
                                                </div>    
                                            <?php 
                                            endwhile;
                                            wp_reset_query(); 
                                        endif;  ?>       
                                    </div>
                                    <span class="d-none total_recent_posts"><?php echo $query_recent->found_posts; ?></span>
                                    <div class="row ajax_recent_posts mb-5" id="ajax_recent_posts"></div>
                                    <div class=" justify-content-center all_recent_loader d-none">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div> 
                                <div id="popular_posts" class="tab-pane mt-0">
                                    
                                    <div class="row mt-0">
                                        <?php // Popular Posts
                                        $args_popular = array(
                                            'post_type'  => 'music',
                                            'order'  => 'DESC',  
                                            'posts_per_page'  => 2,  
                                            'meta_key' => 'post_total_points',
                                            'orderby' => 'meta_value_num', 
                                            'post_status' => 'publish', 
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'music_category',
                                                    'field'    => 'term_id',
                                                    'terms'    => $term_id ,                                       
                                                ),
                                            ), 
                                            'meta_query' => array(
                                                array(
                                                    'key'     => 'post_total_points',
                                                    'value'   => 0,
                                                    'type'    => 'numeric',
                                                    'compare' => '>',
                                                ),
                                            ),
                                        );
                                        $query_popular = new WP_Query($args_popular);  
                                        if($query_popular->have_posts()): 
                                            while ($query_popular->have_posts()) : $query_popular->the_post(); ?>
                                                <div class="col-md-12 main_videos popular_cat_video "> 
                                                    <?php // echo get_home_mediaall_html( get_the_ID()); 
                                                    echo show_home_postsdata( get_the_ID()); ?>
                                                </div>   
                                            <?php 
                                            endwhile;
                                            wp_reset_query(); 
                                        endif;  ?>                                    
                                    </div>
                                    <span class="d-none total_popular_posts"><?php echo $query_popular->found_posts; ?></span>
                                    <div class="row ajax_popular_posts mb-5" id="ajax_popular_posts"></div>
                                    <div class=" justify-content-center popular_post_loader d-none">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    
                                </div>   
                            </div>
                        </div>  
                    </div> 
                </div>
               
                <div class="col-lg-3 col-xs-12 upload-self bg-light px-0 sidebar category-sidebar" style="height: fit-content;"> 
                    <div class="bg-light d-inline-block inner-div">
                        <a href="<?php echo site_url( '/add-music/' ); ?>" class="join-now d-block mx-auto mt-4 for-button-style">New Post</a>    
                        <div class="p-3">
                            <?php the_field('music_category_sidebar_content', 'option' ); ?>   
                        </div>     
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
    .category-sidebar .inner-div{
        border-radius: 6% !important;
    }
    .sidebar { 
        height: 100%;
        min-height: 100%; 
        position: -webkit-sticky;
        position: sticky; 
        top: 6%; 
        border-radius: 7% !important;
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
    } 
    .wrapper {
        display: flex;
        justify-content: space-between;
    }
</style>