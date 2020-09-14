<?php

/**
 * Template Name: Competition Rules
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header('landing');
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
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
                        ?>
                        <div class="row comp-prize-bg mt-3">
                            <?php 
                            if($i%2 == 0){ 
                                if( $image){ ?>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="image-section">
                                            <img src="<?php echo $image['url']; ?>">
                                        </div>
                                    </div>
                                <?php } 
                                if( $description){ ?>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="text-section">
                                            <?php echo $description; ?>
                                        </div>
                                    </div>
                                <?php 
                                }  
                            }else{
                                if( $description){ ?>
                                    <div class="col-xs-12 col-md-6"> 
                                        <div class="text-section">
                                            <?php echo $description; ?>
                                        </div>
                                    </div>
                                <?php }
                                if( $image){ ?>
                                    <div class="col-xs-12 col-md-6">
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