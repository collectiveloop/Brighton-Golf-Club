<?php
/**
 * CUSTOME LOGIN FOR WORDPRESS DISPLAY AS A MDOAL
 */
//CUSTOM LOGIN FORM
 function tee_login_form() {
	$output = '
		<!-- SIGN IN CONTENT-->
		<div id="signin-container">
			<div id="signin">
				<a href="javascript:void(0)" class="clearfix" id="close-signin"><i class="icon-cross"></i></a>
			  	<div class="heading">
				  	<h1>';
	$output .= __("Sign In", "Tee");			
	$output .= sprintf('	  	
				  	</h1>
				  	<hr>
	  			</div>
				<form class="form-horizontal" name="loginform" id="loginform" action="%s" method="post">
				  <div class="form-group">
				    <label for="log" class="col-sm-3 control-label">%s</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" name="log" placeholder="Name">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="pwd" class="col-sm-3 control-label">%s</label>
				    <div class="col-sm-9">
				      <input type="password" class="form-control" name="pwd" placeholder="Password">
				    </div>
				  </div>',
					site_url('wp-login.php', 'login_post'),
					__('Login','tee'),
					__('Password','tee')
	);
	ob_start();
	do_action('login_form');
	$output .= ob_get_clean();
	$output .= sprintf('
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      <div class="checkbox">
				        <label>
				          <input name="rememberme"  id="rememberme" type="checkbox"> %s
				        </label>
				      </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="center">
				        <button tabindex="100" type="submit" name="wp-submit" class="btn btn-default"><i class="icon-checkmark"></i> %s</button>
						<input type="hidden" name="testcookie" value="1" />
				    </div>
				  </div>',
		__('Remember Me', 'tee'),
		__('Log In', 'tee')
	);	$output .= '
			</form>
		</div>
	</div>';
	
	echo $output;
}
add_action('wp_footer','tee_login_form');
