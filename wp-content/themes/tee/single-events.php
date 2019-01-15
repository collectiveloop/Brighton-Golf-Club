<?php
/**
 * The Template for displaying all single event posts.
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<!-- BACKGROUND HEADER-->
	<?php $imageUrl1 = get_template_directory_uri(). '/images/backgrounds/default.jpg'; ?>
	<div id="background" class="small" style="background-image: url('<?php echo get_theme_mod( 'tee_bg_default', $imageUrl1); ?>');"></div>

  	</header>
  	<!-- END HEADER -->
  	
  	<!-- START MAIN CONTAINER -->
  	<div id="main-container">
  		<!-- START CONTAINER -->
	  	<section id="container" class="container">
	  		<!-- TITLE -->
  			<div class="heading page-title animate_right_left">
		  		<h1><?php the_title(); ?></h1>
		  		<hr>
  			</div>
  			<?php if( !get_post_meta( get_the_ID(), 'tee_event_private', true) || is_user_logged_in()) : ?>
	  			<!-- CONTENT -->
	  			<div class="row">
		  			<div class="col-md-8">
		  				<?php if ( has_post_thumbnail() ) { ?>
			  				<span class="post-image-wrapper">
								<?php the_post_thumbnail(); ?>
							</span>
							<hr>
						<?php } ?>
		  				<div class="post-content">
		  					<?php the_content(); ?>
		  				</div>
		  			</div>
		  			<div class="col-md-4">
		  				<div class="event-card center animate_right_left">
		  				<?php if( get_post_meta( get_the_ID(), 'tee_event_datetime', true ) != ""){ ?>
								<h2><?php _e("When Is It ?","tee"); ?></h2>
								<div id="timer">
					                <div id="days" class="timer_box"></div>
					                <div id="hours" class="timer_box"></div>
					                <div id="minutes" class="timer_box"></div>
					                <div id="seconds" class="timer_box"></div>
								</div>
								<?php
							    /* DATE FORMAT => YEAR-MO-DA HO:MI */
							    $the_date = get_post_meta( get_the_ID(), 'tee_event_datetime', true );
							    ?>
								<p><span class="icon icon-calendar"></span> <?php echo tee_events_date($the_date) .' '. __('at','tee').' '. $the_time; ?></p>
								<?php if( get_post_meta( get_the_ID(), 'tee_event_datetime_end', true ) != ""){ ?>
								    <?php
								    /* DATE FORMAT => YEAR-MO-DA HO:MI */
								    $the_end_date = get_post_meta( get_the_ID(), 'tee_event_datetime_end', true );
								    ?>
									<p><?php _e('End:','tee');?> <?php echo tee_events_date($the_end_date); ?></p>
								<?php } ?>
								<hr>
							<?php } ?>
							<h2><?php _e("Where ?", "tee"); ?></h2>
							<p><span class="icon icon-location"></span> <?php echo get_post_meta( get_the_ID(), 'tee_event_location', true ); ?></p>
							<p><?php echo get_post_meta( get_the_ID(), 'tee_event_address', true ); ?></p>
							<?php if( get_post_meta( get_the_ID(), 'tee_event_gps', true ) != ""){ ?>
								<div id="mapEvent"></div>
							<?php } ?>
							<?php if(get_option('tee_mail') != "") { ?>
								<hr>
								<div class="center">
									<a href="mailto:<?php echo get_option('tee_mail'); ?>" class="btn btn-default">
										<i class="icon-mail"></i> <?php _e("Got a Question ?","tee"); ?>
									</a>
								</div>
							<?php } ?>
							<?php if(get_post_meta( get_the_ID(), 'tee_event_external', true ) != ""){ ?>
								<div class="center">
									<a href="<?php echo get_post_meta( get_the_ID(), 'tee_event_external', true ); ?>" class="btn btn-default">
										<i class="icon-link"></i> <?php _e("Sign Up","tee"); ?>
									</a>
								</div>
							<?php } ?>
							<?php if(get_post_meta( get_the_ID(), 'tee_event_subscribe', true ) == true) { ?>
								<div class="center">
									<a href="#" id="open-subscribe" class="btn btn-default">
										<i class="icon-install"></i> <?php _e("Subscribe now","tee"); ?>
									</a>
								</div>
							<?php } ?>
			  			</div>
		  			</div>
	  			</div>
	  			<!-- ONLY FOR THE EVENT SINGLE PAGE : MAP SCRIPT -->
	  			<?php if( get_post_meta( get_the_ID(), 'tee_event_gps', true ) != ""){ ?>
			    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
			    <script>
					function initialize() {
					  var myLatlng = new google.maps.LatLng(<?php echo get_post_meta( get_the_ID(), 'tee_event_gps', true ); ?>); //http://itouchmap.com/latlong.html
					  var mapOptions = {
					    zoom: 15,
					    center: myLatlng
					  }
					  var map = new google.maps.Map(document.getElementById('mapEvent'), mapOptions);
					
					  var marker = new google.maps.Marker({
					      position: myLatlng,
					      map: map,
					      title: 'Hello World!'
					  });
					}
					
					google.maps.event.addDomListener(window, 'load', initialize);
					
				</script>
				<?php } ?>
			    <!-- END -->
			    <?php
				/*
				 * SENDING FORM
				 */
				//If the form is submitted
				if(isset($_POST['submitted'])) { 
				    //Check to make sure that the name field is not empty
				    if($_POST['subscribe_first'] === '') { 
				            $hasError = true;
				    } else {
				            $name_first = $_POST['subscribe_first'];
				    }
				    if($_POST['subscribe_last'] === '') { 
				            $hasError = true;
				    } else {
				            $name_last = $_POST['subscribe_last'];
				    }
				    if($_POST['subscribe_email'] === '')  { 
				            $hasError = true;
				    } else if (!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $_POST['subscribe_email'])) {
				            $hasError = true;
				    } else {
				            $email = $_POST['subscribe_email'];
				    }
				    if($_POST['subscribe_phone'] === '') { 
				            $hasError = true;
				    } else {
				            $phone = $_POST['subscribe_phone'];
				    }
				    
				    if($_POST['subscribe_address'] === '') {
				            $hasError = true;
				    } else {
				            if(function_exists('stripslashes')) {
				                    $address = stripslashes($_POST['subscribe_address']);
				            } else {
				                    $address = $_POST['subscribe_address'];
				            }
				    }
				    if($_POST['subscribe_comment'] === '') {
				            $hasError = true;
				    } else {
				            if(function_exists('stripslashes')) {
				                    $comment = stripslashes($_POST['subscribe_comment']);
				            } else {
				                    $comment = $_POST['subscribe_comment'];
				            }
				    }
				
				    //If there is no error, send the email
				    if(!isset($hasError)) {
							if(get_post_meta( get_the_ID(), 'tee_event_subscribe_email', true ) ===""){
								$emailTo = get_option('tee_mail');
							}	
							else{
								$emailTo = get_post_meta( get_the_ID(), 'tee_event_subscribe_email', true );
							}
							$title = get_the_title();
				            $subject = sprintf( __('New Subscription from your website %d', 'tee'), $title );
				            $date_for_email = $the_month_final ." ". $the_day ." ". $the_year ." at ". $the_time;
				            $body = "Event: $title \n\nEvent Date: $date_for_email \n\nName: $name_first $name_last \n\nEmail: $email \n\nPhone Number: $phone \n\nAddress: $address\n\nComment: $comment";
				            $headers = 'From : [NEW SUBSCRIPTION] <'.$emailTo.'>' . "\r\n" . 'answer to : ' . $email;
				
				            mail($emailTo, $subject, $body, $headers);
				
				            $emailSent = true; 
				    }
				    
				}
				?>
			    <!-- ONLY FOR THE EVENT SINGLE PAGE : COUNTER SCRIPT -->
			    <script type="text/javascript">
			    jQuery(function($) {
				    /**
				    * Set your date here  (YEAR, MONTH (0 for January/11 for December), DAY, HOUR, MINUTE, SECOND)
				    * according to the GMT+0 Timezone
				    **/
				    <?php
				    /* DATE FORMAT => YEAR-MO-DA HO:MI */
				    $the_date = get_post_meta( get_the_ID(), 'tee_event_datetime', true );
				    $the_time_hour = substr($the_date, -5, -3);
				    $the_time_minutes = substr($the_date, -2);
				    $the_date_day = substr($the_date, 8, -6);
				    $the_date_year = substr($the_date, 0, 4);
				    $the_date_month = substr($the_date, 5, -9);
				    $the_date_month_final = $the_date_month - 1;
				    $the_date_final = $the_date_year .", ". $the_date_month_final .", ". $the_date_day .", ". $the_time_hour .", ". $the_time_minutes;
				    ?>


				    var launch = new Date(<?php echo $the_date_final; ?>);
					var time = parseInt(launch.getTime() / 1000, 10);
				    /**
				    * The script
				    **/
				    var days = $('#days');
				    var hours = $('#hours');
				    var minutes = $('#minutes');
				    var seconds = $('#seconds');
				    setDate();
				    function setDate(){
				        var now = new Date();
						var time_tmp = parseInt(now.getTime() / 1000, 10);
						var restant = time - time_tmp;
				        
				        if( launch < now ){
				            days.html('<h1>0</h1><p>Day</p>');
				            hours.html('<h1>0</h1><p>Hour</p>');
				            minutes.html('<h1>0</h1><p>Minute</p>');
				            seconds.html('<h1>0</h1><p>Second</p>');
				        }
				        else{
				        	
							var d = parseInt((restant / (60 * 60 * 24)), 10);
							var h = parseInt((restant / (60 * 60) - d * 24), 10);
							var m = parseInt((restant / 60 - d * 24 * 60 - h * 60), 10);
							var s = parseInt((restant - d * 24 * 60 * 60 - h * 60 * 60 - m * 60), 10);
				            days.html('<h1>'+d+'</h1><p>Day'+(d>1?'s':''),'</p>');
				            hours.html('<h1>'+h+'</h1><p>Hour'+(h>1?'s':''),'</p>');
				            minutes.html('<h1>'+m+'</h1><p>Minute'+(m>1?'s':''),'</p>');
				            seconds.html('<h1>'+s+'</h1><p>Second'+(s>1?'s':''),'</p>');
				            setTimeout(setDate, 1000);
				        }
				    }
				});
			    </script>
			    <!-- END -->
			 <?php else : ?>
			 	<!-- START POST -->
				<div class="post row animate_left_right">
					<div class="col-md-12">
						<h3 class="post-title center"><?php _e( 'You have to login to see this private event.', 'tee' ); ?></h3>
					</div>
				</div>
				<!-- END POST -->
			 <?php endif; ?>
	  	</section>
  	</div>
  	<!-- END MAIN CONTAINER -->
  	
	<!-- SUBSCRIBE FORM-->
	
	<?php if(get_post_meta( get_the_ID(), 'tee_event_subscribe', true ) == true) { ?>
	<!-- PHP ALERTS FROM THE FORMS -->
	<?php if(isset($emailSent) && $emailSent == true) { ?>
	    <div class="alert-success alert subscribe-alert" >
	        <a class="close icon" data-dismiss="alert" href="#"><span class="icon icon-cross"></span></a>
	        <strong><?php _e("Thanks","tee"); ?><?php echo', '. $name  .'.';?></strong>
	            <p><?php _e("Your subscription was sent successfully.","tee"); ?></p>
	    </div><!-- .alert -->
	<?php } ?>
	<?php if(isset($hasError) && $hasError == true) { ?>
	    <div class="alert-danger alert subscribe-alert">
	        <a class="close icon" data-dismiss="alert" href="#"><span class="icon icon-cross"></span></a>
	        <strong><?php _e("Sorry,","tee"); ?></strong>
	        <p><?php _e("Your subscription can't be send...check if your email is correct otherwise a field is missing...","tee"); ?></p>
	    </div><!-- .alert -->
	<?php } ?>
	<div id="subscribe-container">
		<div id="subscribe">
			<form class="form-horizontal" method="post" action="<?php echo get_permalink( $post->ID ); ?>" id="form">
				<a href="javascript:void(0)" class="clearfix" id="close-subscribe"><i class="icon-cross"></i></a>
				<span id="subscribe-view">* <?php _e("Only mobile: better rendering on a desktop/laptop, or zoom out","tee"); ?></span>
				<div class="form-group">
					<label for="subscribe_first" class="col-lg-2 control-label"><?php _e("First Name","tee"); ?></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="subscribe_first" name="subscribe_first">
					</div>
				</div>
				<div class="form-group">
					<label for="subscribe_last" class="col-lg-2 control-label"><?php _e("Last Name","tee"); ?></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="subscribe_last" name="subscribe_last">
					</div>
				</div>
				<div class="form-group">
					<label for="subscribe_email" class="col-lg-2 control-label"><?php _e("Email","tee"); ?></label>
					<div class="col-lg-10">
					 	<input type="email" class="form-control" id="subscribe_email" name="subscribe_email">
					</div>
				</div>
				<div class="form-group">
					<label for="subscribe_phone" class="col-lg-2 control-label"><?php _e("Phone number","tee"); ?></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="subscribe_phone" name="subscribe_phone">
					</div>
				</div>
				<div class="form-group">
					<label for="subscribe_address" class="col-lg-2 control-label"><?php _e("Address","tee"); ?></label>
					<div class="col-lg-10">
						<textarea class="form-control" rows="3" id="subscribe_address" name="subscribe_address"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="subscribe_comment" class="col-lg-2 control-label"><?php _e("Comment","tee"); ?></label>
					<div class="col-lg-10">
						<textarea class="form-control" rows="3" id="subscribe_comment" name="subscribe_comment"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
					 	<input type="hidden" name="submitted" id="submitted" value="true" />
					 	<button type="submit" class="btn btn-default" name="submitted"><i class="icon-paperplane"></i><?php _e("Subscribe","tee"); ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php } ?>

<?php endwhile; ?>
	
<?php get_footer(); ?>