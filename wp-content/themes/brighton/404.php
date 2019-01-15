<?php get_header();?>
  <?php
  $fetured_img_news = get_option_tree( 'fetured_img_news', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_news;?>) no-repeat scroll center center;background-size:cover;">
				<?php get_template_part('banner');?>
		</section>
<?php get_template_part('navigation');?>

		<section class="benefits_area blog_ares" id="benefits_area">
			<div class="container">
				<div class="row">
		
					<div class="col-sm-12">
						<div class="not-found text-center">
							<h1>404</h1>
							<h1>Not Found</h1>
						</div>
					</div>	
				
				</div>

			</div>
		</section>
	
<?php get_footer();?>