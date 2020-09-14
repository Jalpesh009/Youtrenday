<?php



/**

 * Template Name: Singing Cont'd

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

                <header class="entry-header has-text-align-center pt-3">

                    <div class="container">

                    </div><!-- .entry-header-inner -->

                </header><!-- .entry-header -->

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



                        <div class="col-lg-6 col-xs-12 upload-video for-trends-page">

                            <div class="trends-search">

                                <form>

                                <input type="text" placeholder="Search.." name="search">

                                <button type="submit"><i class="fa fa-search"></i></button>

                                </form>

                                <iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                            </div>

                        </div>



                        <div class="col-lg-3 col-xs-12 upload-self pb-4">

                            <h4 class="my-4 trends-title"> Page details: </h4>

                            <h6> upload yourself singing an original song with no auto tune & effects</h6>  </div>

                    </div> 

                </div> 

                <div class="trends-detail-page-categories for-desktop">

                    <div class="container">

                        <div class="row">

                            <div class="col-lg-12 d-flex">

                                <div class="trend-detail-trending-video week-section">

                                    <h3 class="opacity0"> leader </h3>

                                    <ul  class="m-0">

                                    <li><h4> Week 4</h4></li>

                                    <li><h4> Week 3</h4></li>

                                    <li><h4> Week 2</h4></li>

                                    <li><h4> Week 1 </h4></li>

                                    </ul>

                                </div>

                                <div class="trend-detail-trending-video one">

                                    <h3> leader </h3>

                                    <ul class="m-0">

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    </ul>

                                </div>

                                <div class="trend-detail-trending-video two">

                                    <h3> leader </h3>

                                    <ul class="m-0">

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    </ul>                         

                                </div>

                                <div class="trend-detail-trending-video three">

                                    <h3> leader </h3>

                                    <ul class="m-0">

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    </ul>                         

                                </div>

                                <div class="trend-detail-trending-video four">

                                    <h3> leader </h3>

                                    <ul class="m-0">

                                        <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                        <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                        <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                        <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                    </ul>                         

                                </div>

                            </div>

                        </div>

                    </div>

                </div> 

                <div class="trends-detail-page-categories-mobile for-mobile">

        <div class="container">

                <div class="row">

                <h2 class="header-for-mobile"> Weekly - Trends </h2>

                    <div class="col-xs-12 weekly-btn-mobile">

                    <ul  class="m-0">

                               <li><h4 class="selected"> Week 1</h4></li>

                               <li><h4> Week 2</h4></li>

                               <li><h4> Week 3</h4></li> 

                               <li><h4> Week 4 </h4></li>

        </ul>

                </div>

                <div class="col-xs-12">



                <div class="trend-detail-trending-video-mobile one">

                                    <h3> leader </h3>

                                    <ul class="m-0">

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                     </ul>

                                </div> 

                                <div class="trend-detail-trending-video-mobile two">

                                    <h3> two </h3>

                                    <ul class="m-0">

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                     </ul>

                                </div> 

                                <div class="trend-detail-trending-video-mobile three">

                                    <h3> three </h3>

                                    <ul class="m-0">

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                     </ul>

                                </div> 

                                <div class="trend-detail-trending-video-mobile four">

                                    <h3> four </h3>

                                    <ul class="m-0">

                                    <li><iframe width="560" height="315" src="https://www.youtube.com/embed/l6EjYuUSn1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </li>

                                     </ul>

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

