<?php
/*
Template Name: About  Us
*/
 get_header();?>
   <?php
  $fetured_img_about_us = get_option_tree( 'fetured_img_about_us', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_about_us;?>) no-repeat scroll center center;background-size:cover;">
<?php get_template_part('banner');?>
		</section>
<?php get_template_part('navigation');?>
		<section id="sologan_section" class="sologan_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sologan text-center">
							<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
							<h2>Learn about the Brighton Golf Club</h2>
							<p>The Brighton Golf Club of today is very different from the one first mentioned <br>as a founding member of the original Victorian Golf Union of the early 1900's. </p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="berife_history_area" class="berife_history_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="title_breife_history">
						<?php if ( ! dynamic_sidebar( 'about_us_sidebar' ) ) : ?>
							<h2 class="text-center">A brief history</h2>
							<p>The original location of the course played on is unknown, but in 1935 the then Brighton City Council completed the current Brighton Public Golf Course at its Dendy Street site and our early members began playing there.</p>

							<p>In 1952 those members banded together and purchased the property at 99 Glencairn Ave East Brighton which contained a modest dwelling and converted it into a Club House and upgraded the facilities. They later purchased the adjoining property at 97 which is today the car park. This gave them an independent location not relying on Council sheds/rooms to conduct their business.</p>

							<p>The Club became the "Official Club" in residence at the Brighton Public Golf Course, a position which, despite smaller tenants, remains today and through the Club and the Golf Course is able to have official ratings and support competitions, etc. The Rooms at 99-97 Glencairn Ave have direct access to the Golf Course via the practice fairway and are today the hub of competition/social activities by offering official Australian Handicaps via a direct link to the Golf Australia handicapping system (updated within hours of the completion of play), a well stocked bar with friendly and attentive staff, toilets, showers, etc and offering a relaxing and convivial location for golf related post-game banter with like minded people. An extensive array of competition types are offered, additionally the rooms are available for social functions.</p>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="sologan_section_mission_about" class="sologan_section_mission_about">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="mission_about_title text-center">
							<h2>Brighton Golf Club principles</h2>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="mission_about_area text-center">
							<img src="<?php echo get_template_directory_uri();?>/img/principls.png">
							<h3>MISSION</h3>
							<p>Brighton Golf Club will provide members of all ages and abilities with a<br>quality golfing experience within a friendly and welcoming atmosphere. </p>
						</div>
					</div>				
					<div class="col-sm-6">
						<div class="mission_about_area text-center">
							<img src="<?php echo get_template_directory_uri();?>/img/syllbus.png">
							<h3>VISION</h3>
							<p>This we will achieve with highly motivated teams of volunteers, <br>working together to make our Club an enjoyable and affordable place to play golf and socialise.</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="charity_support_area" id="charity_support_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="charity_title text-center">
							<h2>Charity Support</h2>
						</div>
					</div>
				</div>
				<div class="row">
	<?php

    global $post;

    $args = array( 'posts_per_page' => 2, 'post_type'=> 'charity-support');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-6">
						<div class="charity_left">
							<div class="charity_small_img text-center ">
								<?php the_post_thumbnail('charity-thumb', array('class' => 'alignnone')); ?>
								<h2><?php the_title();?></h2>
							</div>
							
							<?php the_content();?>
							<?php 
						$donate_link= get_post_meta($post->ID, 'donate_link', true);
						
						?>
							<div class="charity_link text-center">
								<a class="btn btn-default" href="<?php echo $donate_link;?>">Click to donate</a>
							</div>
						</div>
					</div>
	<?php endforeach; ?>	
				</div>
			</div>
		</section>



		<div class="syllbus_area_about" id="syllbus_area_about">
			<div class="syllbus_area_width">
				<h2 class="text-center">Syllbus</h2>
				<div class="syllbus_area">
	<?php

    global $post;

    $args = array( 'posts_per_page' => 2, 'post_type'=> 'about-syllbus');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="syllbus_area_left">
						<div class="latest_news  post_news_nes_sai_heoght_a">
							<?php the_post_thumbnail('syll-thumb', array('class' => 'alignnone')); ?>
							
						<?php 
						$download_link= get_post_meta($post->ID, 'download_link', true);
						$small_img_upload= get_post_meta($post->ID, 'small_img_upload', true);
						$year_color_picker= get_post_meta($post->ID, 'year_color_picker', true);
						
						?>
						<h2 class="date_download_year text-center" style="background-color:<?php echo $year_color_picker;?>"><?php the_content();?></h2>
						<div class="befits_promo_content">
								<div class="befits_promo_content_img text-center small_text_dwonl">
									
									<img src="<?php echo $small_img_upload;?>">
									<h2><?php the_title();?></h2>
								</div>
							
							<div class="saif_d"><a href="<?php echo $download_link;?>" class="btn btn-default">Download</a></div>
								
								
								
							</div>
						</div>
					</div>
	<?php endforeach; ?>

				</div>
			</div>
		</div>
