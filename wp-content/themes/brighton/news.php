<?php 
/*
Template Name: News
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
		<section id="sologan_section" class="sologan_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sologan text-center">
							<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
							<h2>Find out what’s going on at the Brighton Golf Club</h2>
							<p>There is always a lot going on at our club, and we believe in sharing our news with our membership group.<br>If you’re interested in an upcoming event simply get in-touch and we’ll get you involved.</p> 
						
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="benefits_area" id="benefits_area">
			<div class="container">
				<div class="row">
					<div class="benefits">
						<h2 class="text-center">Read about the latest news at our club</h2>
					</div>
	<?php

    global $post;

    $args = array( 'posts_per_page' => -1, 'post_type'=> 'post','category_name'=> 'Main News');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-4">
						
						<div class="latest_news wow_news">
							<?php the_post_thumbnail('news-thumb-news', array('class' => 'alignnone')); ?>
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
		<section class="news_events_area" id="news_events_area">
			<div class="container">
				<div class="row">
					<div class="benefits">
						<h2 class="text-center">Brighton Golf Club upcoming events</h2>
					</div>
	<?php
    global $post;
    $args = array( 'posts_per_page' => -1, 'post_type'=> 'news-events');
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) : setup_postdata($post); ?>
					
					<div class="col-sm-4">
						<div class="latest_news_event">
							<?php the_post_thumbnail('news-thumb-news', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content">
						<?php 
						$event_small_image_new= get_post_meta($post->ID, 'event_small_image_new', true);
						$event_date= get_post_meta($post->ID, 'event_date', true);
						$event_loctaion= get_post_meta($post->ID, 'event_loctaion', true);
						$event_cost= get_post_meta($post->ID, 'event_cost', true);
						$event_to_link= get_post_meta($post->ID, 'event_to_link', true);
						
						?>
								<div class="befits_promo_content_img text-center">
									<img src="<?php echo $event_small_image_new;?>">
									<h2><?php the_title();?></h2>
								</div>
								<div class="events_date_time">
								<table>

									  <tr>
										<td>Date</td>
										<td id="right_td"><?php echo $event_date;?></td>
									  </tr>
									  <tr>
										<td>Location</td>
										<td id="right_td"><?php echo $event_loctaion;?></td>
									  </tr>		
									  <tr>
										<td>Cost</td>
										<td id="right_td"><?php echo $event_cost;?></td>
									  </tr>
								</table>
								</div>
								<div class="find_more_s">
								<?php the_content();?>
								</div>
								<a href="<?php echo $event_to_link;?>" class="btn btn-default">More Info</a>
								
								
							</div>
						</div>
						
					</div>	
<?php endforeach; ?>
				</div>
			</div>
		</section>
		
<?php get_footer();?>