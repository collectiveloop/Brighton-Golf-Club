<?php
/**
 * The Template for displaying all single course posts.
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
	  				<div class="course-card center animate_right_left">
						<h2><?php _e("Course Information","tee"); ?></h2>
						<p><span class="icon icon-calendar"></span> 
						<?php if(get_post_meta( get_the_ID(), 'tee_course_reccurent', true ) !=""): ?>
							<?php echo get_post_meta( get_the_ID(), 'tee_course_reccurent', true ); ?>
						<?php else : ?>
							<?php echo get_post_meta( get_the_ID(), 'tee_course_date', true ); ?>
						<?php endif; ?>
						</p>
						<p><span class="icon icon-location"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_rendezvous', true ); ?></p>
						<?php if(get_post_meta( get_the_ID(), 'tee_course_places', true ) != ""){ ?>
							<p><span class="icon icon-users"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_places', true ); ?></p>
						<?php } ?>
						<p><span class="icon icon-user"></span> <?php echo get_post_meta( get_the_ID(), 'tee_course_professor', true ); ?></p>
						<?php if(get_post_meta( get_the_ID(), 'tee_course_contact', true ) != "") { ?>
							<div class="center">
								<a href="<?php echo get_post_meta( get_the_ID(), 'tee_course_contact', true ); ?>" class="btn btn-default">
									<i class="icon-mail"></i> <?php _e("Contact the teacher","tee"); ?>
								</a>
							</div>
						<?php } ?>
						<?php if(get_post_meta( get_the_ID(), 'tee_course_subscribe', true ) != "") { ?>
							<div class="center">
								<a href="#" id="open-subscribe" class="btn btn-default">
									<i class="icon-install"></i> <?php _e("Subscribe now","tee"); ?>
								</a>
							</div>
						<?php } ?>
						<hr>
						<h2 class="course-price"><?php echo get_post_meta( get_the_ID(), 'tee_course_price', true ); ?><?php if(get_post_meta( get_the_ID(), 'tee_course_per', true)) : ?><span><?php _e("/hour","tee"); ?></span><?php endif; ?></h2>
		  			</div>
	  			</div>
  			</div>
			<!-- END POST -->
	  	</section>
  	</div>
  	<!-- END MAIN CONTAINER -->
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
				if(get_post_meta( get_the_ID(), 'tee_course_subscribe_email', true ) ===""){
					$emailTo = get_option('tee_mail');
				}	
				else{
					$emailTo = get_post_meta( get_the_ID(), 'tee_course_subscribe_email', true );
				}
				$title = get_the_title();
	            $subject = sprintf( __('New Subscription from your website %d', 'tee'), $title );
	            if(get_post_meta( get_the_ID(), 'tee_course_reccurent', true ) ===""){ 
					$date_for_email = get_post_meta( get_the_ID(), 'tee_course_date', true );
				} else {
					$date_for_email = get_post_meta( get_the_ID(), 'tee_course_reccurent', true ); 
				}
	            $body = "Course: $title \n\nCourse Date: $date_for_email \n\nName: $name_first $name_last \n\nEmail: $email \n\nPhone Number: $phone \n\nAddress: $address\n\nComment: $comment";
	            $headers = 'From : [NEW SUBSCRIPTION] <'.$emailTo.'>' . "\r\n" . 'answer to : ' . $email;
	
	            mail($emailTo, $subject, $body, $headers);
	
	            $emailSent = true; 
	    }
	    
	}
	?><!-- SUBSCRIBE FORM-->
	
	<?php if(get_post_meta( get_the_ID(), 'tee_course_subscribe', true ) == true) { ?>
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