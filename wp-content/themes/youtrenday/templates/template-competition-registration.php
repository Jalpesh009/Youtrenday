<?php



/**

 * Template Name: Competition Registration 

 */

get_header();

if (!is_user_logged_in()) {

    wp_redirect( site_url('/') );

    exit;

} else if (!isset($_GET['comp_id'])) {

    wp_redirect(site_url());

    exit;

}



$comp_id = $_GET['comp_id'];

$userId = get_current_user_id();

$args  = array( 

    'post_type' => 'competition',

    'posts_per_page' => 1,

    'order' => 'ASC',

    'post_status' => 'publish',

    'tax_query' => array(

        array(

            'taxonomy' => 'competition_status',

            'field'    => 'slug',

            'terms'    => 'running',

        ),

    ), 

);

$query  = new WP_Query($args); 



$args_video  = array( 

    'post_type' => 'competition_video',

    'posts_per_page' => -1, 

    'meta_query' => array(

        'relation' => "AND",

        array(

            'key'     => 'compVideo_user',

            'value'   => $userId,

            'type'    => 'NUMERIC',

            'compare' => '=',

        ),

        array(

            'key'     => 'compVideo_from_competition',

            'value'   => $comp_id, 

            'type'    => 'NUMERIC',

            'compare' => '=',

        ),

    ),

);

$query_video  = new WP_Query($args_video); 

// echo '<pre>';

// print_r($query_video->found_posts );

// echo '</pre>'; die;

if($query->found_posts > 0){  ?> 

 

<main id="site-content" role="main" class="custom-single-competition">

    <?php

    if (have_posts()) {

        while (have_posts()) {

            the_post();  ?>

            <article <?php post_class('pb-5'); ?> id="post-<?php echo $comp_id; ?>">

                <div class="post-inner thin mx-3 ">

                    <div class="container-fluid single-comp-content pt-5 buddypress">

                        <div class="row  buddypress-wrap  image-content-sec">



                            <div class="col-lg-3 col-xs-12 left-side-content my-3 common_sidebar position-sticky">

                                <div class="tends left-content side-content px-3 mb-3 position-relative">

                                    <?php the_field('compreg_left_content'); ?>

                                </div>

                                <?php $compreg_side_image = get_field('compreg_side_image'); ?>

                                <img src="<?php echo $compreg_side_image['url']; ?>">

                            </div>

            

                            <div class="tends col-lg-6 col-xs-12 gredient-border upload-video-single-comp standard-form my-3 p-0">

                                <?php 

                                // echo $query_video->found_posts;

                                if($query_video->found_posts < 3) {?> 

                                <div class="bg-white p-3 comp-reg-form">

                                    <h5>You're one step away from winning!</h5> 

                                    <span class="regis-subtext text-center premium_field_cls ">Select the number of badges you want (Displayed on Profile). The more badges, the more entries in the competition.</span>

                                    <h6 class="custom_question_answer text-center d-none"> Alternate Methods of Entry</h6>

                                    <?php  $competition_post = get_post($comp_id);

                                    

                                    $user_info = wp_get_current_user();

                                    $competition_price = get_field('competition_price', $comp_id);



                                    $user_add = get_user_meta(get_current_user_id(), 'user_cust_str_address');

                                    $user_city = get_user_meta(get_current_user_id(), 'user_cust_city');

                                    $user_postalcode = get_user_meta(get_current_user_id(), 'user_cust_postalcode');

                                    $user_country = get_user_meta(get_current_user_id(), 'user_cust_country'); 

                                    $paidVideo_data = get_post_meta(1073, 'compVideo_freevideo_answers', true);

                                    // echo '<pre>';

                                    // print_r($paidVideo_data);

                                    // echo '</pre>';  

                                    if ($comp_id) {

                                        gravity_form(

                                            6,

                                            false,

                                            false,

                                            false,

                                            array(

                                                'edit_user_firstname' => $user_info->user_firstname,

                                                'edit_user_email' => $user_info->user_email,

                                                'edit_user_streetaddress' => $user_add[0],

                                                'edit_user_city' => $user_city[0],

                                                'edit_user_postalcode' => $user_postalcode[0],

                                                'edit_user_country' => $user_country[0],

                                                'compit_postid' => $comp_id,

                                                // 'compet_price' => $competition_price

                                            ),

                                            false

                                        );

                                    }

                                    ?>

                                    <span class="registration_btm_text text-center">By continuing, you agree to our <a href="<?php echo site_url('terms-conditions'); ?>">Terms and Conditions</a>, <a href="<?php echo site_url('privacy-and-policy'); ?>">Priavcy Policy</a> and <a href="<?php echo site_url('rules'); ?>">Contest Rules.</a></span>

                                    <a href="javascript:void(0)"><span class="registration_btm_subtext text-center text-dark">Enter Without Buying Badges</span></a>

                                </div>

                                <?php } else { ?> 

                                <h3 class="m-5" > You have reached the maximum number of entries for

this competition. In one week you will be able to join another competition. </h3>    

                                <?php } ?>

                            </div>



                            <div class="col-lg-3 col-xs-12 right-side-content my-3 common_sidebar position-sticky">

                                <div class="tends upload-self left-content side-content px-3 mb-3 position-relative">

                                  

                                    

                                    <?php 

                                    $array = array(); 

                                    $compreg_right_content = get_field('compreg_right_content');

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

                                    // $totalprizes = get_post_meta( $comp_id, "comp_totalvideos_winnersprizes", true);

                                    // $prizes = ($array['total_prizes'] * 12.5) / 100;

                                    // echo '<pre>';

                                    // print_r( $array['total_prizes']);

                                    // echo '</pre>';

                                    $prize = '';

                                    if( $array['total_prizes']){

                                        $prize =  $array['total_prizes'] / 4;

                                    }

                                    if( $array['total_entries'] ){

                                        $compreg_right_content = str_replace("{total_videos_entries}", $array['total_entries'], $compreg_right_content); 

                                    }else{

                                        $compreg_right_content = str_replace("{total_videos_entries}", '0',$compreg_right_content);  

                                    }

                                    if( $array['total_prizes'] ){

                                        $compreg_right_content = str_replace("{total_videos_cash}", '$'.$prize, $compreg_right_content);  

                                    }else{

                                        $compreg_right_content = str_replace("{total_videos_cash}", '$0',$compreg_right_content);  

                                    }

                                        

                                    echo $compreg_right_content; ?>  





                                </div> 

                                <img class="right-rev-image" src="<?php echo $compreg_side_image['url']; ?>">

                            </div> 

                        </div>

                    </div>

                </div>

            </article><!-- .post -->

    <?php }

    }

    ?>

</main><!-- #site-content -->

<?php 

} else{

    wp_redirect( site_url('home') );

} 

get_footer(); ?>