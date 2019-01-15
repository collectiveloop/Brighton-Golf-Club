<?php
/*
Template Name: Front Page 2
*/
 get_template_part('header-home');?>

 

 
 
 <?php get_template_part('navigation');?>
  <?php
  $fetured_img_home = get_option_tree( 'fetured_img_home', '', false );
  
  ?>

		<section class="banner_area" id="banner_area">
			<div class="slider_area_header">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
								<?php
									global $post;
									$args = array( 'posts_per_page' => -1, 'post_type'=> 'slider' );
									$myposts = get_posts( $args );
									foreach( $myposts as $post ) : setup_postdata($post); ?>
						<div class="item">

						<?php
							 $tablate_mobile = get_post_meta($post->ID, 'tablate_mobile', true);
						?>
							<?php if($tablate_mobile):?>
							<img class="only_mobile" src="<?php echo $tablate_mobile;?>"/>
							<?php endif;?>

						  <?php the_post_thumbnail('slider-thum', array('class' => 'slider-single')); ?>
							<div class="carousel-caption-new">
								<div class="carousel-caption-new-inner">
										<h2><?php the_title();?></h2>
										<?php the_content();?>
										
										<?php
											$button_text = get_post_meta($post->ID, 'button_text', true);
											$button_link = get_post_meta($post->ID, 'button_link', true);
											$border_color = get_post_meta($post->ID, 'border_color', true);
										?>
										
										<a href="<?php echo $button_link; ?>" style="border:1px solid<?php echo $border_color; ?>;background-color:<?php echo $border_color; ?>;"><?php echo $button_text; ?></a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

					  </div>
		
						  <!-- Controls -->
						  <a class="left previous_s" href="#carousel-example-generic" role="button" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						  </a>
						  <a class="right next_s" href="#carousel-example-generic" role="button" data-slide="next">
							<i class="fa fa-angle-right"></i>
							
						  </a>
					</div>
			</div>
				
		</section>

		<section id="sologan_section" class="sologan_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sologan text-center">
							<h2>Find out what’s going on at the Brighton Golf Club</h2>
							<p>There is always a lot going on at our club, and we believe in sharing our news with our membership group. <br>If you’re interested in an upcoming event simply get in-touch and we’ll get you involved.  </p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--<section class="benefits_area" id="benefits_area">
			<div class="container">
				<div class="row">
					<div class="benefits">
						<h2 class="text-center">Read about the latest news at our club</h2>
					</div>
	<?php 

    //global $post;

    //$args = array( 'posts_per_page' => 3, 'post_type'=> 'home-latest-news');

    //$myposts = get_posts( $args );

    //foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-4">
						
						<div class="latest_news wow_news">
							<?php //the_post_thumbnail('news-thumb-news', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content">
								<div class="befits_promo_content_img text-center">
						<?php 
						//$latest_news_title= get_post_meta($post->ID, 'latest_news_title', true);
						//$latest_news_small_thum= get_post_meta($post->ID, 'latest_news_small_thum', true);
						//$click_to_read= get_post_meta($post->ID, 'click_to_read', true);
						//$click_to_link= get_post_meta($post->ID, 'click_to_link', true);
						
						?>
									<img src="<?php// echo $latest_news_small_thum;?>"/>
									<h2><?php// the_title();?></h2>
									<?php// the_content();?>
								</div>
								<div class="for_membership_apply_ww"><a href="<?php //echo $click_to_link;?>" class="btn btn-default"><?php // echo $click_to_read;?></a></div>
								
								
								
							</div>
						</div>
						
					</div>
