<?php
/*
Template Name: Events
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
  			<!-- EVENTS CONTAINER -->
  			<div id="events-container" class="container">
  				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
  				<?php 
			$tee_events_order = get_option('tee_events_order');
			if($tee_events_order == "ascending"): 
				$theorder = "ASC";
			else:
				$theorder = "DESC";
			endif; ?>
                <?php 
                $wp_query = new WP_Query('post_type=events&post_status=publish&order='.$theorder.'&orderby=meta_value&meta_key=tee_event_datetime&paged='.$paged.'&showposts=9');?>
	  			<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
					
						<?php if( !get_post_meta( get_the_ID(), 'tee_event_private', true) || is_user_logged_in()) : ?>
							<!-- START EVENT -->
							<?php 
								$the_date_event = get_post_meta( get_the_ID(), 'tee_event_datetime', true );
								$the_month_event = substr($the_date, 5, -9);
								$today = date('m/d/Y h:i:s a', time());
							?>
							<?php if($the_date_event == "" or strtotime($the_date_event) > strtotime($today) or get_post_meta( get_the_ID(), 'tee_event_hide', true ) != true): ?>
				                <div class="slide <?php echo "date". $the_month_event ; ?>">
									<div class="event">
										<?php if ( has_post_thumbnail() && ! post_password_required() ){?>
											<div class="event-header">
												<a href="<?php the_permalink(); ?>">
													<?php echo get_the_post_thumbnail(get_the_ID(), 'tee-events'); ?> 
												</a>
											</div>
										<?php } ?>
										<div class="event-content">
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<div class="event-data">
												<?php $the_date = get_post_meta( get_the_ID(), 'tee_event_datetime', true );
												$the_date_final =  get_post_meta( get_the_ID(), 'tee_event_datetime_end', true ); ?>
											    <?php if( get_post_meta( get_the_ID(), 'tee_event_datetime', true ) != ""){ ?>
													<p><span class="icon icon-calendar"></span> <?php echo tee_events_date($the_date); ?>
													<?php if( get_post_meta( get_the_ID(), 'tee_event_datetime_end', true ) != ""): ?> 
													- <?php echo tee_events_date($the_date_final); ?><?php endif; ?></p>
												<?php } ?>
												
												<P><span class="icon icon-location"></span> <?php echo get_post_meta( get_the_ID(), 'tee_event_location', true ); ?></p>
											</div>
											<?php echo substr(get_the_excerpt(), 0,120); ?>
											<div class="center">
												<a href="<?php the_permalink(); ?>" class="btn btn-default"><i class="icon-plus2"></i> <?php _e("Read More","tee"); ?></a>
											</div>
										</div>
									</div>
								</div>
								<!-- END EVENT -->
							<?php endif; ?>
			    		<?php endif; ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
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