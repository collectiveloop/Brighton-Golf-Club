		<footer class="footer_top_area" id="footer_top_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-3">
					<div class="footer_tab_height">
						<div class="title">
							<h3>Our Club</h3>
						</div>
						<div class="footer_top_menu">
 <?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
						</div>
					</div>					
					</div>					
					<div class="col-sm-6 col-md-3">
					<div class="footer_tab_height">
						<div class="title">
							<h3>Weather</h3>
						</div>
					<?php if ( ! dynamic_sidebar( 'footer_sidebar' ) ) : ?>
					
						<div class="footer_top_weather">
							<img alt="" src="<?php echo get_template_directory_uri();?>/img/weather.png" class="alignleft">
							<p>12<span class="cel"> C </span><br><span>Partly Cloudy</span><br><span class="h_l">High</span>: 19 C</br><span class="h_l"> Low</span>: 12 C</p>
						</div>
					<?php endif; ?>	
					</div>					
					</div>					
					<?php 

							$facebook_link = get_option_tree( 'facebook', '', false );
							$twitter_link = get_option_tree( 'twitter', '', false );
							$google_plus_link = get_option_tree( 'google_plus', '', false );
							$flicker_link = get_option_tree( 'flicker', '', false );
							$rss_link = get_option_tree( 'rss', '', false );
							$phone_number = get_option_tree( 'phone_hot', '', false );
							$email_address = get_option_tree( 'email_address', '', false );
							$member_login = get_option_tree( 'member_login', '', false );
							$company_address = get_option_tree( 'company_address', '', false );

						?>
					<div class="col-sm-6 col-md-3">
					<div class="footer_tab_height">
						<div class="title">
							<h3>Contact Us</h3>
						</div>
						<div class="footer_top_address">
							<p><i class="fa fa-home"></i><?php echo $company_address; ?></p>
							<p><i class="fa fa-phone"></i><?php echo $phone_number; ?></p>
						</div>
			
					</div>
					</div>
					<div class="col-sm-6 col-md-3">
					<div class="footer_tab_height">
					<div class="title">
							<h3>Terms of Use</h3>
						<div class="footer_top_menu">
<?php wp_nav_menu( array( 'theme_location' => 'footer-trems-menu') ); ?>
						</div>
					</div>	
					</div>	
				</div>
			</div>
			</div>
			<div class="copyright">
					<p>&copy;2015 Brighton Golf Club. All rights Reserved. - Designed by <a href="https://www.collectiveloop.com">Collective Loop</a></p>
			</div>
		</footer>
		

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
	
	if($('#show_competition_result').length > 0)
	{
		 $('#show_competition_result').DataTable({
			"ordering": false,
			"pageLength": 50,
			"info":     false
		});
	}
	
   
    if($('#show_single_competition_result').length > 0)
	{
		$('#show_single_competition_result').DataTable({
			"ordering": false,
			"pageLength": 50,
			"info":     false
		});
	}
	
    if($('#competition_listing_records').length > 0)
	{
		$('#competition_listing_records').DataTable({
			"ordering": false,
			"pageLength": 50,
			"info":     false
		});
	}
});

</script>
<?php wp_footer();?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/additional-methods.js"></script>
<script src='<?php echo get_template_directory_uri(); ?>/js/calendar/moment.min.js'></script>
<script src='<?php echo get_template_directory_uri(); ?>/js/calendar/fullcalendar.min.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

