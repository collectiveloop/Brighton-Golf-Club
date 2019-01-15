<?php 
/*
Template Name: Contact Us
*/
get_header();?>
<?php 
  $fetured_img_contact_page = get_option_tree( 'fetured_img_contact_page', '', false );
  
  ?>


		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_contact_page;?>) no-repeat scroll center center;background-size:cover;">
			<?php get_template_part('banner');?>
		</section>
<?php get_template_part('navigation');?>
		<section id="sologan_section" class="sologan_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sologan text-center">
							<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
							<h2>Contact Us</h2>
							<p>You have a number of ways to contact us at the Brighton Golf Club. </p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="contact_detalis_area_contact_page" id="contact_detalis_area_contact_page">
			<div class="container">
				<div class="row">
					<div class="contact_details_contact_title text-center">
						<h2>Contact Details</h2>
						<div class="single_conatct_details_poromotion">
							<img src="<?php echo get_template_directory_uri();?>/img/home_c.png"/>
							<h2>CLUB ADDREESS</h2>
							<p>97-99 Glencairn Ave,<br>East Brighton 3187</p>
						</div>		
						<div class="single_conatct_details_poromotion">
							<img src="<?php echo get_template_directory_uri();?>/img/message.png"/>
							<h2>POSTAL ADDREESS</h2>
							<p>P.O. Box 2325,<br>Brighton 3186</p>
						</div>	
						<div class="single_conatct_details_poromotion">
							<img src="<?php echo get_template_directory_uri();?>/img/phone_c.png"/>
							<h2>PHONE</h2>
							<p>9592 7806</p>
						</div>	
						<div class="single_conatct_details_poromotion">
							<img src="<?php echo get_template_directory_uri();?>/img/fax.png"/>
							<h2>FAX</h2>
							<p>9592 7841</p>
						</div>	
						<div class="single_conatct_details_poromotion">
							<img src="<?php echo get_template_directory_uri();?>/img/email_c.png"/>
							<h2>EMAIL</h2>
							<a href="mailto:bgolf@bigpond.net.au">bgolf@bigpond.net.au</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="map_area" class="map_area">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3147.3123969183075!2d145.01760931510609!3d-37.92313174808208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad6693308b7d41b%3A0xf3c3cccf8a25d344!2s99+Glencairn+Ave%2C+Brighton+East+VIC+3187%2C+Australia!5e0!3m2!1sen!2sbd!4v1447173350730" width="100%" height="345" frameborder="0" style="border:0" allowfullscreen></iframe>
		</section>
		<section class="contact_us_area" id="contact_us_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="contact_us">
							<h2 class="text-center">Contact Us</h2>
							<?php echo do_shortcode('[contact-form-7 id="221" title="main-contact-from"]');?>
							
						</div>
					</div>
				</div>
			</div>
			
		</section>
<?php get_footer();?>