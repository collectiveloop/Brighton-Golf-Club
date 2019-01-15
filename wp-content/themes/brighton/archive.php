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
		
					<div class="col-sm-12">
	<h1 style="display:none" class="archivetitle">
									<?php if (have_posts()) : ?>
										<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
											<?php /* If this is a category archive */ if (is_category()) { ?>
												<?php _e('Archive for the'); ?> '<?php echo single_cat_title(); ?>' <?php _e('Category'); ?>                                    
											<?php /* If this is a tag archive */  } elseif( is_tag() ) { ?>
												<?php _e('Archive for the'); ?> <?php single_tag_title(); ?> Tag
											<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
												<?php _e('Archive for'); ?> <?php the_time('F jS, Y'); ?>                                        
											<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
												<?php _e('Archive for'); ?> <?php the_time('F, Y'); ?>                                    
											<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
												<?php _e('Archive for'); ?> <?php the_time('Y'); ?>                                        
											<?php /* If this is a search */ } elseif (is_search()) { ?>
												<?php _e('Search Results'); ?>                           
											<?php /* If this is an author archive */ } elseif (is_author()) { ?>
												<?php _e('Author Archive'); ?>
											<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
												<?php _e('Blog Archives'); ?>
									<?php } ?>
								</h1>
								<div id="arcive-post-cat">
										<?php get_template_part('post-loop'); ?>
								</div>
								<?php else : ?>
									<h3><?php _e('404 Error&#58; Not Found'); ?></h3>
								<?php endif; ?>
					</div>	
				
				</div>

			</div>
		</section>
	
<?php get_footer();?>