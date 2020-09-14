<?php 
/**
 * Template Name: Thank you Competition
 */
get_header();     
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
$comp_id = $_GET['comp_id'];
$competition_post = get_post( $comp_id ); 
// echo '<pre>';
// print_r($competition_post);
// echo '</pre>';
?>
<main id="site-content" role="main" class="custom-single-competition"> 
    <?php
    if (have_posts()) {   
        while (have_posts()) { 
            the_post();  ?>
            <article <?php post_class('p-5 container'); ?> id="post-<?php echo $comp_id; ?>">  
                <div class="post-inner thin thank-you-competititon">
                    
                    <div class="row">
                        <div class="container">
                            <h3 class="thanks-title d-none">Thank you Thank you for Participating in competition "<?php echo $competition_post->post_title; ?>"</h3>
                            <p class="thanks-desc">Thank you for participating in the competition. Be sure to vote for others and stay tuned, the winners will be announced soon after the completion of the completion. Good luck!</p>
                        </div> 
                    </div>
                </div>
            </article><!-- .post --> 
    <?php }
    }
    ?>
</main><!-- #site-content --> 
<?php get_footer(); ?>