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
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54aed0d7456a9e4e"></script>
<style type="text/css">
.g-recaptcha div {
  margin: 0 auto;
}

div.wpcf7-mail-sent-ok {
  border: 0px solid !important;
  color: #fff !important;
}

div.wow_news {
  min-height: 320px;
}

.title h3::after {
  width: 100%;
}
.sidebar_widget_footer p.icit-credit-link {
  display: none;
}
#icit_weather_widget-2 .weather-wrapper .weather-forecast, .main {
  background-color: inherit !important;
}

.forth_colum{overflow:hidden;margin-left:-5px}
.single_colum_clubrroms{float:left;width:24%;margin-left:5px}
.single_colum_clubrroms p{margin:0px}


/*Blog Pages*/

div.pagination a, span.current {
  background-color: #921f60;
  color: #fff;
  display: inline-block;
  font-size: 20px;
  margin-left: 5px;
  padding: 5px 10px;
}
#paged_s {
  background: #fff none repeat scroll 0 0;
  border-radius: 500px;
  margin: 0 auto;
  text-align: center;
  width: 280px;
}
div.pagination {
  margin: 0;
}

#paged_s div.pagination span.current,div.pagination a:hover{background-color:#430829;text-decoration:none}

.new_blog_post_height{background-color: #fff;
margin-bottom: 20px;
height: 700px;}

.new_blog_post_single_content h2{color: #4a9448;
font-size: 27px;
font-weight: bold;
margin-top: 0px;
text-transform: uppercase;}
.new_blog_post_height img {
  width: 100%;
  margin-bottom: 10px;
}
/*Single Post style*/
.single_post_img_left {
  margin-top: 10px;
}
#blog_single_post_f_t_share h2 {
  padding-top: 30px;
  color: #4a9448;
font-size: 27px;
font-weight: bold;
margin-top: 10px;
text-transform: uppercase;
}

.single_post__share_befits_promo_content {
  padding: 0 35px 10px;
}

.single_post__share_befits_promo_content p {
  color: #000;
  font-size: 18px;
}





@media only screen and (min-width: 992px) and (max-width: 1200px) {

}
/* Tablet Layout: 768px. */

@media only screen and (min-width: 768px) and (max-width: 991px) {
/*For Blog*/
.new_blog_post_height {
  height: 570px;

}


}
/* Mobile Layout: 320px. */

@media only screen and (max-width: 767px) {

/*For Blog*/

.new_blog_post_height {
  height: auto;
}
.new_blog_post_height img {
  height: auto;
}

.single_colum_clubrroms {width: 48%;}

/*Single post */
.single_post_img_left {
  float: none;
  height: auto;
  margin-top: 10px;
  width: 100% !important;
}
.single_post__share_befits_promo_content p {
  font-size: 15px;
}
#blog_single_post_f_t_share h2 {
  font-size: 22px;
}
.single_post__share_befits_promo_content {
  padding: 0 10px;
}


}
/* Wide Mobile Layout: 480px. */
@media only screen and (min-width: 480px) and (max-width: 767px) {

}

</style>



		<header class="header_top_area" id="header_top_area">
			<div class="container">
			<div class="row">
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
			</div>
			
		</header>