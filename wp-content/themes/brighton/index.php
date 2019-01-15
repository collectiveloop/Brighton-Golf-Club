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
					<div class="benefits">
						<h2 class="text-center">Blog</h2>
					</div>
					<?php get_template_part('post-loop');?>
				</div>
			</div>
		</section>
	
<?php get_footer();?>