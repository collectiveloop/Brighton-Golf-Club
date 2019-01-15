<?php
/*
Template Name: Courses
*/
get_header(); ?>
	
<?php while ( have_posts() ) : the_post(); ?>
	
	<?php if ( is_front_page() && shortcode_exists('rev_slider') ) { ?>
		<div id="background">
			<?php putRevSlider("home"); ?>
		</div>
	<?php } else { ?>
		<!-- BACKGROUND HEADER-->
		<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		  	<div id="background" class="small" style="background-image: url('<?php echo $url; ?>');"></div>
		<?php } else { ?>
			<?php $imageUrl1 = get_template_directory_uri(). '/images/backgrounds/default.jpg'; ?>
			<div id="background" class="small" style="background-image: url('<?php echo get_theme_mod( 'tee_bg_default', $imageUrl1); ?>');"></div>
		<?php } ?>
	<?php } ?>
	
  	</header>
  	<!-- END HEADER -->
  	
  	<!-- START MAIN CONTAINER -->
  	<div id="main-container">
  		<!-- START CONTAINER -->
	  	<section id="container" class="container">
	  		<!-- TITLE -->
  			<div class="heading page-title animate_right_left">
		  		<h1><?php the_title(); ?></h1>
		  		<hr>
  			</div>
		</section>
	  	<div class="colored-container">
  			<!-- courseS CONTAINER -->
  			<div id="courses-container" class="container">
  				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
                <?php $wp_query = new WP_Query('post_type=courses&post_status=publish&paged='.$paged.'&showposts=9');?>
	  			<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
							<!-- START COURSE -->
			                <div class="slide">
								<div class="course">
									<?php if ( has_post_thumbnail() && ! post_password_required() ){?>
										<div class="course-header">
											<a href="<?php the_permalink(); ?>">
												<?php echo get_the_post_thumbnail(get_the_ID(), 'tee-courses'); ?> 
											</a>
										</div>
									<?php } ?>
									<div class="course-content">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="course-data">
											<p><span class="icon icon-calendar"></span> 
											<?php if(get_post_meta( get_the_ID(), 'tee_course_reccurent', true ) !=""): ?>
												<?php echo get_post_meta( get_the_ID(), 'tee_course_reccurent', true ); ?>
											<?php else : ?>
												<?php echo get_post_meta( get_the_ID(), 'tee_course_date', true ); ?>
											<?php endif; ?>
											</p>
											<p><span class="icon icon-location"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_rendezvous', true ); ?></p>
											<p><span class="icon icon-user"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_professor', true ); ?></p>
											<p><span class="icon icon-flag"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_price', true ); ?> 
											<?php if(get_post_meta( get_the_ID(), 'tee_course_per', true)) : ?><?php _e("per hour","tee"); ?><?php endif; ?></p>
										</div>
										<?php echo substr(get_the_excerpt(), 0,120); ?>
										<div class="center">
											<a href="<?php the_permalink(); ?>" class="btn btn-default"><i class="icon-plus2"></i> <?php _e("Read More","tee"); ?></a>
										</div>
									</div>
								</div>
							</div>
							<!-- END course -->
						<?php endwhile; ?>
			    <?php endif; ?>
			</div>
  		</div>
  		<section class="container">
			<?php tee_paging_nav(); ?>
			<?php wp_reset_query(); ?>
	  	</section>
  		<!-- END CONTAINER -->
  	</div>
  	<!-- END MAIN CONTAINER -->
	
  	<?php endwhile; ?>
  	
<?php get_footer(); ?>