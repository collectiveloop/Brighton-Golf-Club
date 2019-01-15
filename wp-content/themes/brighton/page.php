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
				<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="row">
					<div class="benefits">
						<h2 class="text-center"><?php the_title();?></h2>
					</div>
		
					<div class="col-sm-12">

						<div class="single_benefits single_single_banefits">
						
							<div class="befits_promo_content">
								<div class="find_more single_page_wp">
								<?php the_content();?>
								</div>
								
								
							</div>
						</div>
						
					</div>	
				
				</div>
							<?php endwhile; ?>
			<?php else : ?>
			<h2>Post not found!</h2>
			<?php endif; ?>	
			</div>
		</section>
	
<?php get_footer();?>