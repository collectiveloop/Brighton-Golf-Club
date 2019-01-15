<?php
?>
<ul class="nav_lists">
	<li class="nav_lists_li <?php if(@$_REQUEST['action']==''){ ?>active<?php } ?>"><a href="<?php echo $get_newportal_url; ?>">Home</a></li>
	<li class="nav_lists_li <?php if(@$_REQUEST['action']=='member_search'){ ?>active<?php } ?>"><a href="<?php echo $get_newportal_url; ?>?action=member_search">Member Search</a></li>
	<li class="nav_lists_li <?php if(@$_REQUEST['action']=='member_profile'){ ?>active<?php } ?>"><a href="<?php echo $get_newportal_url; ?>?action=member_profile">My Profile</a></li>
	<li class="nav_lists_li <?php if(@$_REQUEST['action']=='member_accounts'){ ?>active<?php } ?>"><a href="<?php echo $get_newportal_url; ?>?action=member_accounts">My Accounts</a></li>
	<!--<li class="nav_lists_li <?php if(@$_REQUEST['action']=='member_business'){ ?>active<?php } ?>"><a href="<?php echo $get_newportal_url; ?>?action=member_business">Business Directory</a></li>-->
	<li class="nav_lists_li <?php if(@$_REQUEST['action']=='member_competitions'){ ?>active<?php } ?>"><a href="<?php echo $get_newportal_url; ?>?action=member_competitions">Competitions</a></li>
	<!--<li class="nav_lists_li"><a href="http://brighton.ppgresults.micropower.com.au/results" target="_blank">Results - V1</a></li>-->
	<li class="nav_lists_li <?php if(@$_REQUEST['action']=='member_results' || @$_REQUEST['action']=='member_single_result' || @$_REQUEST['rtype']=='prizes' || @$_REQUEST['rtype']=='results'){ ?>active<?php } ?>"><a href="<?php echo $get_newportal_url; ?>?action=member_results">Results</a></li>
	<li class="nav_lists_li"><a href="<?php echo get_site_url(); ?>/index.php/new-member-portal/?action=logout">Sign Out</a></li>
</ul>