function records_datatables_fn()
{
	/*$('#show_competition_result').DataTable({
	    "ordering": false,
	    "pageLength": 50,
		"info":     false
	});
	
	$('#show_single_competition_result').DataTable({
	    "ordering": false,
	    "pageLength": 50,
		"info":     false
	});
	
	$('#competition_listing_records').DataTable({
	    "ordering": false,
	    "pageLength": 50,
		"info":     false
	});	*/
}
    jQuery(document).ready(function ($){
		
		/*Simple Pagination*/
		
		/*Simple Pagination*/
        
        $("#date_between_unq").datepicker({ dateFormat: 'dd/mm/yy' });        
        $("#date_final_unq").datepicker({ dateFormat: 'dd/mm/yy' });    

        $('.member_details_section').on('click', '#show_start_date_img', function(e){
            $("#date_between_unq").focus();
		});
        $('.member_details_section').on('click', '#show_end_date_img', function(e){
            $("#date_final_unq").focus();
		});			
  
	    $("#bgc_membership_formdata").validate({				
				rules: {						
					user_creditcard_number: {							  
					required: true,			  			  
					creditcard: true			  			
				},
			},			
		});	
		
		//user_membership_catnm
		
		$('.form_fields_spcontainer').on('change', '#user_membership_catnm', function(e){
			
			var get_mem_catnm=$(this).val();
		
		    if(get_mem_catnm!='')
			{
				if(get_mem_catnm!='Ordinary Playing Member' && get_mem_catnm!='Junior Playing Member' && get_mem_catnm!='2-for-1 Membership Offer')
				{
					$(".bgc_membership_joining_container").hide();
					//alert("No payment");
				}else{
					$(".bgc_membership_joining_container").show();
					//alert("require payment");
				}
			}
	
		});
		
		$('.member_details_section').on('click', '.search_show_details', function(e){
			var memberid=$(this).data("m_id");
			$("#show_member_details_"+memberid).toggle();
			
			if($("#show_member_details_"+memberid).is(':visible')){
				$("#search_show_details_unq_"+memberid).text('Hide Details');                
			} else {
				$("#search_show_details_unq_"+memberid).text('Show Details');                
			}  
		});
		
		/*Business directory functions*/
		$('.busniess_inner').on('change', '#filter_business_category', function(e){
			var get_business_cat=$(this).val();
			$("#category_selector").find(".filters_cat_name").text(get_business_cat);
		});
		$('.busniess_inner').on('keyup', '#businessdir_nm', function(e){
			var getbusinessnm=$(this).val();
			if(getbusinessnm=='')
			{
				$("#busname_selector").hide().find(".filters_businname_name").text('');
			}else{
				$("#busname_selector").show().find(".filters_businname_name").text(getbusinessnm);
			}
		});
		$('.busniess_inner').on('click', '.alphabatic_search', function(e){
			var getalphanm=$(this).data("alphaval");
			$("#alphacode_selector").show().find(".filters_alpha_name").text(getalphanm);
		});
		$('.busniess_inner').on('click', '.business_filter_remove', function(e){
			$("#businessdir_nm").val('');
			$("#busname_selector").hide().find(".filters_businname_name").text('');
		});
		$('.busniess_inner').on('click', '.aplhabet_filter_remove', function(e){
			$("#alphacode_selector").hide().find(".filters_alpha_name").text('');
		});
		$('.busniess_inner').on('click', '.cat_filter_remove', function(e){
			
			$("#filter_business_category").val("All Categories");
			$("#category_selector").find(".filters_cat_name").text("All Categories");
		});
		
		var add_counter=1;
		$('.new_b_listning').on('click', '#add_new_business', function(e){
			
			var getclone_html=$(".business_cloning_form_fields").html();
			$(".business_addedit_form").prepend('<div class="add_busiess_loop_cont" id="busiess_unq_cont_'+add_counter+'">'+getclone_html+'</div>');
			
			$("#busiess_unq_cont_"+add_counter).find(".details-expand").attr("data-unqid",add_counter);
			$("#busiess_unq_cont_"+add_counter).find(".details-cancel").attr("data-unqid",add_counter);
			$("#busiess_unq_cont_"+add_counter).find(".submit-expand").attr("data-unqid",add_counter);
			$("#busiess_unq_cont_"+add_counter).find(".expend-cancel").attr("data-unqid",add_counter);
			$("#busiess_unq_cont_"+add_counter).find(".business_form_cls").attr("id",'business_sub_frm-'+add_counter);
			$("#busiess_unq_cont_"+add_counter).find(".title_input").attr("id","frm_inner_unq_ct_"+add_counter);
			
			add_counter++;
		});
		
		$('.business_addedit_form').on('click', '.details-expand', function(e){
			var getelement_id=$(this).data("unqid");
			$("#frm_inner_unq_ct_"+getelement_id).slideToggle();
		});
		$('.business_addedit_form').on('click', '.details-cancel', function(e){
			var getelement_id=$(this).data("unqid");
			$("#busiess_unq_cont_"+getelement_id).remove();
		});
		$('.business_addedit_form').on('click', '.expend-cancel', function(e){
			var getelement_id=$(this).data("unqid");
			$("#busiess_unq_cont_"+getelement_id).remove();
		});
		
		//business_form_cls
		
		$(document).on('submit','.business_form_cls',function(){
			
			var getelement_id=$(this).attr("id");
			var resarr = getelement_id.split("-");
			
			var ctid=resarr[1];
			
			var description=$("#busiess_unq_cont_"+ctid).find(".business_description").val();
			var buscategory=$("#busiess_unq_cont_"+ctid).find(".business_cat_cls").val();
			
			if(description=='' || buscategory=='')
			{
				if(description=='')
				{
					$("#busiess_unq_cont_"+ctid).find(".business_description").css("border","2px solid #ff0000");
				}else{
					$("#busiess_unq_cont_"+ctid).find(".business_description").css("border","1px solid #ccc");
				}
				
				if(buscategory=='')
				{
					$("#busiess_unq_cont_"+ctid).find(".business_cat_cls").css("border","2px solid #ff0000");
				}else{
					$("#busiess_unq_cont_"+ctid).find(".business_cat_cls").css("border","1px solid #ccc");
				}
				return false;
			}else{
				$("#busiess_unq_cont_"+ctid).find(".business_description").css("border","1px solid #ccc");
				$("#busiess_unq_cont_"+ctid).find(".business_cat_cls").css("border","1px solid #ccc");
			}
			return false;
		});
		/*Business directory functions*/
		
		/*Competition list functions*/
		$('.competitions_search_form').on('change', '#showing_events_type', function(e){
			var showtype=$(this).val();
			if(showtype=='sel_date')
			{
				$(".datepicker_input_ct").show();
			}else{
				$(".datepicker_input_ct").hide();
			}
		});
		$(document).on('submit','#caompetition_search_frm',function(){
			var showtype=$("#showing_events_type").val();
			if(showtype=='sel_date')
			{
				var startdate=$("#date_between_unq").val();
				var enddate=$("#date_final_unq").val();
				if(startdate=='' || enddate=='')
				{
					$(".show_req_date_err").show();
				    $(".show_req_date_err").html("Please enter valid date range.");
					return false;
				}
			}
		});
		/*Competition list functions*/
		
		$('#profile_payment_form_unq').on('click', '.paywithsecurepay_cls', function(e){
			
			var amount_val=$("#accont_amount_unq").val();
			
			if(amount_val=='')
			{
				$("#ac_amount_err").show().html("Please enter amount.");
				return false;
			}else{
				$("#ac_amount_err").hide().html('');
			}
		});
		
		/*Result list functions*/
		
		$('.competitions_search_form').on('change', '#showing_result_types', function(e){
			var typeid=$("#showing_result_types").val();
			var roundid=$("#showing_result_rounds").val();
			var divisionid=$("#showing_results_division").val();
			if(typeid!='')
			{
				result_filtration_fn(typeid,roundid,divisionid);
			}
			return false;
		});
		
		$('.competitions_search_form').on('change', '#showing_result_rounds', function(e){
			var typeid=$("#showing_result_types").val();
			var roundid=$("#showing_result_rounds").val();
			var divisionid=$("#showing_results_division").val();
		    if(roundid!='')
			{
				result_filtration_fn(typeid,roundid,divisionid);
			}
			return false;
		});
		
		$('.competitions_search_form').on('change', '#showing_results_division', function(e){
			var typeid=$("#showing_result_types").val();
			var roundid=$("#showing_result_rounds").val();
			var divisionid=$("#showing_results_division").val();
		    
			result_filtration_fn(typeid,roundid,divisionid);
			
			return false;
		});
		
		$('.competitions_search_form').on('change', '#showing_prize_types', function(e){
			
			var get_prize_tempid=$(this).val();
			var comp_id=$(this).data("competitionid");
			
			prizes_filtration_fn(get_prize_tempid,comp_id);
			
			return false;
		});
		
		function prizes_filtration_fn(prize_temp_id,comp_id)
		{
			$("#showresultloader").show();
			$.ajax({
				type : "post",
				url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-resultsearch.php",
				data : {prize_type_id:prize_temp_id,competition_id:comp_id,action_type:'prize'},
				success:function(response)
				{
					$("#showresultloader").hide();
					//alert(response);
					$("#result_ajaxloading_data").html(response);
					
					records_datatables_fn();
					//result_ajaxloading_data
				},
			});
		
		}
		
		function result_filtration_fn(typeid,roundid,divisionid)
		{
			var compid=$("#show_competion_resultval").val();
			$("#showresultloader").show();
			$.ajax({
				type : "post",
				url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-resultsearch.php",
				data : {type_id:typeid,round_id:roundid,division_id:divisionid,com_id:compid},
				success:function(response)
				{
					$("#showresultloader").hide();
					//alert(response);
					$("#result_ajaxloading_data").html(response);
					//result_ajaxloading_data
					records_datatables_fn();
				},
			});
		
		}
		
		
		
		

		// Validate amount for payment
		

		$('#accont_amount_unq').keydown(function (event) {
			
			if (event.shiftKey == true) {
				event.preventDefault();
			}

			if ((event.keyCode >= 48 && event.keyCode <= 57) || 
				(event.keyCode >= 96 && event.keyCode <= 105) || 
				event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
				event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

			} else {
				event.preventDefault();
			}

			if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
			{
				event.preventDefault(); 
			}
			
			var inptcontent=$(this).val();
			
			var counter_decimal=inptcontent.substring($(this).val().indexOf('.')).length;
			
			/*if(counter_decimal > 2 && event.keyCode != 8)
			{
				event.preventDefault();
			}*/
			
			if (($(this).val().indexOf('.') != -1) && ($(this).val().substring($(this).val().indexOf('.')).length > 2) && (event.which != 0 && event.which != 8) && ($(this)[0].selectionStart >= $(this).length - 2)) {
					event.preventDefault();
			}   
			
		});
		
		$('.member_details_section').on('click', '#change_member_image', function(e){
            $("#upload_picture").trigger("click");
		});
		
		$('.member_details_section').on('click', '#remove_member_proimg', function(e){
			
			$("#profile_image_loader").show();
            $.ajax({
				type : "post",
				url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-memberlogin.php",
				data : {action:'delete_image'},
				success:function(response)
				{
					$("#profile_image_loader").hide();
					var getnewimgsrc=$("#temp_default_proimg").attr("src");
					$(".profile_picture").attr('src', getnewimgsrc);
				},
			});
			return false;
		});
		

		$(".upload_pic_ct").on("change", "#upload_picture", function() {
			
			var imagesrc='';
			if (this.files && this.files[0]) 
			{
				var reader = new FileReader();
				reader.onload = function (e) {
					imagesrc=e.target.result;
					$("#temp_profile_imgurl").attr('src', e.target.result);
					
				}
				reader.readAsDataURL(this.files[0]);
			}
			var file_data = $('#upload_picture').prop('files')[0];   
		    var form_data = new FormData();                  
		    form_data.append('file', file_data);
			$("#profile_image_loader").show();
			$.ajax({
				url: '<?php echo get_template_directory_uri(); ?>/member_login/ajax-memberlogin.php?action=change_image',
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(response)
				{
					$("#profile_image_loader").hide();
					var getnewimgsrc=$("#temp_profile_imgurl").attr("src");
					$(".profile_picture").attr('src', getnewimgsrc);
				}
			});
			
			//return false;
			
		});
		
		/* Change Password */
		
		$(document).on('submit','#profile_pass_frm_data',function(){
			
			var new_password=$("#new_password").val();
			var confirm_new_password=$("#confirm_new_password").val();
			
			var pattern=(/^(?=.*\d)(?=.*[A-Z]).{7,20}$/);
			var is_valid=pattern.test(new_password);
			
			if(new_password=='' || confirm_new_password=='' || is_valid==false || new_password!=confirm_new_password)
			{
				if(new_password=='')
				{
					$("#new_password_err").show().html("The New password field is required.");
				}else if(new_password!='' && is_valid==false)
				{
					$("#new_password_err").show().html("Password does not meet requirements");
				}else{
					$("#new_password_err").hide().html("");
				}
				
				if(confirm_new_password=='')
				{
					$("#confirm_password_err").show().html("The Confirm new password field is required.");
					
				}else if(confirm_new_password!='' && new_password!=confirm_new_password)
				{
					$("#confirm_password_err").show().html("'Confirm new password' and 'New password' do not match.");
				}else{
					$("#confirm_password_err").hide().html("");
				}
			}else{
				$("#new_password_err").hide();
				$("#confirm_password_err").hide();
				
				$(".member_search_loader_ct").show();
				$.ajax({
					type : "post",
					url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-memberlogin.php",
					data : $("#profile_pass_frm_data").serialize()+'&action=change_password',
					success:function(response)
					{
						$(".member_search_loader_ct").hide();
						if(response==1)
						{
							$("#profilepass_req_response").removeClass("success");
							$("#profilepass_req_response").addClass("failure");
							$("#profilepass_req_response").show();
							$("#profilepass_req_response").html("Updation Unsuccessful! There is problem in updating data.");
						}else{
							$("#profilepass_req_response").removeClass("failure");
							$("#profilepass_req_response").addClass("success");
							$("#profilepass_req_response").show();
							$("#profilepass_req_response").html("Password has been updated successfully.");
						}
					},
				});
			}
		    return false;
		});
		
		/*Edit Profile data*/
		
		$(document).on('submit','#profile_frm_data',function(){
			
			$(".member_search_loader_ct").show();
			$.ajax({
				type : "post",
				url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-memberlogin.php",
				data : $("#profile_frm_data").serialize()+'&action=edit_profile',
				success:function(response)
				{
					//alert(response);
					$(".member_search_loader_ct").hide();
					if(response==1)
					{
						$("#profile_req_response").removeClass("success");
						$("#profile_req_response").addClass("failure");
						$("#profile_req_response").show();
					    $("#profile_req_response").html("Updation Unsuccessful! There is problem in updating data.");
					}else{
						$("#profile_req_response").removeClass("failure");
						$("#profile_req_response").addClass("success");
						$("#profile_req_response").show();
					    $("#profile_req_response").html("Updated Successfully");
					}
				},
			});
		    return false;
		});
		
		$(document).on('submit','#upload_pro_img',function(){
			
			var file_data = $('#profileToUpload').prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('file', file_data);

			$.ajax({
				url: '<?php echo get_template_directory_uri(); ?>/member_login/ajax-memberlogin.php?action=change_image', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(response)
				{
					alert(response);
				}
			});
		
		    return false;
		});
		
		
		//search_bgc_members_frm
		
		$(document).on('submit','.search_bgc_members_frm',function(){
		    var getsearch_str=$("#member-search-input").val();
			if(getsearch_str!='')
			{
				$(".member_search_loader_ct").show();
				$.ajax({
					type : "post",
					url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-membersearch.php",
					data : $(".search_bgc_members_frm").serialize(),
					success:function(response)
					{
						$(".member_search_loader_ct").hide();
						$("#member_search_results_container").html(response);
					},
				});
		    }
		    return false;
		});
		
		$('.member_details_section').on('click', '.bookmark_member_btn', function(e){
			var fav_memberid=$(this).data("favmemid");
			$(".member_search_loader_ct").show();
			$.ajax({
				type : "post",
				url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-membersearch.php",
				data : {"fav_mid":fav_memberid,"action":"add_bookmark"},
				success:function(response)
				{
					$(".allmembers_cls").removeClass("active");
					$("#all_members").removeClass("in active");
					
					$(".bookmarks_cls").addClass("active");
					$("#bookmarked_members").addClass("in active");
					
					$(".member_search_loader_ct").hide();
					$("#member_bookmarks_list_container").html(response);
				},
			});
		});
		
		$('.member_details_section').on('click', '.remove_bookmark_member_btn', function(e){
			var fav_memberid=$(this).data("favmemid");
			$(".member_search_loader_ct").show();
			$.ajax({
				type : "post",
				url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-membersearch.php",
				data : {"fav_mid":fav_memberid,"action":"remove_bookmark"},
				success:function(response)
				{
					$(".allmembers_cls").removeClass("active");
					$("#all_members").removeClass("in active");
					
					$(".bookmarks_cls").addClass("active");
					$("#bookmarked_members").addClass("in active");
					
					$(".member_search_loader_ct").hide();
					$("#member_bookmarks_list_container").html(response);
				},
			});
		});
		
		
		
		
        $(".bgc_member_login_formdata").validate({
		    submitHandler: function(form) {
				$("#memberlogin_loader_ct").show();
				$("#member_login_response").hide();
				$.ajax({
					url: "<?php echo get_template_directory_uri();  ?>/member_login/ajax-memberlogin.php",
					method: "POST",
					data: $("#bgc_memberlogin_formdata").serialize(),
					success:function(is_error)
					{
						//alert(is_error);
						$("#memberlogin_loader_ct").hide();
						if(is_error==1)
						{
							$("#member_login_response").show();
							$("#member_login_response").html('<span class="login_error">Login Unsuccessful! There seems to be an error processing your request.</span>');
						}else{
							location.reload(true);
							$("#member_login_response").show();
							$("#member_login_response").html('<span class="login_sucess">Login Successfully! We are redirecting you to your account.</span>');
						}
					}
				});			
				return false;				
		    }
	    });	
		
		/*Reset Password*/
		
		$(".bgc_member_resetpass_formdata").submit(function(){
			
			$(".member_login_status").hide();
			
			var reset_member_id=$("#resetpass_member_login").val();
			var reset_captcha_cd=$("#reset_captcha_filled").val();
			
			if(reset_member_id=='' || reset_captcha_cd!=1)
			{
				if(reset_member_id=='')
				{
					$("#member_login_error").show().html("This field is required.");
				}else{
					$("#member_login_error").hide().html("");
				}
				
				if(reset_captcha_cd!=1)
				{
					$("#captcha_code_error").show().html("Please fill captcha code.");
				}else{
					$("#captcha_code_error").hide().html("");
				}
				
			}else{
				
				$("#member_login_error").hide().html("");
				$("#captcha_code_error").hide().html("");
				$("#memberlogin_loader_ct").show();
				$.ajax({
					url: "<?php echo get_template_directory_uri();  ?>/member_login/ajax-memberlogin.php",
					method: "POST",
					data: $(".bgc_member_resetpass_formdata").serialize()+'&action=reset_password',
					success:function(response)
					{
						var outputarr=$.parseJSON(response);
						$("#memberlogin_loader_ct").hide();
						if(response==2)
						{
							$(".member_login_status").show();
							$(".member_login_status").html('<span class="login_error">Wrong information!! Please enter correct details.</span>');
						}else if(typeof outputarr.status === 'undefined')
						{
							$("#captcha_code_error").show().html("Robot verification failed, please try again.");
						}else{
							$("#captcha_code_error").hide();
							var outputhtml="<h2>Thank you.</h2><p>A link to reset your password has been emailed to: </p><p>"+outputarr.masked_email+"</p><p>You should receive the email in 10 minutes or less. Please be aware that your email may have been directed to your email's spam folder. If you still have not received an email after this time, please contact your club. </p>";
							$(".reset_pass_rep_cont").html(outputhtml);
						}
					}
				});
			}
			return false;
		});
		
		
		$(".bgc_member_finalresetpass_formdata").submit(function(){
	
			var new_password=$("#new_password").val();
			var confirm_new_password=$("#confirm_new_password").val();
			
			var pattern=(/^(?=.*\d)(?=.*[A-Z]).{7,20}$/);
			var is_valid=pattern.test(new_password);
			
			if(new_password=='' || confirm_new_password=='' || is_valid==false || new_password!=confirm_new_password)
			{
				if(new_password=='')
				{
					$("#new_password_err").show().html("The New password field is required.");
				}else if(new_password!='' && is_valid==false)
				{
					$("#new_password_err").show().html("Password does not meet requirements");
				}else{
					$("#new_password_err").hide().html("");
				}
				
				if(confirm_new_password=='')
				{
					$("#confirm_password_err").show().html("The Confirm new password field is required.");
					
				}else if(confirm_new_password!='' && new_password!=confirm_new_password)
				{
					$("#confirm_password_err").show().html("'Confirm new password' and 'New password' do not match.");
				}else{
					$("#confirm_password_err").hide().html("");
				}
			}else{
				$("#new_password_err").hide().html("");
				$("#confirm_password_err").hide().html("");
				
				$("#memberlogin_loader_ct").show();
				$.ajax({
					type : "post",
					url  : "<?php echo get_template_directory_uri(); ?>/member_login/ajax-memberlogin.php",
					data : $(".bgc_member_finalresetpass_formdata").serialize()+'&action=updatepassword',
					success:function(response)
					{
						$("#memberlogin_loader_ct").hide();
						if(response==1)
						{
							$("#member_login_response").removeClass("success");
							$("#member_login_response").addClass("failure");
							$("#member_login_response").show();
							$("#member_login_response").html("Updation Unsuccessful! There is problem in updating data.");
						}else{
							$("#member_login_response").removeClass("failure");
							$("#member_login_response").addClass("success");
							$("#member_login_response").show();
							var restpass_html='<h2>Password Reset Complete</h2><p>Your password has successfully been reset. Please click the link below to sign in using your new password.</p> <p><a href="<?php echo get_site_url(); ?>/index.php/new-member-portal/">Go to Sign In Page</a></p>';
							$(".resetpass_rep_cont").html(restpass_html);
						}
					},
				});
			}
			
			return false;
		});
        /*$("#bgc_memberlogin_formdata").validate({
		submitHandler: function(form) {
			//#419639//#8b0000//memberlogin_loader_ct//member_login_error
			$("#memberlogin_loader_ct").show();
			$.ajax({
				url: "<?php echo get_template_directory_uri();  ?>/member_login/ajax-memberlogin.php",
				method: "POST",
				data: $("#bgc_memberlogin_formdata").serialize(),
				success:function(result)
				{
					$("#memberlogin_loader_ct").hide();
					alert(result);
					//$("#member_ajax_form_loader").hide();
					
				}
			});			
            return false;				
		}
	});	*/		
  
  });
  
/*Reset Password other fns*/  
  
function recaptchaCallback() {
    jQuery('#reset_captcha_filled').val(1);
}
  
  
var livepaypalurl="https://www.paypal.com/cgi-bin/webscr";


var testpaypalurl="https://www.sandbox.paypal.com/cgi-bin/webscr";
  
  
function change_payment_method(myobj){	
  
  
    var getoptionval=myobj.value;	

    jQuery("#bgc_membership_formdata").attr("action","");
  
  
    if(getoptionval=='paypal')	
    {						
  
    jQuery("#securepay_creditcard_container").hide();		
  
  
    jQuery("#paypal_payment_container").show();	  
	
	
	//jQuery("#bgc_membership_formdata").attr("action",testpaypalurl);
  
  
    }else{			
  
  
    jQuery("#securepay_creditcard_container").show();	
  
  
    jQuery("#paypal_payment_container").hide();
	
	
	jQuery("#bgc_membership_formdata").attr("action","");
	
  
    }	
  
}
  
</script>  
  
<script>
$(function () {
	
  $('[data-toggle="popover"]').popover();
  
})
</script>  
  

</body>
</html>
