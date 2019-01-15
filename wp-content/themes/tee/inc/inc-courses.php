<?php
/**
 * The template for displaying courses shortcode
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
		<ul class="slides">
			<?php  query_posts(array('post_type' => 'courses', 'showposts' => $display_final , 'posts_per_page'=>-1)); ?>
			  	<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<li>
							<!-- START course -->
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
						</li>
					<?php endwhile; ?>
				<?php endif; ?>
		  	<?php wp_reset_query(); ?>
		</ul>
	</div>
</div>
<div class="container button-container">
	<a href="<?php echo $button_url_final; ?>" class="btn btn-default pull-right"><i class="icon-flag"></i> 
	<?php _e("All courses", "tee"); ?></a>
</div>
<section class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post-content">
				<div class="wpb_row vc_row-fluid">
					<div class="vc_span12 wpb_column column_container">
						<div class="wpb_wrapper">
			