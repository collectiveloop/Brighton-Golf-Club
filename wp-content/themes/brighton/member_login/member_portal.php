<?php
include("api/micropower_api_config.php");

//date_default_timezone_set('Australia/Brisbane');

$get_newportal_url=get_site_url().'/index.php/new-member-portal/';

$gettoken = $_SESSION['member_token'];
$tokenarr = DecodeJWT($gettoken);
$member_id = $tokenarr['memberid'];

$logoimgResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId", false);
$logoData = json_decode($logoimgResponse, TRUE);
if(!empty($logoData))
{
	$logo_url=@$logoData['logoUrl'];
}else{
	$logo_url='';
}
//echo "<pre>";print_r($logoData);

$clubotherResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/resources/content", false);
$clubdata = json_decode($clubotherResponse, TRUE);

//echo "<pre>";print_r($clubdata);

$clubfielddata=array();
if(!empty($clubdata))
{
	foreach($clubdata as $getclubnfo)
	{
		$clubfielddata[$getclubnfo['title']]=$getclubnfo['content'];
	}
}
if(isset($clubfielddata['WelcomeMessage']))
{
	$club_msg=$clubfielddata['WelcomeMessage'];
}else{
	$club_msg='';
}


if($_REQUEST['ak']==1)
{
	//venueId
	
	///$profileResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId", false);
	
	
	
	if(!empty($_FILES))
	{
		//echo "<pre>";print_r($_FILES);
		
		//$proimgarr['profileimage']='@'.$_FILES['profileimage']['tmp_name'].'/'.$_FILES['profileimage']['name'];
		
		//echo "<pre>";print_r($proimgarr);
		
		/*$filename = $_FILES['file']['name'];
		$filedata = $_FILES['file']['tmp_name'];
		$filesize = $_FILES['file']['size'];
		
		$cfile = new CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);

		$proimgarr['profileimage']=$cfile;
		//echo $postfields = array("filedata" => "@$filedata", "filename" => $filename);
		
        $changeprofilereq = CallAPI_image("POST", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/resources/profileimage", $proimgarr);
	    $profileimagearr = json_decode($changeprofilereq, TRUE);
		
		echo "<pre>";print_r($changeprofilereq);
		echo "<pre>";print_r($profileimagearr);
		
		echo "ak hre";*/
		
		
	}
	
	?>
	<form action="" id="upload_pro_img11" method="post" enctype="multipart/form-data">
		Select image to upload:
		<input type="file" name="file" id="profileToUpload">
		<input type="submit" id="submitfiles" value="Upload Image" name="submit">
	</form>

	<?php
	
	/*$comptarr['competitionId']=49204;
	$competereq = CallAPI("POST", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competition/results", $comptarr);
	$competetionres = json_decode($competereq, TRUE);
	echo "<pre>";print_r($competetionres);
	
	$mytime=date("c",strtotime(20170829120415));
	$payment_receipt_arr=array();
	$payment_receipt_arr['clubId']=$venueId;
	$payment_receipt_arr['clubMemberId']=$member_id;
	$payment_receipt_arr['receiptDate']=$mytime;
	$payment_receipt_arr['description']="BGCTest";
	$payment_receipt_arr['referenceNumber']=4388202899135649;
	$payment_receipt_arr['currency']="AUD";
	$payment_receipt_arr['creditCardName']="";
	$payment_receipt_arr['creditCardCharge']=1.00;*/

	$payment_receipt_arr['accountPayments'][0]['foreignAccountId']=16;
	$payment_receipt_arr['accountPayments'][0]['amount']=1.00;
				
	//$addpaymentreceipt = CallAPI("POST", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/paymentreceipt", $payment_receipt_arr);
	//$paymentreceipt_resp = json_decode($addpaymentreceipt, TRUE);			

	//echo "<pre>";print_r($paymentreceipt_resp);			

	//$profileResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/pendingreceipts", false);
	//$MemberData = json_decode($profileResponse, TRUE);

	//echo "<pre>";print_r($MemberData);
	
	//die;
}

	
?>
<?php

