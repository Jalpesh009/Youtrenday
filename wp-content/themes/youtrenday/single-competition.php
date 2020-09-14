<?php
get_header(); 
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
// setPostViews(get_the_ID()); 
$terms = get_the_terms(get_the_ID(), 'music_category');  ?> 
<main id="site-content" class="custom-single-blog">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();	?>
			<article class="container single-post" id="post-<?php the_ID(); ?>">
		 
				<header class="entry-header">
					<div class="entry-header-inner medium">
						<?php 
						if ( is_user_logged_in()) { ?>
							<span class="edit-text"><a href="<?php echo site_url('/edit-music/') ?>?id=<?php the_ID(); ?>"> Edit </a></span>
						<?php } ?>
						
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						
						<div class="post-meta-wrapper post-meta-single post-meta-single-top"> 
							<ul class="post-meta"> 
								<li class="post-author meta-wrapper">
									<span class="meta-icon">
										<i class="fa fa-user-circle-o" aria-hidden="true"></i> 
									</span>
									<span class="meta-text">
										<?php 
										$author_id=$post->post_author; 
										$author_obj = get_user_by('id', $author_id); ?>
										<a href="<?php echo home_url( '/members/' . bp_core_get_username( $author_id ) . '/profile/' ); ?>" title="Posts by <?php echo get_the_author();?>" rel="author"><?php echo ucfirst( get_the_author());?></a>
										<span class="divider">|</span>
									</span>
								</li>
								<li class="post-date meta-wrapper"> 
									<span class="meta-icon">
										<i class="fa fa-clock-o" aria-hidden="true"></i>
									</span>
									<span class="meta-text">
										<?php echo get_the_date()?>
										<?php echo $terms ? '<span class="divider">|</span>' : '';  ?> 
									</span>
								</li>
							 
							</ul><!-- .post-meta --> 
						</div> 
					</div><!-- .entry-header-inner --> 
				</header><!-- .entry-header --> 
				
				<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
				<img src="<?php echo $featured_img_url; ?>" id="imageResult" class="d-block mx-auto">
					 
				<div class="post-inner thin"> 
					<div class="container">
						<div class="entry-content">
							<!-- <div class="w-70"> -->
								<?php
								if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
									the_excerpt();
								} else {
									the_content( __( 'Continue reading', 'twentytwenty' ) );
								} ?>
							<!-- </div> .w-70 -->
						</div><!-- .entry-content --> 
						<div class="comments-wrapper section-inner">
							<?php comments_template(); ?>
						</div><!-- .comments-wrapper -->
						
					</div>
				</div><!-- .post-inner --> 
			</article>
		<?php }
	} ?> 
</main><!-- #site-content -->   
<?php get_footer(); ?> 