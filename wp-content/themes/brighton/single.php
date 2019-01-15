<?php get_header();?>
  <?php
  $fetured_img_home = get_option_tree( 'fetured_img_home', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_home;?>) no-repeat scroll center center;background-size:cover;">
			
				<?php get_template_part('banner');?>
			
		</section>
<?php get_template_part('navigation');?>

		<section class="benefits_area blog_ares" id="benefits_area">
			<div class="container">
				<div class="row">
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
					<div class="col-sm-12">

						<div class="single_benefits single_single_banefits">
						
							<div class="single_post__share_befits_promo_content">
								<div id="blog_single_post_f_t_share" class="befits_promo_content_img">
									
									<h2><?php the_title();?></h2>
									<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_native_toolbox"></div>
								</div>
								<div class="find_more">
								<?php the_post_thumbnail('post-blog-thumb', array('class' => 'alignleft single_post_img_left')); ?>
								<?php the_content();?>
								</div>
								
								
							</div>
						</div>
						
					</div>	
			<?php endwhile; ?>
			<?php else : ?>
			<h2>Post not found!</h2>
			<?php endif; ?>					
				</div>
			</div>
		</section>
	
<?php get_footer();?>