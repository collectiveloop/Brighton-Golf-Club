<?php
session_start();
include("api/micropower_api_config.php");


if(isset($_REQUEST['action_type']) && $_REQUEST['action_type']=='prize')
{
	/*get logged member id*/
	$gettoken = $_SESSION['member_token'];
	$tokenarr = DecodeJWT($gettoken);
	$member_id = $tokenarr['memberid'];
	/*get logged member id*/

	$prize_temp_id=$_REQUEST['prize_type_id'];
	$competitionId=$_REQUEST['competition_id'];
	
	$prizesreq = CallAPI("GET",$BaseAPIurl."teebooking/clubs/$venueId/members/$member_id/prizes?competitionId=".$competitionId."&templateId=".$prize_temp_id, false);
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
    ?>
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
				}else{
					?>
					<tr><td colspan="8">No results found.</td></tr>
					<?php
				}
			?>
		</tbody>
	</table>
    <?php	
}else{

$type_id=$_REQUEST['type_id'];
$round_id=$_REQUEST['round_id'];
$division_id=$_REQUEST['division_id'];
$com_id=$_REQUEST['com_id'];

/*get logged member id*/
$gettoken = $_SESSION['member_token'];
$tokenarr = DecodeJWT($gettoken);
$member_id = $tokenarr['memberid'];
	
/*Filtration code*/
$addroundarr['clubId']=$venueId;
$addroundarr['clubMemberId']=$member_id;
$addroundarr['competitionId']=$com_id;
if($round_id!='' || $round_id!='best_rounds'){ $addroundarr['competitionRoundId']=$round_id;  }
if($type_id!=''){ $addroundarr['competitionTypeId']=$type_id;  }
if($division_id!=''){ $addroundarr['competitionDivisionId']=$division_id; }

$getroundreq = CallAPI("POST", $BaseAPIurl . "teebooking/clubs/$venueId/members/$member_id/competition/results",$addroundarr);
$getcompetition_res = json_decode($getroundreq, TRUE);


if(!empty($getcompetition_res))
{
	$getcompetitionrounds=$getcompetition_res['competitionDetails']['competitionRounds'];
	$getcompetitiontypes=$getcompetition_res['competitionDetails']['competitionTypes'];
	$getcompetitiondivisions=$getcompetition_res['competitionDetails']['competitionDivisions'];
	$competionname=$getcompetition_res['competitionDetails']['competitionName'];
	
	$firstroundid=@$getcompetition_res['competitionDetails']['competitionRounds'][0]['competitionRoundId'];
	$firsttypeid=@$getcompetition_res['competitionDetails']['competitionTypes'][0]['competitionTypeId'];
	$firsttypename=@$getcompetition_res['competitionDetails']['competitionTypes'][0]['competitionTypeName'];
	
	$selectedtypname='';
	if(!empty($getcompetitiontypes))
	{
		foreach($getcompetitiontypes as $comptype)
		{
			$typeid=$comptype['competitionTypeId'];
			$types_name=$comptype['competitionTypeName'];
			if($type_id!='' && $type_id==$typeid)
			{
				$selectedtypname=$types_name;
			}
		}
	}
	$selectedroundname='';
	if(!empty($getcompetitionrounds))
	{
		foreach($getcompetitionrounds as $compround)
		{
			$roundid=$compround['competitionRoundId'];
			$round_name=$compround['name'];
			if(($round_id!='' || $round_id!='best_rounds') && $round_id==$roundid)
			{
				$selectedroundname=$round_name;
			}
		}
	}
	
}
$countrounds=count($getcompetitionrounds);

//echo "<pre>";print_r($getcompetition_res);

if($round_id=='best_rounds')
{
?>
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
					<th>Round 1 <?php echo $selectedtypname; ?></th>
					<?php
				}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($getcompetition_res))
			{
				$getcompresults=$getcompetition_res['resultItem'];
				
				//echo "<pre>";print_r($getcompresults);
				if(!empty($getcompresults))
				{
					foreach($getcompresults as $single_comp)
					{
						//echo "<pre>";print_r($single_comp);
						$competitionId=$single_comp['competitionId'];
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
					<tr><td colspan="6">No results found.</td></tr>
					<?php
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

<?php }else{ 
//selectedroundname//selectedtypname
?>

<div class="responsive-table">
<table class="account-balance-table" >
	<thead>
		<tr>
			<th>Position</th>
			<th>Name</th>
			<th>GA Hdcp (Dly)</th>
			<th>Home club</th>
			<th><?php echo $selectedroundname; ?> <?php echo $selectedtypname; ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($getcompetition_res))
			{
				$getcompresults=$getcompetition_res['resultItem'];
				
				if(!empty($getcompresults))
				{
					foreach($getcompresults as $single_comp)
					{
						//echo "<pre>";print_r($single_comp);
						$competitionId=$single_comp['competitionId'];
						$positionid=$single_comp['pos'];
						$displayName=$single_comp['displayName'];
						$homeClubName=$single_comp['homeClubName'];
						$handicapIndex=$single_comp['handicapIndex'];
						$dailyHandicap=$single_comp['dailyHandicap'];
						
						$gettotal=$single_comp['total'];
						
						$roundScoresarr=$single_comp['roundScores'][0];
						$roundScores=$roundScoresarr[roundScore];
						
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
							<td><?php echo $roundScores; ?></td>
						</tr>
						<?php
					}
				}else{
					?>
					<tr><td colspan="6">No results found.</td></tr>
					<?php
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


<?php } 
}
?>