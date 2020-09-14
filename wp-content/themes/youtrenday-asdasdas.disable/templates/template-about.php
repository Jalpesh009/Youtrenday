<?php

/**
 * Template Name: About Us
 */
get_header(); ?>

<main id="site-content">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();	?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<div class="post-inner thin about-us-page">
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

					<div class="container-fluid"> 
						<?php if( get_field('about_content') ):  ?>
							<div class="about-us-content">
								<p><?php the_field('about_content'); ?>
							</div>
						<?php endif; ?>
						<?php 
						if( have_rows('about_whyus') ): 
							while ( have_rows('about_whyus') ) : the_row(); 
								$whyus_title = get_sub_field('whyus_title'); 
								$whyus_content = get_sub_field('whyus_content'); 
								$whyus_image = get_sub_field('whyus_image'); ?>
								<div class="row why-us">
									<div class="col-xs-12 col-md-8">
										<div class="why-us-text">
											<h2> <?php echo $whyus_title; ?></h2>
											<p><?php echo str_replace('<br />', "\n", $whyus_content); ?></p>
										</div>
									</div>
									<div class="col-xs-12 col-md-4">
										<div class="why-us-img text-right">
											<img src="<?php echo $whyus_image['url']; ?>">
										</div>
									</div>
								</div>
							<?php endwhile;  
						endif; ?>	
						<?php 
						if( have_rows('about_team') ): 
							while ( have_rows('about_team') ) : the_row(); 
								$out_team_title = get_sub_field('out_team_title');   ?>
								<div class="our-team">
									<h2><?php echo $out_team_title; ?></h2> 
									<div class="team_border our-team-content">
										<div class="row position-relative team_row equaclass_0" >
											<?php 
											if( have_rows('team_members') ): 
												$i = 1;
												while ( have_rows('team_members') ) : the_row();  
													$teammember_image = get_sub_field('teammember_image'); 
													$teammember_name = get_sub_field('teammember_name'); 
													$teammember_designation	 = get_sub_field('teammember_designation');
													$teammember_description	 = get_sub_field('teammember_description'); ?>
													
													<div class="col-xs-12 col-md-12 col-lg-4 py-4">
														<div class="member-details">
															<div class="team-member-pic">
																<img src="<?php  echo $teammember_image['url']; ?>">
															</div>
															<div class="team-member">
																<h4><?php  echo $teammember_name; ?></h4>
																<h5><?php  echo $teammember_designation; ?></h5>
																<p><?php  echo $teammember_description; ?></p>
															</div>
														</div>
													</div> 
													<?php  
													if($i % 3 !=  0 ){  
													}else{ 
														echo ' </div><div class="row team_row equaclass_'.$i.'" >'; 
													}
													
													$i++;
												endwhile;  
											endif; ?>
										</div>
									</div>
								</div>
							<?php endwhile;  
						endif; ?>	
						<div class="prize mb-5">
							<div class="row">
								<?php 
								if( have_rows('about_top_talent') ): 
									while ( have_rows('about_top_talent') ) : the_row(); 
										$talent_title = get_sub_field('talent_title'); 
										$talent_image = get_sub_field('talent_image'); 
										$talent_content	 = get_sub_field('talent_content');  ?>
										<div class="col-xs-12 col-md-12 col-lg-6">
											<div class="top">
												<h2><?php echo $talent_title; ?></h2>
											</div> 
											<div class="prize-content"> 
												<div class="winner-member">  
													<p><?php echo $talent_content; ?></p>
												</div>
												<div class="winner-member-pic position-relative">
													<img src="<?php echo $talent_image['url']; ?>">
												</div>
											</div>
										</div>
									<?php endwhile;  
								endif; 
								if( have_rows('about_amazing_prizes') ): 
									while ( have_rows('about_amazing_prizes') ) : the_row(); 
										$amazing_prizes_title = get_sub_field('amazing_prizes_title'); 
										$amazing_prizes_image = get_sub_field('amazing_prizes_image'); 
										$amazing_prizes_content	 = get_sub_field('amazing_prizes_content');?>
										<div class="col-xs-12 col-md-12 col-lg-6">
											<div class="prize-detail">
												<h2><?php echo $amazing_prizes_title; ?></h2>
											</div>

											<div class="prize-content">
												<div class="team-member-pic position-relative">
													<img src="<?php echo $amazing_prizes_image['url']; ?>">
												</div>
												<div class="team-member">
													
													<p><?php echo $amazing_prizes_content; ?></p>
												</div>
											</div>
										</div>
									<?php endwhile;  
								endif; ?>
							</div>
						</div>
					</div>
				</div>
			</article>
	<?php }
	} ?>
</main><!-- #site-content -->
<?php get_footer(); ?>