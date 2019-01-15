<?php
/**
 * The Header for our theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- MAKE IT RESPONSIVE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if (get_option('tee_favicon') != ""){ ?>
		<!-- FAVICON -->	
		<link rel="shortcut icon" href="<?php echo get_option('tee_favicon'); ?>" />
    <?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php if (get_option('tee_ios_114') != ""): ?>
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_option('tee_ios_114'); ?>" />
	<?php endif; ?>
	<?php if (get_option('tee_ios_72') != ""): ?>
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_option('tee_ios_72'); ?>" />
	<?php endif; ?>
	<!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
	<?php tee_custom_styles(); ?>
</head>

<body <?php body_class(); ?>>
  	<div id="page" <?php if (get_option('tee_boxed') == "true"){ echo 'class="boxed"'; } ?>>
	  	<!-- START HEADER -->
	  	<header id="header" <?php if (get_option('tee_menu_layout') == "2"){ echo 'class="layout_2"'; } ?>>
	  		<?php if (get_option('tee_top_bar') == "true"){ ?>
		  		<div id="topbar" class="animate_top_bottom">
			  		<div class="container">
				  		<ul>
				  			<?php if (get_option('tee_phone') != ""){ ?>
					  			<li><span class="icon-phone"></span><?php echo get_option('tee_phone'); ?></li>
					  		<?php } ?>
					  		<?php if (get_option('tee_mail') != ""){ ?>
					  			<li><span class="icon-mail"></span><a href="mailto:<?php echo get_option('tee_mail'); ?>"><?php echo get_option('tee_mail'); ?></a></li>
					  		<?php } ?>
				  		</ul>
				  		<?php 
				  		if (get_option('tee_header_social') == "true"){
				  			if(get_option('tee_social_window') == "true"){
					  			$target = 'target="_blank"';
				  			}
				  			else{
					  			$target = '';
				  			}
				  		echo '<ul class="list-unstyled header-social">';
					  	if (get_option('tee_facebook') != ""){ 
				  		echo' <li><a href="'. get_option('tee_facebook') .'" '. $target .' title="Join us on Facebook" class="facebook-link"><span class="icon-facebook"></span></a></li>';
				  		}
					  	if (get_option('tee_twitter') != ""){ 
				  		echo' <li><a href="'. get_option('tee_twitter') .'" '. $target .' title="Join us on Twitter" class="twitter-link"><span class="icon-twitter"></span></a></li>';
				  		}
					  	if (get_option('tee_vimeo') != ""){ 
				  		echo' <li><a href="'. get_option('tee_vimeo') .'" '. $target .' title="Join us on Vimeo" class="vimeo-link"><span class="icon-vimeo"></span></a></li>';
				  		}
					  	if (get_option('tee_googleplus') != ""){ 
				  		echo' <li><a href="'. get_option('tee_googleplus') .'" '. $target .' title="Join us on Google Plus" class="googleplus-link"><span class="icon-googleplus"></span></a>
				  			</li>';
				  		}
				  		if (get_option('tee_flickr') != ""){ 
				  		echo' <li><a href="'. get_option('tee_flickr') .'" '. $target .' title="Join us on Flickr" class="flickr-link"><span class="icon-flickr"></span></a></li>';
				  		}
				  		if (get_option('tee_pinterest') != ""){ 
				  		echo' <li><a href="'. get_option('tee_pinterest') .'" '. $target .' title="Join us on Pinterest" class="pinterest-link"><span class="icon-pinterest"></span></a>
				  			</li>';
				  		}
				  		if (get_option('tee_tumblr') != ""){ 
				  		echo' <li><a href="'. get_option('tee_tumblr') .'" '. $target .' title="Join us on Tumblr" class="tumblr-link"><span class="icon-tumblr"></span></a></li>';
				  		}
				  		if (get_option('tee_instagram') != ""){ 
				  		echo' <li><a href="'. get_option('tee_instagram') .'" '. $target .' title="Join us on Instagram" class="instagram-link"><span class="icon-instagram"></span></a>
				  			</li>';
				  		}
				  		if (get_option('tee_linkedin') != ""){ 
				  		echo' <li><a href="'. get_option('tee_linkedin') .'" '. $target .' title="Join us on Linkedin" class="linkedin-link"><span class="icon-linkedin"></span></a></li>';
				  		}
				  		if (get_option('tee_rss') != ""){ 
				  		echo'<li><a href="'. get_option('tee_rss') .'" '. $target .' title="Subscribe to our RSS feed" class="rss-link"><span class="icon-rss"></span></a>
	                    	</li>';
				  		}
		                echo '</ul>'; 
		                }
		                ?>
				  		<ul class="topbar-right">
				  			<?php if (function_exists('is_woocommerce')) { ?>
								<li>
									<a id="tee_cart" href="<?php echo WC()->cart->get_cart_url(); ?>" class="<?php echo sizeof(WC()->cart->get_cart()) > 0 ? 'active' : ''; ?>">
										<i class="icon-cart"></i>
										<span>
											<?php if (sizeof( WC()->cart->get_cart()) > 0) { ?>
												<?php echo WC()->cart->get_cart_subtotal(); ?> 
											<?php } ?>
										</span>
									</a>
									<div id="tee_mini_cart">
										<?php tee_wc_print_mini_cart(); ?>
									</div>
								</li>
							<?php } ?>
			  				<?php if (class_exists('SitePress') or function_exists("transposh_widget")) { ?>
			  					<li>
			  					<?php tee_languages_switcher(); ?>
			  					</li>
			  				<?php } ?>
					  		<?php if ( function_exists('bp_is_active') ) { ?>
					  			<?php tee_buddypress_menu_top(); ?>
							<?php } ?>
				  		</ul>
			  		</div>
		  		</div>
		  	<?php } ?>
		  	<div class="container">
		  		<!-- LOGO -->
			  	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" id="logo">
				  	<?php if (get_option('tee_logo') != ""){ ?>
				  		<img src="<?php echo get_option('tee_logo'); ?>" id="the-logo" alt="<?php _e("Logo Image","tee"); ?>">
				  	<?php } else { ?>
						<h2><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></h2>
						<h4><?php bloginfo( 'description' ); ?></h4>
					<?php }?>
					<?php if (get_option('tee_fixed_logo') != ""){ ?>
				  		<img src="<?php echo get_option('tee_fixed_logo'); ?>" id="fixed-logo" alt="<?php _e("Logo Fixed Image","tee"); ?>">
				  	<?php } ?>
			  	</a>
			  	<!-- MOBILE NAVIGATION -->
	  			<nav id="navigation-mobile"></nav>
			  	<!-- MENU -->
			  	<?php
			  	if(has_nav_menu('primary')) {
			  		?>
			  			<div id="navigation">
			  				<a href="#" id="show-mobile-menu"><span class="icon-list2"></span></a>
			  				<a href="#" id="close-navigation-mobile"><span class="icon-cross2"></span></a>
			  				<?php 
								wp_nav_menu(array(
									'theme_location' => 'primary'
								));
							?>
						</div>
					<?php
				} else {
					?>
						<div id="navigation">
			  				<a href="#" id="show-mobile-menu"><span class="icon-list2"></span></a>
			  				<a href="#" id="close-navigation-mobile"><span class="icon-cross2"></span></a>
							<?php wp_nav_menu(); ?>
						</div>
					<?php
				}
			  	?>
		  	</div>