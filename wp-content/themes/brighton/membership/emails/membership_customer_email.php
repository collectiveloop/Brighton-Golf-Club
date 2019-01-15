<html dir="">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
	</head>
	<body marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						<div id="template_header_image">
						</div>
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container">
						    <tr align="center" valign="top">
							    <td style="text-align:center;">
								    <a href="<?php echo get_site_url(); ?>" class="BGC Logo" title="BGC Logo" style="text-align:center;">
									    <img style="text-align:center;width:110px;" src="<?php echo get_template_directory_uri(); ?>/img/BGC_WebsiteHeaderLOGO_v2-1.png" />
									</a>
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" style='background-color:#921F60;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif'>
										<tr>
											<td style="padding:12px 48px;display:block">
												<h1 style='color:#ffffff;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:150%;margin:0;text-align:center;text-transform:uppercase;'>Application Submitted Successfully</h1>
											</td>
										</tr>
									</table>
									<!-- End Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="2" cellspacing="2" width="600" style="border:1px solid #dcdcdc;border-radius:3px!important;">
										<tr>
											<td valign="top" style="">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tr>
														<td valign="top" >
															<div id="body_content_inner" style='color:#333333;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left'>
															    
																<p style="color:#333333;">Thank you <?php echo ucwords($user_name); ?> your application has been submitted successfully and we look forward to welcoming you as a Member of Brighton Golf Club. We will contact you soon about the next step in the application process.</p>
																
																<!--<p style="color:#333333;"><b>Your membership application details are given below:</b></p>-->
																
																<!--<table style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;color:#333333;font-size:13px;  margin-top:10px;" cellspacing="0" cellpadding="6" border="0">
																    <tr>
																	    <td colspan="2" style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;">
																		    <h3 style="margin-bottom:0px;">Contact Details</h3>
																		</td>
																	</tr>
																    <tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;"><b>Name: </b> <?php echo ucwords($user_name); ?></td>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px"><b>Email Address: </b> <span style="color:#921F60;"><?php echo $user_emailaddress; ?></span></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>How did you find us?: </b> <?php echo $user_wheredidyoufindus; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>Address: </b> <?php echo $user_address; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;"><b>Suburb: </b> <?php echo $user_address_sub; ?></td>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px"><b>Postcode: </b> <?php echo $user_address_postal; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;"><b>Phone Number: </b> <?php echo $user_phoneno; ?></td>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px"><b>Date Of Birth: </b> <?php echo $userdateofbirth; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>Occupation: </b> <?php echo $user_occupation; ?></td>
																	</tr>
																	<tr>
																	    <td colspan="2" style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;">
																		    <h3 style="margin-bottom:0px;">Membership Details</h3>
																		</td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>Membership Category: </b> <?php echo $user_membership_category; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>I am currently/have been a Member of the following club/s: </b> <?php echo $user_iscurrent_member; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>My exact golf handicap is/was: </b> <?php echo $user_is_handicap; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>Golf Link Number: </b> <?php echo $user_golflink_number; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>I have had my membership suspended or cancelled: </b> <?php echo $user_ismembership_suspended; ?></td>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>I have been refused membership of a club: </b> <?php echo $user_refuse_membership; ?></td>
																	</tr>
																	<tr>
																	    <td colspan="2" style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;">
																		    <h3 style="margin-bottom:0px;">Membership Payment Information</h3>
																		</td>
																	</tr>
																	
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2"><b>Payment Method: </b> <?php echo $paymentmethod; ?></td>
																	</tr>
																	
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>Payment Fee: $<?php echo $membershiprice; ?></b></td>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>Payment Status:</b> <?php echo 'Pending - Under Review'; ?></td>
																	</tr>
																	
																	<?php if($select_payment_method=='creditcard'){ ?>
																	
																	
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>Credit Card Used: <?php echo $creditcardno; ?></b></td>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>Exipry Date:</b> <?php echo $creditexpdate; ?></td>
																	</tr>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>Name on card: <?php echo $ccardholdername; ?></b></td>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" ><b>Transaction ID: <?php echo $transactionId; ?></b></td>
																	</tr>
																	<?php } ?>
																	<tr>
																		<td style="text-align:left;text-align:left;color:#333333;border:1px solid #e4e4e4;padding:12px;width:50%;" colspan="2" ><b>Order ID: <?php echo $order_id; ?></b></td>
																	</tr>
																</table>-->
																<p style="color:#333333;">Above email has been sent from <a style="" href="<?php echo get_site_url(); ?>"><?php echo get_site_url(); ?></a></p>
																<p style="color:#333333;"><b>
																Best Regards, <br/>
																BGC Team
																</b></p>
																
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>


