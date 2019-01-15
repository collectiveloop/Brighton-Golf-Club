<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <head>

	<title><?php bloginfo('name'); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiri:400italic,400">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amaranth:400italic,400">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php wp_head();?>
    </head>
    <body>
	<style type="text/css">
	.wrapper{width:1170px;margin:0 auto;display:block;overflow:hidden;}
	.single_footer {
  float: left;
  width: 292px;
}
.single_top_wrapper {
  margin-left: -20px;
  overflow: hidden;
}
.single_footer {
  float: left;
  margin-left: 20px;
  width: 275px;
}
.navbar-nav li {
  border-bottom: 0 none;
  display: inline;
}
.navbar-nav li a {
  display: inline-block;
}
.wrapper nav.custom_navbar ul {
  text-align: center;
}
.ifamre_border iframe{border:0px}
.ifamre_border {
  border: 1px solid #ddd;
  margin-bottom: 20px;
  margin-top: 20px;
  padding-left: 20px;
  padding-top: 20px;
}
.navbar-nav li a {
  color: #fff;
  font-size: 22px;
  font-weight: 300;
}
#icit_weather_widget-2 .weather-wrapper .weather-forecast, .main {
  background-color: inherit !important;
}

/************IPad**************/

@media only screen and (min-width: 992px) and (max-width: 1200px) {







}


/* Tablet Layout: 768px. */

@media only screen and (min-width: 768px) and (max-width: 991px) {
#navigation-area,.footer_top_area,.banner_area{width:1170px;margin:0 auto}


}
/* Mobile Layout: 320px. */

@media only screen and (max-width: 767px) {
#navigation-area,.footer_top_area,.banner_area{width:1170px;margin:0 auto}
div.logo {
  height: 300px;
}

div.logo img {
  height: 300px;
  width: auto;
}

}
/* Wide Mobile Layout: 480px. */

@media only screen and (min-width: 480px) and (max-width: 767px) {


}
</style>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<header class="header_top_area" id="header_top_area">
			<div class="wrapper">
			
				<div class="header_top solve">
					<div class="header_top_left floatleft">
						<?php 

							$facebook_link = get_option_tree( 'facebook', '', false );

							$twitter_link = get_option_tree( 'twitter', '', false );

							$google_plus_link = get_option_tree( 'google_plus', '', false );

							$flicker_link = get_option_tree( 'flicker', '', false );
							$rss_link = get_option_tree( 'rss', '', false );
							$phone_number = get_option_tree( 'phone_hot', '', false );
							$email_address = get_option_tree( 'email_address', '', false );
							$member_login = get_option_tree( 'member_login', '', false );

						?>
						<div class="header_top_content">
							<ul>
								<li><a href="tel:<?php echo $phone_number; ?>"><i class="fa fa-phone"></i>Call Us</a></li>
								<li><a href="mailto:<?php echo $email_address; ?>"><i class="fa fa-envelope"></i>Email Us</a></li>
							</ul>						
						
						</div>
					</div>
					<div class="header_top_right floatright">
						<ul>
							<li><a href="<?php echo $member_login; ?>"><i class="fa fa-male"></i>Login</a></li>
						</ul>

					</div>
				
			
			</div>
			</div>
			
		</header>