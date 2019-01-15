<?php 
/*
Template Name: Non Responsive Member Login page
*/
get_template_part('member_header');?>
  <?php
  $fetured_img_home = get_option_tree( 'fetured_img_home', '', false );
  
  ?>
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_home;?>) no-repeat scroll center center;background-size:cover;">
			
				<?php get_template_part('banner');?>
			
		</section>
		<section class="navigation-area" id="navigation-area">
			<div class="wrapper">
				
						<nav class="custom_navbar">

							<!-- Collection of nav links and other content for toggling -->
							
						<?php

						if (function_exists('wp_nav_menu')) {

							wp_nav_menu(array('theme_location' => 'wpj-main-menu', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'wpj_default_menu'));

						}

						else {

							wpj_default_menu();

						}

						?>
							
						</nav>
					
			</div>
		</section>

		<section id="ifamre_area" class="ifarme_area">
			<div class="wrapper ifamre_border">
				<iframe src="https://online.micropower.com.au/clubpages/brightongc_login.html" frameborder="0" scrolling="auto" width="1150px" height="1500" onload="scroll(0,0);"></iframe>
			</div>
		</section>
	
		<footer class="footer_top_area" id="footer_top_area">
			<div class="wrapper">
			<div class="single_top_wrapper">
					<div class="single_footer">
					<div class="footer_tab_height">
						<div class="title">
							<h3>Our Club</h3>
						</div>
						<div class="footer_top_menu">
 <?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
						</div>
					</div>					
					</div>					
					<div class="single_footer">
					<div class="footer_tab_height">
						<div class="title">
							<h3>Weather</h3>
						</div>
					<?php if ( ! dynamic_sidebar( 'footer_sidebar' ) ) : ?>

						<div class="footer_top_weather">
							<img alt="" src="<?php echo get_template_directory_uri();?>/img/weather.png" class="alignleft">
							<p>12<span class="cel"> C </span><br><span>Partly Cloudy</span><br><span class="h_l">High</span>: 19 C</br><span class="h_l"> Low</span>: 12 C</p>
						</div>
					<?php endif; ?>	
					</div>					
					</div>					
					<?php 

							$facebook_link = get_option_tree( 'facebook', '', false );
							$twitter_link = get_option_tree( 'twitter', '', false );
							$google_plus_link = get_option_tree( 'google_plus', '', false );
							$flicker_link = get_option_tree( 'flicker', '', false );
							$rss_link = get_option_tree( 'rss', '', false );
							$phone_number = get_option_tree( 'phone_hot', '', false );
							$email_address = get_option_tree( 'email_address', '', false );
							$member_login = get_option_tree( 'member_login', '', false );
							$company_address = get_option_tree( 'company_address', '', false );

						?>
					<div class="single_footer">
					<div class="footer_tab_height">
						<div class="title">
							<h3>Contact Us</h3>
						</div>
						<div class="footer_top_address">
							<p><i class="fa fa-home"></i><?php echo $company_address; ?></p>
							<p><i class="fa fa-phone"></i><?php echo $phone_number; ?></p>
						</div>
					
					</div>
					</div>
					<div class="single_footer">
					<div class="footer_tab_height">
					<div class="title">
							<h3>Trems of Use</h3>
						<div class="footer_top_menu">
<?php wp_nav_menu( array( 'theme_location' => 'footer-trems-menu') ); ?>
						</div>
					</div>	
					</div>	
				
			</div>
			</div>
			</div>
			<div class="copyright">
					<p>&copy; Copyright - Design By <a href="https://www.collectiveloop.com">Collective Loop</a></p>
			</div>
		</footer>
		
<?php wp_footer();?>
    

</body>
</html>
