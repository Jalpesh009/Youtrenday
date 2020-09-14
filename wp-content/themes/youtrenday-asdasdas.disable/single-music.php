<?php
get_header(); 
if (!is_user_logged_in()) {
    wp_redirect( site_url('/') );
    exit;
} 
setPostViews(get_the_ID()); 
$post_id = get_the_ID();
$terms = get_the_terms(get_the_ID(), 'music_category');  ?> 
<main id="site-content" class="custom-single-blog">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
		
			the_post();	 ?>
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
											$music_cat_list = [];
											foreach($terms as $term){ 
												$music_cat_list[] ='<a href="' . get_term_link($term->slug, 'music_category') . '" rel="category tag">
												'. $term->name .'</a>'; ?> 
											<?php } 
											echo implode(', ', $music_cat_list); ?>
											<span class="divider">|</span>
										</span> 
									</li> 
								<?php }  ?>
								</li> 
								<li class="post-views meta-wrapper">
									<span class="meta-icon">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</span>
									<span class="meta-text"> 
										<?php echo getPostViews(get_the_ID()); ?>
									</span> 
								</li>  
							</ul><!-- .post-meta --> 
						</div> 
					</div><!-- .entry-header-inner --> 
				</header><!-- .entry-header --> 
				<?php  
				$musicMedia_from = get_post_meta($post_id, 'musicMedia_from', true);  
				$musicMedia_url = get_post_meta($post_id, 'musicMedia_url', true);  
				$media_uploaded_types = wp_check_filetype($musicMedia_url);
				$media_uploaded_type = $media_uploaded_types['type']; 
	
				if( $musicMedia_from == 'media_system' || $musicMedia_from === 'comp_from_computer' ){
					if(  $media_uploaded_type == 'video/x-ms-asf' ||  
						$media_uploaded_type == 'video/x-ms-wmv' || 
						$media_uploaded_type == 'video/x-ms-wmx' || 
						$media_uploaded_type == 'video/x-ms-wm' || 
						$media_uploaded_type == 'video/avi' || 
						$media_uploaded_type == 'video/divx' || 
						$media_uploaded_type == 'video/x-flv' || 
						$media_uploaded_type == 'video/quicktime' || 
						$media_uploaded_type == 'video/mpeg' || 
						$media_uploaded_type == 'video/mp4' || 
						$media_uploaded_type == 'video/ogg' || 
						$media_uploaded_type == 'video/webm' || 
						$media_uploaded_type == 'video/x-matroska' || 
						$media_uploaded_type == 'video/3gpp' || 
						$media_uploaded_type == 'video/3gpp2' ){ ?>    
						<video  width="100%" height="400" controls>
							<source src="<?php echo $musicMedia_url; ?>?autoplay=0" type="<?php echo $media_uploaded_type; ?>">
						</video>  
					<?php 
					//$increment++;
					} elseif ($media_uploaded_type == 'audio/mp3' ||  
								$media_uploaded_type == 'audio/mpeg' || 
								$media_uploaded_type == 'audio/aac' || 
								$media_uploaded_type == 'audio/x-realaudio' || 
								$media_uploaded_type == 'audio/wav' ||  
								$media_uploaded_type == 'audio/ogg' || 
								$media_uploaded_type == 'audio/flac' || 
								$media_uploaded_type == 'audio/midi' || 
								$media_uploaded_type == 'audio/x-ms-wma' || 
								$media_uploaded_type == 'audio/x-ms-wax' || 
								$media_uploaded_type == 'audio/x-matroska' ){ ?> 
						<audio controls class="pt-2">
							<source src="<?php echo $musicMedia_url; ?>"  >
						</audio> 
					<?php } elseif ( $media_uploaded_type == 'image/jpeg' || 
									$media_uploaded_type == 'image/gif' || 
									$media_uploaded_type == 'image/png' || 
									$media_uploaded_type == 'image/bmp' || 
									$media_uploaded_type == 'image/tiff' || 
									$media_uploaded_type == 'image/x-icon'  ){ ?> 
						<img id="imageResult" src="<?php echo $musicMedia_url; ?>" alt="" class="img-fluid mx-auto d-block pt-2" >
					<?php }
				}elseif( $musicMedia_from == 'youtube' || $musicMedia_from == 'comp_from_yoututbe' ){ ?>    
					<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);
					$youtube_id = $match[1]; ?>
					<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe>
				<?php }elseif( $musicMedia_from == 'soundcloud' || $musicMedia_from == 'comp_from_soundcloud'  ){ ?>   
					<?php // echo do_shortcode("[soundcloud url=". $musicMedia_url ." height='400' width='100%' iframe='true' /]"); ?>    
					<iframe class="embed-responsive-item" width="100%" height="400" src="<?php echo $musicMedia_url; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe> 
				<?php }elseif( $musicMedia_from == 'spotify' || $musicMedia_from == 'comp_spotify' ){ ?> 
					<div class="embed-responsive embed-responsive-16by9">   
						<iframe class="embed-responsive-item" width="100%" height="400" src="<?php echo $musicMedia_url; ?>" autoplay="false" frameborder="0" allowfullscreen></iframe>  
					</div>  
				<?php } ?>		
					 
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