<?php
/*
Template Name: Membership
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

<style type="text/css">
.memberhip_tree_height {
  height: 650px;
}

/************IPad**************/

@media only screen and (min-width: 992px) and (max-width: 1200px) {


}


/* Tablet Layout: 768px. */

@media only screen and (min-width: 768px) and (max-width: 991px) {


}
/* Mobile Layout: 320px. */

@media only screen and (max-width: 767px) {
.memberhip_tree_height {
  height: 400px;
}

}
/* Wide Mobile Layout: 480px. */

@media only screen and (min-width: 480px) and (max-width: 767px) {


}

</style>
		<section id="sologan_section" class="sologan_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sologan text-center membership_s">
							<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
							<h2>Become a member at Brighton Golf Club</h2>
							<p>Various membership/handicap options are available as well as a convivial heated and <br>cooled Club House for after golf social interaction which also features screened results <br>continuously updated as cards are returned. </p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="membership_bg_area" id="membership_bg_area">
			<div class="container">
				<div class="row">
					<div class="benefits">
						<h2 class="text-center">Membership Options</h2>
					</div>
	<?php

    global $post;

    $args = array( 'posts_per_page' => 6, 'post_type'=> 'benefits-membership','meta_key' => 'benefits_membership','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
				<li class="col-md-4 col-sm-6">
					<div>
						
						<div class="single_benefits_membership">
							<?php the_post_thumbnail('benefits-thumb', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content">
								<div class="befits_promo_content_img text-center">
								<?php 
								$small_images_membership= get_post_meta($post->ID, 'small_images_membership', true);
								$membership_title= get_post_meta($post->ID, 'membership_title', true);
								$membership_date= get_post_meta($post->ID, 'membership_date', true);
								$membership_join_fees= get_post_meta($post->ID, 'membership_join_fees', true);
								$membership_join_subs= get_post_meta($post->ID, 'membership_join_subs', true);
								$membership_join_Bar= get_post_meta($post->ID, 'membership_join_Bar', true);
								$membership_join_total= get_post_meta($post->ID, 'membership_join_total', true);
								
								?>
									<img src="<?php echo $small_images_membership; ?>">
									<h2><?php echo $membership_title; ?></h2>
								</div>
								<div class="find_more find_more_membership" id="saiful<?php the_ID();?>">
								<?php the_content();?>
								</div>
								<div class="events_date_time membership_table_price">
									<h3>Membership Fee’s</h3>
									<h4><?php echo $membership_date; ?></h4>
									<table>
										  <tr>
											<td>Joining Fees*</td>
											<td id="right_td"><?php echo $membership_join_fees; ?></td>
										  </tr>
										  <tr>
											<td>Annual Fees</td>
											<td id="right_td"><?php echo $membership_join_subs; ?></td>
										  </tr>		
											
									</table>
									<h4>*One time only payment</h4>
								</div>
								<div class="for_membership_apply_ww">
								<a href="<?php echo $membership_options_apply_link;?>" class="btn btn-default">Click to apply</a>
								</div>
								
								
								
							</div>
						</div>
						
					</div>	
				</li>
<?php endforeach; ?>					
					
				</div>
			</div>
		</section>

		<section class="club_specilty_area membership_culub" id="club_specilty_area membership_culub">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="club_specilty_title text-center">
							<h2>Benefits of Joining</h2>
						</div>
					</div>
				</div>
				<div class="row">
	<?php

    global $post;

    $args = array( 'posts_per_page' => -1, 'post_type'=> 'benefits-joining','meta_key' => 'benefits_joining','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-md-4 col-sm-6">
						<div class="single_club_specilty wowo_club just_fonts_c text-center">
							<?php the_post_thumbnail('joining-thumb', array('class' => 'alignnone')); ?>
							<h2><?php the_title();?></h2>
							<?php the_content();?>
						</div>
					</div>	
<?php endforeach; ?>						

				</div>
			</div>
		</section>
		<section class="memebership_tree_area" id="memebership_tree_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<div class="memberhip_tree_height">
						<div class="tree_content">
							<div class="tree_title text-center">
								<h2>Members Introduction</h2>
							</div>							

						</div>
						<div class="tree_video">
					<iframe width="100%" height="500" src="https://www.youtube.com/embed/HITvIGyUtFY?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>	
</div>
						<div class="tree_anchor membership_anchor">
								<a href="<?php echo $membership_options_apply_link;?>" class="btn btn-default">Click to apply</a>
						</div>
					</div>
				</div>
				</div>
			</div>
		</section>
		<section class="benefits_area" id="benefits_area">
			<div class="container">
				<div class="row">
					<div class="benefits">
						<h2 class="text-center">Our latest Membership offers</h2>
					</div>
		<?php

    global $post;

    $args = array( 'posts_per_page' => -1, 'post_type'=> 'latest-offer','meta_key' => 'latest_offers','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-md-3 col-sm-6">
						
						<div class="single_benefits">
							<?php the_post_thumbnail('latest-thumb', array('class' => 'alignnone')); ?>
							<div class="befits_promo_content another_new_s_j">
								<div class="befits_promo_content_img text-center">
								<?php 
								$small_img_mem= get_post_meta($post->ID, 'small_img_mem', true);
								$offers_terget_link= get_post_meta($post->ID, 'offers_terget_link', true);
								?>
									<img src="<?php echo $small_img_mem;?>">
									<h2 id="wowo"><?php the_title();?></h2>
								</div>
								<div class="find_more wowo_content arond_membership_page">
									<?php the_content(); ?>
								</div>
								<div class="for_membership_apply_ww">
									<a href="<?php echo $offers_terget_link;?>" class="btn btn-default">Find out more</a>
								</div>
								
								
								
							</div>
						</div>
						
					</div>	
<?php endforeach; ?>						
					
						
					</div>
				</div>
			
		</section>
		<section class="member_login_area_home memebrship_page_member_login_area_home" id="member_login_area_home">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="memmber_title text-center">
							<h2>How to join</h2>
						</div>
					</div>
				</div>
							<div class="row">
			<?php

    global $post;

    $args = array( 'posts_per_page' => -1, 'post_type'=> 'member-joining-h','meta_key' => 'member_joining_h','orderby' => 'meta_value','order' => 'ASC');

    $myposts = get_posts( $args );

    foreach( $myposts as $post ) : setup_postdata($post); ?>
					<div class="col-sm-6">
						<div class="single_club_specilty text-center membership_club">
						<?php 
						$number_join= get_post_meta($post->ID, 'number_join', true);
								
						?>
							<h3><?php echo $number_join;?></h3>
							<h2><?php the_title();?></h2>
							<?php the_content();?>
						</div>
					</div>	
<?php endforeach; ?>						
				
				</div>
			</div>
		</section>

		<section class="contact_us_area_member" id="contact_us_area_member">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="contact_us">
							<h2 class="text-center" style="color:#fff;">Apply for Membership</h2>
							<h2 class="text-left" style="color:#fff;margin:0px;">Contact Details</h2>
						<?php //echo do_shortcode('[contact-form-7 id="470" title="Membership-register123"]');?>
							
						</div>
					</div>
				</div>
			</div>
			
		</section>
<?php get_footer();?>