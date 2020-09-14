<?php

/**
 * Template Name: FAQ
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
get_header();

?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();  ?>
            <article <?php post_class('forums-listing'); ?> id="post-<?php the_ID(); ?>"> 
                <header class="entry-header has-text-align-center">
                    <div class="container">
                        <?php the_title( '<h1 class="entry-title mb-4">', '</h1>' );  ?>
                    </div><!-- .entry-header-inner -->
                </header><!-- .entry-header --> 
                <div class="post-inner thin">
                    <div class="container mb-5"> 
                        <div class="accordion" id="accordionExample">

                            <?php 
                            $args_faq =  array(
                                'post_type' => 'faq',  
                                'posts_per_page' => -1, 
                                'order' => 'DESC', 
                                'post_status' => 'publish', 
                            ); 
                            $query_faq = new WP_Query( $args_faq ); 
                            if ($query_faq->have_posts()) :
                                $i = 0;
                               
                                while ($query_faq->have_posts()) : $query_faq->the_post(); 
                                $collapsed = '';
                                $show = '';
                                if($i == 0 ){
                                    $collapsed = 'collapsed';
                                    $show = 'show';
                                } ?>   
                                    <div class="card border-0 my-2 rounded-0">
                                        <div class="card-header border-0 py-1" id="heading_<?php echo $i; ?>">
                                            <h2 class=" ">
                                                <button type="button" class="btn btn-link text-left w-100 text-decoration-none <?php echo $collapsed; ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i; ?>"> 
                                                    <?php the_title(); ?>
                                                    <i class="fa fa-plus float-right pt-1"></i>
                                                </button>									
                                            </h2>
                                        </div>
                                        <div id="collapse_<?php echo $i; ?>" class="collapse <?php echo $show; ?>" aria-labelledby="heading_<?php echo $i; ?>" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++;  
                                endwhile; 
                            endif; ?>

                            <!-- <div class="card border-0 my-2 rounded-0">
                                <div class="card-header border-0 py-1" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link text-left w-100 collapsed text-decoration-none" data-toggle="collapse" data-target="#collapseTwo"> 
                                        What is Bootstrap?
                                        <i class="fa fa-plus float-right"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Bootstrap is a sleek, intuitive, and powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 my-2 rounded-0">
                                <div class="card-header border-0 py-1" id="headingThree">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link text-left w-100 collapsed text-decoration-none" data-toggle="collapse" data-target="#collapseThree">
                                        What is CSS?
                                        <i class="fa fa-plus float-right"></i>
                                        </button>                     
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content -->
<?php get_footer(); ?>
 