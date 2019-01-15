<?php
/**
 * The template for displaying contact shortcode
 */
?>
<?php
/*
 * CONTACT FORM
 */
//If the form is submitted
if(isset($_POST['submitted'])) { 
    //Check to make sure that the name field is not empty
    if($_POST['contact_name'] === '') { 
            $hasError = true;
    } else {
            $name = $_POST['contact_name'];
    }

    //Check to make sure sure that a valid email address is submitted
    if($_POST['contact_email'] === '')  { 
            $hasError = true;
    } else if (!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $_POST['contact_email'])) {
            $hasError = true;
    } else {
            $email = $_POST['contact_email'];
    }

    //Check to make sure comments were entered	
    if($_POST['contact_textarea'] === '') {
            $hasError = true;
    } else {
            if(function_exists('stripslashes')) {
                    $comments = stripslashes($_POST['contact_textarea']);
            } else {
                    $comments = $_POST['contact_textarea'];
            }
    }

    //If there is no error, send the email
    if(!isset($hasError)) {

            $emailTo = get_option('tee_mail');
            $subject = __("Message From Your Website","tee");
            $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
            $headers = 'From : my site <'.$emailTo.'>' . "\r\n" . 'answer to : ' . $email;

            mail($emailTo, $subject, $body, $headers);

            $emailSent = true; 
    }
    
}
?>
<div id="contact-container">
	<!-- PHP ALERTS FROM THE FORMS -->
	<?php if(isset($emailSent) && $emailSent == true) { ?>
	    <div class="alert-success alert" >
	        <a class="close icon" data-dismiss="alert" href="#"><span class="icon icon-cross"></span></a>
	        <strong><?php _e("Thanks","tee"); ?><?php echo', '. $name  .'.';?></strong>
	            <p><?php _e("Your message was sent successfully. You will receive a response shortly.","tee"); ?></p>
	    </div><!-- .alert -->
	<?php } ?>
	<?php if(isset($hasError) && $hasError == true) { ?>
	    <div class="alert-danger alert">
	        <a class="close icon" data-dismiss="alert" href="#"><span class="icon icon-cross"></span></a>
	        <strong><?php _e("Sorry,","tee"); ?></strong>
	        <p><?php _e("Your message can't be send...check if your email is correct otherwise a field is missing...","tee"); ?></p>
	    </div><!-- .alert -->
	<?php } ?>
	<!-- END ALERT -->
	<!-- CONTACT FORM -->
	<div class="center form-header">
		<h3><?php echo $title_final ?></h3>
		<?php if($informations_final == "true") { ?>
			<a href="javascript:void(0)" id="open-address"><?php _e("Information","tee"); ?> <i class="icon-arrow-right3"></i></a>
		<?php } ?>
	</div>
	<form class="form-horizontal" method="post" action="<?php echo get_permalink( $post->ID ); ?>" id="form">
		
		<div class="form-group">
			<label for="contact_name" class="col-lg-2 control-label"><?php _e("Name","tee"); ?></label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="contact_name" name="contact_name">
			</div>
		</div>
		<div class="form-group">
			<label for="contact_email" class="col-lg-2 control-label"><?php _e("Email","tee"); ?></label>
			<div class="col-lg-10">
			 	<input type="email" class="form-control" id="contact_email" name="contact_email">
			</div>
		</div>
		<div class="form-group">
			<label for="contact_textarea" class="col-lg-2 control-label"><?php _e("Message","tee"); ?></label>
			<div class="col-lg-10">
				<textarea class="form-control" rows="3" id="contact_textarea" name="contact_textarea"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			 	<input type="hidden" name="submitted" id="submitted" value="true" />
			 	<button type="submit" class="btn btn-default" name="submitted"><i class="icon-paperplane"></i><?php _e("Send","tee"); ?></button>
			</div>
		</div>
	</form>
	<?php if($informations_final == "true") { ?>
		<!-- CONTACT TEXT -->
		<div id="address">
			<a href="javascript:void(0)" id="close-address"><i class="icon-cross"></i></a>
			<div class="center">
				<h3><?php _e("Information","tee"); ?></h3>
			</div>
			<p class="center">
				<?php if(get_option('tee_address')!=""){ echo get_option('tee_address'); } ?> <br/>
				<?php if(get_option('tee_phone')!=""){ ?><strong><?php _e("Phone","tee"); ?>: <?php echo get_option('tee_phone'); ?></strong><br/><?php } ?>
				<?php if(get_option('tee_fax')!=""){ ?><strong><?php _e("Fax","tee"); ?>: <?php echo get_option('tee_fax'); ?></strong><br/><?php } ?>
			</p>
		</div>
	<?php } ?>
</div>