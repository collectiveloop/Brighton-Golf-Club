<?php
session_start();
include("../../../../wp-config.php");

include("api/micropower_api_config.php");

function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode(array_slice($em, 0, count($em)-1), '@');
    $len  = floor(strlen($name)/2);
    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}

if(isset($_REQUEST['action']))
{
	$gettoken = $_SESSION['member_token'];
	$tokenarr = DecodeJWT($gettoken);
	$member_id = $tokenarr['memberid'];
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='change_image')
{
	$cfile = new CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);

	$proimgarr['profileimage']=$cfile;
	$changeprofilereq = CallAPI_image("POST", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/resources/profileimage", $proimgarr);
	$profileimagearr = json_decode($changeprofilereq, TRUE);
	
	if(!empty($profileimagearr['files']))
	{
		$is_error=0;
	}else{
		$is_error=1;
	}	
}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_image')
{
	$deleteprofileimgreq = CallAPI("DELETE", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/resources/profileimage",false);
	$delprofileimagearr = json_decode($deleteprofileimgreq, TRUE);
	
	if(!empty($delprofileimagearr))
	{
		$is_error=0;
	}else{
		$is_error=1;
	}	
	
}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='change_password')
{
    $gettoken = $_SESSION['member_token'];
	$tokenarr = DecodeJWT($gettoken);
	$member_id = $tokenarr['memberid'];
	
	/*Update Password*/
	$updatepassarr['clubId']=$venueId;
	$updatepassarr['clubMemberId']=$member_id;
	$updatepassarr['newPassword']=$_REQUEST['new_password'];
	
	$updatepassResponse = CallAPI("PUT", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/password", $updatepassarr);
    $updatedpassresponse = json_decode($updatepassResponse, TRUE);
	
	if(empty($updatedpassresponse))
	{
		$is_error=0;
	}else{
		$is_error=1;
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='edit_profile')
{
	//extract($_REQUEST);
	$gettoken = $_SESSION['member_token'];
	$tokenarr = DecodeJWT($gettoken);
	$member_id = $tokenarr['memberid'];
	
	$updatearr=array();
	$updatearr['clubId']=$venueId;
	$updatearr['clubMemberId']=$member_id;
	$p=0;
	foreach($_REQUEST['profile_data'] as $k=>$field_val)
	{
		$updatearr['fields'][$p]['name']=$k;
		$updatearr['fields'][$p]['value']=$field_val;
		$p++;
	}
	
	$updatedataResponse = CallAPI("PUT", $BaseAPIurl . "data/clubs/$venueId/members/$member_id", $updatearr);
    $updatedresponse = json_decode($updatedataResponse, TRUE);
	
	if(empty($updatedresponse))
	{
		$is_error=0;
	}else{
		$is_error=1;
	}
	
	/*Update privacy settings*/
	$updateprivacyarr=array();
	$updateprivacyarr['clubId']=$venueId;
	$updateprivacyarr['clubMemberId']=$member_id;
	$t=0;
	foreach($_REQUEST['privacy_data'] as $k=>$fieldval)
	{
		if($fieldval==0)
		{
			$fieldval=false;
		}else{
			$fieldval=true;
		}
		$updateprivacyarr['fields'][$t]['name']=$k;
		$updateprivacyarr['fields'][$t]['public']=$fieldval;
		$t++;
	}
	
	$updateprivacyResponse = CallAPI("PUT", $BaseAPIurl . "data/clubs/$venueId/directory/$member_id/settings", $updateprivacyarr);
    $updatedprivacyresponse = json_decode($updateprivacyResponse, TRUE);
	
	if(empty($updatedprivacyresponse))
	{
		$is_error=0;
	}else{
		$is_error=1;
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='reset_password')
{
	$to='';
	$memberemailaddress='';
	$email_message='';
	$headers='';
	$customersubject='';
	
	/*Reset Password*/
	
	$recaptcha_secret = "6LefDDIUAAAAAH9po2To2IAWDqD-svKc7qYver9B";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_REQUEST['g-recaptcha-response']);
	$response = json_decode($response, true);

	if($response["success"] === true)
	{
		$member_id=$_REQUEST['member_login'];
		$settingResponse = CallAPI("GET", $BaseAPIurl . "application/refresh/member?clubId=$venueId&memberNo=$member_id", false);
		$settingdata = json_decode($settingResponse, TRUE);
		$getsettingfields=$settingdata['fields'];
		
		$membersettingarr=array();
		if(!empty($getsettingfields))
		{
			foreach($getsettingfields as $settingfield)
			{
				$fieldname = $settingfield['name'];
				$membersettingarr[$fieldname]=$settingfield['value'];
			}
		
		
			$username=$membersettingarr['WWW_Username'];
			$user_Password=$membersettingarr['WWW_Password'];
			
			/*Get member id*/
			$loginData["Username"]=trim($username);
			$loginData["Password"]=trim($user_Password);
			
			$logonResponse = CallAPI("POST", $BaseAPIurl . "security/authorisation/user", $loginData);
			// Parse the json Response
			$logonResponseData = json_decode($logonResponse, TRUE);
			$tokenValue = $logonResponseData['token'];
			
			if(!empty($tokenValue))
			{
				$JWTClaims = DecodeJWT($tokenValue);
				$memberId = $JWTClaims['memberid'];
			}
			/*Get member id*/
			
			$memberemailaddress=$membersettingarr['Email1'];
			$PreferredName=$membersettingarr['PreferredName'];
			
			/*Send password change email*/
			$adminfrom=get_option("admin_email");
			$to=$memberemailaddress;

			
			$resetpassurl=get_site_url().'/index.php/new-member-portal/?action=resetpass&mid='.base64_encode($memberId).'&nowtime='.time();
			$email_message='<p><b>Hi '.ucwords($PreferredName).',</b></p>';
			$email_message.="<p>This email has been sent because you recently requested to reset your password to your account at Brighton GC Member's Portal. Please click the link below to reset your password:</p>";
			$email_message.="<p><a href='".$resetpassurl."'>Reset Password</a></p>";
			$email_message.="<p>This link will be valid for two hours. If you did not request your password to be reset, please ignore this email.</p>";

			$customersubject="Brighton GC - Reset Password";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: BGC <'.$adminfrom.'>'. "\r\n";
			mail($to,$customersubject,$email_message,$headers);
			/*Send password change email*/
			
			$email_address=obfuscate_email($memberemailaddress);
			
			$memberretdata=array();
			$memberretdata['email']=$memberemailaddress;
			$memberretdata['masked_email']=$email_address;
			$memberretdata['nick_name']=$PreferredName;
			$memberretdata['status']=0;
			
			$is_error=json_encode($memberretdata);
		
		}else{
			$is_error=2;
		}
	}else{
		$is_error=5;
	}
}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='updatepassword')
{
	$to='';
	$memberemailaddress='';
	$email_message='';
	$headers='';
	$customersubject='';
	
	/*Update Password*/

    $reset_member_id=$_REQUEST['resetpass_member'];
	
	$updatepassarr=array();
	$updatepassarr['clubId']=$venueId;
	$updatepassarr['clubMemberId']=trim($reset_member_id);
	$updatepassarr['newPassword']=trim($_REQUEST['new_password']);
	
	$updatepassResponse = CallAPI("PUT", $BaseAPIurl . "data/clubs/$venueId/members/$reset_member_id/password", $updatepassarr);
    $updatedpassresponse = json_decode($updatepassResponse, TRUE);
	
	/*Send password change email*/
	$member_id=trim($reset_member_id);
	$profileResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id", false);
	$MemberData = json_decode($profileResponse, TRUE);
	$MemberFields = $MemberData['fields'];
	$getsettingfields=$MemberFields;
	
	//echo "<pre>";print_r($getsettingfields);
	
	$membersettingarr=array();
	if(!empty($getsettingfields))
	{
		foreach($getsettingfields as $settingfield)
		{
			$fieldname = $settingfield['name'];
			$membersettingarr[$fieldname]=$settingfield['value'];
		}
	}
	
	$memberemailaddress=$membersettingarr['Email1'];
	$PreferredName=$membersettingarr['PreferredName'];
	
	
	$adminfrom=get_option("admin_email");
	$to=$memberemailaddress;
	
	$email_message='<p><b>Hi '.ucwords($PreferredName).',</b></p>';
	$email_message.="<p>This email has been sent because your password for Brighton GC Member's Portal has recently been changed.</p>";
	$email_message.="<p>If you have changed your password recently, you can safely ignore this email.</p>";
	$email_message.="<p>If you did not request a password reset, please contact you club as soon as possible.</p>";

	$customersubject="Brighton GC - Password Reset Confirmation";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: BGC <'.$adminfrom.'>'. "\r\n";
	
	/*Send password change email*/
		
	if(empty($updatedpassresponse))
	{
		$is_error=0;
		
		mail($to,$customersubject,$email_message,$headers);
	
	}else{
		$is_error=1;
	}
}else{
	$member_login_no=$_REQUEST['member_login'];
	$member_password=$_REQUEST['member_password'];

	if(!empty($member_login_no) && !empty($member_password))
	{
		$loginData["Username"]=trim($member_login_no);
		$loginData["Password"]=trim($member_password);
		
		$logonResponse = CallAPI("POST", $BaseAPIurl . "security/authorisation/user", $loginData);
		// Parse the json Response
		$logonResponseData = json_decode($logonResponse, TRUE);
		$tokenValue = $logonResponseData['token'];
		
		if(!empty($tokenValue))
		{
			$JWTClaims = DecodeJWT($tokenValue);
			$memberId = $JWTClaims['memberid'];
			
			$_SESSION['is_member_login']='yes';
			$_SESSION['logged_member_id']=$memberId;
			$_SESSION['member_token']=$tokenValue;
			
			$is_error=0;
		}else{
			$is_error=1;
		}
	}else{
		$is_error=1;
	}
}
echo $is_error;
?>