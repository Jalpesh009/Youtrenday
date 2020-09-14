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
                    <div class="col-lg-3 col-xs-12 tends">
                        <h4 class="my-4 trends-title"><?php the_field('left_side_title'); ?></h4>
                        <ul class="m-0">
                            <?php 
                            $args_video = array( 
                                'post_type' => array('music', 'competition' ),   
                                'meta_key' => 'post_total_points',
                                'orderby' => 'meta_value_num',
                                'posts_per_page' =>-1,  
                                'post_status' => 'publish',    
                            );
                            $query_video = new WP_Query($args_video);   
                            $do_not_duplicate = array();
                            if($query_video->have_posts()): 
                            
                                while ($query_video->have_posts()) : $query_video->the_post(); 
                                    $author_id = $post->post_author;  
                                    if ( !in_array( $author_id, $do_not_duplicate ) ) {
                                        $do_not_duplicate[] = $author_id;  
                                    }
                                endwhile; 
                                // wp_reset_query();
                            endif; 
                            $users = get_users(array( 'fields' => array( 'ID') ));
                            
                            foreach($do_not_duplicate as $key => $value){ 
                                $args_posts = array( 
                                    'post_type' => array('music', 'competition' ),   
                                    'meta_key' => 'post_total_points',
                                    'orderby' => 'meta_value_num',
                                    'posts_per_page' => 1,  
                                    'post_status' => 'publish',   
                                    'author' => $value
                                );
                                $query_posts = new WP_Query($args_posts);   
                                if($key <= 5){
                                    if($query_posts->have_posts()):  
                                        while ($query_posts->have_posts()) : $query_posts->the_post(); 
                                            $author_id = $post->post_author;  
                                            $author_obj = get_user_by('id', $author_id); ?>
                                            <li class="leader-board-li post-<?php the_ID(); ?>">
                                                <p><a href="<?php echo home_url( '/members/' . bp_core_get_username( $author_id ) . '/profile/edit/group/1' ); ?>"><?php echo ucfirst($author_obj->data->display_name); ?></a></p>
                                            </li>
                                        <?php   
                                        endwhile; 
                                        // wp_reset_query();
                                    endif; 
                                }
                            } ?>
                       
                        </ul>
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
                        ) ); ?>
                    <div class="row">
                        <?php  
                        // echo '<pre>';
                        // print_r($music_terms);
                        // echo '</pre>';
                        // die;
                        if ( !empty($music_terms) ) { 
                            foreach( $music_terms as $music_term ) {  ?> 
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
                                                    <p> <?php echo get_the_date('d M Y');?> </p>
                                                </li>
                                            </ul>
                                            <?php  
                                        endwhile;
                                        wp_reset_postdata(); 

                                    else:
                                        echo '<h5 class="text-center mt-5 pt-5">No Music Found</h5>';
                                    endif; ?> 
                                </div> 
                            <?php } 
                        } ?>  
                    </div>
                </div>
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content --> 
<?php get_footer(); ?>
