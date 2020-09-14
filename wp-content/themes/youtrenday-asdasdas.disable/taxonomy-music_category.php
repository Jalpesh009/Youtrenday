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
                        <div class="col-lg-4 col-xs-12 tends bg-light equal_height_cls">
                            <h4 class="my-4 trends-title">Leader Board </h4>
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