if(isset($_REQUEST))
{
	$mystr='';
	foreach($_REQUEST as $k=>$newvalue)
	{
		$mystr.=$k.'-------------------'.$newvalue.'<br/>';
	}
	
	//mail("impala.anju@gmail.com","ak test here",$mystr);
}

    if(isset($_SESSION['is_member_login']) && $_SESSION['is_member_login']=='yes')
	{
		$gettoken = $_SESSION['member_token'];
		$tokenarr = DecodeJWT($gettoken);
		$member_id = $tokenarr['memberid'];
		
		if(isset($_REQUEST['action']) && $_REQUEST['action']=='logout')
		{
			/*Logout Member from Portal*/
			$tokendata['token']=$gettoken;
			$logoutrequest = CallAPI("POST", $BaseAPIurl . "security/expiration/token", $tokendata);
	        $logoutresponse = json_decode($logoutrequest, TRUE);
			
			session_destroy();
			$_SESSION=array();
			
			header('location:'.$get_newportal_url);
		}
		
		/*Get Member details*/
		
		$profileResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id", false);
		$MemberData = json_decode($profileResponse, TRUE);
		$MemberFields = $MemberData['fields'];
		
		$memberinfoarr=array();
		$k=0;
		foreach($MemberFields as $field)
		{
			$firstname = $field['value'];
			$memberinfoarr[$field['name']]=$field['value'];
		}
		
		$getgolflinkno=@$memberinfoarr['GolflinkNo'];
		
		if(isset($MemberData['profileImageUrl']))
		{
			$profileimages=$MemberData['profileImageUrl'];
		}else
		{
			$profileimages='';
		}
		
?>
    <!--Member Portal starts here-->
	
    <!--Include calender js and css-->
	<link href='<?php echo get_template_directory_uri(); ?>/css/calendar/fullcalendar.css' rel='stylesheet' />
	<link href='<?php echo get_template_directory_uri(); ?>/css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <!--Include calender js and css-->
	
    <h2>Member Account</h2>	
	<?php
        if(isset($_REQUEST['action']) && $_REQUEST['action']=='member_competitions')
		{
			$currentdate=date("Y-m-d");
			if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='sel_date')
			{
				$startdate=$_REQUEST['date_between'];
				$startdate=str_replace("/","-",$startdate);
			    $startdate=date("Y-m-d",strtotime($startdate));
				$enddate=$_REQUEST['date_final_end'];
				$enddate=str_replace("/","-",$enddate);
				$enddate=date("Y-m-d",strtotime($enddate));
				$isdateshow="yes";
			}else{
				$startdate=date("Y-m-d");
			    $enddate = date('Y-m-d', strtotime('+1 year'));
				$isdateshow="no";
			}
			
			//echo $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competitions?fromDate=$startdate&toDate=$enddate";
			
			$getcompetitionreq = CallAPI("GET", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competitions?fromDate=$startdate&toDate=$enddate", false);
		    $getcompetition_res = json_decode($getcompetitionreq, TRUE);
			
			//echo "<pre>";print_r($getcompetition_res);
	
			$eventshtml='';
			if(!empty($getcompetition_res))
			{
				foreach($getcompetition_res as $single_comp)
				{
					if(isset($single_comp['competitionId']))
					{
						$competitionId=$single_comp['competitionId'];
						$isNineHole=$single_comp['isNineHole'];
						$getround_no=$single_comp['roundNo'];
						$gender=$single_comp['gender'];
						$roundDate=$single_comp['roundDate'];
						$eventstartdate=date("Y-m-d",strtotime($roundDate));
						
						if($getround_no>1)
						{
							$showround='R'.$getround_no.' ';
							$showtooltipround='Round '.$getround_no.' ';
							$visibility='Club Members Only';
						}else{ $visibility='All Visitors'; }
						$compname=$single_comp['name'];
						$competitionTypes=$single_comp['competitionTypes'];
						
						$gettypedetails=$competitionTypesDetail['competitionTypesDetail'][0];
						$isteamhandicap=$gettypedetails['hasTeamHandicap'];
						$isTeamBased=$gettypedetails['isTeamBased'];
						
						$finaleventname=$showround.$compname;
						$finaleventtooltipname=$showtooltipround.$compname;
						if($isteamhandicap==''){ $teamhandshow='None';  }else{ $teamhandshow="Yes"; }
						
						if($gender=='Female'){ $eventcolor='#FA8072'; }elseif($gender=='Male'){ $eventcolor='#4682B4'; }else{ $eventcolor='#808080';  }
						
						if($gender=='Male'){ $gender_img='user_male.png'; }elseif($gender=='Female'){ $gender_img='user_female.png'; }else{ $gender_img='com_user.png'; } 
						$gender_img=get_template_directory_uri().'/img/'.$gender_img;
																
						if($isNineHole==1){ $scoreimg='9hole_sm.png'; }else{ $scoreimg='18hole_sm.png'; }
						$scoreimg=get_template_directory_uri().'/img/'.$scoreimg;
						
						$eventshtml.='{id:'.$competitionId.',gender_img:"'.$gender_img.'",score_img:"'.$scoreimg.'",visible:"'.$visibility.'",ishandicap:"'.$teamhandshow.'",types:"'.$competitionTypes.'",show_title:"'.$finaleventtooltipname.'",title:"'.$finaleventname.'",start:"'.$eventstartdate.'",color:"'.$eventcolor.'"},';
					
				    }
					
				}
			}
			//echo $eventshtml;
			?>
			<script>
				$(document).ready(function() {
					$('#calendar').fullCalendar({
						header: {
							left: 'prev,next today',
							center: 'title',
							right: ''
						},
						defaultDate: '<?php echo $currentdate; ?>',
						navLinks: true, // can click day/week names to navigate views
						editable: false,
						eventLimit: false, // allow "more" link when too many events
						events: [<?php echo $eventshtml; ?>],
						eventMouseover: function(event, jsEvent) {
							  
							var showtooltiphtml='<div class="bgc_event_title"><div class="bgc_event_leftct"><h3>'+event.show_title+'</h3></div><div class="bgc_event_rightct"><img class="bgc_calender_genderimg" src="'+event.gender_img+'" /><img class="bgc_calender_holeimg" src="'+event.score_img+'" /></div></div>'; 
							showtooltiphtml+='<p class="bgc_other_details"><label>Who can play: </label><span> '+event.visible+'</span></p>'; 
							showtooltiphtml+='<p class="bgc_other_details"><label>Types: </label><span> '+event.types+'</span></p>'; 
							showtooltiphtml+='<p class="bgc_other_details"><label>Marker: </label><span> None</span></p>'; 
							showtooltiphtml+='<p class="bgc_other_details"><label>Member Fee: </label><span> None</span></p>'; 
							showtooltiphtml+='<p class="bgc_other_details"><label>Max Handicap: </label><span> '+event.ishandicap+'</span></p>'; 
							showtooltiphtml+='<p class="bgc_other_details"><label>Visitor Fee: </label><span> None</span></p>'; 
							
							var tooltip = '<div class="tooltipevent bgc_calendar_tooltipcls"><div class="tooltip_inner_container">'+showtooltiphtml+'</div></div>';
							var $tooltip = $(tooltip).appendTo('body');

							$(this).mouseover(function(e) {
								$(this).css('z-index', 10000);
								$tooltip.fadeIn('500');
								$tooltip.fadeTo('10', 1.9);
							}).mousemove(function(e) {
								
								//alert(e.pageX);
								//alert(e.pageY);
								var getourwidth=$(this).width(); 
								
								var getoffset = $("#calendar").offset();
                                var relativeX = (e.pageX - getoffset.left);
								
								//alert(e.pageX);
								//alert(offset.left);
								//alert(offset.right);
								
								var rightpos = ($(window).width() - ($(this).offset().left + $(this).outerWidth()));
								
								//alert(rt);
								
								$tooltip.css('top', e.pageY + 10);
								
								//alert(relativeX);
								
								if(relativeX < $("#calendar").width()/2) {
									
									$tooltip.css('left', e.pageX + 20);
								}else{
									$tooltip.css('right', rightpos + 20);
								}
								
							});
						},

						eventMouseout: function(event, jsEvent) {
							$(this).css('z-index', 8);
							$('.tooltipevent').remove();
						}
						
					});
					
				});

			</script>
			
			<section class="new_member_login_portal member_newportal_details" id="member_competition_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>Competitions</h2>
						</div>
					</div>
					<div class="member_details_section">
					    <div class="main_div">
							<div class="identification">
							    <div class="competitions_search_form">
								    <form action="<?php echo $get_newportal_url; ?>?action=member_competitions" id="caompetition_search_frm" method="post">
										<div class="compt_form_fields">
											<label>Showing:</label> 
											<select name="showing_events" id="showing_events_type">
												<option value="all" <?php if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='all'){ echo 'selected="selected"'; } ?>>All upcoming events</option>
												<option value="sel_date" <?php if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='sel_date'){ echo 'selected="selected"'; } ?>>Within selected dates</option>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
										</div>
										<div class="compt_form_fields">
											<label>View:</label>
											<select name="display_views" id="showing_views_type">
												<option value="calendar" <?php if(isset($_REQUEST['display_views']) && $_REQUEST['display_views']=='calendar'){ echo 'selected="selected"'; } ?>>Calendar</option>
												<option value="event_list" <?php if(isset($_REQUEST['display_views']) && $_REQUEST['display_views']=='event_list'){ echo 'selected="selected"'; } ?>>Competition/Event List</option>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
										</div>
										<div class="compt_form_fields datepicker_input_ct" style="<?php if($isdateshow=='no'){ ?>display:none;<?php } ?>">
											<label>Between:</label>
											<input type="text" name="date_between" value="<?php if(isset($_REQUEST['date_between'])){ echo $_REQUEST['date_between']; } ?>" id="date_between_unq" class="compt_input_fields" />
											<img id="show_start_date_img" class="show_date_icons" src="<?php echo get_template_directory_uri(); ?>/img/calendar-icon_input.png" />
										</div>
										<div class="compt_form_fields datepicker_input_ct" style="<?php if($isdateshow=='no'){ ?>display:none;<?php } ?>">
											<label>And:</label>
											<input type="text" name="date_final_end" value="<?php if(isset($_REQUEST['date_final_end'])){ echo $_REQUEST['date_final_end']; } ?>" id="date_final_unq" class="compt_input_fields" />
											<img id="show_end_date_img"  class="show_date_icons" src="<?php echo get_template_directory_uri(); ?>/img/calendar-icon_input.png" />
										</div>
										<div class="compt_form_fields">
										    <span class="show_req_date_err" style="display:none;"></span>
											<input type="submit" name="search_compitition_records" id="search_compitition" value="GO" />
										</div>
									</form>
								</div>
								<?php 
								    if(isset($_REQUEST['display_views']) && $_REQUEST['display_views']=='event_list')
									{
										?>
										<div class="allevents_competitions_listing member_mprofilr_accounts">
											<div class="responsive-table">
												<table class="account-balance-table" id="competition_listing_records">
													<thead>
														<tr>
															<th>Competition/Event</th>
															<th>Date</th>
															<th>Round</th>
															<th><img class="member_gender_icons" src="<?php echo get_template_directory_uri(); ?>/img/com_user.png" /></th>
															<th><img class="holes_vals_num" src="<?php echo get_template_directory_uri(); ?>/img/18hole_sm.png" /></th>
															<th>A/M/V</th>
														</tr>
													</thead>
													<tbody>
														<?php
															if(!empty($getcompetition_res))
															{
																foreach($getcompetition_res as $single_comp)
																{
																	if(isset($single_comp['competitionId']))
																	{
																		$competitionId=$single_comp['competitionId'];
																		$isNineHole=$single_comp['isNineHole'];
																		$getround_no=$single_comp['roundNo'];
																		$gender=$single_comp['gender'];
																		$roundDate=$single_comp['roundDate'];
																		$eventstartdate=date("d/m/Y",strtotime($roundDate));
																		
																		if($getround_no>1)
																		{
																			$visibility='M';
																		}else{ $visibility='V'; }
																		$compname=$single_comp['name'];
																		$competitionTypes=$single_comp['competitionTypes'];
																		
																		if($gender=='Male'){ $gender_img='user_male.png'; }elseif($gender=='Female'){ $gender_img='user_female.png'; }else{ $gender_img='com_user.png'; } 
																		
																		if($isNineHole==1){ $scoreimg='9hole_sm.png'; }else{ $scoreimg='18hole_sm.png'; }
																		
																		?>
																		<tr>
																			<td><?php echo $compname; ?></td>
																			<td><?php echo $eventstartdate; ?></td>
																			<td><?php echo $getround_no; ?></td>
																			<td><img class="member_gender_icons" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $gender_img; ?>" /></td>
																			<td><img class="holes_vals_num" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $scoreimg; ?>" /></td>
																			<td><?php echo $visibility; ?></td>
																		</tr>
																		<?php
																	}
																}
															}else{
																?>
																<tr><td colspan="6">No results found.</td></tr>
																<?php
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<?php
									}else{
										?>
										<div class="calendar_display_area">
											<div id='calendar'></div>
										</div>
										<?php
									}
								?>
								
								
							</div>
						</div>
					</div>
				</div>
			</section>
			
			<?php
		}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='member_business')
		{
			//data/clubs/$venueId/members/$member_id
			$getbusinescats = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/businessDirectory/categories", false);
		    $bus_catarr = json_decode($getbusinescats, TRUE);

            ?>
			<!--busniess -->
			<section class="new_member_login_portal member_mprofilr_busniess member_newportal_details" id="member_business_directoy">
			    <div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>Business Directory</h2>
						</div>
					</div>
					<div class="member_details_section">
						<div class="main_div">
							<div class="busniess_inner">
							  <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
								<ul class="nav nav-tabs" id="myTabs" role="tablist">
								  <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Search Business Directory</a></li>
								  <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">My Businesses</a></li>
								</ul>
								<div class="tab-content" id="myTabContent">
								    <div class="tab-pane fade active in" role="tabpanel" id="home" aria-labelledby="home-tab">
										<form>
										    <div class="name_busniess">
												<label class="category">Name:</label>
												<input class="business_inner_fields" id="businessdir_nm" name="business_dir_name" type="text">
										    </div>
										    <div class="category_busniess">
												<label class="category">Category:</label>
												<select class="category" name="business_category" id="filter_business_category">
												    <option value="All Categories">All Categories</option>
												   
													<?php
													    if(!empty($bus_catarr))
														{
															foreach($bus_catarr as $singlecat)
															{
																if(isset($singlecat['businessDirectoryCategoryId']))
																{
																	$cat_id=$singlecat['businessDirectoryCategoryId'];
																	?>
																	<option value="<?php echo $cat_id; ?>"><?php echo $singlecat['name']; ?></option>
																	<?php
																}
															}
														}
													?>
												</select>
										    </div>
										</form>
										<div class="alignment_alphabet">
										    <ul class="az_alphabet">
												<?php
												    foreach (range('A', 'Z') as $char) 
													{
														?>
														<li><a href="javascript:;" class="alphabatic_search" data-alphaval="<?php echo $char; ?>"><?php echo $char; ?></a></li>
														<?php
													}
												?>
										    </ul>
										</div>
										<div class="multiselect">
										    <div class="multislct_btn" id="busname_selector" style="display:none;"> 
										        <span class="removeFilter business_filter_remove">X</span> 
												<span class="categoryFilter">
												    <strong>Title Contains: </strong> 
													<span class="filters_businname_name">All Categories</span>
												</span> 
											</div>
										    <div class="multislct_btn" id="alphacode_selector" style="display:none;"> 
										        <span class="removeFilter aplhabet_filter_remove">X</span> 
												<span class="categoryFilter">
												    <strong>Title Begins With: </strong> 
													<span class="filters_alpha_name">All Categories</span>
												</span> 
											</div>
										    <div class="multislct_btn" id="category_selector"> 
										        <span class="removeFilter cat_filter_remove">X</span> 
												<span class="categoryFilter">
												    <strong>Category: </strong> 
													<span class="filters_cat_name">All Categories</span>
												</span> 
											</div>
										</div>
										<?php/*<div class="business_directory_listing">
										    <div class="col col-fullwidth">
											    <div class="responsive-table">
													<table data-table-id="account-balance-table">
														<thead>
															<tr>
																<th class="">Business Name</th>
																<th class="">Description</th>
																<th class=""></th>
															</tr>
														</thead>
														<tbody>
															<tr class="body-row">
																<td><strong>sdsffsdf</strong></td>
																<td>Description</td>
																<td class="payment-button">
																	<a class="button edit_business_directry" data-busid="1" href="javascript:;">Edit</a>
																</td>
															</tr>
														</tbody>
													</table>
											    </div>
											</div>
										</div>*/?>
										    
										<p>No Business Listings found.</p>
										
								    </div>
								    <div class="tab-pane fade" role="tabpanel" id="profile" aria-labelledby="profile-tab">
										<div class="add_busnies">
										    <div class="new_b_listning">
											    <div class="top_listn_busns"> 
												    <a class="bsetup" id="add_new_business" href="javascript:;">Add New Business</a> 
												</div>
											</div>
											<div class="business_addedit_form">
											    
											</div>
											<div class="business_cloning_form_fields" style="display:none;">
											   
												<form action="" method="POST" class="business_form_cls">
													<div class="new_b_listning business_details_listing_ct">
														<div class="left"> 
														    <a class="ng-binding" href="<?php echo $get_newportal_url; ?>?action=member_business">New Business Listing</a> 
														</div>
														<div class="right"> 
															<a class="details-expand" href="javascript:;">Edit</a> | <a class="details-cancel" href="javascript:;">Cancel</a> 
														</div>
														<div class="title_input">
															<div class="tiltt">
																<label>Title:</label>
																<input type="text" name="business_title"/>
															</div>
															<div class="tiltt">
																<label>Website:</label>
																<input type="text" name="business_website"/>
															</div>
															<div class="tiltt">
																<label>Description:</label>
																<textarea required name="business_description" cols="" rows="" class="business_description"></textarea>
															</div>
															<div class="tiltt">
																<label>Category:</label>
																<select required name="business_cat" class="business_cat_cls">
																	<option value="">Select Category...</option>
																	<?php
																		if(!empty($bus_catarr))
																		{
																			foreach($bus_catarr as $singlecat)
																			{
																				if(isset($singlecat['businessDirectoryCategoryId']))
																                {
																					$cat_id=$singlecat['businessDirectoryCategoryId'];
																					?>
																					<option value="<?php echo $cat_id; ?>"><?php echo $singlecat['name']; ?></option>
																					<?php
																				}
																			}
																		}
																	?>
																</select>
															</div>
															<div class="tiltt">
																<label>Address:</label>
																<input type="text" name="business_address"/>
															</div>
															<div class="tilti">
																<label>Contact Person:</label>
																<div class="full_contact_inpts">
																	<div class="half">
																		<input type="text" name="business_contact_person1"/>
																	</div>
																	<div class="half">
																		<input type="text" name="business_contact_person2"/>
																	</div>
																</div>
															</div>
															<div class="tiltt">
																<label>Email:</label>
																<input type="text" name="business_email"/>
															</div>
															<div class="tiltt">
																<label>Phone:</label>
																<input type="text" name="business_phone"/>
															</div>
															<div class="last_update">
																<div class="left">
																	<p>Last Updated: </p>
																</div>
																<div class="right"> 
																	<input type="submit" class="submit-expand" value="Submit" name="submit_new_businessdir" />
																	<a class="expend-cancel" href="javascript:;">Cancel</a> 
																</div>
															</div>
														</div>
													</div>
												</form>
												
											</div>
										</div>
								    </div>
								    <div class="tab-pane fade" role="tabpanel" id="dropdown1" aria-labelledby="dropdown1-tab">
									    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
								    </div>
								    <div class="tab-pane fade" role="tabpanel" id="dropdown2" aria-labelledby="dropdown2-tab">
									    <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
								    </div>
								</div>
							  </div>
							</div>
						</div>
			        </div>
			    </div>
			</section>
			<!-- end --> 
			<?php
      	}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='member_single_result')
		{
		    $competitionId=$_REQUEST['compid'];
		    $roundid=$_REQUEST['rid'];
			
			$competarr['clubId']=$venueId;
			$competarr['clubMemberId']=$member_id;
			$competarr['competitionId']=$competitionId;
			$competarr['competitionDivisionId']=1;
			
			$getcompetitionreq = CallAPI("POST", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competition/results",$competarr);
		    $getcompetition_res = json_decode($getcompetitionreq, TRUE);
			
			//echo "<pre>";print_r($getcompetition_res);
			
			//echo "akk";
			
			if(!empty($getcompetition_res))
			{
				$getcompetitionrounds=$getcompetition_res['competitionDetails']['competitionRounds'];
				$getcompetitiontypes=$getcompetition_res['competitionDetails']['competitionTypes'];
				$getcompetitiondivisions=$getcompetition_res['competitionDetails']['competitionDivisions'];
				$competionname=$getcompetition_res['competitionDetails']['competitionName'];
				
				$firstroundid=@$getcompetition_res['competitionDetails']['competitionRounds'][0]['competitionRoundId'];
				$firsttypeid=@$getcompetition_res['competitionDetails']['competitionTypes'][0]['competitionTypeId'];
				$firsttypename=@$getcompetition_res['competitionDetails']['competitionTypes'][0]['competitionTypeName'];
			}
			//getcompetition_res
			$addroundarr['clubId']=$venueId;
			$addroundarr['clubMemberId']=$member_id;
			$addroundarr['competitionId']=$competitionId;
			//if($firstroundid!=''){ $addroundarr['competitionRoundId']=$firstroundid;  }
			if($firsttypeid!=''){ $addroundarr['competitionTypeId']=$firsttypeid;  }
			if($firstdivisionid!=''){ $addroundarr['competitionDivisionId']=$firstdivisionid;  }
			
			$getroundreq = CallAPI("POST", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competition/results",$addroundarr);
		    $getcompetition_res = json_decode($getroundreq, TRUE);
			
			//echo "<pre>";print_r($getcompetition_res);
			
			$akroundarr['clubId']=$venueId;
			$akroundarr['clubMemberId']=$member_id;
			$akroundarr['competitionId']=$competitionId;
			$getroundreq1 = CallAPI("POST", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competition/results",$akroundarr);
		    $getcompetition_resdate = json_decode($getroundreq1, TRUE);
			
			//echo "<pre>";print_r($getcompetition_resdate);
			
			$countrounds=count($getcompetitionrounds);
			
			
			/*uksort($getcomptmonthsarr, function($a1, $a2) {
				$time1 = strtotime($a1);
				$time2 = strtotime($a2);
				return $time1 - $time2;
			});*/
			
			$result_page_link=$get_newportal_url."?action=member_single_result&compid=$competitionId&rid=$roundid&rtype=results";
			$prizes_page_link=$get_newportal_url."?action=member_single_result&compid=$competitionId&rid=$roundid&rtype=prizes";
			
			
			$getcompetitionprizereq = CallAPI("GET", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/prizes?competitionId=$competitionId");
		    $getcompetitionprizes = json_decode($getcompetitionprizereq, TRUE);
			
			//echo "<pre>";print_r($getcompetition_res);
			?>
			     <!-- Accont table -->
			<section class="new_member_login_portal member_newportal_details  member_mprofilr_accounts" id="member_results_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>Competition - <?php echo $competionname; ?></h2>
						</div>
					</div>
					<div class="member_details_section">
						<div class="main_div">
							<div class="col col-fullwidth">
							    <div class="competitions_featuresbtns_form">
								    <span class="competitions_bts_cont">
									    <a href="<?php echo $result_page_link; ?>" class="compt_results_btn <?php if(@$_REQUEST['rtype']=='prizes'){ echo 'active_res_btn';  } ?>"><i class="fa fa-list" aria-hidden="true"></i>Results</a> | 
										<a href="<?php echo $prizes_page_link; ?>" class="compt_prizes_btn <?php if(@$_REQUEST['rtype']!='prizes'){ echo 'active_res_btn';  } ?>"><i class="fa fa-trophy" aria-hidden="true"></i>Prizes</a>
									</span>
								</div>
								
								<?php 
								if(isset($_REQUEST['rtype']) && $_REQUEST['rtype']=='prizes')
								{
									$prizesreq = CallAPI("GET",$BaseAPIurl."teebooking/clubs/$venueId/members/$member_id/prizes?competitionId=".$competitionId, false);
									$get_prize_data = json_decode($prizesreq, TRUE);
									
									$prize_templates=array();
									$get_prizesarr=array();
									$get_prize_templates=array();
									if(!empty($get_prize_data))
									{
										if(isset($get_prize_data['prizeItem']) && !empty($get_prize_data['prizeItem']))
										{
											$get_prizes_finalarr=$get_prize_data['prizeItem'];
											$get_prizesarr=$get_prizes_finalarr;
										}
										
										if(isset($get_prize_data['competitionDetails']) && !empty($get_prize_data['competitionDetails']))
										{
											if(isset($get_prize_data['competitionDetails']['competitionPrizeTemplate']))
											{
												$get_prize_templates=$get_prize_data['competitionDetails']['competitionPrizeTemplate'];
											}
										}
									}
									//echo "<pre>";print_r($get_prize_data);
								?>	
								<div id="competitions_prizesearch_form" class="competitions_search_form">
									<input type="hidden" name="show_competion_resultval" value="<?php echo $competitionId; ?>" id="show_competion_resultval" />
									<div class="compt_form_fields">
										<label> View Prize Report:</label>
										<select name="showing_prize_types" id="showing_prize_types" data-competitionid="<?php echo $competitionId; ?>">
											<?php 
												if(!empty($get_prize_templates))
												{
													foreach($get_prize_templates as $single_template)
													{
														if(isset($single_template['rsPrizeTemplateUID']))
													    {
															$template_id=$single_template['rsPrizeTemplateUID'];
															$template_name=$single_template['name'];
															?>
															<option value="<?php echo $template_id; ?>"><?php echo $template_name; ?></option>
															<?php
													    }
													}
												}
											?>
										</select>
										<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
									</div>
									
									<div class="compt_form_fields datepicker_input_ct" >
										<img id="showresultloader" src="<?php echo get_template_directory_uri();?>/img/member_proimg_loader.gif" style="display:none;"  />
									</div>
									
									<div class="allevents_competitions_listing member_mprofilr_accounts" id="result_ajaxloading_data">
										<div class="responsive-table">
											<table class="account-balance-table" id="show_single_competition_result">
												<thead>
													<tr>
														<th>Prize Type</th>
														<th>Mem No</th>
														<th>Gender</th>
														<th>Name</th>
														<th>GA Hdcp (Dly)</th>
														<th>Rnd#</th>
														<th>Total</th>
														<th>Prize</th>
													</tr>
												</thead>
												<tbody>
													<?php
														if(!empty($get_prizesarr))
														{
															foreach($get_prizesarr as $single_prize_data)
															{
																if(isset($single_prize_data['prizeType']))
													            {
																	$prizeType=$single_prize_data['prizeType'];
																	$memnumber=$single_prize_data['displayCode'];
																	$gender=$single_prize_data['gender'];
																	$displayName=$single_prize_data['displayName'];
																	$asAtRoundNo=$single_prize_data['asAtRoundNo'];
																	$prize=$single_prize_data['prize'];
																	$prizeQty=$single_prize_data['prizeQty'];
																	$total=$single_prize_data['total'];
																	$handicapIndex=$single_prize_data['handicapIndex'];
																	
																	$prize_full_name=$prizeQty.' x '.$prize;
																	
																	//echo "<pre>";print_r($single_prize_data);
																	
																	if($asAtRoundNo=='')
																	{
																		$showroundtext="Unallocated ($asAtRoundNo)";
																	}else{
																		$showroundtext=$asAtRoundNo;
																	}
																	
																	if($total=='')
																	{
																		$showtitle=0;
																	}else{
																		$showtitle=$total;
																	}
																	?>
																	<tr>
																		<td><?php echo $prizeType; ?></td>
																		<td><?php echo $memnumber; ?></td>
																		<td><?php echo $gender; ?></td>
																		<td><?php echo $displayName; ?></td>
																		<td><?php echo $handicapIndex; ?></td>
																		<td><?php echo $showroundtext; ?></td>
																		<td><?php echo $showtitle; ?></td>
																		<td><?php echo $prize_full_name; ?></td>
																	</tr>
																	<?php
																}
															}
														}else{
															?>
															<tr><td colspan="8">No results found.</td></tr>
															<?php
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
									
								</div>
								<?php }else{ ?>
							    <div id="competitions_ressearch_form"  class="competitions_search_form">
								        <input type="hidden" name="show_competion_resultval" value="<?php echo $competitionId; ?>" id="show_competion_resultval" />
										<div class="compt_form_fields">
											<label>Type:</label>
											<select name="showing_types" id="showing_result_types">
											    <?php 
												    if(!empty($getcompetitiontypes))
													{
														foreach($getcompetitiontypes as $comptype)
														{
															if(isset($comptype['competitionTypeId']))
													        {
																$typeid=$comptype['competitionTypeId'];
																$types_name=$comptype['competitionTypeName'];
																?>
																<option value="<?php echo $typeid; ?>"><?php echo $types_name; ?></option>
																<?php
														    }
														}
													}else{
														?>
														<option value="">All Types</option>
														<?php
													}
												?>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
										</div>
										<div class="compt_form_fields datepicker_input_ct" style="<?php if($isdateshow=='no'){ ?>display:none;<?php } ?>">
											<label>Round:</label>
											<select name="showing_rounds" id="showing_result_rounds">
												<?php 
												   
												    if(!empty($getcompetitionrounds))
													{
														if($countrounds>1)
														{
															?>
															<option value="best_rounds">Best Rounds</option>
															<?php
														}
														foreach($getcompetitionrounds as $compround)
														{
															if(isset($compround['competitionRoundId']))
													        {
																$roundid=$compround['competitionRoundId'];
																$round_name=$compround['name'];
																$round_date=$compround['roundDate'];
																$rounddate=date("d M Y",strtotime($round_date));
																?>
																<option value="<?php echo $roundid; ?>"><?php echo $rounddate.' - '.$round_name; ?></option>
																<?php
															}
														}
													}else{
														?>
														<option value="">All Rounds</option>
														<?php
													}
												?>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
										</div>
										<div class="compt_form_fields datepicker_input_ct" style="<?php if($isdateshow=='no'){ ?>display:none;<?php } ?>">
											<label>Division:</label>
											<select name="showing_division" id="showing_results_division">
											    <?php 
												    if(!empty($getcompetitiondivisions))
													{
														?>
														<option value="">All Divisions</option>
														<?php
														foreach($getcompetitiondivisions as $compdivision)
														{
															if(isset($compdivision['divisionId']))
													        {
																$divisionId=$compdivision['divisionId'];
																$divisionName=$compdivision['divisionName'];
																$handicapFrom=number_format($compdivision['handicapFrom'],1);
																$handicapTo=number_format($compdivision['handicapTo'],1);
																//$round_name=$compround['name'];
																//$round_date=$compround['roundDate'];
																//$rounddate=date("d M Y",strtotime($round_date));
																?>
																<option value="<?php echo $divisionId; ?>">(<?php echo $handicapFrom.' to '.$handicapTo; ?>) <?php echo $divisionName; ?></option>
																<?php
															}
														}
													}else{
														?>
														<option value="">All Divisions</option>
														<?php
													}
												?>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
										</div>
										<div class="compt_form_fields datepicker_input_ct" >
											<img id="showresultloader" src="<?php echo get_template_directory_uri();?>/img/member_proimg_loader.gif" style="display:none;"  />
										</div>
								</div>
								
								<div class="allevents_competitions_listing member_mprofilr_accounts" id="result_ajaxloading_data">
									<div class="responsive-table">
									    <?php
											if($countrounds>5)
											{
												$setcounter=5;
											}else{
												$setcounter=$countrounds;
											}
											if($countrounds>1)
											{
										?>
										<div class="showing_rounds_info">Best <?php echo $setcounter; ?> of <?php echo $countrounds; ?> rounds</div>
										<?php } ?>
										<table class="account-balance-table" id="show_single_competition_result">
											<thead>
												<tr>
													<th>Position</th>
													<th>Name</th>
													<th>GA Hdcp (Dly)</th>
													<th>Home club</th>
													<?php
														if($countrounds>1)
														{
															$p=1;
															for($s=0;$s<$setcounter;$s++)
															{
																?>
																<th><?php echo $p; ?></th>
																<?php
																$p++;
															}
															echo '<th>Total</th>';
														}elseif($countrounds==1){
															?>
															<th>Round 1 <?php echo $firsttypename; ?></th>
															<?php
														}
													?>
												</tr>
											</thead>
											<tbody>
												<?php
												    //echo "asdasdasd";
													
													if(!empty($getcompetition_res))
													{
														$getcompresults=$getcompetition_res['resultItem'];
														
														//echo "<pre>";print_r($getcompresults);
														
														if(!empty($getcompresults))
														{
															foreach($getcompresults as $single_comp)
															{
																//echo "<pre>";print_r($single_comp);
																
																if(isset($single_comp['competitionId']))
													            {
																	$competitionId=$single_comp['competitionId'];
																}
																	$positionid=$single_comp['pos'];
																	$displayName=$single_comp['displayName'];
																	$homeClubName=$single_comp['homeClubName'];
																	$handicapIndex=$single_comp['handicapIndex'];
																	$dailyHandicap=$single_comp['dailyHandicap'];
																	
																	$gettotal=$single_comp['total'];
																	
																	$roundScores=$single_comp['roundScores'];
																	
																	
																	if($countrounds>5)
																	{
																		$setcounter=5;
																	}else{
																		$setcounter=$countrounds;
																	}
																	?>
																	<tr>
																		<td><?php echo $positionid; ?></td>
																		<td><?php echo $displayName; ?></td>
																		<td><?php echo $handicapIndex.' ('.$dailyHandicap.')'; ?></td>
																		<td><?php echo $homeClubName; ?></td>
																		<?php
																			if($countrounds>1)
																			{
																				for($s=0;$s<$setcounter;$s++)
																				{
																					$roundvalarr='';
																					if(isset($roundScores[$s]))
																					{
																						$roundvalarr=$roundScores[$s];
																						$roundscore=$roundvalarr['roundScore'];
																					}else{
																						$roundscore='-';
																					}	
																					?>
																					<td><?php echo $roundscore; ?></td>
																					<?php
																				}
																				echo '<th>'.$gettotal.'</th>';
																				
																			}elseif($countrounds==1){
																				if(isset($roundScores[0]))
																				{
																					$roundval=$roundScores[0];
																					$roundscore2=$roundval['roundScore'];
																				}
																				?>
																				<th><?php echo $roundscore2; ?></th>
																				<?php
																			}
																		?>
																	</tr>
																	<?php
															    
															}
														}else{
															?>
															<tr><td colspan="4">No results found.</td></tr>
															<?php
														}
													}else{
														?>
														<tr><td colspan="4">No results found.</td></tr>
														<?php
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
										
								<?php } ?>		
										
							</div>
						</div>
				    </div>
				</div>
			</section>
			<!-- end --> 
			<?php
		}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='member_results')
		{
		    $currentdate=date("Y-m-d");
			if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='sel_date')
			{
				$startdate=$_REQUEST['date_between'];
				$startdate=str_replace("/","-",$startdate);
				$startdate=date("Y-m-d",strtotime($startdate));
				$enddate=$_REQUEST['date_final_end'];
				$enddate=str_replace("/","-",$enddate);
				$enddate=date("Y-m-d",strtotime($enddate));
				$isdateshow="yes";
				
			}elseif(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='next_3mon')
			{
				/*Get data by last 3 months*/
				$startdate=date("Y-m-d");
				$enddate=date("Y-m-d",strtotime("+3 months"));
				
				$isdateshow="no";
				
			}elseif(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='last_year')
			{
				/*Get data by last 3 months*/
				$currentyearenddate=date('Y-m-d');
				$oneyearearlier=date("Y-m-d",strtotime("-1 year"));
				
				$startdate=$oneyearearlier;
				$enddate=$currentyearenddate;
				
				$isdateshow="no";
			}else{
				/*Get data by last 3 months*/
				$currentmonthstartdate=date('Y-m-d');
				$threemonthsearlier=date("Y-m-d",strtotime($currentmonthstartdate." -3 months"));
				
				$startdate=$threemonthsearlier;
				$enddate=$currentmonthstartdate;
				
				$isdateshow="no";
			}
			
		
			$getcompetitionreq = CallAPI("GET", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competitions?fromDate=$startdate&toDate=$enddate", false);
			
			//$getcompetitionreq = CallAPI("GET", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competitions?fromDate=2017-09-25&toDate=2017-03-01", false);
			
			$getcompetition_res = json_decode($getcompetitionreq, TRUE);
			
			//echo "<pre>";print_r($getcompetition_res);
			
			$getcomptmonthsarr=array();
			if(!empty($getcompetition_res))
			{
				foreach($getcompetition_res as $singlecomptition)
				{
					if(isset($singlecomptition['roundDate']))
					{
						$round_date=$singlecomptition['roundDate'];
						$getmonthdata=date("m-Y",strtotime($round_date));
						
						$getcomptmonthsarr[$getmonthdata][]=$singlecomptition;
					}
				}
			}
			//echo "<pre>";print_r($getcomptmonthsarr);
			
			uksort($getcomptmonthsarr, function($a1, $a2) {
				$time1 = strtotime($a1);
				$time2 = strtotime($a2);
				return $time1 - $time2;
			});
			
			//echo "<pre>";print_r($getcompetition_res);
			
		   ?>
		    <!-- Accont table -->
			<section class="new_member_login_portal member_newportal_details  member_mprofilr_accounts" id="member_results_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>Results</h2>
						</div>
					</div>
					<div class="member_details_section">
						<div class="main_div">
							<div class="col col-fullwidth">
							    <div class="competitions_search_form">
								    <form action="<?php echo $get_newportal_url; ?>?action=member_results" id="caompetition_search_frm" method="post">
										<div class="compt_form_fields full_width">
											<label>Showing:</label>
											<select name="showing_events" id="showing_events_type">
											    <option value="last_3mon" <?php if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='last_3mon'){ echo 'selected="selected"'; } ?> >Within last 3 months</option>
												<option value="last_year" <?php if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='last_year'){ echo 'selected="selected"'; } ?> >Within last year</option>
												<option value="sel_date" <?php if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='sel_date'){ echo 'selected="selected"'; } ?>>Within selected dates</option>
												<option value="next_3mon" <?php if(isset($_REQUEST['showing_events']) && $_REQUEST['showing_events']=='next_3mon'){ echo 'selected="selected"'; } ?>>All upcoming events in 3 months</option>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
										</div>
										<div class="compt_form_fields datepicker_input_ct" style="<?php if($isdateshow=='no'){ ?>display:none;<?php } ?>">
											<label>Between:</label>
											<input type="text" name="date_between" value="<?php if(isset($_REQUEST['date_between'])){ echo $_REQUEST['date_between']; } ?>" id="date_between_unq" class="compt_input_fields" />
											<img id="show_start_date_img" class="show_date_icons" src="<?php echo get_template_directory_uri(); ?>/img/calendar-icon_input.png" />
										</div>
										<div class="compt_form_fields datepicker_input_ct" style="<?php if($isdateshow=='no'){ ?>display:none;<?php } ?>">
											<label>And:</label>
											<input type="text" name="date_final_end" value="<?php if(isset($_REQUEST['date_final_end'])){ echo $_REQUEST['date_final_end']; } ?>" id="date_final_unq" class="compt_input_fields" />
											<img id="show_end_date_img"  class="show_date_icons" src="<?php echo get_template_directory_uri(); ?>/img/calendar-icon_input.png" />
										</div>
										<div class="compt_form_fields">
										    <span class="show_req_date_err" style="display:none;"></span>
											<input type="submit" name="search_compitition_records" id="search_compitition" value="GO" />
										</div>
									</form>
								</div>
								
								<div class="allevents_competitions_listing member_mprofilr_accounts">
									<div class="responsive-table">
										<table id="show_competition_result" class="account-balance-table table table-striped table-bordered" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>Competition/Event</th>
													<th>Date</th>
													<th>Round</th>
													<th><img class="member_gender_icons" src="<?php echo get_template_directory_uri(); ?>/img/com_user.png" /></th>
													<th><img class="holes_vals_num" src="<?php echo get_template_directory_uri(); ?>/img/18hole_sm.png" /></th>
													
												</tr>
											</thead>
											<tbody>
												<?php
													if(!empty($getcomptmonthsarr))
													{
														if(@$_REQUEST['showing_events']!='last_year')
			                                            {
															//krsort($getcomptmonthsarr);
														}
														
														foreach($getcomptmonthsarr as $k=>$compmonthdataarr)
														{
														    $getmonthval=date("F Y",strtotime('01-'.$k));
															
															?>
															<tr class="monthnamevals_td">
															    <td align="left">
																    <strong class="compt_monthshow_cls"><?php echo $getmonthval; ?></strong>
																</td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
															<?php
															
															krsort($compmonthdataarr);
															
															//echo "<pre>";print_r($compmonthdataarr);
															
															if(!empty($compmonthdataarr))
															{
																foreach($compmonthdataarr as $single_comp)
																{
																	if(isset($single_comp['competitionId']))
																	{
																		//echo "<pre>";print_r($single_comp);
																		$competitionId=$single_comp['competitionId'];
																		$competitionRoundId=$single_comp['competitionRoundId'];
																		$isNineHole=$single_comp['isNineHole'];
																		$getround_no=$single_comp['roundNo'];
																		$gender=$single_comp['gender'];
																		$roundDate=$single_comp['roundDate'];
																		//$eventstartdate=date("D M d, Y",strtotime($roundDate));
																		$eventstartdate=date("d/m/Y",strtotime($roundDate));
																		
																		if($getround_no>1)
																		{
																			$visibility='M';
																		}else{ $visibility='V'; }
																		$compname=$single_comp['name'];
																		$competitionTypes=$single_comp['competitionTypes'];
																		
																		if($gender=='Male'){ $gender_img='user_male.png'; }elseif($gender=='Female'){ $gender_img='user_female.png'; }else{ $gender_img='com_user.png'; } 
																		
																		if($isNineHole==1){ $scoreimg='9hole_sm.png'; }else{ $scoreimg='18hole_sm.png'; }
																		
																		
																		?>
																		<tr>
																			<td><a class="member_single_res_linl" href="<?php echo $get_newportal_url; ?>?action=member_single_result&compid=<?php echo $competitionId; ?>&rid=<?php echo $competitionRoundId; ?>"><?php echo $compname; ?></a></td>
																			<td><?php echo $eventstartdate; ?></td>
																			<td><?php echo $getround_no; ?></td>
																			<td><img class="member_gender_icons" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $gender_img; ?>" /></td>
																			<td><img class="holes_vals_num" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $scoreimg; ?>" /></td>
																			
																		</tr>
																		<?php
																	}
																}
															}
														}
														
													}else{
														
														?>
														
														<?php
													}
												?>
												
											</tbody>
											<tfoot>
												<tr>
													<th>Competition/Event</th>
													<th>Date</th>
													<th>Round</th>
													<th><img class="member_gender_icons" src="<?php echo get_template_directory_uri(); ?>/img/com_user.png" /></th>
													<th><img class="holes_vals_num" src="<?php echo get_template_directory_uri(); ?>/img/18hole_sm.png" /></th>
													
												</tr>
											</tfoot>
										</table>
										<div class="member_portal_pagination">
										    
										</div>
									</div>
								</div>
										
							</div>
						</div>
				    </div>
				</div>
			</section>
			<!-- end --> 
		   <?php
	    }elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='securepayment')
		{
			//echo "<pre>";print_r($_REQUEST);
            $settdate=$_REQUEST['settdate'];
            $suramount=$_REQUEST['suramount'];
            $expirydate=$_REQUEST['expirydate'];
            $amount=$_REQUEST['amount'];
            $restext=$_REQUEST['restext'];
            $baseamount=$_REQUEST['baseamount'];
            $rescode=$_REQUEST['rescode'];
            $surfee=$_REQUEST['surfee'];
            $pan=$_REQUEST['pan']; //cardhalfnumber
            $cardtype=$_REQUEST['cardtype'];
            $summarycode=$_REQUEST['summarycode'];
            $txnid=$_REQUEST['txnid'];
            $timestamp=$_REQUEST['timestamp'];
            $refid=$_REQUEST['refid'];
			
            $foreignAccountId=$_REQUEST['ac_id'];
			
			$getfinalamount=$amount/100;
			$getfinalamount=number_format($getfinalamount,2);
			$mytime=date("c",strtotime($timestamp));
			$payment_receipt_arr=array();
			//$payment_receipt_arr['id']=1490;
			$payment_receipt_arr['clubId']=$venueId;
			$payment_receipt_arr['clubMemberId']=$member_id;
			$payment_receipt_arr['receiptDate']=$mytime;
			$payment_receipt_arr['description']="THANKS";
			$payment_receipt_arr['referenceNumber']=$refid;
			$payment_receipt_arr['currency']="AUD";
			$payment_receipt_arr['creditCardName']="";
			$payment_receipt_arr['creditCardCharge']=$getfinalamount;

			//$payment_receipt_arr['accountPayments'][0]['id']=1515;
			$payment_receipt_arr['accountPayments'][0]['foreignAccountId']=$foreignAccountId;
			$payment_receipt_arr['accountPayments'][0]['amount']=$getfinalamount;
			
            //echo "<pre>";print_r($payment_receipt_arr);	
			
			$addpaymentreceipt = CallAPI("POST", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/paymentreceipt", $payment_receipt_arr);
			$paymentreceipt_resp = json_decode($addpaymentreceipt, TRUE);

			//$resubmitpaymentreceipt = CallAPI("PUT", $BaseAPIurl . "data/clubs/$venueId/paymentreceipt/resubmit", $payment_receipt_arr);
			///$resubmipaymentreceipt_resp = json_decode($resubmitpaymentreceipt, TRUE);
            //echo "<pre>";print_r($resubmipaymentreceipt_resp);	
			
			
            //$maunalupdatepaymentreceipt = CallAPI("PUT", $BaseAPIurl . "data/clubs/$venueId/paymentreceipt/manualpay", $payment_receipt_arr);
			//$manpaymentreceipt_resp = json_decode($maunalupdatepaymentreceipt, TRUE);

            //echo "<pre>";print_r($manpaymentreceipt_resp);				

            //$getpaymentreceipts = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/pendingreceipts", false);
			//$getpaymentdata = json_decode($getpaymentreceipts, TRUE);

            //echo "<pre>";print_r($getpaymentdata);

			$adminfrom="info@example.com";
			$customerto="admin@collectiveloop.com";
			$customersubject="BGC Member Portal - Payment Notification";
			$getemailhtml='<b>Hi,</b> <br/><br/>';
			$getemailhtml.='<b>Please review your payment details:</b> <br/><br/>';
			$getemailhtml.='<b>Club ID:</b> '.$venueId.' <br/>';
			$getemailhtml.='<b>Member ID:</b> '.$member_id.' <br/>';
			$getemailhtml.='<b>Reference Number/ID:</b> '.$refid.' <br/>';
			$getemailhtml.='<b>Transaction ID:</b> '.$txnid.' <br/>';
			$getemailhtml.='<b>Amount:</b> $'.$getfinalamount.' <br/>';
			$getemailhtml.='<b>ReceiptDate:</b> '.$mytime.' <br/>';
			
            $headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: Brighton Golf Club <'.$adminfrom.'>'. "\r\n";
			//mail($customerto,$customersubject,$getemailhtml,$headers);	
			
			$responseval='';
			foreach($_REQUEST as $k=>$value)
			{
				$responseval.='<b>'.$k.'</b> '.$value.'<br/>';
			}
			
			mail("ashishkul555@gmail.com,impala.anju@gmail.com",$customersubject,$getemailhtml,$headers);			
			mail("impala.anju@gmail.com","Securepay live response",$responseval,$headers);			

			if(empty($paymentreceipt_resp))
			{
				header('location:'.$get_newportal_url.'?action=member_accounts');
			}
 	
	    }elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='proceed_payment')
		{
			//current_ac_id//accont_amount//current_ac_id//current_ac_name
			
			$current_ac_id=$_REQUEST['current_ac_id'];
			$accont_amount=$_REQUEST['accont_amount'];
			$current_ac_name=$_REQUEST['current_ac_name'];
			
			/*Calculate field vals*/
			
			$merchantid="2ZO0017";
			//$merchantid="ABC0010";
			$txnpassword="6z5PwFgl";
			//$txnpassword="abc123";
			$txn_type=0;
			$amount=$_REQUEST['accont_amount'];
			$amount=$amount*100;
			$primary_ref=mt_rand(0000000000000000,9999999999999999);
			$fp_timestamp=date("YmdHis");

			$fingerprint_raw=$merchantid.'|'.$txnpassword.'|'.$txn_type.'|'.$primary_ref.'|'.$amount.'|'.$fp_timestamp;

			$fingerprint=sha1($fingerprint_raw);
			?>
			<section class="new_member_login_portal member_newportal_details" id="member_profile_payform_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>SecurePay</h2>
						</div>
					</div>
					<div class="member_details_section">
					    <div class="main_div">
							<div class="identification">
							    <!---https://payment.securepay.com.au/test/v2/invoice-->
								
							    <form action="https://payment.securepay.com.au/live/v2/invoice" method="post">
									<input type="hidden" name="bill_name" value="transact">
									<input type="hidden" name="merchant_id" value="<?php echo $merchantid; ?>">
									<input type="hidden" name="txn_type" value="<?php echo $txn_type; ?>">
									<input type="hidden" name="primary_ref" value="<?php echo $primary_ref; ?>">
									<input type="hidden" name="amount" value="<?php echo $amount; ?>">
									<input type="hidden" name="fp_timestamp" value="<?php echo $fp_timestamp; ?>">
									<input type="hidden" name="fingerprint" value="<?php echo $fingerprint; ?>">
									
									<input id="card_types" name="card_types" value="VISA|MASTERCARD" type="hidden">
									<input id="currency" name="currency" value="AUD" type="hidden">
									
									<input id="callback_url" name="callback_url" value="https://mpsapi.micropower.com.au/v1/data/clubs/<?php echo $venueId; ?>/members/<?php echo $member_id; ?>/securepay/<?php echo $current_ac_id; ?>" type="hidden" >
									<!--<input id="callback_url" name="callback_url" value="<?php echo $get_newportal_url; ?>?action=securepayment&ac_id=<?php echo $current_ac_id; ?>" type="hidden">-->
									
									<input id="return_url" name="return_url" value="<?php echo $get_newportal_url; ?>?action=securepayment&ac_id=<?php echo $current_ac_id; ?>" type="hidden">
									<input id="return_url_text" name="return_url_text" value="Return to Accounts" type="hidden">
									<input id="return_url_target" name="return_url_target" value="self" type="hidden">
									<input id="cancel_url" name="cancel_url" value="<?php echo $get_newportal_url; ?>?action=member_accounts" type="hidden">
									<input id="cancel_url_text" name="cancel_url_text" value="Cancel Payment" type="hidden">
									<input id="cancel_url_target" name="cancel_url_target" value="self" type="hidden">

									<input id="page_title" name="page_title" value="<?php echo $current_ac_name; ?> Invoice Payment" type="hidden">
									<input id="primary_ref_name" name="primary_ref_name" value="" type="hidden">
									<input id="template" name="template" value="" type="hidden">
									<input id="dispaly_receipt" name="dispaly_receipt" value="yes" type="hidden">
									<input id="page_style_url" name="page_style_url" value="" type="hidden">

									<input id="surcharge" name="surcharge" value="no" type="hidden">
									
									<main id="content">
										<div class="row">
											<div class="col col-1-2 left">
											    <div class="one_identy">
													<div class="address full_width_field">
														<label for=""><?php echo $current_ac_name; ?></label>
														<input disabled="disabled" id="displayAmount" name="displayAmount" value="<?php echo $accont_amount; ?>" type="text">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="left_aliged_btn">
												<button type="submit" class="button">Make Payment</button>
											</div>
											<div class="right_aligned_links">
												<a class="button" href="<?php echo $get_newportal_url; ?>/?action=member_accounts">Return to accounts</a>
											</div>
										</div>
										<img src="<?php echo get_template_directory_uri(); ?>/img/securepay_logo_RGB.png" alt="Powered by SecurePay Payment Solutions" class="max-width-container" border="0">
									</main>
								</form>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<?php
			
		}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='payment')
		{
	        $getaccount_id=$_REQUEST['acid'];
			$accountname=urldecode($_REQUEST['ac_name']);
			
			//$activityResponse = CallAPI("GET",$BaseAPIurl."data/clubs/$venueId/members/$member_id/accounts/$getaccount_id/activity", false);
           // $singleaccounts_activity = json_decode($activityResponse, TRUE);
			
			$activityResponse = CallAPI("GET",$BaseAPIurl."data/clubs/$venueId/members/$member_id/accounts/$getaccount_id", false);
            $singleaccounts_activity = json_decode($activityResponse, TRUE);
			
			//echo "<pre>";print_r($singleaccounts_activity);
			
			//balanceCurrent
			
			/*$gettotal_bal=0;
			if(!empty($singleaccounts_activity))
			{
				foreach($singleaccounts_activity as $singleactivity)
				{
					$acval_balance=number_format($singleactivity['balance'],2);
					$gettotal_bal+=$acval_balance;
				}
			}*/
			
			$gettotal_bal=$singleaccounts_activity['total'];
			
			$getfinalbal=number_format($gettotal_bal,2);
			
			?>
			<section class="new_member_login_portal member_newportal_details" id="member_profile_payform_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>Payment (<?php echo $accountname; ?>)</h2>
						</div>
					</div>
					<div class="member_details_section">
					    <div class="main_div">
							<div class="identification">
							    <form action="<?php echo $get_newportal_url; ?>" method="POST" name="profile_payment_form" id="profile_payment_form_unq">
									<div class="one_identy">
									    <div class="address full_width_field">
											<label>Balance:</label>
											<input type="hidden" name="current_ac_id" value="<?php echo @$getaccount_id; ?>"/>
											<input type="hidden" name="current_ac_name" value="<?php echo @$accountname; ?>"/>
											<input type="text" disabled name="current_balance" value="<?php echo @$getfinalbal; ?>"/>
									    </div>
									    <div class="address full_width_field">
											<label>Amount:</label>
											<input type="text" name="accont_amount" id="accont_amount_unq" />
											<span class="profileamt_err_cls" id="ac_amount_err" style="display:none;"></span>
									    </div>
									    <div class="save_changes">
										    <input type="hidden" name="action" value="proceed_payment"/>
										    <input class="button paywithsecurepay_cls" name="pay_with_securepay" value="Pay with SecurePay" type="submit">
											<span class="paysecure_response success" id="paywith_req_response" style="display:none;"></span>
											
											<a class="button" href="<?php echo $get_newportal_url; ?>/?action=member_accounts">Return to accounts</a>
									    </div>
									</div>
							    </form>
							</div>
						</div>
						
						<div class="member_search_loader_ct" style="display:none;">
							<img class="member_search_unqloader" src="<?php echo get_template_directory_uri(); ?>/img/member_search_loader.gif"  />
						</div>
						
					</div>
				</div>
			</section>
			<?php
			
	    }elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='account_activity')
		{
			$getaccount_id=$_REQUEST['acid'];
			$activityResponse = CallAPI("GET",$BaseAPIurl."data/clubs/$venueId/members/$member_id/accounts/$getaccount_id/activity", false);
            $singleaccounts_activity = json_decode($activityResponse, TRUE);
			
			$accountname=urldecode($_REQUEST['ac_name']);
			$acost=urldecode($_REQUEST['acost']);
			
			//$accountssingleResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/accounts/$getaccount_id", false);
           // $accountssingledata = json_decode($accountssingleResponse, TRUE);
			//echo "<pre>";print_r($accountssingledata);
			?>
			<!-- Accont table -->
			<section class="new_member_login_portal member_newportal_details  member_mprofilr_accounts" id="member_ac_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2><?php echo $accountname; ?></h2>
						</div>
					</div>
					<div class="member_details_section">
						<div class="main_div">
							<div class="col col-fullwidth">
							    <?php
								    if(empty($singleaccounts_activity))
									{
										?>
										<div class="account_activity_notify">
											<span>Your latest account details could not be retrieved from the server.</span>
										</div>
										<?php
									}
								?>
							    <div class="responsive-table">
									<table class="account-balance-table">
										<thead>
											<tr>
												<th class="account-name">Date</th>
												<th class="ninety-days">Reference</th>
												<th class="sixty-days">Description</th>
												<th class="thirty-days">Total</th>
												<th class="current">Paid</th>
												<th class="total">Balance</th>
											</tr>
										</thead>
										<tbody>
										    <?php
											    $gettotal_bal=0.00;
											    if(!empty($singleaccounts_activity))
												{
													foreach($singleaccounts_activity as $singleactivity)
													{
														if(isset($singleactivity['reference']))
														{
															$ac_date=$singleactivity['date'];
															$acval_paid=number_format($singleactivity['paid'],2);
															$acval_total=number_format($singleactivity['total'],2);
															$acval_balance=number_format($singleactivity['balance'],2);
															
															$activity_reference=$singleactivity['reference'];
															$activity_desc=$singleactivity['description'];
															$transaction_id=$singleactivity['accountTransactionId'];

															$gettotal_bal+=$acval_balance;
															
															$getactivitydate=date("d/m/Y",strtotime($ac_date));
															?>
															<tr class="body-row">
																<td class=""><?php echo $getactivitydate; ?></td>
																<td class=""><?php echo $activity_reference; ?></td>
																<td class=""><?php echo $activity_desc; ?></td>
																<td class=""><?php echo $acval_total; ?></td>
																<td class=""><?php echo $acval_paid; ?></td>
																<td class=""><?php echo $acval_balance; ?></td>
															</tr>
															<?php
													    }
													}
												}else{
													$gettotal_bal=$acost;
												}
											?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="7"> <strong>Total: <?php $getfinalbal=number_format($gettotal_bal,2);
												    
													if($getfinalbal<0)
													{
														$getfinalbal='-$'.number_format(abs($getfinalbal),2);
													}else{
														$getfinalbal='$'.$getfinalbal;
													}
													echo $getfinalbal;
     
												?> &nbsp;&nbsp; </strong></td>
											</tr>
										</tfoot>
									</table>
							    </div>
								<div class="save_changes other_link_cont">
									<a class="button" href="<?php echo $get_newportal_url; ?>?action=member_accounts">Return to Your Accounts</a>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</section>
			<!-- end --> 
			<?php
		}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='member_accounts')
		{
			$accountsResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/accounts", false);
            $accountsdata = json_decode($accountsResponse, TRUE);
			
			//echo "<pre>";print_r($accountsdata);
			
			
			?>
			<!-- Accont table -->
			<section class="new_member_login_portal member_newportal_details  member_mprofilr_accounts" id="member_ac_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>Your Accounts</h2>
						</div>
					</div>
					<div class="member_details_section">
						<div class="main_div">
							<div class="col col-fullwidth">
							    <div class="responsive-table">
									<table class="account-balance-table">
										<thead>
											<tr>
												<th class="account-name">Account Name</th>
												<th class="ninety-days">90+ Days</th>
												<th class="sixty-days">60 Days</th>
												<th class="thirty-days">30 Days</th>
												<th class="current">Current</th>
												<th class="total">Total</th>
												<th class="payment-button"></th>
											</tr>
										</thead>
										<tbody>
										    <?php
											    $gettotal_val=0.00;
											    if(!empty($accountsdata))
												{
													foreach($accountsdata as $singleaccount)
													{
														if(isset($singleaccount['foreignAccountId']))
														{
														$acval90=number_format($singleaccount['balance90Day'],2);
														$acval60=number_format($singleaccount['balance60Day'],2);
														$acval30=number_format($singleaccount['balance30Day'],2);
														$acval_current=number_format($singleaccount['balanceCurrent'],2);
														$acval_total=number_format($singleaccount['total'],2);
														
														$ac_name=$singleaccount['name'];
														$foreign_acid=$singleaccount['foreignAccountId'];
														
														$gettotal_val+=$acval_total;
														?>
														<tr class="body-row">
															<td class="account-name">
															    <a href="<?php echo $get_newportal_url; ?>?action=account_activity&acid=<?php echo $foreign_acid; ?>&ac_name=<?php echo urlencode($ac_name); ?>&acost=<?php echo $singleaccount['total']; ?>"><?php echo $ac_name; ?></a>
															</td>
															<td class="ninety-days"><?php echo $acval90; ?></td>
															<td class="sixty-days"><?php echo $acval60; ?></td>
															<td class="thirty-days"><?php echo $acval30; ?></td>
															<td class="current"><?php echo $acval_current; ?></td>
															<td class="total"><?php echo $acval_total; ?></td>
															<td class="payment-button">
															    <a class="button" href="<?php echo $get_newportal_url; ?>/?action=payment&acid=<?php echo $foreign_acid; ?>&ac_name=<?php echo urlencode($ac_name); ?>">Make Payment</a>
															</td>
														</tr>
														<?php
														}
													}
												}
											?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="7"><strong> Total: <?php 
													$gettotal_val=number_format($gettotal_val,2); 
													
													if($gettotal_val<0)
													{
														$gettotal_val='-$'.number_format(abs($gettotal_val),2);
													}else{
														$gettotal_val='$'.$gettotal_val;
													}
													echo $gettotal_val;
												
												?> &nbsp;&nbsp; </strong></td>
											</tr>
										</tfoot>
									</table>
							    </div>
							</div>
						</div>
				    </div>
				</div>
			</section>
			<!-- end --> 
			<?php
		}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='change_password')
		{
			?>
			<section class="new_member_login_portal member_newportal_details" id="member_profile_pass_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
						</div>
						<div class="member_profile_heading">
							<h2>Change Password</h2>
						</div>
					</div>
					<div class="member_details_section">
					    <div class="main_div">
							<div class="identification">
							    
								<div class="change_pass_warning">
									<p>Password must be at least 7 characters long and contain at least one capital letter and one number.</p>
								</div>
							    <form action="" method="POST" name="profile_data" id="profile_pass_frm_data">
									<div class="one_identy">
									    <div class="address full_width_field">
											<label>Current password:</label>
											<input type="password" readonly name="current_password" value="<?php echo @$memberinfoarr['WWW_Password']; ?>"/>
									    </div>
									    <div class="address full_width_field">
											<label>New password:</label>
											<input type="password" name="new_password" id="new_password" />
											<span class="profile_err_cls" id="new_password_err" style="display:none;"></span>
									    </div>
									    <div class="address full_width_field">
											<label>Confirm new password:</label>
											<input type="password" name="confirm_new_password" id="confirm_new_password"  />
											<span class="profile_err_cls" id="confirm_password_err" style="display:none;"></span>
									    </div>
									    <div class="save_changes">
										    <input class="button change_password_btn" name="change_password" value="Change Password" type="submit">
											<span class="profile_password_response success" id="profilepass_req_response" style="display:none;"></span>
											
											<a class="button" href="<?php echo $get_newportal_url; ?>/?action=member_profile">My Details</a>
									    </div>
									</div>
							    </form>
							</div>
						</div>
						
						<div class="member_search_loader_ct" style="display:none;">
							<img class="member_search_unqloader" src="<?php echo get_template_directory_uri(); ?>/img/member_search_loader.gif"  />
						</div>
						
					</div>
				</div>
			</section>
			<?php
		}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='member_profile')
		{
			//echo "<pre>";print_r($MemberData);
			
			$settingResponse = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/directory/$member_id/settings", false);
		    $settingdata = json_decode($settingResponse, TRUE);
		    $getsettingfields=$settingdata['fields'];
			
			$membersettingarr=array();
			if(!empty($getsettingfields))
			{
				foreach($getsettingfields as $settingfield)
				{
					$fieldname = $settingfield['name'];
					$membersettingarr[$fieldname]=$settingfield['public'];
				}
			}
		?>
		    <section class="new_member_login_portal member_newportal_details" id="member_profile_directoy">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<?php
					    if($profileimages=='')
						{
							?>
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
							<?php
						}else{
							?>
							<img class="member_proimg" src="<?php echo $profileimages; ?>?ver=<?php echo time(); ?>" />
							<?php
						}
					?>
						</div>
						<div class="member_profile_heading">
							<h2>Change Contact Details</h2>
						</div>
					</div>
					<div class="member_details_section">
					    <div class="main_div">
							<div class="profile_piture">
							    <div class="col-sm-12 right_profile">
									<h2>Profile Picture</h2>
									<div class="picture" id="profile_picture_ct">
									    <?php
										    if($profileimages=='')
											{
												?>
												<img class="profile_picture" src="<?php echo get_template_directory_uri(); ?>/img/Uplodlogo.png">
												<?php
											}else{
												?>
												<img class="profile_picture" src="<?php echo $profileimages; ?>?ver=<?php echo time(); ?>">
												<?php
											}
										?>
										
									</div>
									<div class="buttons">
										<a href="javascript:;" id="remove_member_proimg" class="remove_picture">Remove picture</a>
										<a href="javascript:;" id="change_member_image" class="change_picture">Change picture</a> 
										<a href="<?php echo $get_newportal_url; ?>/?action=change_password" class="change_password">Change Password</a>
									</div>
									<div id="profile_image_loader" style="display:none;">
									    <img src="<?php echo get_template_directory_uri(); ?>/img/member_proimg_loader.gif"   />
									</div>
									<div class="upload_pic_ct">
									    <input type="file" name="upload_picture" id="upload_picture" accept="image/*" />
										<img src="" id="temp_profile_imgurl" style="display:none;" />
										<img src="<?php echo get_template_directory_uri(); ?>/img/Uplodlogo.png" id="temp_default_proimg" style="display:none;" />
									</div>
							    </div>
							</div>
							<div class="identification">
							    <h2>Identification Details</h2>
							    <form action="" method="POST" name="profile_data" id="profile_frm_data">
									<div class="one_identy">
									    <div class="address">
											<label>Address1:</label>
											<input type="text" name="profile_data[Address1]" value="<?php echo $memberinfoarr['Address1']; ?>"/>
									    </div>
									    <div class="address">
											<label>Address2:</label>
											<input type="text" name="profile_data[Address2]" value="<?php echo $memberinfoarr['Address2']; ?>" />
									    </div>
									    <div class="address">
											<label>Address3:</label>
											<input type="text" name="profile_data[address_3]" value="<?php echo $memberinfoarr['Address3']; ?>" />
									    </div>
									    <div class="address">
											<label>Suburb:</label>
											<input type="text" name="profile_data[Suburb]" value="<?php echo $memberinfoarr['Suburb']; ?>" />
									    </div>
									    <div class="address">
											<label>State:</label>
											<input type="text" name="profile_data[State]" value="<?php echo $memberinfoarr['State']; ?>" />
									    </div>
									    <div class="address">
											<label>PostCode:</label>
											<input type="text" name="profile_data[PostCode]" value="<?php echo $memberinfoarr['PostCode']; ?>" />
									    </div>
									</div>
									<div class="Directory">
									    <h2>Directory Details</h2>
									    <div class="detail">
											<label>Phone:</label>
											<input type="text" name="profile_data[Phone]" value="<?php echo $memberinfoarr['Phone']; ?>" />
									    </div>
									    <div class="detail">
											<label>Mobile:</label>
											<input type="text" name="profile_data[Mobile]" value="<?php echo $memberinfoarr['Mobile']; ?>" />
									    </div>
									    <div class="direct_email">
											<label>Email1:</label>
											<input type="text" name="profile_data[Email1]" value="<?php echo strip_tags($memberinfoarr['Email1']); ?>" />
									    </div>
									</div>
									<div class="Direct_Privacy">
									    <h2>Directory Privacy Settings</h2>
									    <p>You can restrict which of your contact details will be visible to other club members who search for you on the <a href="<?php echo $get_newportal_url; ?>?action=member_search">Member Search</a> page. However, contacts details that are disabled fields have been marked as always visible by your club manager. </p>
									    <div class="privacy_direct">
											<label>Phone:</label>
											<select name="privacy_data[Phone]" >
												<option value="1" <?php if(isset($membersettingarr['Phone']) && $membersettingarr['Phone']==1){ echo 'selected="selected"'; } ?> >Visible</option>
												<option value="0" <?php if(isset($membersettingarr['Phone']) && $membersettingarr['Phone']==0){ echo 'selected="selected"'; } ?> >Hidden</option>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
									    </div>
									    <div class="privacy_direct">
											<label>Email1:</label>
											<select name="privacy_data[Email1]" >
											    <option value="1" <?php if(isset($membersettingarr['Email1']) && $membersettingarr['Email1']==1){ echo 'selected="selected"'; } ?>>Visible</option>
											    <option value="0" <?php if(isset($membersettingarr['Email1']) && $membersettingarr['Email1']==0){ echo 'selected="selected"'; } ?>>Hidden</option>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
									    </div>
									    <div class="privacy_direct">
											<label>Mobile:</label>
											<select name="privacy_data[Mobile]">
											  <option value="1" <?php if(isset($membersettingarr['Mobile']) && $membersettingarr['Mobile']==1){ echo 'selected="selected"'; } ?>>Visible</option>
											  <option value="0" <?php if(isset($membersettingarr['Mobile']) && $membersettingarr['Mobile']==0){ echo 'selected="selected"'; } ?> >Hidden</option>
											</select>
											<div class="selct_arrow"><img src="<?php echo get_template_directory_uri();?>/img/down.png"></div>
									    </div>
									</div>
									<div class="Other_Details">
									    <h2>Other Details</h2>
									    <div class="Det_Othr">
											<label>Email2:</label>
											<input type="text" name="profile_data[Email2]" value="<?php echo $memberinfoarr['Email2']; ?>" />
									    </div>
									    <div class="Det_Othr">
											<label>Emergency Name:</label>
											<input type="text" name="profile_data[EmergencyName]" value="<?php echo $memberinfoarr['EmergencyName']; ?>"  />
									    </div>
									    <div class="Dethr">
											<label>Emergency Phone:</label>
											<input type="text" name="profile_data[EmergencyPhone]" value="<?php echo $memberinfoarr['EmergencyPhone']; ?>" />
									    </div>
									    <div class="save_changes">
										    <input class="button submit_profile_changes" name="submit_profile_changes" value="Save all changes" type="submit">
											<span class="profile_updated_response success" id="profile_req_response" style="display:none;"></span>
									    </div>
									</div>
							    </form>
							</div>
						</div>
						
						<div class="member_search_loader_ct" style="display:none;">
							<img class="member_search_unqloader" src="<?php echo get_template_directory_uri(); ?>/img/member_search_loader.gif"  />
						</div>
						
					</div>
				</div>
			</section>
			<!--Member Portal starts here-->
        <?php
		}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='member_search')
		{
			/*Get Member Search Records*/
			$bokkmarkedres = CallAPI("GET", $BaseAPIurl . "data/clubs/$venueId/members/$member_id/favourites/", false);
			$getallbookmarks = json_decode($bokkmarkedres, TRUE);
			
			?>
			<section class="new_member_login_portal member_newportal_details" id="member_msearch_details">
				<div class="bgc_member_portal_nav">
					<?php include("member_top_navi.php"); ?>
				</div>
				<div class="bgc_member_portal_content">
					<div class="member_intro_section">
						<div class="member_profile_img">
							<?php
					    if($profileimages=='')
						{
							?>
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
							<?php
						}else{
							?>
							<img class="member_proimg" src="<?php echo $profileimages; ?>?ver=<?php echo time(); ?>" />
							<?php
						}
					?>
						</div>
						<div class="member_profile_heading">
							<h2>Member Search</h2>
						</div>
					</div>
					<div class="member_details_section">
						
						<ul class="nav nav-tabs">
							<li class="active allmembers_cls"><a data-toggle="tab" href="#all_members">All Members</a></li>
							<li class="bookmarks_cls"><a data-toggle="tab" href="#bookmarked_members">Bookmarked Members</a></li>
						</ul>
                       
						<div class="tab-content">
							<div id="all_members" class="tab-pane fade in active">
								<div class="member_search_resct">
									<div class="member-search-filters_ct">
										<form name="search_bgc_members" method="post" class="search_bgc_members_frm">
											<label for="member-search-input">Search for members:</label>
											<input id="member-search-input" name="member_search_field" type="text" placeholder="Enter member number or name..." class="member_search_inputs">
											<input type="submit" class="button mp-search-button" name="search_members" id="search_members_btn" value="Search Members" />
										</form>
									</div>
									<div class="member_search_results" id="member_search_results_container">
										
									</div>
								</div>
							</div>
							<div id="bookmarked_members" class="tab-pane fade">
								<div class="member_search_results" id="member_bookmarks_list_container">
									<!---Get Bookmarked Members-->
									<?php
									//echo "<pre>";print_r($getallbookmarks);
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
													<img class="member_sprof_img" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
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
																	<input type="text" value="-" readonly="readonly" value="<?php echo $memberphone; ?>">
																</div>
																<div>
																	<label class="ng-binding">Mobile:</label>
																</div>
																<div>
																	<input type="text" value="-" readonly="readonly" value="<?php echo $membermobile; ?>">
																</div>
																<div>
																	<label class="ng-binding">Email1:</label>
																</div>
																<div>
																	<input type="text" value="-" readonly="readonly" value="<?php echo $memberemail1; ?>">
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
									?>
									<!---Get Bookmarked Members-->
								</div>
							</div>
						</div>
						
						<div class="member_search_loader_ct" style="display:none;">
							<img class="member_search_unqloader" src="<?php echo get_template_directory_uri(); ?>/img/member_search_loader.gif"  />
						</div>
						
					</div>
				</div>
			</section>
			<!--Member Portal starts here-->
			<?php
		}else{
	?>
	<section class="new_member_login_portal member_newportal_details" id="member_other_prodetails">
		<div class="bgc_member_portal_nav">
			<?php include("member_top_navi.php"); ?>
		</div>
		<div class="bgc_member_portal_content">
			<div class="member_intro_section">
				<div class="member_profile_img">
				    <?php
					    if($profileimages=='')
						{
							?>
							<img class="member_proimg" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
							<?php
						}else{
							?>
							<img class="member_proimg" src="<?php echo $profileimages; ?>?ver=<?php echo time(); ?>" />
							<?php
						}
					?>
					
				</div>
				<div class="member_profile_heading">
					<h2>Welcome,</h2>
					<h1><?php echo @$memberinfoarr['FullName'] ?></h1>
				</div>
			</div>
			<div class="member_details_section">
				<div class="member_ac_section">
					<a href="#">
						<div>
							<h2>Your Account</h2>
							<p class="name ng-binding"><?php echo @$memberinfoarr['FullName'] ?></p>
							<dl class="member-number">
								<dt class="key">Member No.</dt>
								<dd class="value ng-binding"><?php echo @$memberinfoarr['MemberNo'] ?></dd>
							</dl>
						</div>
					</a>
				</div>
				<div class="member_search_section">
					<a href="<?php echo $get_newportal_url; ?>/?action=member_search">
						<div>
							<img width="80px;" src="https://www.kitsunemusicacademy.com/wp-content/uploads/avatars/1/57e809f130ece-bpthumb.jpg" />
							<h2>Member Search</h2>
						</div>
					</a>
				</div>
				<div class="member_hand_section">
					<h2>My Handicap</h2>
					<a class="button my-handicap-button" href="https://www.golflink.com.au/handicap-history/?golflink_No=<?php echo $getgolflinkno; ?>" target="_blank">Lookup Handicap</a>
				</div>
			</div>
		</div>
	</section>
	<!--Member Portal starts here-->
	<?php  } ?>
	
	