<?php //endforeach; ?>					
				
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
    //global $post;
   // $args = array( 'posts_per_page' => 3, 'post_type'=> 'home-news-events');
   // $myposts = get_posts( $args );
   // foreach( $myposts as $post ) : setup_postdata($post); ?>
					
					<div class="col-sm-4">
						<div class="latest_news_event">
							<?php// the_post_thumbnail('news-thumb-news', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content">
						<?php 
						//$event_small_image_new= get_post_meta($post->ID, 'event_small_image_new', true);
						//$event_date= get_post_meta($post->ID, 'event_date', true);
						//$event_loctaion= get_post_meta($post->ID, 'event_loctaion', true);
						//$event_cost= get_post_meta($post->ID, 'event_cost', true);
						//$event_to_link= get_post_meta($post->ID, 'event_to_link', true);
						
						?>
								<div class="befits_promo_content_img text-center">
									<img src="<?php //echo $event_small_image_new;?>">
									<h2><?php //the_title();?></h2>
								</div>
								<div class="events_date_time">
								<table>

									  <tr>
										<td>Date</td>
										<td id="right_td"><?php //echo $event_date;?></td>
									  </tr>
									  <tr>
										<td>Location</td>
										<td id="right_td"><?php// echo $event_loctaion;?></td>
									  </tr>		
									  <tr>
										<td>Cost</td>
										<td id="right_td"><?php// echo $event_cost;?></td>
									  </tr>
								</table>
								</div>
								<div class="find_more_s">
								<?php //the_content();?>
								</div>
								<a href="<?php //echo $event_to_link;?>" class="btn btn-default">More Info</a>
								
								
							</div>
						</div>
						
					</div>	
<?php //endforeach; ?>
				</div>
			</div>
		</section>-->
<?php $book_a_tee_link = get_option_tree( 'book_a_tee_link', '', false );?>
		<section class="tree_area" id="tree_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<div class="tree_height">
						<div class="tree_content">
							<div class="tree_title text-center">
								<h2>Book a Tee-Time</h2>
								<h4>You will be redirtected to Brighton Golf Course to book your Tee-Time</h4>
							</div>							

						</div>
						<div class="tree_anchor">
								<a href="<?php echo $book_a_tee_link; ?>" class="btn btn-default">Book now</a>
						</div>
					</div>
				</div>
				</div>
			</div>
		</section>
		<section class="club_specilty_area" id="club_specilty_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="club_specilty_title text-center">
							<h2>Find out what makes Brighton Golf Club special</h2>
						</div>
					</div>
				</div>
				<div class="row">
	<?php

    global $post;

    $args = array( 'posts_per_page' => -1, 'post_type'=> 'special-items','meta_key' => 'special_order','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-4">
						<div class="single_club_specilty text-center">
							<?php the_post_thumbnail('special-thumb', array('class' => 'alignnone')); ?>
							<h2><?php the_title();?></h2>
							<?php the_content();?>
						</div>
					</div>
	<?php endforeach; ?>

				</div>
				<?php $golf_special_link = get_option_tree( 'golf_special_link', '', false );?>
				<div class="row">
					<div class="col-sm-12">
						<div class="button_text text-center">
							<a href="<?php echo $golf_special_link; ?>" class="btn btn-default">Find out more</a>
						</div>
						
					</div>
				</div>
			</div>
		</section>
		<section class="member_login_area_home" id="member_login_area_home">
	<?php $member_login = get_option_tree( 'member_login', '', false );?>
			<div class="container">
	<?php

    global $post;

    $args = array( 'posts_per_page' => 1, 'post_type'=> 'member-login');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="memmber_title text-center">
							<h2><?php the_title();?></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="member_image_left text-right">
							<?php the_post_thumbnail('login-thumb', array('class' => 'alignnone')); ?>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="member_text_right">
							<?php the_content();?>
							<div class="go_to_login">
								<a href="<?php echo $member_login;?>" class="btn btn-default">Go to login</a>
							</div>
							
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</section>
		<section class="partners_area" id="partners_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2>Partners</h2>
					</div>
				</div>
				<div class="row">
					<div class="main_partners_div text-center">
						<?php

						global $post;

						$args = array( 'posts_per_page' => -1, 'post_type'=> 'generous-partners','meta_key' => 'generous_partners','orderby' => 'meta_value','order' => 'ASC');

						$myposts = get_posts( $args );

						foreach( $myposts as $post ) : setup_postdata($post); ?>
							<div class="single_partner_div">
						<?php 
						$go_website_link= get_post_meta($post->ID, 'go_website_link', true);
						
						?>
								<a href="<?php echo $go_website_link;?>"><?php the_post_thumbnail('partner-thumb', array('class' => 'alignnone')); ?></a>
							</div>
						<?php endforeach; ?>
						
					</div>
				</div>
			</div>						
							
		</section>
		<section class="contact_us_area" id="contact_us_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="contact_us">
							<h2 class="text-center">Contact Us about anything</h2>
			<?php echo do_shortcode('[contact-form-7 id="221" title="main-contact-from"]');?>
							
							
						</div>
					</div>
				</div>
			</div>
			
		</section>
<?php get_footer();?>