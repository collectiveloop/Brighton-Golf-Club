<?php
/*
Template Name: Blog Page
*/
 get_header();?>
  <?php
  $fetured_img_membership = get_option_tree( 'fetured_img_membership', '', false );
  $membership_options_apply_link = get_option_tree( 'membership_options_apply_link', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_membership;?>) no-repeat scroll center center;background-size:cover;">
			<?php get_template_part('banner');?>
		</section>
<?php get_template_part('navigation');?>

		<section class="membership_bg_area" id="membership_bg_area">
			<div class="container">
				<div class="row">
					<div class="benefits">
						<h2 class="text-center">Our Blog</h2>
					</div>
	<?php
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query('post_type=blogs-post' . '&paged=' . $paged . '&posts_per_page=9');
		?>
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<li class="col-md-4 col-sm-6">
					<div>
						
						<div class="new_blog_post_height">
							<?php the_post_thumbnail('post-blog-thumb', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content">
								<div class="new_blog_post_single_content text-center">
									<h2><?php the_title();?></h2>
								</div>
								<div class="find_more">
								<?php the_excerpt();?>
								</div>

								<div class="for_membership_apply_ww">
								<a href="<?php the_permalink();?>" class="btn btn-default">Read More..</a>
								</div>
								
								
								
							</div>
						</div>
						
					</div>	
				</li>
		
		<?php endwhile; ?>
		<div class="clearfix"></div>
	<div id="paged_s">
		<?php kriesi_pagination();?>
	</div>
	<?php $wp_query = null; $wp_query = $temp; ?>			
					
				</div>
			</div>
		</section>


<?php get_footer();?>