<?php }elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='reset_password'){

if($logo_url!='')
{
	?>
	<img src="<?php echo $logo_url; ?>?ver=<?php echo time(); ?>" class="member_portal_dis_logo" />
	<?php
} ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<section class="new_member_login_portal" id="contact_us_area_member">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="new_member_login_form contact_us">
					<!--Form container starts from here-->
					<div class="bgc_membership_form_container reset_pass_rep_cont">
					    <h2>Reset Password</h2>	
						<div class="screen-reader-response"></div>
						<form action="" method="post" class="bgc_memberlogin_form bgc_member_resetpass_formdata" id="bgc_memberlogin_formdata" >
							<div class="text-center memberlogin_form_controls">
								<p>
									<label>Please enter your Member Number: <span class="error">*</span></label>
									<br/>
									<span class="form_fields_spcontainer">
										<input name="member_login" size="40" id="resetpass_member_login" class="bgc_form_controls required" type="text">
										<label id="member_login_error" class="error reset_pass_memberlogin" style="display:none;" for="member_login"></label>
									</span>
								</p>
							</div>
							<div class="text-center memberlogin_form_controls">
								<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LefDDIUAAAAAAE4WBiTqXTXprqSieSmMgo_Kzs_"></div>
								<p>
								    <span class="form_fields_spcontainer">
									    <label id="captcha_code_error" class="error captchad_memberlogin" style="display:none;"></label>
									</span>
								</p>
							</div>
							<div class="text-center memberlogin_form_controls">
								<p>
								    <input id="reset_captcha_filled" class="is_captcha_checked" type="hidden" value="0" />
									<input value="Reset Password" id="bgc_member_resetpass" class="btn btn-default" type="submit">
								</p>
								<span id="memberlogin_loader_ct" style="display:none;">
									<img src="<?php echo get_template_directory_uri();  ?>/img/memberlogin-loader.gif"   class="memberlogin_loader" />
								</span>
								<span id="member_login_response" class="member_login_status"  style="display:none;"></span>
							</div>
						</form>
					</div>
					<div class="reset_password_ct">
						<a href="<?php echo get_site_url(); ?>/index.php/new-member-portal/" class="forget_password_link">Click here to return to the log in screen</a>
					</div>
					<!--Form container starts from here-->
				</div>
			</div>
		</div>
	</div>
</section>
<?php }elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='resetpass'){ 

$member_id=base64_decode($_REQUEST['mid']);
$nowtime=$_REQUEST['nowtime'];
$restdate=date("Y-m-d H:i:s",$nowtime);

$restdatetime=date("Y-m-d H:i:s",strtotime($restdate." +2 hours"));

$currenttime=date("Y-m-d H:i:s");

?>	
<section class="new_member_login_portal" id="contact_us_area_member">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="new_member_login_form contact_us">
				
				    <?php
					    if($currenttime > $restdatetime)
						{
							?>
							<span id="member_login_response" class="member_login_status failure" >Timeout!!!!. Reset password time has been expired now.</span>
							<?php
						}else{
					?>
					<!--Form container starts from here-->
					<div class="bgc_membership_form_container resetpass_rep_cont">
					    <h2>Reset Password</h2>	
						<ul class="info-message info resetpass_myct">
							<li>
								Password must be &gt; 7 characters
							</li>
							<li>
								It contains 1 block letter
							</li>
							<li>
								It contains 1 number
							</li>
						</ul>
						<div class="screen-reader-response"></div>
						<form action="" method="post" class="bgc_memberlogin_form bgc_member_finalresetpass_formdata" id="bgc_memberlogin_formdata" >
							<div class="text-center memberlogin_form_controls">
								<p>
									<label>New Password: <span class="error">*</span></label>
									<br/>
									<span class="form_fields_spcontainer">
										<input name="new_password" size="40" id="new_password" class="bgc_form_controls required" type="password">
										<label id="new_password_err" class="error reset_pass_memberlogin" style="display:none;" for="member_login"></label>
									</span>
								</p>
							</div>
							<div class="text-center memberlogin_form_controls">
								<p>
									<label>Confirm Password: <span class="error">*</span></label>
									<br/>
									<span class="form_fields_spcontainer">
										<input name="confirm_new_password" size="40" id="confirm_new_password" class="bgc_form_controls required" type="password">
										<label id="confirm_password_err" class="error reset_pass_memberlogin" style="display:none;" for="member_login"></label>
									</span>
								</p>
							</div>
							<div class="text-center memberlogin_form_controls">
								<p>
								    <input type="hidden" name="resetpass_member" value="<?php echo $member_id; ?>" />
									<input value="Reset Password" id="bgc_member_resetpass" class="btn btn-default" type="submit">
								</p>
								<span id="memberlogin_loader_ct" style="display:none;">
									<img src="<?php echo get_template_directory_uri();  ?>/img/memberlogin-loader.gif"   class="memberlogin_loader" />
								</span>
								<span id="member_login_response" class="member_login_status"  style="display:none;"></span>
							</div>
						</form>
						<div class="reset_password_ct">
							<!--<a href="<?php echo get_site_url(); ?>/index.php/new-member-portal/" class="forget_password_link">Click here to return to the log in screen</a>-->
						</div>
						<!--Form container starts from here-->
					</div>
						<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
	
	
	
<?php }else{ 


//club_msg//logo_url
?>

<h2>Member Login</h2>
<?php
if($logo_url!='')
{
	?>
	<img src="<?php echo $logo_url; ?>?ver=<?php echo time(); ?>" class="member_portal_dis_logo" />
	<?php
}
if($club_msg!='')
{
	?>
	<p class="member_success"><?php echo $club_msg; ?></p>
	<?php
}
?>


<section class="new_member_login_portal" id="contact_us_area_member">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="new_member_login_form contact_us">
					<!--Form container starts from here-->
					<div class="bgc_membership_form_container">
						<div class="screen-reader-response"></div>
						<span class="member_application_instructions">This section of the web site provides information and services that are available only to members of Brighton Golf Club Inc.</span>
						<form action="" method="post" class="bgc_memberlogin_form bgc_member_login_formdata" id="bgc_memberlogin_formdata" >
							<div class="text-center memberlogin_form_controls">
								<p>
									<label>Member No.<span class="error">*</span></label>
									<br/>
									<span class="form_fields_spcontainer">
										<input name="member_login" size="40" class="bgc_form_controls required" type="text">
									</span>
								</p>
								<span class="member_application_instructions">This is your five (5) digit membership number. If you don’t know it have a look at your GolfLink card and it is the last five digits.</span>
							</div>
							<div class="text-center memberlogin_form_controls">
								<p>
									<label>Password<span class="error">*</span></label>
									<br/>
									<span class="form_fields_spcontainer">
										<input name="member_password"  size="40" class="bgc_form_controls required" id="user_emailaddress" type="password">
									</span>
								</p>
								<span class="member_application_instructions"> This is your date of birth (DOB). Use DDMM (no slashes, dots or spaces, just the four numbers). It is possible that when you joined the club you elected not to provide a DOB. In this case use your alpha code, the code you use to enter a Saturday Competition.</span>
							</div>
							<div class="text-center memberlogin_form_controls">
								<p>
									<input value="Login" id="bgc_member_login" class="btn btn-default" type="submit">
								</p>
								<span id="memberlogin_loader_ct" style="display:none;">
									<img src="<?php echo get_template_directory_uri();  ?>/img/memberlogin-loader.gif"   class="memberlogin_loader" />
								</span>
								<span id="member_login_response" class="member_login_status"  style="display:none;"></span>
								
								<span class="member_application_instructions">If you need assistance with either the Members Number or Password please contact Hon. Secretary Sue Williams by email at <a href="mailto:sue.margaret@hotmail.com">sue.margaret@hotmail.com</a></span>
								
								<!--<span class="member_application_instructions"> If you need assistance with either the Members Number or Password please contact Hon. Secretary Sue Williams (see <a href="<?php echo get_site_url(); ?>/index.php/contact-us/" target="_blank">Contact Us</a> page)</span>-->
								
								
								<div class="reset_password_ct">
								    <a href="<?php echo get_site_url(); ?>/index.php/new-member-portal/?action=reset_password" class="forget_password_link">Forgot Password ?</a>
								</div>
							</div>
						</form>
					</div>
					<!--Form container starts from here-->
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>