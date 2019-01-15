<?php 
/*
Template Name: News Past Editaion
*/
get_header();?>
  <?php
  $fetured_img_news = get_option_tree( 'fetured_img_news', '', false );
  $news_upcomming_click = get_option_tree( 'news_upcomming_click', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_news;?>) no-repeat scroll center center;background-size:cover;">
				<?php get_template_part('banner');?>
		</section>
<?php get_template_part('navigation');?>
		<section class="benefits_area" id="benefits_area">
			<div class="container">
				<div class="row">
					<div class="benefits">
						<h2 class="text-center">Read about the Past Editions news at our club</h2>
					</div>
	<?php

    global $post;

    $args = array( 'posts_per_page' => -1, 'post_type'=> 'post', 'category_name'=> 'Past News');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-4">
						
						<div class="latest_news wow_news past_news_area_new">
							<?php the_post_thumbnail('news-thumb-news', array('class' => 'alignnone past_news')); ?>
							<div class="befits_promo_content">
								<div class="befits_promo_content_img text-center">
						<?php 
						$latest_news_title= get_post_meta($post->ID, 'latest_news_title', true);
						$latest_news_small_thum= get_post_meta($post->ID, 'latest_news_small_thum', true);
						$click_to_read= get_post_meta($post->ID, 'click_to_read', true);
						$click_to_link= get_post_meta($post->ID, 'click_to_link', true);
						
						?>
									
									<?php echo $latest_news_title;?>
								</div>
								<div class="for_membership_apply_ww"><a href="<?php echo $click_to_link;?>" class="btn btn-default"><?php echo $click_to_read;?></a></div>
								
								
								
							</div>
						</div>
						
					</div>	
<?php endforeach; ?>					
				
				</div>
			</div>
		</section>		

		
<?php get_footer();?>