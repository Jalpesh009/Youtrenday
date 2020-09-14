<?php
get_header(); 
$terms = get_the_terms(get_the_ID(), 'blog_category'); ?> 
<main id="site-content" class="custom-single-blog">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();	?>
			<article class="container single-post" id="post-<?php the_ID(); ?>">
		 
				<header class="entry-header has-text-align-center">
					<div class="entry-header-inner medium">
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
										<a href="<?php echo home_url( '/members/' . bp_core_get_username( $author_id ) . '/profile/edit/group/1' ); ?>" title="Posts by <?php echo get_the_author();?>" rel="author"><?php echo ucfirst( get_the_author());?></a>
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
								<?php if($terms ){ ?> 
									<li class="post-categories meta-wrapper">
										<span class="meta-icon">
											<i class="fa fa-file-text-o" aria-hidden="true"></i>
										</span>
										<span class="meta-text"> 
											<?php 
											$blog_cat_list = [];
											foreach($terms as $term){ 
												$blog_cat_list[] ='<a href="' . get_term_link($term->slug, 'blog_category') . '" rel="category tag">
												'. $term->name .'</a>'; ?> 
											<?php } 
											echo implode(', ', $blog_cat_list);	  ?>
										</span> 
									</li> 
								<?php }  ?>
							</ul><!-- .post-meta --> 
						</div> 
					</div><!-- .entry-header-inner --> 
				</header><!-- .entry-header --> 
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?></a>
				<?php }else{  
					$featured_video = get_post_meta(get_the_ID() , 'featured_video_uploading', true); 
					if( $video = wp_get_attachment_url($featured_video)) {  
						echo '<div class="embed-responsive embed-responsive-16by9"><video class="sfv_videos embed-responsive-item" id="sfv_video_'. get_the_ID() .'" controls="" src="'.$video.'" style="max-width:100%;display:block;"></video></div>';
					}
				} ?>  
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

						<div class="section-inner"> 
							<?php
							wp_link_pages(
								array(
									'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
									'after'       => '</nav>',
									'link_before' => '<span class="page-number">',
									'link_after'  => '</span>',
								)
							);

							edit_post_link(); 
							if ( is_single() ) { 
								get_template_part( 'template-parts/entry-author-bio' ); 
							}
							?> 
						</div><!-- .section-inner -->

						<?php 
						// if ( is_single() ) { 
						// 	get_template_part( 'template-parts/navigation' ); 
						// }
					
						if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) { ?>
							<div class="comments-wrapper section-inner">
								<?php comments_template(); ?>
							</div><!-- .comments-wrapper -->
							<?php
						}
						?>

					</div>
				</div><!-- .post-inner -->

				

			</article>
		<?php }
	} ?> 
</main><!-- #site-content -->   
<?php get_footer(); ?> 