<?php

/* Payment By Securepay */

global $wpdb;

$errormessage='';

function maskCreditCard($cc)
{

    $cc_length = strlen($cc);

    for($i=0; $i<$cc_length-4; $i++)
	{
		
        if($cc[$i] == '-'){ continue; }

        $cc[$i] = 'X';

    }

    return $cc;

}


if(isset($_REQUEST['user_registration']))
{
	
	$user_name=$_REQUEST['user_name'];
	
	$user_emailaddress=$_REQUEST['user_emailaddress'];
	
	$user_wheredidyoufindus=$_REQUEST['user_wheredidyoufindus'];
	
	$user_address=$_REQUEST['user_address'];
	
	$user_address_sub=$_REQUEST['user_address_sub'];
	
	$user_address_postal=$_REQUEST['user_address_postal'];
	
	$user_phoneno=$_REQUEST['user_phoneno'];
	
	$user_occupation=$_REQUEST['user_occupation'];
	
	$user_dob_day=$_REQUEST['user_dob_day'];
	
	$user_dob_month=$_REQUEST['user_dob_month'];
	
	$user_dob_year=$_REQUEST['user_dob_year'];
	
	$userdateofbirth=$user_dob_year.'-'.$user_dob_month.'-'.$user_dob_day;
	
	$user_membership_category=$_REQUEST['user_membership_category'];
	
	$user_iscurrent_member=$_REQUEST['user_iscurrent_member'];
	
	$user_is_handicap=$_REQUEST['user_is_handicap'];
	
	$user_golflink_number=$_REQUEST['user_golflink_number'];
	
	$user_ismembership_suspended=$_REQUEST['user_ismembership_suspended'];
	
	$user_refuse_membership=$_REQUEST['user_refuse_membership'];
	
	$select_payment_method=$_REQUEST['select_payment_method'];
	
	$user_creditcard_number=$_REQUEST['user_creditcard_number'];
	
	$user_expiry_month=$_REQUEST['user_expiry_month'];
	
	$user_expiry_month=str_pad($user_expiry_month,2,0,STR_PAD_LEFT); 
	
	$user_expiry_year=$_REQUEST['user_expiry_year'];
	
	
	$cc_expiry_year = substr($user_expiry_year, -2);
	
	$user_cvv_number=$_REQUEST['user_cvv_number'];
	
	$user_nameoncard=$_REQUEST['user_nameoncard'];
	
	$user_iscertify=$_REQUEST['user_iscertify'];
	
	
	$payment_status='pending';
	
	
	$wpdb->query("INSERT INTO ".$wpdb->prefix."membership_subscriptions (id, user_name, user_emailaddress, user_wheredidyoufindus, user_address, user_address_sub, user_address_postal, user_phoneno, user_occupation, user_dob, user_membership_category, user_iscurrent_member, user_is_handicap, user_golflink_number, user_ismembership_suspended, user_refuse_membership, user_iscertify, payment_status, transaction_id, payment_gateway) VALUES ('', '".$user_name."', '".$user_emailaddress."', '".$user_wheredidyoufindus."', '".$user_address."', '".$user_address_sub."', '".$user_address_postal."', '".$user_phoneno."', '".$user_occupation."', '".$userdateofbirth."', '".$user_membership_category."', '".$user_iscurrent_member."', '".$user_is_handicap."', '".$user_golflink_number."', '".$user_ismembership_suspended."', '".$user_refuse_membership."', '".$user_iscertify."', '".$payment_status."', '".$transaction_id."', 'paypal');");
	
	
	$getlastentryid = $wpdb->insert_id;
	
	/* SecurePay API */
	

	$liveurl="https://www.paypal.com/cgi-bin/webscr";


	$testurl="https://www.sandbox.paypal.com/cgi-bin/webscr";
	
	
	$order_id='ORD-'.$getlastentryid.'-'.time();
	
	
	$membershiprice="100";
	
	
	$namearr=explode(" ",$user_name);
	
	if(isset($namearr[0]))
	{
		
		$fname=$namearr[0];
		
	}
	
	if(isset($namearr[1]))
	{
		$lastname='';
		for($p=0;$p<count($namearr);$p++)
		{
			
			if($p!=0)
			{
				
				$lastname.=$namearr[$p].' ';
				
			}
			
		}
		
		$lastname=trim($lastname);
	}
	
	
	
	?>
	
	
	
	<form action="<?php echo $testurl; ?>" method="" id="paypal_form_submit">
										
	<input type="hidden" name="business" value="ashishkul555-facilitator@gmail.com">
		
	<input type="hidden" name="cmd" value="_xclick">
	
	<input type="hidden" name="item_name" id="bgc_pro_frm_ttle" value="Brighton Golf Club - Membership">
	
	<input type="hidden" name="item_number" id="bgc_pro_frm_numbr" value="<?php echo $order_id; ?>">
	
	<input type="hidden" name="quantity" value="1">
	
	<input type="hidden" name="amount" id="bgc_membership_amount" value="<?php echo $membershiprice; ?>">
	
	<input type="hidden" name="currency_code" value="AUD">

	<input type="hidden" name="first_name" value="<?php echo $fname; ?>">
	
	<input type="hidden" name="last_name" value="<?php echo $lastname; ?>">
	
	<input type="hidden" name="address1" value="<?php echo $user_address; ?>">
	
	<input type="hidden" name="city" value="<?php echo $user_address_sub; ?>">
	
	<input type="hidden" name="zip" value="<?php echo $user_address_postal; ?>">
	
	<input type="hidden" name="night_phone_a" value="<?php echo $user_phoneno; ?>">
	
	<input type="hidden" name="email" value="<?php echo $user_emailaddress; ?>">
	
	<!---------Return and other request----------->
	
	<input type="hidden" name="return" value="<?php echo get_site_url(); ?>/index.php/membership-confirmation/">
	
	
	<input type="hidden" name="notify_url" value="<?php echo get_site_url(); ?>/index.php/membership-confirmation/">
	
	
	<!---------Return and other request----------->
	
    </form>
	
	<script>
												
	jQuery(document).ready(function ($){
		
		
		$("#paypal_form_submit").submit();
		
		
	});
	
	</script>
	
	<?php

}


   



	
	
	
	

