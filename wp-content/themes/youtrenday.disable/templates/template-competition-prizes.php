    <?php

/**
 * Template Name: Competition Prizes
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header('landing');
 
$arr = array();
                                            
$args_comp = array( 
    'post_type' => 'competition', 
    'posts_per_page' =>  1, 
    'order'   => 'DESC',
    'meta_key' => 'comp_start_date',
    'orderby' => 'meta_value_num',
    'post_status' => 'publish',
    'tax_query' => array(
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
    while ($query_comp->have_posts()) : $query_comp->the_post(); 
        $arr['enter_today_url'] = '<a href="' .site_url('/competition-registration/') .'?comp_id='.get_the_ID() .'">Enter today!</a>';
    endwhile;
    wp_reset_query();  
endif;  
?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) { 
        while (have_posts()) { 
            the_post();  ?> 
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">  
                <header class="entry-header has-text-align-center pt-3 hello">
                    <div class="container">
                        <?php the_title( '<h1 class="entry-title mb-4">', '</h1>' );  ?>
                    </div><!-- .entry-header-inner -->
                </header><!-- .entry-header --> 
                <div class="container comp-prize-page">

                    <?php if( have_rows('competition_prizes_section') ):
                        $i = 0;
                        while ( have_rows('competition_prizes_section') ) : the_row();   
                        $image = get_sub_field('image');
                        $description = get_sub_field('description');   
                        $left_class = '';
                        $right_class = '';
                        if($i % 2 == 0){  
                            $left_class = '';
                            $right_class = '';
                        }else{
                            $left_class = '';
                            $right_class = '';
                        }
                        $odd_cls = '';
                        $odd_cls = $i%2 == 0 ? "even_section" : "odd_section";
                        ?>
                        <div class="row comp-prize-bg mt-3 <?php echo $odd_cls; ?>">
                            <?php 
                            if($i%2 == 0){ 
                                if( $image){ ?>
                                    <div class="col-xs-12 col-md-12 col-lg-6 ">
                                        <div class="image-section">
                                            <img src="<?php echo $image['url']; ?>">
                                        </div>
                                    </div>
                                <?php } 
                                if( $description){ ?>
                                    <div class="col-xs-12 col-md-12 col-lg-6">
                                        <div class="text-section">
                                            <?php $description = str_replace("{enter_today}",$arr['enter_today_url'], $description); 
                                            echo $description; ?>
                                        </div>
                                    </div>
                                <?php 
                                }  
                            }else{
                                if( $description){ ?>
                                    <div class="col-xs-12 col-md-12 col-lg-6"> 
                                        <div class="text-section">
                                            <?php $description = str_replace("{enter_today}",$arr['enter_today_url'], $description); 
                                            echo $description;?>
                                        </div>
                                    </div>
                                <?php }
                                if( $image){ ?>
                                    <div class="col-xs-12 col-md-12 col-lg-6">
                                        <div class="image-section">
                                            <img src="<?php echo $image['url']; ?>">
                                        </div>
                                    </div>
                                <?php } 
                            } ?>
                        </div>
                        <?php  $i++;
                        endwhile; 
                    endif; ?> 
                </div>
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content --> 
<?php get_footer(); ?>