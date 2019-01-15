<?php
/**
 * The template for displaying sponsors
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
	<div class="container center">
		<?php  query_posts(array('post_type' => 'sponsor', 'order' => 'DESC' , 'posts_per_page'=>-1)); ?>
		  	<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<!-- A SPONSOR -->
					<a href="<?php echo get_post_meta( get_the_ID(), 'tee_sponsor_url', true ); ?>" class="sponsor">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php endwhile; ?>
			<?php endif; ?>
	  	<?php wp_reset_query(); ?>
	</div>
</div>
<section class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="post-content">
				<div class="wpb_row vc_row-fluid">
					<div class="vc_span12 wpb_column column_container">
						<div class="wpb_wrapper">
			