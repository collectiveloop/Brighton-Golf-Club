<?php
ob_start();
session_start();
/*
Template Name: New Member Portal
*/

get_header();?>
 
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

<?php
    global $wpdb;

	//include("member_login/api/micropower_api_config.php");

	if(isset($_SESSION['is_member_login']))
	{
		//echo "<pre>";print_r($_SESSION);
	}
?>

<section id="sologan_section" class="sologan_section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="sologan text-center membership_s">
					<img src="<?php echo get_template_directory_uri();?>/img/fetured_img.png">
					
					<?php include("member_login/member_portal.php"); ?>
					
				</div>
			</div>
		</div>
	</div>
</section>
		
<?php get_footer();?>