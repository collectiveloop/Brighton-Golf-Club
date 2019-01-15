<?php
ob_start();
/*
Template Name: Membership Confirmation
*/

get_header();?>
 
<?php

    global $wpdb;
	
    global $post;
	
	$get_page_content=$post->post_content;
  
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

<?php

    global $wpdb;
	

    if(isset($_REQUEST['txn_id']))
	{
		
		$transactionid=$_REQUEST['txn_id'];
		
		
		$payment_status=$_REQUEST['payment_status'];
		
		
		$item_number=$_REQUEST['item_number'];
		
		
		$order_id=$item_number;
		
		
		if($item_number!='')
		{
			
			$getitemarra=explode("-",$item_number);
			
			$getrecordid=trim($getitemarra[1]);
			
		}
		
		$testars='';
		
		if($getrecordid!='')
		{
			
         	$getsubrecords=$wpdb->get_row("select * from ".$wpdb->prefix."membership_subscriptions where transaction_id='".$transactionid."' and id=".$getrecordid);
			
			
			if(!empty($getsubrecords))
			{
				
				//$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='review'  where id=".$getrecordid);
				
				
			}else{
				
				
				$getallrecords=$wpdb->get_row("select * from ".$wpdb->prefix."membership_subscriptions where id=".$getrecordid);
				
				
				$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='review', transaction_id='".$transactionId."' where id=".$getrecordid);
				
				
				$user_name=$getallrecords->user_name;
	
				$user_emailaddress=$getallrecords->user_emailaddress;
				
				$user_wheredidyoufindus=$getallrecords->user_wheredidyoufindus;
				
				$user_address=$getallrecords->user_address;
				
				$user_address_sub=$getallrecords->user_address_sub;
				
				$user_address_postal=$getallrecords->user_address_postal;
				
				$user_phoneno=$getallrecords->user_phoneno;
				
				$user_occupation=$getallrecords->user_occupation;
				
				$userdateofbirth=$getallrecords->user_dob;
				
				$user_membership_category=$getallrecords->user_membership_category;
				
				$user_iscurrent_member=$getallrecords->user_iscurrent_member;
				
				$user_is_handicap=$getallrecords->user_is_handicap;
				
				$user_golflink_number=$getallrecords->user_golflink_number;
				
				$user_ismembership_suspended=$getallrecords->user_ismembership_suspended;
				
				$user_refuse_membership=$getallrecords->user_refuse_membership;
				
				$select_payment_method=$getallrecords->select_payment_method;
				
				
				$user_iscertify=$getallrecords->user_iscertify;
				
				
				$order_id=$getallrecords->orderid;
				
				
				/* Sent First Email to user admin */
				
				
				/* Confirmation Emails */
			
			
				/* Customer Email Notification */
				
				
				$paymentmethod="PayPal";
				
	            
				$select_payment_method='paypal';
				
				
				$membershiprice="100";
				
				
				ob_start();
				
				
				include("membership/emails/membership_customer_email.php");
				
				
				$customeremailcontent = ob_get_clean();
				
				
				$customerto=$user_emailaddress;
				

				$enterdemailaddress=$memberemailaddress;
				

				$adminfrom=get_option("admin_email");
				
				
				//$adminfrom="info@example.com";
				

				$customersubject="Membership Application Submitted";
				

				$headers = "MIME-Version: 1.0" . "\r\n";
				
				
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				
				$headers .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
				
				
				mail($customerto,$customersubject,$customeremailcontent,$headers);
				
				
				/* Customer Email Notification */
				
				
				/* Admin Email Notification */
				
				ob_start();
				
				
				include("membership/emails/membership_admin_email.php");
				
				
				$adminnotifycontent = ob_get_clean();
				

				$adminfrom=get_option("admin_email");
				
				
				$adminto=$adminfrom;
				
				
				//$adminfrom="info@example.com";
				

				$adminsubject="New Membership Application";
				

				$headers1 = "MIME-Version: 1.0" . "\r\n";
				
				
				$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				
				$headers1 .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
				
				$headers1 .= 'Cc: johnmccreery@bigpond.com, fandvgattuso@optusnet.com.au, jimmac5439@gmail.com, sue.margaret@hotmail.com, bgolf@bigpond.net.au' . "\r\n";
		
		        $headers1 .= 'Bcc: admin@collectiveloop.com' . "\r\n";
				
				mail($adminto,$adminsubject,$adminnotifycontent,$headers1);
				
				
				/* Admin Email Notification */
				
				
				/* Confirmation Emails */
				
				
				
				/* Sent First Email to user admin */
				
				
			}
		}
		
		
	
	
	}
	
	
	if(isset($_REQUEST['admin_sent_confirmation']))
	{
		$orderid=$_REQUEST['orderid'];
		
		if($orderid!='')
		{	
			$getitemarra=explode("-",$orderid);
			
			$getrecordid=trim($getitemarra[1]);
			
			$getallrecords=$wpdb->get_row("select * from ".$wpdb->prefix."membership_subscriptions where id='".$getrecordid."'");
			
			
			//echo "<pre>";print_r($getallrecords); die;
			
			if(!empty($getallrecords))
			{
				
				if($getallrecords->payment_status!='completed' || $getallrecords->payment_status!='nopayment')
				{
					if($getallrecords->payment_status=='no_payment')
					{
						$user_name=$getallrecords->user_name;

						$user_emailaddress=$getallrecords->user_emailaddress;
						
						$user_wheredidyoufindus=$getallrecords->user_wheredidyoufindus;
						
						$user_address=$getallrecords->user_address;
						
						$user_address_sub=$getallrecords->user_address_sub;
						
						$user_address_postal=$getallrecords->user_address_postal;
						
						$user_phoneno=$getallrecords->user_phoneno;
						
						$user_occupation=$getallrecords->user_occupation;
						
						$userdateofbirth=$getallrecords->user_dob;
						
						$user_membership_category=$getallrecords->user_membership_category;
						
						$user_iscurrent_member=$getallrecords->user_iscurrent_member;
						
						$user_is_handicap=$getallrecords->user_is_handicap;
						
						$user_golflink_number=$getallrecords->user_golflink_number;
						
						$user_ismembership_suspended=$getallrecords->user_ismembership_suspended;
						
						$user_refuse_membership=$getallrecords->user_refuse_membership;
						
						$select_payment_method=$getallrecords->select_payment_method;
						
						$user_iscertify=$getallrecords->user_iscertify;
						
						$order_id=$getallrecords->orderid;
					
						$membershiprice="";
						
						
						
						/* Confirmation Emails */
						
						
						/* Customer Email Notification */
						
						ob_start();
						
						
						include("membership/emails/membership_customer_completion_email.php");
						
						
						$customeremailcontent = ob_get_clean();
						
						
						$customerto=$user_emailaddress;
						

						$enterdemailaddress=$memberemailaddress;
						

						$adminfrom=get_option("admin_email");
						
						
						//$adminfrom="info@example.com";
						
						if($adminfrom!='')
						{
							$adminto=$adminfrom.', ktbmmb@bigpond.net.au';
						}else{
							$adminto='ktbmmb@bigpond.net.au';
						}
						
						$admincssemail=$adminto;

						$customersubject="Membership Application Approved";
						

						$headers = "MIME-Version: 1.0" . "\r\n";
						
						
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						
						
						$headers .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
						
						$headers .= 'Cc: '.$admincssemail. "\r\n";
						
						mail($customerto,$customersubject,$customeremailcontent,$headers);
					
						/* Customer Email Notification */
						
						
						/* Admin Email Notification */
						
						ob_start();
						
						
						include("membership/emails/membership_admin_completion_email.php");
						
						
						$adminnotifycontent = ob_get_clean();
						

						$adminfrom=get_option("admin_email");
						
						
						if($adminfrom!='')
						{
							$adminto=$adminfrom.', ktbmmb@bigpond.net.au';
						}else{
							$adminto='ktbmmb@bigpond.net.au';
						}
						

						$adminsubject="Membership Application Approved";
						

						$headers1 = "MIME-Version: 1.0" . "\r\n";
						
						
						$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						
						
						$headers1 .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
						
						$headers1 .= 'Cc: johnmccreery@bigpond.com, fandvgattuso@optusnet.com.au, jimmac5439@gmail.com, sue.margaret@hotmail.com, bgolf@bigpond.net.au' . "\r\n";
		
		                $headers1 .= 'Bcc: admin@collectiveloop.com' . "\r\n";
						
						mail($adminto,$adminsubject,$adminnotifycontent,$headers1);
						
						
						/* Admin Email Notification */
						
						
						/* Confirmation Emails */
						$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='nopayment' where id=".$getrecordid);
				
					}else{
						
						$user_name=$getallrecords->user_name;

						$user_emailaddress=$getallrecords->user_emailaddress;
						
						$user_wheredidyoufindus=$getallrecords->user_wheredidyoufindus;
						
						$user_address=$getallrecords->user_address;
						
						$user_address_sub=$getallrecords->user_address_sub;
						
						$user_address_postal=$getallrecords->user_address_postal;
						
						$user_phoneno=$getallrecords->user_phoneno;
						
						$user_occupation=$getallrecords->user_occupation;
						
						$userdateofbirth=$getallrecords->user_dob;
						
						$user_membership_category=$getallrecords->user_membership_category;
						
						$user_iscurrent_member=$getallrecords->user_iscurrent_member;
						
						$user_is_handicap=$getallrecords->user_is_handicap;
						
						$user_golflink_number=$getallrecords->user_golflink_number;
						
						$user_ismembership_suspended=$getallrecords->user_ismembership_suspended;
						
						$user_refuse_membership=$getallrecords->user_refuse_membership;
						
						$select_payment_method=$getallrecords->select_payment_method;
						
						$user_iscertify=$getallrecords->user_iscertify;
						
						$order_id=$getallrecords->orderid;
					
						$membershiprice="100";
						
						
						
						/* Confirmation Emails */
						
						
						/* Customer Email Notification */
						
						
						$select_payment_method=$getallrecords->payment_gateway;
						
						if($select_payment_method=='securepay')
						{
							
							$paymentmethod="Credit Card";
							$select_payment_method='creditcard';
							
						}elseif($select_payment_method=='paypal')
						{
							
							$paymentmethod="PayPal";
							$select_payment_method='paypal';
							
						}
						
						ob_start();
						
						
						include("membership/emails/membership_customer_completion_email.php");
						
						
						$customeremailcontent = ob_get_clean();
						
						
						$customerto=$user_emailaddress;
						

						$enterdemailaddress=$memberemailaddress;
						

						$adminfrom=get_option("admin_email");
						
						
						//$adminfrom="info@example.com";
						
						if($adminfrom!='')
						{
							$adminto=$adminfrom.', ktbmmb@bigpond.net.au';
						}else{
							$adminto='ktbmmb@bigpond.net.au';
						}
						
						$admincssemail=$adminto;

						$customersubject="Membership Application Approved";
						

						$headers = "MIME-Version: 1.0" . "\r\n";
						
						
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						
						
						$headers .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
						
						$headers .= 'Cc: '.$admincssemail. "\r\n";
						
						mail($customerto,$customersubject,$customeremailcontent,$headers);
					
						/* Customer Email Notification */
						
						
						/* Admin Email Notification */
						
						ob_start();
						
						
						include("membership/emails/membership_admin_completion_email.php");
						
						
						$adminnotifycontent = ob_get_clean();
						

						$adminfrom=get_option("admin_email");
						
						
						if($adminfrom!='')
						{
							$adminto=$adminfrom.', ktbmmb@bigpond.net.au';
						}else{
							$adminto='ktbmmb@bigpond.net.au';
						}
						

						$adminsubject="Membership Application Approved";
						

						$headers1 = "MIME-Version: 1.0" . "\r\n";
						
						
						$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						
						
						$headers1 .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
						
						//$headers1 .= 'Cc: johnmccreery@bigpond.com, fandvgattuso@optusnet.com.au, jimmac5439@gmail.com' . "\r\n";
					
						//$headers1 .= 'Bcc: admin@collectiveloop.com, bgolf@bigpond.net.au, sue.margaret@hotmail.com' . "\r\n";
						
						$headers1 .= 'Cc: johnmccreery@bigpond.com, fandvgattuso@optusnet.com.au, jimmac5439@gmail.com, sue.margaret@hotmail.com, bgolf@bigpond.net.au' . "\r\n";
		
		                $headers1 .= 'Bcc: admin@collectiveloop.com' . "\r\n";
						
						mail($adminto,$adminsubject,$adminnotifycontent,$headers1);
						
						/* Admin Email Notification */
						
						
						/* Confirmation Emails */
					
					}
					
					$responsemsg='<h2>Confirmation Sent Successfully!!!</h2>
					<p class="member_success">Membership confirmation notification has been sent successfully.</p>';
					
					$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='completed' where id=".$getrecordid);
			
					
				}else{
					
					$responsemsg='<h2>Confirmation Already Sent!!!</h2>
					<p class="member_success">Confirmation email has been already sent.</p>';
				}
				
				
			}else{
				$responsemsg='<p class="member_failure">Invalid Request</p>';
			}
				
		}else{
			$responsemsg='<p class="member_failure">Invalid Request</p>';
		}
		
	}else{
		$responsemsg='<p class="member_failure">Invalid Request</p>';
	}

?>

<section id="sologan_section" class="sologan_section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="sologan text-center membership_s">
					<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
					
					<?php
					    if(isset($_REQUEST['admin_sent_confirmation']))
	                    {
					
					    echo $responsemsg;
					?>
			
					
					<?php }else{ 
					
					echo apply_filters("the_content",$get_page_content);

					} ?>
					
				</div>
			</div>
		</div>
	</div>
</section>
		
<?php get_footer();?>