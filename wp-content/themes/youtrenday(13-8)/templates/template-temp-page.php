<?php
/* Template Name: Temp Page*/
get_header();
if (!is_user_logged_in()) {
    wp_redirect(site_url('/custom-login/'));
    exit;
}
?>
<main id="site-content" role="main">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();  ?>
            <article <?php post_class('pb-5'); ?> id="post-<?php the_ID(); ?>">
                <div class="post-inner thin">
                    <div class="entry-content">
                        <div class="container user-profile-musics">
 

                        </div>
                    </div>
            </article><!-- .post -->
    <?php }
    } ?>
</main><!-- #site-content -->
<?php get_template_part('template-parts/footer-menus-widgets'); ?>
<?php get_footer(); ?>