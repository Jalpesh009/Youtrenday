<?php
/**
 * Template Name: Trends 
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
            the_post(); ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
            <div class="container singing-content my-5">
                <div class="row">
                    <div class="col-lg-3 col-xs-12">
                        <ul class="nav nav-tabs profile-musics-tab home_tabs ml-0 mt-0"> 
                            <li class="mt-0">
                                <a href="#monthly_posts" data-toggle="tab" class="mothly_posts_tab ">Monthly</a>
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
                    <div class="col-lg-6 col-xs-12 upload-video for-trends-page">
                        <div class="trends-search">
                            <form>
                                <input type="text" placeholder="Search.." name="search">
                                <button type="submit"><i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>  
                        <div class="mt-5 mb-4">
                            <a href="<?php echo site_url( '/add-music/' ); ?>" class="join-now  for-button-style">Upload here</a>
                        </div>
                       
                        <?php 
                        $uposts = get_posts(
                            array(
                                'post_type' => 'competition',
                                'numberposts' => 1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'competition_status',
                                        'field'    => 'slug',
                                        'terms'    => 'running',
                                    ),
                                ), 
                            )
                        ); 
                        foreach (  $uposts as $competition ) {
                           
                            echo ' <h5 class="text-center">OR</h5><div class="mt-4 mb-3"><a href="'. site_url( '/competition-registration/' ) .'?comp_id=' . $competition->ID . '" class="join-now  for-button-style">Join our Prestigious Competition here</a></div>';
                        }  
                        wp_reset_postdata();
  
                        ?>  
                    </div>
                    <div class="col-lg-3 col-xs-12 upload-self p-4">
                        <?php the_field('right_side_text' ); ?>              
                    </div>
                </div>
            </div>
            <div class="trendig-categories">
                <div class="container trends-categories">
                    <?php $music_terms = get_terms( array(
                            'taxonomy' => 'music_category',
                            'hide_empty' => true
                        ) );   ?>
                    <div class="row">
                        <?php   
                        if ( !empty($music_terms) ) { 
                            foreach( $music_terms as $music_term ) { ?> 
                                <div class="col-lg-3 col-md-6 col-xs-12 my-3">
                                    <h4><a href="<?php echo get_category_link($music_term->term_id); ?>"><?php echo $music_term->name; ?></a> </h4>
                                    <?php 
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
                                    );
                                    $query_music = new WP_Query( $args_music );
                                    $total_postCount = $query_music->found_posts;
 
                                    if ($query_music->have_posts()) :
                                        while ($query_music->have_posts()) : $query_music->the_post();    
                                            $post_trend = get_post( get_the_ID() ); 
                                            $author_id = $post_trend->post_author; 
                                            $author_obj = get_user_by('id', $author_id);  

                                            $musicMedia_from = get_post_meta(get_the_ID(), 'musicMedia_from', true);  
                                            $musicMedia_url = get_post_meta(get_the_ID(), 'musicMedia_url', true);  
                                            $media_uploaded_types = wp_check_filetype($musicMedia_url);
                                            $media_uploaded_type = $media_uploaded_types['type'];  ?> 
                                            <?php echo get_media_music_html(get_the_ID());  ?>
                                            <a href="<?php echo get_the_permalink(); ?>">
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
                                            <ul class="trends-video-details m-0">
                                                <li>
                                                    <!-- <p><?php //echo getPostViews(get_the_ID()); ?></p> -->
                                                    <p> Count : <?php echo $total_postCount; ?></p>
                                                </li>
                                                <li>
                                                    <a href="<?php echo home_url( '/members/' . bp_core_get_username( $author_id ) . '/profile/' ); ?>" rel="author"><?php echo ucfirst( get_the_author());?></a>
                                                </li>
                                                <li>
                                                    <p> <?php echo get_the_date('d M Y');?> </p>
                                                </li>
                                            </ul>
                                            <?php  
                                        endwhile;
                                        wp_reset_postdata();  
                                    endif; ?> 
                                </div> 
                            <?php } 
                        } else { 
                            echo '<h5 class="text-center w-100">There are currently no posts</h5>';
                        } ?>  
                    </div>
                </div>
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content --> 
<?php get_footer(); ?>
