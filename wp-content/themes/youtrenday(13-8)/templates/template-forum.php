<?php



/**

 * Template Name: Forum

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

            <article <?php post_class('forums-listing'); ?> id="post-<?php the_ID(); ?>"> 

                <header class="entry-header has-text-align-center pt-3 hello">

                    <div class="container">

                        <?php the_title( '<h1 class="entry-title mb-4">', '</h1>' );  ?>

                    </div><!-- .entry-header-inner -->

                </header><!-- .entry-header --> 

                <div class="post-inner thin mx-3 ">

                    <div class="container singing-content my-5">

                        <div class="row">

                           

                            <div class="col-lg-12 ">

                                <div class="forum-trends-search"> 

                                <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>

                                    <?php the_content();?>

                                    <!-- for vandana - comment code here -->

                                </div>

                            </div>

 

                        </div> 

                    </div>

                </div>

            </article><!-- .post -->

    <?php }

    }

    ?>

</main><!-- #site-content -->

<?php get_footer(); ?>

 