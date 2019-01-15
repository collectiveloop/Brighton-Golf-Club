<?php
session_start();
include("api/micropower_api_config.php");
$member_search=$_REQUEST['member_search_field'];

//echo "<pre>";print_r($_REQUEST);

if(isset($_REQUEST['action']) && ($_REQUEST['action']=='add_bookmark' || $_REQUEST['action']=='remove_bookmark'))
{
	$gettoken = $_SESSION['member_token'];
	$tokenarr = DecodeJWT($gettoken);
	$member_id = $tokenarr['memberid'];
	$fav_member_id=$_REQUEST['fav_mid'];
	
	$favdata['clubId']=$venueId;
	$favdata['memberId']=$member_id;
	$favdata['favouriteId']=$fav_member_id;
	
	if($_REQUEST['action']=='add_bookmark')
	{
		$addfavourites = CallAPI("POST", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/favourites?favouriteId=$fav_member_id", $favdata);
	    $addfavresponse = json_decode($addfavourites, TRUE);
		
	}elseif($_REQUEST['action']=='remove_bookmark')
	{
		$removefavourites = CallAPI("DELETE", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/favourites?favouriteId=$fav_member_id", $favdata);
	    $removefavresponse = json_decode($removefavourites, TRUE);
	}
	
	//echo "<pre>";print_r($addfavresponse);
	
	$bokkmarkedres = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/favourites/", false);
	$getallbookmarks = json_decode($bokkmarkedres, TRUE);

	$get_members=$getallbookmarks['members'];
	if(!empty($get_members))
	{
		foreach($get_members as $single_member)
		{
			$clubmemberid=$single_member['clubMemberId'];
			$memberfields=$single_member['fields'];
			
			$memberotherflds=array();
			foreach($memberfields as $singlefield)
			{
				$memfield_name=$singlefield['name'];
				$memberotherflds[$singlefield['name']]=$singlefield['value'];
			}
			//echo "<pre>";print_r($memberotherflds);
			$membername=$memberotherflds['FullName'];
			$memberphone=$memberotherflds['Phone'];
			$membermobile=$memberotherflds['Mobile'];
			$memberemail1=$memberotherflds['Email1'];
			$memderno=$clubmemberid.'RM017';
			
			?>
			<div class="member_search_rec_loop">
				<div class="member_sprofile_img">
					<img class="member_sprof_img" src="http://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
				</div>
				<div class="member_sprofile_leftsect">
					<h3><?php echo $membername; ?></h3>
					<a href="javascript:void(0);" data-m_id="<?php echo $memderno; ?>" id="search_show_details_unq_<?php echo $memderno; ?>" class="search_show_details" >Show Details</a>
					<div class="memebr_show_details" id="show_member_details_<?php echo $memderno; ?>" style="display:none">
					
					    <div class="details_action_container"> 
							<div class="details-container">
								<div>
									<label class="ng-binding">Phone:</label>
								</div>
								<div>
									<input type="text" readonly="readonly" value="<?php echo $memberphone; ?>">
								</div>
								<div>
									<label class="ng-binding">Mobile:</label>
								</div>
								<div>
									<input type="text" readonly="readonly" value="<?php echo $membermobile; ?>">
								</div>
								<div>
									<label class="ng-binding">Email1:</label>
								</div>
								<div>
									<input type="text" readonly="readonly" value="<?php echo $memberemail1; ?>">
								</div>
							</div>
							<div class="actions-container">
								<a href="javascript:;" class="button contact-link remove_bookmark_member_btn" data-favmemid="<?php echo $clubmemberid; ?>">Remove member</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<?php
		}
	}
	
}else{

	$search_string=$member_search;
	$searchstring="&firstnamefilter=".$search_string;
	$searchstring.="&surnamefilter=".$search_string;
	$searchstring.="&membernofilter=".$search_string;
	$searchallResponse = CallAPI("GET", $BaseAPIurl . "application/member/search/?clubid=$venueId".$searchstring, false);
	$membersearchdata = json_decode($searchallResponse, TRUE);

	//echo "<pre>";print_r($membersearchdata);

	$get_members=$membersearchdata['members'];
	if(!empty($get_members))
	{
		foreach($get_members as $single_member)
		{
			$clubmemberid=$single_member['clubMemberId'];
			$memberfields=$single_member['fields'];
			
			$memberotherflds=array();
			foreach($memberfields as $singlefield)
			{
				$memfield_name=$singlefield['name'];
				$memberotherflds[$singlefield['name']]=$singlefield['value'];
			}
			//echo "<pre>";print_r($memberotherflds);
			$PreferredName=$memberotherflds['PreferredName'];
			$membername=$memberotherflds['FullName'].' '.$PreferredName;
			$memberphone=$memberotherflds['Phone'];
			$membermobile=$memberotherflds['Mobile'];
			$memberemail1=$memberotherflds['Email1'];
			$memderno=$clubmemberid.'P017';
			
			if($memberphone==''){ $memberphone="-"; }
			if($membermobile==''){ $membermobile="-"; }
			if($memberemail1==''){ $memberemail1="-"; }
			
			?>
			<div class="member_search_rec_loop">
				<div class="member_sprofile_img">
					<img class="member_sprof_img" src="http://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
				</div>
				<div class="member_sprofile_leftsect">
					<h3><?php echo $membername; ?></h3>
					<a href="javascript:void(0);" data-m_id="<?php echo $memderno; ?>" id="search_show_details_unq_<?php echo $memderno; ?>" class="search_show_details" >Show Details</a>
					<div class="memebr_show_details" id="show_member_details_<?php echo $memderno; ?>" style="display:none">
					    <div class="details_action_container"> 
							<div class="details-container">
								<div>
									<label class="ng-binding">Phone:</label>
								</div>
								<div>
									<input type="text" readonly="readonly" value="<?php echo $memberphone; ?>">
								</div>
								<div>
									<label class="ng-binding">Mobile:</label>
								</div>
								<div>
									<input type="text" readonly="readonly" value="<?php echo $membermobile; ?>">
								</div>
								<div>
									<label class="ng-binding">Email1:</label>
								</div>
								<div>
									<input type="text" readonly="readonly" value="<?php echo $memberemail1; ?>">
								</div>
							</div>
							<div class="actions-container">
								<a href="javascript:;" class="button contact-link bookmark_member_btn" data-favmemid="<?php echo $clubmemberid; ?>">Bookmark Member</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
?>