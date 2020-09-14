<?php

/**
 * Template Name: Singing
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
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
            the_post();  ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                <div class="entry-content">
                    <div class="container singing-content my-5">
                        <div class="row">
                            <div class="col-lg-3 col-xs-12 tends">
                                <h4 class="my-4 trends-title"> Leader Board </h4>
                                <ul class="m-0">
                                    <li>
                                        <p> Mack 1,00,00,000 Trends</p>
                                    </li>
                                    <li>
                                        <p> Mack 1,00,00,000 Trends</p>
                                    </li>
                                    <li>
                                        <p> Mack 1,00,00,000 Trends</p>
                                    </li>
                                    <li>
                                        <p> Mack 1,00,00,000 Trends</p>
                                    </li>
                                    <li>
                                        <p> Mack 1,00,00,000 Trends</p>
                                    </li>
                                    <li>
                                        <p> Mack 1,00,00,000 Trends</p>
                                    </li>
                                </ul> 
                            </div>
                            <div class="col-lg-6 col-xs-12 upload-video">
                                <a href="#">
                                    <img src="https://www.belightsoft.com/products/imagetricks/img/intro-video-poster@2x.jpg" class="mx-auto">
                                    <h5>Lorem impusum lorem lorem</h5>
                                </a> 
                            </div> 
                            <div class="col-lg-3 col-xs-12 upload-self pb-4">
                                <h4 class="my-4 trends-title"> Page details: </h4>
                                <h6> upload yourself singing an original song with no auto tune & effects</h6>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                            <!-- for vandana =  comment section here  -->
                            </div>
                        </div>
                    </div>

                    <div class="container recent-video">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-xs-12">
                                <a href="#">
                                    <img src="https://www.belightsoft.com/products/imagetricks/img/intro-video-poster@2x.jpg">
                                    Lorem impusum lorem lorem
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-xs-12">
                                <a href="#">
                                    <img src="https://www.belightsoft.com/products/imagetricks/img/intro-video-poster@2x.jpg">
                                    Lorem impusum lorem lorem
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-xs-12">
                                <a href="#">
                                    <img src="https://www.belightsoft.com/products/imagetricks/img/intro-video-poster@2x.jpg">
                                    Lorem impusum lorem lorem
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-xs-12">
                                <a href="#">
                                    <img src="https://www.belightsoft.com/products/imagetricks/img/intro-video-poster@2x.jpg">
                                    Lorem impusum lorem lorem
                                </a>
                            </div>
                        </div>
                    </div>
                </div>    
            </article><!-- .post -->
    <?php }
    }
    ?>
</main><!-- #site-content -->
<?php get_template_part('template-parts/footer-menus-widgets'); ?>
<?php get_footer(); ?>
