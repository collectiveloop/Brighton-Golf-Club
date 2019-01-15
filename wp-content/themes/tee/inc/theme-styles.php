<?php
function tee_styles() {
	if (!is_admin()) {
		wp_register_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css', '', '', 'screen, all');
		wp_enqueue_style('bootstrap-css');
		wp_register_style('general-css', get_stylesheet_uri(), '', '', 'screen, all');
		wp_enqueue_style('general-css');
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'mytheme-font1', "$protocol://fonts.googleapis.com/css?family=". get_theme_mod( 'font1', "Open Sans") .":400italic,400,600,700" );
	    wp_enqueue_style( 'mytheme-font2', "$protocol://fonts.googleapis.com/css?family=". get_theme_mod( 'font2', "Playfair Display") .":400,700,400italic" );
	}
}
add_action('wp_enqueue_scripts', 'tee_styles',20,1);

function tee_custom_styles() {
?>
			<style type="text/css">
				/*FONTS*/
				body,
				.buddypress-container .buddypress-page-title h1,
				#buddypress h1,
				#buddypress h2,
				#buddypress h3,
				#buddypress div.profile h4,
				.item-title a{
					<?php 
					$font1 = get_theme_mod( 'font1', "Open Sans");
					$font1_f = str_replace('+',' ', $font1);
					?>
					font-family: "<?php echo $font1_f ?>" ,"Helvetica Neue",Helvetica, arial, serif;
				}
				h1, h2, h3, h4, h5, h6,
				#navigation li,
				#copyright,
				.btn-default,
				.minus, .plus,
				.gallery-item a span,
				.caption,
				.comment-meta,
				.table th, .table tr td:first-child,
				#main-container blockquote,
				#main-cotainer .pagination>li>a,
				#main-container .dropcap,
				#contact-container,
				.member-forum-table .row:first-child,
				.post .post-author a span,
				.event-card,
				.event-data,
				.course-card,
				.course-data,
				#current_weather,
				#current_temperature,
				.wpcf7-form p,
				.breadcrumbs,
				#product-reviews .meta{
					<?php 
					$font2 = get_theme_mod( 'font2', "Playfair Display");
					$font2_f = str_replace('+',' ', $font2);
					?>
					font-family: "<?php echo $font2_f ?>",Georgia, serif;
				}
				body{
					font-size: <?php echo get_theme_mod( 'font_size_body', "1.6em"); ?>;
				}
				h1{
					font-size: <?php echo get_theme_mod( 'font_size_h1', "2.6em"); ?>;
				}
				h2{
					font-size: <?php echo get_theme_mod( 'font_size_h2', "2em"); ?>;
				}
				p{
					line-height: <?php echo get_theme_mod( 'main_line_height', "1.8em"); ?>;
				}
				/*COLORS*/
				#main-container .pagination>.active>a,
				#main-container .pagination>.active>span,
				#main-container .pagination>.active>a:hover,
				.widget.buddypress #bp-login-widget-form input[type="submit"],
				.search-container form button{
					background: <?php echo get_theme_mod( 'tee_color1', '#555'); ?>;
				}
				#header #mobile-menu span,
				.search-container input[type="text"],
				.widget select,
				#header #topbar h4.tee-mini-cart-subtotal,
				#header #topbar .tee-mini-cart-title h4,
				#header.fixed_navigation #navigation ul li a,
				#header.fixed_navigation #navigation .menu-search a span{
					color: <?php echo get_theme_mod( 'tee_color1', '#555'); ?> !important;
				}
				#header *{
					color: <?php echo get_theme_mod( 'tee_header_color', '#FFF'); ?>;
				}
				body,
				a:hover,
				#main-container ul.pagination>li>a,
				#main-container #sidebar .widget ul li:before,
				.flexslider .slides .event,
				.flexslider .slides .course,
				#events-container .event,
				#courses-container .course,
				#main-container #events-container .event-content h3 a,
				#main-container #courses-container .course-content h3 a,
				.dropdown-menu>li>a, #close-address,
				.panel-title:before,
				.widget.buddypress div.item .item-title a,
				#open-address,
				.widget.buddypress div.item-options a.selected,
				#signin #close-signin:hover,
				#subscribe #close-subscribe:hover,
				#shop-container .product a,
				.star-rating span:before,
				.comment-form-rating .stars a:hover,
				.comment-form-rating .stars a.active,
				.variations .label{
					color: <?php echo get_theme_mod( 'tee_color1', '#555'); ?>;
				}
				#main-container .pagination>.active>a,
				#main-container .pagination>.active>span,
				#main-container .pagination>.active>a:hover,
				#main-container .event-card hr,
				#main-container .course-card hr,
				.wpb_vc_table td.vc_table_cell,
				.table>tbody>tr>td,
				.table>tbody>tr>th,
				.table>tfoot>tr>td,
				.table>tfoot>tr>th{
					border-color: <?php echo get_theme_mod( 'tee_color1', '#555'); ?> !important;
				}
				a,
				.btn-default i,
				.colored, #main-container .dropcap,
				.staff span,
				.post .post-date,
				.post .post-comments,
				.post .post-tags,
				.post-likes,
				.post-categories,
				.flexslider .slides .event-data,
				.flexslider .slides .course-data,
				#events-container .event-data,
				#courses-container .course-data,
				.dropdown-menu>li, 
				#main-container .event-card h2,
				#main-container .course-card h2,
				.timer_box:before,
				.timer_box p,
				#testimonials li:before,
				#testimonials li span,
				#open-address:hover,
				#signin .btn-default i,
				#subscribe .btn-default i,
				.widget.buddypress div.item .item-title a:hover,
				.widget.buddypress span.activity,
				#signin #close-signin,
				#subscribe #close-subscribe,
				.topic-info, #members-container .member h4, 
				#footer a,
				#subscribe-view,
				#shop-container .product a:hover,
				#product-reviews .meta,
				.comment-form-rating .stars a{
					color: <?php echo get_theme_mod( 'tee_color2', '#CCC'); ?>;
				}
				#main-container ul.pagination>li>a,
				.search-container input[type="text"],
				.widget select,
				.minus, .plus,
				.member-forum-table .row,
				#signin .heading hr{
					border-color: <?php echo get_theme_mod( 'tee_color2', '#CCC'); ?>;
				}
				#header #topbar *{
					color: <?php echo get_theme_mod( 'tee_color2', '#CCC'); ?> !important;
				}
				/*MENU*/
				<?php if(get_option('tee_logo_size') != "300"){ ?>
					#logo{
						width: <?php echo esc_html(get_option('tee_logo_size')); ?>px;
					}	
				<?php } else { ?>
					#logo{
						width: 300px;
					}
				<?php } ?>
				<?php if(get_option('tee_logo_margins') != "100px auto 0px auto"){ ?>
					#logo{
						margin: <?php echo esc_html(get_option('tee_logo_margins')); ?>;
					}	
				<?php } else { ?>
					#logo{
						margin: 100px auto 0px auto;
					}
				<?php } ?>
				<?php if (get_option('tee_menu_bold') == "true"){ ?>
					#navigation ul li a{
						font-weight: bold;
					}
				<?php } ?>

				#navigation ul.sub-menu li a{background: rgba(0,0,0, <?php echo get_option('tee_submenu_opacity'); ?>);}

				<?php if(get_option('tee_menu_margins') != "20px 0 60px 0"){ ?>
					#navigation{
						margin: <?php echo esc_html(get_option('tee_menu_margins')); ?>;
					}	
				<?php } else { ?>
					#navigation{
						margin: 20px 0 60px 0;
					}
				<?php } ?>
				/*BACKGROUNDS*/
				<?php if(get_option('tee_header_height') != "300"){ ?>
					#background.small{
						height: <?php echo esc_html(get_option('tee_header_height')); ?>px;
					}	
				<?php } else { ?>
					#background.small{
						height: 300px;
					}
				<?php } ?>
				<?php if (get_option('tee_boxed') == "true"){ ?>
				body{
					<?php $imageUrlBoxed = get_template_directory_uri(). '/images/backgrounds/footer_bg.png'; ?>
					background-image: url("<?php echo get_theme_mod( 'tee_bg_boxed', $imageUrlBoxed); ?>");
					<?php
					$imageUrlBoxedCustom = get_theme_mod( 'tee_bg_boxed', $imageUrlBoxed);
					list($imageUrlBoxed_width, $imageUrlBoxed_height) = getimagesize($imageUrlBoxedCustom);
					echo 'background-size: '. esc_html($imageUrlBoxed_width) .'px '. esc_html($imageUrlBoxed_height) .'px;';
					?>
				}
				<?php } ?>
				#main-container .colored-container{
					<?php $imageUrl1 = get_template_directory_uri(). '/images/backgrounds/content_bg.png'; ?>
					background-image: url("<?php echo get_theme_mod( 'tee_bg', $imageUrl1); ?>");
					<?php
					$imageUrl1Custom = get_theme_mod( 'tee_bg', $imageUrl1);
					list($bg_width, $bg_height) = getimagesize($imageUrl1Custom);
					echo 'background-size: '. esc_html($bg_width) .'px '. esc_html($bg_height) .'px;';
					?>
				}
				#footer, 
				.event-card,
				.course-card,
				.table,
				.table-responsive,
				#members-directory-form, 
				#groups-directory-form, 
				#create-group-form,
				#buddypress .activity[role=main],
				#members-directory-form, 
				#groups-directory-form,
				#create-group-form,
				#buddypress.activity-page,
				#buddypress #item-header,
				#buddypress form#whats-new-form{
					<?php $imageUrl2 = get_template_directory_uri(). '/images/backgrounds/footer_bg.png'; ?>
					background-image: url("<?php echo get_theme_mod( 'tee_bg2', $imageUrl2); ?>");
					<?php
					$imageUrl2Custom = get_theme_mod( 'tee_bg2', $imageUrl2);
					list($bg2_width, $bg2_height) = getimagesize($imageUrl2Custom);
					echo 'background-size: '. esc_html($bg2_width) .'px '. esc_html($bg2_height) .'px;';
					?>
				}
				/* Retina Screen */
				@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
					   only screen and (min--moz-device-pixel-ratio: 1.5),
					   only screen and (min-device-pixel-ratio: 1.5){
					   <?php if (get_option('tee_boxed') == "true"){?>
						body{
							<?php $imageUrlBoxed_retina = get_template_directory_uri(). '/images/backgrounds/footer_bg@2X.png'; ?>
							background-image: url("<?php echo get_theme_mod( 'tee_bg_boxed_retina', $imageUrlBoxed_retina); ?>");
							<?php
							echo 'background-size: '. esc_html($imageUrlBoxed_width) .'px '. esc_html($imageUrlBoxed_height) .'px;';
							?>
						}
						<?php } ?>
						#main-container .colored-container{
							<?php $imageUrl3 = get_template_directory_uri(). '/images/backgrounds/content_bg@2X.png'; ?>
							background-image: url("<?php echo get_theme_mod( 'tee_bg_retina', $imageUrl3); ?>");
							<?php echo 'background-size: '. esc_html($bg_width) .'px '. esc_html($bg_height) .'px;'; ?>
						}
						#footer, 
						.event-card,
						.table,
						.course-card,
						.table-responsive,
						#members-directory-form, 
						#groups-directory-form, 
						#create-group-form,
						#buddypress .activity[role=main],
						#members-directory-form, 
						#groups-directory-form,
						#create-group-form,
						#buddypress.activity-page,
						#buddypress #item-header,
						#buddypress form#whats-new-form{
							<?php $imageUrl4 = get_template_directory_uri(). '/images/backgrounds/footer_bg@2X.png'; ?>
							background-image: url("<?php echo get_theme_mod( 'tee_bg2_retina', $imageUrl4); ?>");
							<?php echo 'background-size: '. esc_html($bg2_width) .'px '. esc_html($bg2_height) .'px;'; ?>
						}
				}
				<?php if (get_option('tee_animations') != "true"){ ?>
					.animate_bottom_top, .animate_top_bottom, .animate_left_right, .animate_right_left, .animate_fade{
						opacity: 1 !important; 
				        -webkit-animation: none!important;
				        animation: none!important
					}
				<?php } ?>
				
				<?php if (get_option('tee_headline_seperation') == "false"){ ?>
					#main-container .heading h1:after,#main-container .heading hr{display: none !important;}
					#main-container .heading h1{margin: 0;}
				<?php } ?>
				
				/* CUSTOM CSS */
				<?php echo esc_html(get_option('tee_custom_css')); ?>
			</style>
		<?php
}