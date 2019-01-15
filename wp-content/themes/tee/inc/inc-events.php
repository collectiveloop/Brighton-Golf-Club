<?php
/**
 * The template for displaying events shortcode
 */
?>
							</div><!-- END .wpb_wrapper -->
						</div><!-- END .vc_span12 -->
					</div><!-- END .wpb_row -->
				</div><!-- END .post-content -->
			</div><!-- END .row -->
	</div><!-- END .col-md -->
</section><!-- END #CONTAINER -->
<div class="colored-container">
	<div class="content-carousel flexslider container">
		<?php 
		$tee_events_order = get_option('tee_events_order');
		if($tee_events_order == "ascending"): 
			$theorder = "ASC";
		else:
			$theorder = "DESC";
		endif; ?>
		<ul class="slides">
			<?php  query_posts(array('post_type' => 'events', 'order' => $theorder, 'orderby' => 'meta_value', 'meta_key' => 'tee_event_datetime' , 'posts_per_page'=> -1)); ?>
			  	<?php if ( have_posts() ) : ?>
			  		<?php $count = 0; ?>
					<?php while ( have_posts() && $count < $display_final) : the_post(); ?>
						<?php $count++; ?>
						<?php if( !get_post_meta( get_the_ID(), 'tee_event_private', true) || is_user_logged_in()) : ?>
							
							<?php 
								$the_date_event = get_post_meta( get_the_ID(), 'tee_event_datetime', true );
								$the_month_event = substr($the_date, 5, -9);
								$today = date('m/d/Y h:i:s a', time());
							?>
							<?php if($the_date_event =="" or strtotime($the_date_event) > strtotime($today) or get_post_meta( get_the_ID(), 'tee_event_hide', true ) != true): ?>
							<li>
								<!-- START EVENT -->
				                <div class="slide">
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

												<p><span class="icon icon-location"></span> <?php echo get_post_meta( get_the_ID(), 'tee_event_location', true ); ?></p>
											</div>
											<?php echo substr(get_the_excerpt(), 0,120); ?>
											<div class="center">
												<a href="<?php the_permalink(); ?>" class="btn btn-default"><i class="icon-plus2"></i> <?php _e("Read More","tee"); ?></a>
											</div>
										</div>
									</div>
								</div>
								<!-- END EVENT -->
							</li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>
		  	<?php wp_reset_query(); ?>
		</ul>
	</div>
</div>
<div class="container button-container">
	<a href="<?php echo $button_url_final; ?>" class="btn btn-default pull-right"><i class="icon-pictures"></i> 
	<?php _e("All Events", "tee"); ?></a>
</div>
<section class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post-content">
				<div class="wpb_row vc_row-fluid">
					<div class="vc_span12 wpb_column column_container">
						<div class="wpb_wrapper">
			