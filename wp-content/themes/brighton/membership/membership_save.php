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
	
	//$user_wheredidyoufindus=$_REQUEST['user_wheredidyoufindus'];
	
	//$user_address=$_REQUEST['user_address'];
	
	//$user_address_sub=$_REQUEST['user_address_sub'];
	
	//$user_address_postal=$_REQUEST['user_address_postal'];
	
	$user_phoneno=$_REQUEST['user_phoneno'];
	
	//$user_occupation=$_REQUEST['user_occupation'];
	
	//$user_dob_day=$_REQUEST['user_dob_day'];
	
	//$user_dob_month=$_REQUEST['user_dob_month'];
	
	//$user_dob_year=$_REQUEST['user_dob_year'];
	
	//$userdateofbirth=$user_dob_year.'-'.$user_dob_month.'-'.$user_dob_day;
	
	$user_membership_category=$_REQUEST['user_membership_category'];
	
	//$user_iscurrent_member=$_REQUEST['user_iscurrent_member'];
	
	//$user_is_handicap=$_REQUEST['user_is_handicap'];
	
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
	
	
	$wpdb->query("INSERT INTO ".$wpdb->prefix."membership_subscriptions (id, user_name, user_emailaddress, user_wheredidyoufindus, user_address, user_address_sub, user_address_postal, user_phoneno, user_occupation, user_dob, user_membership_category, user_iscurrent_member, user_is_handicap, user_golflink_number, user_ismembership_suspended, user_refuse_membership, user_iscertify, payment_status, transaction_id, payment_gateway) VALUES ('', '".$user_name."', '".$user_emailaddress."', '".$user_wheredidyoufindus."', '".$user_address."', '".$user_address_sub."', '".$user_address_postal."', '".$user_phoneno."', '".$user_occupation."', '".$userdateofbirth."', '".$user_membership_category."', '".$user_iscurrent_member."', '".$user_is_handicap."', '".$user_golflink_number."', '".$user_ismembership_suspended."', '".$user_refuse_membership."', '".$user_iscertify."', '".$payment_status."', '".$transaction_id."', 'securepay');");
	
	
	$getlastentryid = $wpdb->insert_id;
	
	/* SecurePay API */
	
	
		
	$testurl="https://test.securepay.com.au/xmlapi/payment";


	$liveurl="https://api.securepay.com.au/xmlapi/payment";


	$timeStamp = date("YdmHisB" . "000+660");


	$mId = time();


	$merchantID='2ZO0017';
	//$merchantID='ABC0001';

	$transactionpassword='6z5PwFgl';
	//$transactionpassword='abc123';

	$membershiprice='';
	if($user_membership_category=='Junior Playing Member')
	{
		
	    $membershiprice="22";
		
	}elseif($user_membership_category=='2-for-1 Membership Offer'){
		
		$membershiprice="50";
		
	}elseif($user_membership_category=='Ordinary Playing Member'){
		
	    $membershiprice="100";
		
	}
	
	$errormessage='';
	
	if(empty($membershiprice))
	{
		
		$order_id='ORD-'.$getlastentryid.'-'.time();
		
		$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='no_payment',orderid='".$order_id."' where id=".$getlastentryid);
		
		/*No Payment*/
        
        /* Confirmation Emails */
				
		/* Customer Email Notification */
		
		ob_start();
		
		include("emails/membership_customer_email.php");
		
		$customeremailcontent = ob_get_clean();
		
		$customerto=$user_emailaddress;
		
		$enterdemailaddress=$memberemailaddress;
		
		$adminfrom=get_option("admin_email");
		
		$customersubject="Membership Application Submitted";
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
	
		$headers .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
		
		//$customerto=$customerto.',ashishkul555@gmail.com';
		
		mail($customerto,$customersubject,$customeremailcontent,$headers);
		
		
		/* Customer Email Notification */
		
		
		/* Admin Email Notification */
		
		ob_start();
		
		
		include("emails/membership_admin_email.php");
		
		
		$adminnotifycontent = ob_get_clean();
		

		$adminfrom=get_option("admin_email");
		
		if($adminfrom!='')
		{
			$adminto=$adminfrom.',ktbmmb@bigpond.net.au';
		}else{
			$adminto='ktbmmb@bigpond.net.au';
		}
		
		
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
		
	}else{
		
		/*With Payment*/
		
		//echo $membershiprice;
	
		/*Adding live test account*/
		
		//$membershiprice=1;
		
		/*Adding live test account*/

		$currentycode="AUD";

		$order_id='ORD-'.$getlastentryid.'-'.time();


		$ccardnumber=$user_creditcard_number;


		$ccardexpmonth=$user_expiry_month;


		$ccardexpyear=$cc_expiry_year;


		$ccardcvv=$user_cvv_number;


		$ccardholdername=$user_nameoncard;
		
		
		$creditexpdate=$ccardexpmonth.'/'.$ccardexpyear;


		$xmlRequest = '<?xml version="1.0" encoding="UTF-8"?>
			<SecurePayMessage>
				<MessageInfo>
					<messageID>'.$mId.'</messageID>
					<messageTimestamp>' . $timeStamp . '</messageTimestamp>
					<timeoutValue>60</timeoutValue>
					<apiVersion>xml-4.2</apiVersion>
				</MessageInfo>
				<MerchantInfo>
					<merchantID>' . $merchantID . '</merchantID>
					<password>' . $transactionpassword . '</password>
				</MerchantInfo>
				<RequestType>Payment</RequestType>
				<Payment>
				<TxnList count="1">
					<Txn ID="1">
					<txnType>0</txnType>
					<txnSource>23</txnSource>
					<amount>'.($membershiprice * 100).'</amount>
					<currency>'.$currentycode.'</currency>
					<purchaseOrderNo>'.$order_id.'</purchaseOrderNo>
					<CreditCardInfo>
						<cardNumber>'.$ccardnumber.'</cardNumber>
						<expiryDate>'.$ccardexpmonth.'/'. $ccardexpyear.'</expiryDate>
						<cvv>'.$ccardcvv.'</cvv>
						<cardHolderName>'.$ccardholdername.'</cardHolderName>
					</CreditCardInfo>
					</Txn>
				</TxnList>
				</Payment>
			</SecurePayMessage>';
					
			//liveurl//testurl
			$sresponse = wp_remote_post($liveurl, array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array('content-type' => 'text/xml'),
					'body' => $xmlRequest,
					'cookies' => array()
				)
			);
			
			
		$errormessage='error';
		
		if(!is_wp_error($sresponse) && $sresponse['response']['code'] >= 200 && $sresponse['response']['code'] < 300) 
		{

			$apiResp = $sresponse['body'];
			

			$xml = simplexml_load_string($apiResp);
			
			//echo "<pre>";print_r($sresponse);

			if(isset($xml->Status->statusCode) && $xml->Status->statusCode != '000')
			{
				$responsecode = $xml->Status->statusCode;
				
				
				$responsetext = $xml->Status->statusDescription;
				
				
			}elseif(isset($xml->Payment->TxnList->Txn->approved))
			{
				
				$responsecode = $xml->Payment->TxnList->Txn->responseCode;
				
				
				$responsetext = $xml->Payment->TxnList->Txn->responseText;
				
				
				$transactionId = $xml->Payment->TxnList->Txn->txnID;
				

			}else{
				
				$responsecode = false;
				
			}


			if ($responsecode == '00' || $responsecode == '08') 
			{
				
				$errormessage=0;
				
				$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='review',orderid='".$order_id."', transaction_id='".$transactionId."' where id=".$getlastentryid);
				
				
				/* Confirmation Emails */
				
				
				/* Customer Email Notification */
				
				
				$paymentmethod="Credit Card";
				
				
				$creditcardno=maskCreditCard($ccardnumber);
				
				
				ob_start();
				
				
				include("emails/membership_customer_email.php");
				
				
				$customeremailcontent = ob_get_clean();
				
				
				$customerto=$user_emailaddress;
				

				$enterdemailaddress=$memberemailaddress;
				

				$adminfrom=get_option("admin_email");
				
				
				//$adminfrom="info@example.com";
				

				$customersubject="Membership Application Submitted";
				

				$headers = "MIME-Version: 1.0" . "\r\n";
				
				
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				
				$headers .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
				
				//$customerto=$customerto.',ashishkul555@gmail.com';
				
				mail($customerto,$customersubject,$customeremailcontent,$headers);
				
				
				/* Customer Email Notification */
				
				
				/* Admin Email Notification */
				
				ob_start();
				
				
				include("emails/membership_admin_email.php");
				
				
				$adminnotifycontent = ob_get_clean();
				

				$adminfrom=get_option("admin_email");
				
				if($adminfrom!='')
				{
					$adminto=$adminfrom.',ktbmmb@bigpond.net.au';
				}else{
					$adminto='ktbmmb@bigpond.net.au';
				}
				
				
				
				//$adminfrom="info@example.com";
				

				$adminsubject="New Membership Application";
				

				$headers1 = "MIME-Version: 1.0" . "\r\n";
				
				
				$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				
				$headers1 .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
				
				//$headers1 .= 'Cc: johnmccreery@bigpond.com, fandvgattuso@optusnet.com.au, jimmac5439@gmail.com, sue.margaret@hotmail.com, bgolf@bigpond.net.au'. "\r\n";
				
				$headers1 .= 'Cc: johnmccreery@bigpond.com, fandvgattuso@optusnet.com.au, jimmac5439@gmail.com, sue.margaret@hotmail.com, bgolf@bigpond.net.au' . "\r\n";
		
		        $headers1 .= 'Bcc: admin@collectiveloop.com' . "\r\n";
				
				
				mail($adminto,$adminsubject,$adminnotifycontent,$headers1);

				/* Admin Email Notification */
				
				
				/* Confirmation Emails */
				
				

			} else {
				
				$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='failed' where id=".$getlastentryid);
				
				$errormessage='Payment can not be processed. ( '.$responsetext.' )';
				
				
			}

		} else {
			
			
			$errormessage='Payment Gateway Error';
			
			$wpdb->query("update ".$wpdb->prefix."membership_subscriptions set payment_status='failed' where id=".$getlastentryid);
			
		}
	}

	//echo $errormessage;
	
	if(!empty($errormessage))
	{
		
	}else{
		header("location:".get_site_url().'/index.php/membership-confirmation/#sologan_section');
	}
	if($errormessage==0)
	{
	}
}


   



	
	
	
	

