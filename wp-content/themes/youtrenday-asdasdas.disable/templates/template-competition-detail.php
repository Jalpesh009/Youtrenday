<?php

/**
 * Template Name: Competition Detail
 */
get_header();   
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
}  
$args  = array( 
    'post_type' => 'competition',
    'posts_per_page' =>  1,
    'order' => 'ASC',
    'post_status' => 'publish',
    'tax_query' => array(
        // 'relation' => 'OR',
        // array(
        //     'taxonomy' => 'competition_status',
        //     'field'    => 'slug',
        //     'terms'    => 'future',
        // ),
        array(
            'taxonomy' => 'competition_status',
            'field'    => 'slug',
            'terms'    => 'running',
        ),
    ), 
);
$query  = new WP_Query($args); 

if($query->found_posts > 0){  ?> 
    <main id="site-content" class="custom-single-competition competition-detail">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();	?>
                <article  <?php post_class(); ?>  id="post-<?php the_ID(); ?>">
                    <div class="post-inner thin">
                        <div class="container single-comp-content py-5">
                            <div class="row image-content-sec">
                                
                                <div class="col-lg-3 col-xs-12 tends left-content comp_side_section">
                                    <?php 
                                    if( have_rows('compdetail_sidebar_content') ): 
                                        while ( have_rows('compdetail_sidebar_content') ) : the_row(); 
                                        $compdetail_leftside_content = get_sub_field('compdetail_leftside_content'); 
                                            echo $compdetail_leftside_content;
                                        endwhile; 
                                        wp_reset_query();
                                    endif; ?>    
                                </div>
                                    
                                <div class="col-lg-6 col-xs-12 upload-video-single-comp">
                                    <h1><?php the_title(); ?></h1>  
                                    <?php  

                                    $arr = array();
                                    
                                    $args_comp = array( 
                                        'post_type' => 'competition', 
                                        'posts_per_page' =>  1, 
                                        'order'   => 'DESC',
                                        'meta_key' => 'comp_start_date',
                                        'orderby' => 'meta_value_num',
                                        'post_status' => 'publish',
                                        'tax_query' => array(
                                            // 'relation' => 'OR',
                                            // array(
                                            //     'taxonomy' => 'competition_status',
                                            //     'field'    => 'slug',
                                            //     'terms'    => 'future',
                                            // ),
                                            array(
                                                'taxonomy' => 'competition_status',
                                                'field'    => 'slug',
                                                'terms'    => 'running',
                                            ),
                                        ), 
                                        
                                    );
                                    // phpinfo();
                                    $query_comp = new WP_Query($args_comp); 
                                    if($query_comp->have_posts()):  
                                        $i = 0;    
                                        while ($query_comp->have_posts()) : $query_comp->the_post(); 
                                            if($i == 0 ){ 
                                                
                                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?> 
                                                <img src="<?php echo $featured_img_url; ?>" class="mx-auto d-block"> 
                                                <?php  
                                                $arr['title'] = get_the_title(); 
                                                $comp_start_date =  get_field('comp_start_date', get_the_ID()) ;
                                                $comp_start_date1 = date_create( $comp_start_date);
                                                $counter_startdate = date_format($comp_start_date1,"F j, Y H:i:s");    

                                                $comp_end_date = get_field('comp_end_date', get_the_ID()) ;   
                                                $comp_end_date1 = date_create( $comp_end_date);
                                                $countert_enddate =    date_format($comp_end_date1,"F j, Y H:i:s");  
                                                $date_now = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) ) ; 
                                                // echo 'Start Date = ' . $comp_start_date . '</br>';
                                                // echo 'Endd Date = ' . $comp_end_date. '</br>' ;
                                                // echo  date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) ) ;
                                                // if(  ($date_now >  $comp_start_date) && ($date_now <  $comp_end_date) ){
                                                    echo "<a href='". site_url('competition-registration')."?comp_id=". get_the_ID() ."' class='single-comp-joinnow for-button-style'> Join Now </a>"; ?> 
                                                    <?php  
                                                    if(  $date_now >= $comp_start_date  ){  ?> 
                                                        <div class="alert alert-danger tends d-inline-block">
                                                            <p> Registration Ends - Voting Starts </p> 
                                                            <script>
                                                                jQuery(document).ready(function ($){  
                                                                    countDownTimer("<?php echo $countert_enddate; ?>");  
                                                                }) ;
                                                            </script>
                                                             <div class=" countDown " id="countDown"> </div>
                                                        </div>
                                                    <?php } else { ?> 
                                                        <div class="alert alert-danger tends d-inline-block">
                                                            <p> Starts in </p> 
                                                            <script>
                                                                jQuery(document).ready(function ($){  
                                                                    countDownTimer("<?php echo $counter_startdate; ?>");  
                                                                }) ;
                                                            </script>
                                                             <div class=" countDown " id="countDown"> </div>
                                                        </div>
                                                    <?php }  ?>  
                                                <?php 
                                            }
                                        $i++;
                                        endwhile;
                                        wp_reset_query();  
                                    endif;  ?>
                                    
                                    <?php 
                                    /*if( have_rows('compdetail_last_section') ): 
                                        while ( have_rows('compdetail_last_section') ) : the_row(); 
                                        $compdetail_title = get_sub_field('compdetail_title');
                                        $compdetail_image = get_sub_field('compdetail_image');  ?>
                                            <h3 class="middle_textbelow_codet"><?php echo $compdetail_title; ?></h3>
                                            <a href="<?php echo site_url('home'); ?>"><img src="<?php echo $compdetail_image['url']; ?>" class="middle_imgbelow_codet mx-auto"></a>
                                        <?php endwhile; wp_reset_query();
                                    endif; */?>  
                                    
                                </div> 
                                <div class="col-lg-3 col-xs-12 upload-self  pb-4 right-content comp_side_section">
                                   
                                    <?php 
                                    $array = array();
                                    if( have_rows('compdetail_sidebar_content') ): 
                                        while ( have_rows('compdetail_sidebar_content') ) : the_row(); 
                                        $compdetail_rightside_content = get_sub_field('compdetail_rightside_content');
                                         
                                            $args  = array( 
                                                'post_type' => 'competition',
                                                'posts_per_page' => -1,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'competition_status',
                                                        'field'    => 'slug',
                                                        'terms'    => 'running',
                                                    ),
                                                ), 
                                            );
                                            $query  = new WP_Query($args); 
                                            if($query->have_posts()):  
                                                while ($query->have_posts()) : $query->the_post();
                                                    $comp_id = $post->ID;
                                                    $totalvideos = get_post_meta( $comp_id, "comp_totalvideos", true);
                                                    $totalprizes = get_post_meta( $comp_id, "comp_totalvideos_prizes", true);
                                                    $array['total_entries'] = $totalvideos; 
                                                    $array['total_prizes'] = $totalprizes;   
                                                endwhile; wp_reset_query();
                                            endif; 
                                            $totalprizes = get_post_meta( $comp_id, "comp_totalvideos_winnersprizes", true);
                                            // $prizes = ($array['total_prizes'] * 12.5) / 100;
                                            // echo '<pre>';
                                            // print_r( $totalprizes );
                                            // echo '</pre>';
                                            $prize = '';
                                            if( $array['total_prizes']){
                                                $prize =  $array['total_prizes'] / 4;
                                            }
                                            if( $array['total_entries'] ){
                                                $compdetail_rightside_content = str_replace("{total_videos_entries}", $array['total_entries'], $compdetail_rightside_content); 
                                            }else{
                                                $compdetail_rightside_content = str_replace("{total_videos_entries}", '0',$compdetail_rightside_content);  
                                            }
                                            if( $array['total_prizes'] ){
                                                $compdetail_rightside_content = str_replace("{total_videos_cash}", '$'. $prize, $compdetail_rightside_content);  
                                            }else{
                                                $compdetail_rightside_content = str_replace("{total_videos_cash}", '$0',$compdetail_rightside_content);  
                                            }
                                             
                                            echo $compdetail_rightside_content; 
                                        endwhile; wp_reset_query();
                                    endif; ?>  
                                </div>
                            </div>    
                        </div>
                    </div>
                </article>
            <?php }
        } ?> 
    </main><!-- #site-content -->   
<?php 
} else{
    wp_redirect( site_url('home') );
}
get_footer(); ?>  