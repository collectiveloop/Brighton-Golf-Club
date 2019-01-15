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
	                 <?php _e( 'Events', 'tee' ); ?>
		  		</h1>
		  		<hr>
  			</div>
  			<!-- CONTENT -->
  			<div id="archive-events" class="row">
	  			<div class="col-md-12">
		  			<?php if ( have_posts() ) : ?>
						<?php /* The loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="row event">
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
					  			<?php if( get_post_meta( get_the_ID(), 'tee_event_datetime', true ) != ""){ ?>
					  				<div class="event-card center animate_right_left">
										<h2><?php _e("When Is It ?","tee"); ?></h2>
										<?php
									    /* DATE FORMAT => YEAR-MO-DA HO:MI */
									    $the_date = get_post_meta( get_the_ID(), 'tee_event_datetime', true );
									    $the_day = substr($the_date, 8, -6);
									    $the_year = substr($the_date, 0, 4);
									    $the_month = substr($the_date, 5, -9);
									    $the_time = substr($the_date, -5);
									    if($the_month=="01"){ $the_month_final = __("January", "tee"); }
									    if($the_month=="02"){ $the_month_final = __("February", "tee"); }
									    if($the_month=="03"){ $the_month_final = __("March", "tee"); }
									    if($the_month=="04"){ $the_month_final = __("April", "tee"); }
									    if($the_month=="05"){ $the_month_final = __("May", "tee"); }
									    if($the_month=="06"){ $the_month_final = __("June", "tee"); }
									    if($the_month=="07"){ $the_month_final = __("July", "tee"); }
									    if($the_month=="08"){ $the_month_final = __("August", "tee"); }
									    if($the_month=="09"){ $the_month_final = __("September", "tee"); }
									    if($the_month=="10"){ $the_month_final = __("October", "tee"); }
									    if($the_month=="11"){ $the_month_final = __("November", "tee"); }
									    if($the_month=="12"){ $the_month_final = __("December", "tee"); }
									    ?>
										<p><span class="icon icon-calendar"></span> <?php echo $the_month_final.' '.$the_day.', '. $the_year .' at '. $the_time; ?></p>
										<hr>
									<?php } ?>
										<h2><?php _e("Where ?", "tee"); ?></h2>
										<p><span class="icon icon-location"></span> <?php echo get_post_meta( get_the_ID(), 'tee_event_location', true ); ?></p>
										<p><?php echo get_post_meta( get_the_ID(), 'tee_event_address', true ); ?></p>
										<?php if(get_option('tee_mail') != "") { ?>
											<hr>
											<div class="center">
												<a href="mailto:<?php echo get_option('tee_mail'); ?>" class="btn btn-default">
													<i class="icon-mail"></i> <?php _e("Got a Question ?","tee"); ?>
												</a>
											</div>
										<?php } ?>
										<?php if(get_post_meta( get_the_ID(), 'tee_event_external', true ) != ""){ ?>
											<div class="center">
												<a href="<?php echo get_post_meta( get_the_ID(), 'tee_event_external', true ); ?>" class="btn btn-default">
													<i class="icon-link"></i> <?php _e("Sign Up","tee"); ?>
												</a>
											</div>
										<?php } ?>
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