<section class="club_specilty_area" id="club_specilty_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="club_specilty_title text-center">
							<h2>Meet the Committee of Management</h2>
						</div>
					</div>
				</div>
				<div class="row">
	<?php

    global $post;

    $args = array( 'posts_per_page' => -1, 'post_type'=> 'about-committee','meta_key' => 'about_committee','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-4">
						<div class="Commeitte_member">
							<div class="single_club_specilty text-center single_about_meet_tem">
								<?php the_post_thumbnail('committee-thumb', array('class' => 'alignnone')); ?>
							<?php 
							$committe_name= get_post_meta($post->ID, 'committe_name', true);
							$contact_number= get_post_meta($post->ID, 'contact_number', true);
							$email_address= get_post_meta($post->ID, 'email_address', true);
							
							?>
								<h2><?php echo $committe_name;?></h2>
								<?php the_content();?>
								<h4>Contact: <?php echo $contact_number;?> </h4>
							</div>
							<div class="button_text text-center">
								<a href="mailto:<?php echo $email_address;?>" class="btn btn-default">Email</a>
							</div>
						</div>
					</div>	
<?php endforeach; ?>					
			
					
					

				</div>
				

						
					
				</div>
			</div>
		</section>
		<section class="member_login_area_home another_committe" id="member_login_area_home">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="main_title_generoud text-center">
							<h2>Office Bearers</h2>
						</div>
					</div>
				</div>
				<div class="row">
						<?php
    global $post;
    $args = array( 'posts_per_page' => -1, 'post_type'=> 'women-committee','meta_key' => 'women_committee','orderby' => 'meta_value','order' => 'ASC');
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="committe_another_style">
						<?php the_content();?>

					</div>
	<?php endforeach; ?>
				

				</div>
			</div>
		</section>
		<section id="our_generous_area" class="our_generous_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="main_title_generoud text-center">
							<h2>Links</h2>
						</div>
					</div>
				</div>
				<div class="row">
	<?php
    global $post;
    $args = array( 'posts_per_page' => -1, 'post_type'=> 'generous-partners','partner_cat' => 'Link','meta_key' => 'generous_partners','orderby' => 'meta_value','order' => 'ASC');
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-md-3 col-sm-4">
						<div class="generous_imag text-center">
								<?php the_post_thumbnail('committee-thumb', array('class' => 'alignnone')); ?>
							<div class="generous_pragraph" style="min-height:0px">
								<?php the_content();?>
								<?php 
							$go_website_link= get_post_meta($post->ID, 'go_website_link', true);
						?>
							<div class="website_url_partner"><a href="<?php echo $go_website_link;?>" class="btn btn-default">Go to Website</a></div>
								
							</div>
						</div>
					</div>	
<?php endforeach; ?>					
					
				</div>
			</div>		
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="main_title_generoud text-center">
							<h2>Our generous partners</h2>
						</div>
					</div>
				</div>
				<div class="row">
	<?php
    global $post;
    $args = array( 'posts_per_page' => -1, 'post_type'=> 'generous-partners','partner_cat' => 'Generous Partners','meta_key' => 'generous_partners','orderby' => 'meta_value','order' => 'ASC');
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-md-3 col-sm-4">
						<div class="generous_imag text-center">
								<?php the_post_thumbnail('committee-thumb', array('class' => 'alignnone')); ?>
							<div class="generous_pragraph">
								<?php the_content();?>
								<?php 
							$go_website_link= get_post_meta($post->ID, 'go_website_link', true);
						?>
							<div class="website_url_partner"><a href="<?php echo $go_website_link;?>" class="btn btn-default">Go to Website</a></div>
								
							</div>
						</div>
					</div>	
<?php endforeach; ?>					
					
				</div>
			</div>
		</section>
<?php get_footer();?>