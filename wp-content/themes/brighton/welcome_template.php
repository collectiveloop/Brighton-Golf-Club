<?php
/*
Template Name: Front Page
*/
 get_header();?>
  <?php
  $fetured_img_home = get_option_tree( 'fetured_img_home', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_home;?>) no-repeat scroll center center;background-size:cover;">
			
				<?php get_template_part('banner');?>
			
		</section>
<?php get_template_part('navigation');?>
		<section id="sologan_section" class="sologan_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sologan text-center">
							<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
							<h2>Welcome to the Brighton Golf Club</h2>
							<p>Brighton Golf Club provides it's members of all ages and abilities with a quality golfing experience<br> within a friendly and welcoming atmosphere. </p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="benefits_area" id="benefits_area">
		
		
		
					<div class="syllbus_area_width">
				<h2 class="text-center">Benefits of Brighton Golf Club</h2>
				<div class="syllbus_area">
	<?php

    global $post;

    $args = array( 'posts_per_page' => 3, 'post_type'=> 'benefits-items','meta_key' => 'benefits_order','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="syllbus_area_left">
						<div class="latest_news home_changes_area">
							<?php the_post_thumbnail('benefits-thumb', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content">
								<div class="befits_promo_content_img text-center">
						<?php 
						$small_images_banefit= get_post_meta($post->ID, 'small_images_banefit', true);
						$find_out_home_more= get_post_meta($post->ID, 'find_out_home_more', true);
						
						?>
									<img src="<?php echo $small_images_banefit; ?>">
									<h2><?php the_title();?></h2>
								</div>
								<div class="find_more">
								<?php the_excerpt();?>
								</div>
								<div class="fond_ot_home">
								<a href="<?php echo $find_out_home_more; ?>" class="btn btn-default">Find out more</a>
								</div>
								
							</div>
						</div>
					</div>
	<?php endforeach; ?>

				</div>
			</div>
		</section>
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