<?php 
/* Template Name: Home Loggedin */
get_header();
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) {  
        while (have_posts()) {  the_post();  ?>
            <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>"> 
                <header class="entry-header has-text-align-center pt-3">
                    <div class="container">
                        <div class="row"> 
                            <div class="col-md-12">
                                <?php  the_title( '<h1 class="entry-title mypost-list-title">', '</h1>' ); ?>
                              </div>  
                        </div>
                        
                    </div><!-- .entry-header-inner -->
                </header><!-- .entry-header -->
                    
                <div class="post-inner thin">
                    <div class="entry-content"> 
                        <div class="container user-profile-musics ">
                            <div class="row user-profile-single-music"> 
                                <?php  
                                $loop_music = new WP_Query( 
                                                        array( 
                                                            'post_type' => array('music', 'competition'), 
                                                            'posts_per_page' => -1, 
                                                            'order'   => 'DESC',
                                                            'post_status' => 'publish'  
                                                        ));
                                if($loop_music->have_posts()): 
                                    while ( $loop_music->have_posts() ) : $loop_music->the_post();                           
                                    
                                    $post_likes_data = get_post_meta( get_the_ID(), 'post_likes_data', true  );
                                    // echo '<pre>';
                                    // print_r($post_likes_data);
                                    // echo '</pre>' ;
                                    
                                    ?>
                                        <div class="col-xs-12 col-lg-3 single-music mb-4"> 
                                            <?php $posttype = get_post_type(get_the_ID());
                                            // echo $posttype; 
                                            if($posttype  == 'music') { 
                                                echo get_media_music_html(get_the_ID());
                                            } else{
                                            //    echo get_the_post_thumbnail( get_the_ID(), 'medium' );   
                                             the_post_thumbnail();
                                            } ?>
                                            <div class="pindex user_data">
                                                <div class="ptitle"> 
                                                <a href="<?php the_permalink(); ?>" class="my-0"><h2 class="my-0"><?php the_title(); ?></h2></a>

                                                <div class="like_dislike_comment_share border-top d-flex"> 
                                                    <?php 
                                                    $totalcount = get_post_meta(get_the_ID(), 'post_likes_count', true);
                                                    if($totalcount==''){
                                                        $post_count = 0;
                                                    }else{
                                                        $post_count = $totalcount;
                                                    }
                                                    $post_likes_data = get_post_meta(get_the_ID(), 'post_likes_data', true);
                                                    $like_cls= '';
                                                    if($post_likes_data){
                                                        if(in_array(get_current_user_id(), $post_likes_data)){
                                                            $like_cls = 'unlike_a';
                                                        }else{
                                                            $like_cls = 'like_a';
                                                        }
                                                    }else{
                                                        $like_cls = 'like_a';
                                                    }

                                                    ?>
                                                    <!-- Like Music -->
                                                    <span class="like_mus_comp">
                                                        <a href="javascript:void(0);" class="d-inline <?php echo $like_cls; ?>" data-postid="<?php the_ID(); ?>" data-userid="<?php echo get_current_user_id(); ?>">
                                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>   
                                                        <span class="like_total px-1"><?php echo $post_count; ?></span>
                                                        </a>
                                                    </span>
                                                    <!-- Dislike Music -->
                                                    <span class="dislike_mus_comp">
                                                        <a href="javascript:void(0);" class="d-inline dislike_a ">
                                                        <i class="fa fa-thumbs-down" aria-hidden="true"></i> 
                                                            <span class="dislike_total px-1">2</span>
                                                        </a>
                                                    </span>
                                                    <!-- Comment Music -->  
                                                    <span class="comment_mus_comp">
                                                        <a href="javascript:void(0);" class="d-inline comment_mucSomp_a">
                                                            <i class="fa fa-comment" aria-hidden="true"></i>  
                                                            <span class="comment_total px-1"><?php 
                                                            $num_comment = get_comments_number($post->ID);
                                                            echo $num_comment;
                                                            // / ?></span>
                                                        </a>
                                                    </span>
                                                    <!-- Share Music -->
                                                    <span class="share_mus_comp">
                                                        <a href="javascript:void(0);" class="d-inline share_mucSomp_a ">
                                                            <i class="fa fa-share-alt-square" aria-hidden="true"></i> 
                                                        </a>
                                                    </span>
                                                    <!-- LikeBtn.com END -->
                                                </div> 
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
    } ?> 
</main><!-- #site-content -->
<?php get_template_part('template-parts/footer-menus-widgets'); ?>
<?php get_footer(); ?>
