<?php
/**
 * The template for displaying Archive pages.
 */
 get_header(); ?>
	
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
		  		<h1>
	                 <?php _e( 'Courses', 'tee' ); ?>
		  		</h1>
		  		<hr>
  			</div>
  			<!-- CONTENT -->
  			<div id="archive-courses" class="row">
	  			<div class="col-md-12">
		  			<?php if ( have_posts() ) : ?>
						<?php /* The loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="row course">
					  			<div class="col-md-8">
					  				<div class="heading page-title animate_right_left">
								  		<h1><?php the_title(); ?></h1>
								  		<hr>
						  			</div>
					  				<?php if ( has_post_thumbnail() ) { ?>
						  				<span class="post-image-wrapper">
											<?php the_post_thumbnail(); ?>
										</span>
										<hr>
									<?php } ?>
					  				<div class="post-content">
					  					<?php the_excerpt(); ?>
					  				</div>
									<div class="center">
										<a href="<?php the_permalink(); ?>" class="btn btn-default"><i class="icon-plus2"></i> <?php _e("Read More","tee"); ?></a>
									</div>
					  			</div>
					  			<div class="col-md-4">
					  				<div class="course-card center animate_right_left">
										<h2><?php _e("Course Informations","tee"); ?></h2>
										<p><span class="icon icon-calendar"></span> 
										<?php if(get_post_meta( get_the_ID(), 'tee_course_reccurent', true ) !=""): ?>
											<?php echo get_post_meta( get_the_ID(), 'tee_course_reccurent', true ); ?>
										<?php else : ?>
											<?php echo get_post_meta( get_the_ID(), 'tee_course_date', true ); ?>
										<?php endif; ?>
										</p>
										<p><span class="icon icon-location"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_rendezvous', true ); ?></p>
										<?php if(get_post_meta( get_the_ID(), 'tee_course_places', true ) != ""){ ?>
											<p><span class="icon icon-users"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_places', true ); ?></p>
										<?php } ?>
										<p><span class="icon icon-user"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_professor', true ); ?></p>
										<?php if(get_post_meta( get_the_ID(), 'tee_course_contact', true ) != "") { ?>
											<div class="center">
												<a href="<?php echo get_post_meta( get_the_ID(), 'tee_course_contact', true ); ?>" class="btn btn-default">
													<i class="icon-mail"></i> <?php _e("Contact the teacher","tee"); ?>
												</a>
											</div>
										<?php } ?>
										<hr>
										<h2 class="course-price"><?php echo get_post_meta( get_the_ID(), 'tee_course_price', true ); ?><?php if(get_post_meta( get_the_ID(), 'tee_course_per', true)) : ?><span><?php _e("/hour","tee"); ?></span><?php endif; ?></h2>
						  			</div>
					  			</div>
				  			</div>
						<?php endwhile; ?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
						<?php tee_paging_nav(); ?>
					</div>
	  			<?php get_sidebar(); ?>
  			</div>
	  	</section>
  		<!-- END CONTAINER -->
  	</div>
  	<!-- END MAIN CONTAINER -->
	
<?php get_footer(); ?>