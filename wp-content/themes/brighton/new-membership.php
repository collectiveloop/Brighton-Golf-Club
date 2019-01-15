<?php
ob_start();
/*
Template Name: New Membership
*/
 get_header();?>

	<?php 
										
		if(isset($_REQUEST['select_payment_method']) && $_REQUEST['select_payment_method']=='creditcard')
		{
			
			
			include("membership/membership_save.php");
			
			
			
			
		}elseif(isset($_REQUEST['select_payment_method']) && $_REQUEST['select_payment_method']=='paypal')
		{
			
			
			include("membership/membership_paypal.php");
			
			
			
		}
			
	?>
	
	<?php

		$fetured_img_membership = get_option_tree( 'fetured_img_membership', '', false );
		$membership_options_apply_link = get_option_tree( 'membership_options_apply_link', '', false );
  
    ?>
	
		<section class="banner_area" id="banner_area" style="background:url(<?php echo $fetured_img_membership;?>) no-repeat scroll center center;background-size:cover;">
			<?php get_template_part('banner');?>
		</section>
		
<?php get_template_part('navigation');  ?>


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
							<!--<h2 class="text-center" style="color:#fff;">Apply for Membership</h2>-->
							<!--<h2 class="text-left" style="color:#fff;margin:0px;">Contact Details</h2>-->
						    <?php //echo do_shortcode('[contact-form-7 id="470" title="Membership-register"]');?>
							
							
                            <!--Custom Membership Form-->

									<h2 class="text-center" style="color:#fff;">Apply for Membership</h2>

									<?php
									    if(!empty($errormessage))
	                                    {
											?>
											<p class="membershp_error" ><b>Membership request failed:</b>  <?php echo $errormessage; ?></p>
											<?php
										}
									?>
									<h3 style="color:#fff;text-align:center;">Joining Fee refunded if application for Membership is unsuccessful.</h3>
									
									<h2 class="text-left" style="color:#fff;margin:0px;">Contact Details</h2>

									<div class="bgc_membership_form_container">

										<div class="screen-reader-response"></div>
										
										<form action="<?php echo get_site_url(); ?>/index.php/membership/#contact_us_area_member" method="post" class="bgc_membership_form" id="bgc_membership_formdata" >

										<p>Your Name*<br>
											<span class="form_fields_spcontainer">
												<input name="user_name" size="40" class="bgc_form_controls required" value="<?php if(isset($_REQUEST['user_name'])){ echo $_REQUEST['user_name']; } ?>" type="text">
											</span>
										</p>

										<p>Your Email*<br>
											<span class="form_fields_spcontainer">
												<input name="user_emailaddress"  size="40" class="bgc_form_controls required email" id="user_emailaddress" type="email" value="<?php echo @$_REQUEST['user_emailaddress']; ?>">
											</span>
										</p>
										
										<p>Your Contact No*<br>
											<span class="form_fields_spcontainer">
												<input name="user_phoneno"  size="40" class="bgc_form_controls required" type="tel">
											</span>
										</p>

										<?php /*<p>How did you find us?*<br>
										
											<span class="form_fields_spcontainer">
											
												<select name="user_wheredidyoufindus" class="bgc_form_controls required" >
												
													<option value="">---</option>
													<option value="Google">Google</option>
													<option value="Member Referral">Member Referral</option>
													<option value="Non-Member Referral">Non-Member Referral</option>
													<option value="Social Media Flyers">Social Media Flyers</option>
													<option value="Corporate Event">Corporate Event</option>
													<option value="Other">Other</option>

												</select>
												
											</span>
										</p>

										<p>Address*<br>
											<span class="form_fields_spcontainer">
												<input name="user_address"  size="40" class="bgc_form_controls required" type="text">
											</span>
										</p>

										<div class="contact_us_news_area">

											<p id="Suburb_left">Suburb*<br>
												<span class="form_fields_spcontainer">
													<input name="user_address_sub" size="40" class="bgc_form_controls required" type="text">
												</span>
											</p>
											
											<p id="postal_code">Postcode* <br>
												<span class="form_fields_spcontainer">
													<input name="user_address_postal" size="40" class="bgc_form_controls required" type="text">
												</span>
											</p>
											
										</div>

										<p>Phone*<br>
											<span class="form_fields_spcontainer">
												<input name="user_phoneno"  size="40" class="bgc_form_controls required" type="tel">
											</span>
										</p>

										<p>Occupation*<br>
											<span class="form_fields_spcontainer">
												<input name="user_occupation" size="40" class="bgc_form_controls required" type="text">
											</span>
										</p>

										<div class="contact_us_news_area">

											<p id="date_of">Date Of Birth*</p>
											
											<p id="postal_code_m">
												<span class="form_fields_spcontainer">
													<select name="user_dob_day" class="bgc_form_controls required" >
													    <option value="">---</option>
														<?php
														    for($k=1;$k<=31;$k++)
															{
																
																?>
																<option value="<?php echo $k; ?>"><?php echo $k; ?></option>
																<?php
																  
															}
														?>
													</select>
												</span>
											</p>

											<p id="postal_code_m">
												<span class="form_fields_spcontainer">
													<select name="user_dob_month" class="bgc_form_controls required" >
													    <option value="">---</option>
														
														<?php
														    for ($m=1; $m<=12; $m++) 
															{
															    $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
																
															    ?>
																<option value="<?php echo $m; ?>"><?php echo $month; ?></option>
																<?php
																
															}
														?>
													</select>
												</span>
											</p>

											<p id="postal_code_m">
												<span class="form_fields_spcontainer">
													<select name="user_dob_year" class="bgc_form_controls required" >
														<option value="">---</option>
														
														<?php
														
														    $getcurrentyear=date("Y");
															
															$getlastyear=date("Y",strtotime("-80 years"));
															
														    for($y=$getcurrentyear; $y > $getlastyear; $y--) 
															{
															    
															    ?>
																<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
																<?php
																
															}
														?>
														
													</select>
												</span>
											</p>
										</div>*/ ?>

										<div style="clear:both"></div>

										<h2 style="color:#fff;">Membership Details</h2>

										<p>Membership Category*<br>
											<span class="form_fields_spcontainer">
											    <!--onchange="return change_membership_cat(this);"-->
												<select name="user_membership_category" id="user_membership_catnm"  class="bgc_form_controls required" >
													<option value="">---</option>
													<option value="Ordinary Playing Member" <?php if(@$_REQUEST['user_membership_category']=='Ordinary Playing Member'){ echo 'selected="selected"'; } ?>>Ordinary Playing Member</option>
													<option value="Junior Playing Member" <?php if(@$_REQUEST['user_membership_category']=='Junior Playing Member'){ echo 'selected="selected"'; } ?>>Junior Playing Member</option>
													<option value="Golf Access Member" <?php if(@$_REQUEST['user_membership_category']=='Golf Access Member'){ echo 'selected="selected"'; } ?>>Golf Access Member</option>
													<option value="Social Playing Member" <?php if(@$_REQUEST['user_membership_category']=='Social Playing Member'){ echo 'selected="selected"'; } ?>>Social Playing Member</option>
													<option value="Country Member" <?php if(@$_REQUEST['user_membership_category']=='Country Member'){ echo 'selected="selected"'; } ?>>Country Member</option>
													<option value="Social Non-Playing Member" <?php if(@$_REQUEST['user_membership_category']=='Social Non-Playing Member'){ echo 'selected="selected"'; } ?>>Social Non-Playing Member</option>
													<option value="Country Non-Playing Member" <?php if(@$_REQUEST['user_membership_category']=='Country Non-Playing Member'){ echo 'selected="selected"'; } ?>>Country Non-Playing Member</option>
													<option value="2-for-1 Membership Offer" <?php if(@$_REQUEST['user_membership_category']=='2-for-1 Membership Offer'){ echo 'selected="selected"'; } ?>>2-for-1 Membership Offer</option>
												</select>
											</span>
										</p>
                                        
										<!--<p>I am currently/have been a Member of the following club/s*<br>
											<span class="form_fields_spcontainer">
												<input name="user_iscurrent_member" size="40" class="bgc_form_controls required" type="text">
											</span>
										</p>-->

										<!--<p>My exact golf handicap is/was*<br>
											<span class="form_fields_spcontainer">
												<input name="user_is_handicap" size="40" class="bgc_form_controls required" type="text" value="<?php //echo @$_REQUEST['user_is_handicap']; ?>">
											</span>
										</p>-->

										<p>Golflink Number*<br>
											<span class="form_fields_spcontainer">
												<input name="user_golflink_number" size="40" class="bgc_form_controls required" type="text">
											</span>
										</p>


										<div class="contact_us_news_area">
										
											<p id="Suburb_left">I have had my membership suspended or cancelled*</p>
											
											<p id="postal_code">
											
												<span class="form_fields_spcontainer">
												
													<select name="user_ismembership_suspended" class="bgc_form_controls required" >
														<option value="">---</option>
														<option value="Yes" <?php if(@$_REQUEST['user_ismembership_suspended']=='Yes'){ echo 'selected="selected"'; } ?>>Yes</option>
														<option value="No" <?php if(@$_REQUEST['user_ismembership_suspended']=='No'){ echo 'selected="selected"'; } ?>>No</option>
													</select>
													
												</span>
											</p>
										</div>


										<div class="contact_us_news_area">

											<p id="Suburb_left">I have been refused membership of a club*</p>

											<p id="postal_code">
											
												<span class="form_fields_spcontainer">
												
													<select name="user_refuse_membership" class="bgc_form_controls required" >
														<option value="">---</option>
														<option value="YES" <?php if(@$_REQUEST['user_refuse_membership']=='YES'){ echo 'selected="selected"'; } ?>>YES</option>
														<option value="NO" <?php if(@$_REQUEST['user_refuse_membership']=='NO'){ echo 'selected="selected"'; } ?>>NO</option>
													</select>
													
												</span>
												
											</p>

										</div>

										<div style="clear:both"></div>
										
										<div class="bgc_membership_joining_container">
										
										    <h2 style="color:#fff;">Joining Fee</h2>
										
										    <p>A Joining Fee of $100 is required for Ordinary Playing Membership applications, $22.00 for Juniors and $50 for 2-4-1 . Please pay with Visa or MasterCard to complete your application. All payments are securely processed via our SecurePay payment gateway.</p>

                                            <p class="payment_methodhead">Payment Method</p>
											
											<div class="bgc_joining_payment_methods">
											    
												<div class="choose_payment_method">
												    
													<span class="payment_methods_area">
													
													    <!--<input type="radio" name="select_payment_method" value="creditcard" onclick="return change_payment_method(this)" checked id="secureccpayment" />-->
														
													    <input type="hidden" name="select_payment_method" value="creditcard" id="secureccpayment" />
														
														<label for="secureccpayment" style="padding:0px;"> Credit Card </label> 
														
														<img src="<?php echo get_template_directory_uri(); ?>/img/bgcvisa.png" class="secure_payments_imgs" />
														
													</span>
													
													<!--<span class="payment_methods_area">
													
														<input type="radio" name="select_payment_method" value="paypal" onclick="return change_payment_method(this)" id="ccpaypal"    />
														
														<label for="ccpaypal"> PayPal </label>
														
														<img src="<?php echo get_template_directory_uri(); ?>/img/bgcpaypal.png" class="paypal_payments_imgs" />
													
													</span>-->
													
												</div>
											
											</div>
											<div class="payment_method_container" id="paypal_payment_container" style="display:block;">
											
											</div>
											<div class="payment_method_container" id="securepay_creditcard_container" style="display:block;">
											
											    <div class="joiningfeecarddetails">

													<p class="joining_labels">Card Number*</p>

													<p class="joining_fields">
													
														<span class="form_fields_spcontainer">
														
															<input name="user_creditcard_number" class="bgc_form_controls required" type="text">
															
														</span>
														
													</p>

												</div>
												
												<div class="joiningfeecarddetails">

													<p class="joining_labels">Expiry Date*</p>

													<p class="joining_fields">
													
														<span class="form_fields_spcontainer joining_expiry_date">
														
															<select class="bgc_form_controls required" name="user_expiry_month">
															
															    <option value="">MM</option>
																
																<?php
																	for ($cm=1; $cm<=12; $cm++) 
																	{
																		$cmmonth = date('M', mktime(0,0,0,$cm, 1, date('Y')));
																		$monthval=str_pad($cm,2,0, STR_PAD_LEFT);
																		?>
																		<option value="<?php echo $monthval; ?>"><?php echo strtoupper($monthval); ?></option>
																		<?php
																		
																	}
																?>
																
															</select>
															
														</span>
														<label>/</label>
														<span class="form_fields_spcontainer joining_expiry_date">
														
															<select class="bgc_form_controls required" name="user_expiry_year">
															
															    <option value="">YY</option>
																
																<?php
														
																	$getcurrentyear=date("Y");
																	
																	$getnextyear=date("Y",strtotime("+30 years"));
																	
																	for($cy=$getcurrentyear; $cy <= $getnextyear; $cy++) 
																	{
																		
																		?>
																		<option value="<?php echo $cy; ?>"><?php echo $cy; ?></option>
																		<?php
																		
																	}
																	
																?>
																
															</select>
															
														</span>
														
													</p>

												</div>
												
												<div class="joiningfeecarddetails">

													<p class="joining_labels">CVV*</p>

													<p class="joining_fields">
													
														<span class="form_fields_spcontainer joining_cvv_number">
														
															<input name="user_cvv_number" class="bgc_form_controls required number" type="text" minlength="3" maxlength="4">
															
														</span>
												<!--button pop up  -->
                                                		
														<span class="pop_over_cstm">
														
														    <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="3 digit CVV number is printed at the backside of all the 'Debit and Credit Cards'.">
															
														        <img src="<?php echo get_template_directory_uri(); ?>/img/pop_over.png" class="pop_imgs" />
															
														    </button>
												
														</span>      
                                                        
                                                        
													</p>

												</div>
												
												<div class="joiningfeecarddetails">

													<p class="joining_labels">Name on Card*</p>

													<p class="joining_fields">
													
														<span class="form_fields_spcontainer joining_cardnumber">
														
															<input name="user_nameoncard" class="bgc_form_controls required" type="text">
															
														</span>
														
													</p>

												</div>
												
												
											</div>
										
										</div>
										
										
										<div style="clear:both"></div>


										<h2 style="color:#fff;margin-bottom:0px;margin-top:10px">Submission</h2>

										<div class="contact_us_news_area">

											<p id="Suburb_left">I certify that the above information is true and correct in every particular. I am an amateur golfer as defined by the Royal and Ancient Golf Club of St Andrews and I undertake, if accepted, to be bound by the Rules of Association and the By-Laws of the Brighton Golf Club</p>

											<p id="postal_code" class="member_submission">
											
												<span class="form_fields_spcontainer">
												
													<select name="user_iscertify" class="bgc_form_controls required" >
														<option value="">---</option>
														<option value="YES">YES</option>
														<option value="NO">NO</option>
													</select>
													
												</span>
												
											</p>

										</div>

										<div style="clear:both"></div>

										<div class="text-center">
										
											<p>
											
												<input value="Register" class="user_registration" name="user_registration" id="user_registration" type="submit">
												
											</p>
											
										</div>

										</form>

									</div>														
														
                            <!--Custom Membership Form-->
							
							
						</div>
					</div>
				</div>
			</div>
			
		</section>
		<script>
		/*function change_membership_cat(selobj)
		{
			var membershipcat=selobj.value;
			
			alert(membershipcat);
		}*/
		
		</script>
<?php get_footer();?>