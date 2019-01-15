<?php

add_action('init','propanel_of_options');

if (!function_exists('propanel_of_options')) {
function propanel_of_options(){

//Theme Shortname
$shortname = "tee";


//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');


//Access the WordPress Pages via an Array
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tt_pages_obj as $tt_page) {
$tt_pages[$tt_page->ID] = $tt_page->post_name; }
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:"); 


//Access the WordPress Categories via an Array
$tt_categories = array();  
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "Select a category:");

$menu_layouts = array("1","2");
$event_order = array("ascending","descending");
$dateformats = array("Day Month Year","Month Day Year");
/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall


/* Option Page 1 - GENERAL */
$options[] = array( "name" => __('General','tee'),
			"type" => "heading");
			
$options[] = array( "name" => __('Design Customization','tee'),
			"desc" => "",
			"id" => $shortname."_alert",
			"std" => "If you want to change the fonts,colors or background please use the Customize button with Wordpress (Appearance->Customize).",
			"type" => "info");			

$options[] = array( "name" => __('Website Logo','tee'),
			"desc" => __('Upload a custom logo for your Website.','tee'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");
			
$options[] = array( "name" => __('Boxed Layout ?','tee'),
			"desc" => __('Enable the boxed layout (for all the website).','tee'),
			"id" => $shortname."_boxed",
			"std" => "false",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Slider on HomePage ?','tee'),
			"desc" => __('Display revolution slider "home" on the home page','tee'),
			"id" => $shortname."_slider_home",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Buddypress private','tee'),
			"desc" => __('Do you want to display all the members pages (buddypress) private, 
			only for not-logged user ? will display the login form instead of the content..','tee'),
			"id" => $shortname."_buddypress_private",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Events order ?','tee'),
			"desc" => __('Otherwise, it will be ascending order.','tee'),
			"id" => $shortname."_events_order",
			"std" => "ascending",
			"type" => "select",
			"options" => $event_order);

$options[] = array( "name" => __('Events Date format ?','tee'),
			"id" => $shortname."_events_date_format",
			"std" => "Month Day Year",
			"type" => "select",
			"options" => $dateformats);

$options[] = array( "name" => __('Number of images displayed in the gallery page','tee'),
			"desc" => __('','tee'),
			"id" => $shortname."_gallery_display",
			"std" => "12",
			"type" => "text");

			
$options[] = array( "name" => __('Headlines Decorations ','tee'),
			"desc" => __('Do you want to see the decorations under the titles.','tee'),
			"id" => $shortname."_headline_seperation",
			"std" => "true",
			"type" => "checkbox");
						
$options[] = array( "name" => __('Enable CSS3 Animations ?','tee'),
			"desc" => __('Do you want to animate all your content with some fresh CSS3 animations','tee'),
			"id" => $shortname."_animations",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Favicon','tee'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. </em>','tee'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");
									
$options[] = array( "name" => __('Bookmark icon for IOS (retina)','tee'),
			"desc" => __('Upload a 114px x 114px image displayed on your Apple\'s devices.','tee'),
			"id" => $shortname."_ios_114",
			"std" => "",
			"type" => "upload");	
			
$options[] = array( "name" => __('Bookmark icon for IOS (not retina)','tee'),
			"desc" => __('Upload a 72px x 72px image displayed on your Apple\'s devices.','tee'),
			"id" => $shortname."_ios_72",
			"std" => "",
			"type" => "upload");
								   
$options[] = array( "name" => __('Tracking Code','tee'),
			"desc" => __('Paste Google Analytics (or other) tracking code here.','tee'),
			"id" => $shortname."_google_analytics",
			"std" => "",
			"type" => "textarea");
								   
$options[] = array( "name" => __('Custom CSS','tee'),
			"desc" => __('Add some custom CSS code here if you want.','tee'),
			"id" => $shortname."_custom_css",
			"std" => "",
			"type" => "textarea");
			
$options[] = array( "name" => __('Custom JS','tee'),
			"desc" => __('Add some custom Javascript code here if you want.','tee'),
			"id" => $shortname."_custom_js",
			"std" => "",
			"type" => "textarea");
				
/* Option Page 2 - HEADER */
$options[] = array( "name" => __('Header','tee'),
			"type" => "heading");
				
$options[] = array( "name" => __('Display Top Bar ?','tee'),
			"desc" => __('Top bar with the contact informations and the languages','tee'),
			"id" => $shortname."_top_bar",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Header height','tee'),
			"desc" => __('height of the header (in pixel)','tee'),
			"id" => $shortname."_header_height",
			"std" => "300",
			"type" => "text");
			
$options[] = array( "name" => __('Logo Size','tee'),
			"desc" => __('Width of the logo\'s image (in pixel)','tee'),
			"id" => $shortname."_logo_size",
			"std" => "300",
			"type" => "text");
			
$options[] = array( "name" => __('Logo Margins','tee'),
			"desc" => __('Margins logo (top, right, bottom, left)','tee'),
			"id" => $shortname."_logo_margins",
			"std" => "100px auto 0px auto",
			"type" => "text");

$options[] = array( "name" => __('Menu Layout','framework_localize'),
			"desc" => __('Choose your menu layout. "1"is default menu (centered logo, menu below), "2" is menu at the right and the logo at the left.','framework_localize'),
			"id" => $shortname."_menu_layout",
			"std" => "1",
			"type" => "select",
			"options" => $menu_layouts);
			
$options[] = array( "name" => __('Fixed Navigation','tee'),
			"desc" => __('Do you want the header navigation to be fixed on scroll.','tee'),
			"id" => $shortname."_menu_fixed",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Fixed Logo','tee'),
			"desc" => __('Upload a custom logo for your the fixed navbar.','tee'),
			"id" => $shortname."_fixed_logo",
			"std" => "",
			"type" => "upload");
			
$options[] = array( "name" => __('Menu Margins','tee'),
			"desc" => __('Margins of the menu (top, right, bottom, left)','tee'),
			"id" => $shortname."_menu_margins",
			"std" => "20px 0 60px 0",
			"type" => "text");

$options[] = array( "name" => __('Submenu Opacity','tee'),
			"desc" => __('A number between 0 and 1 for the opacity of the background.','tee'),
			"id" => $shortname."_submenu_opacity",
			"std" => ".1",
			"type" => "text");
			
$options[] = array( "name" => __('Menu font, bold ?','tee'),
			"desc" => __('Bold option for the menu\'s text','tee'),
			"id" => $shortname."_menu_bold",
			"std" => "false",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Search Form ?','tee'),
			"desc" => __('The magnifying glass into the menu which allow your visitor to access to the search form directly from the menu.','tee'),
			"id" => $shortname."_search",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Display Social icons into the Top Bar ?','tee'),
			"desc" => __('','tee'),
			"id" => $shortname."_header_social",
			"std" => "false",
			"type" => "checkbox");
			
/* Option Page 3 - FOOTER */
$options[] = array( "name" => __('Footer','tee'),
			"type" => "heading");
			
$options[] = array( "name" => __('Footer text','tee'),
			"desc" => __('Text into the footer with the copyright.','tee'),
			"id" => $shortname."_footer",
			"std" => '&#169; Copyright - <a href="http://www.2f-design.fr">2F design</a>',
			"type" => "textarea");
				
/* Option Page 4 - SOCIAL NETWORKS */
$options[] = array( "name" => __('Social-Networks','tee'),
			"type" => "heading");

$options[] = array( "name" => __('Enable a network','tee'),
			"desc" => "",
			"id" => $shortname."_enable",
			"std" => "To enable a network please set your URL in the appropriate field.",
			"type" => "info");	
			
$options[] = array( "name" => __('New window ?','tee'),
			"desc" => __('Open social link in a new window after clicking','tee'),
			"id" => $shortname."_social_window",
			"std" => "false",
			"type" => "checkbox");
						
$options[] = array( "name" => __('facebook','tee'),
			"desc" => "Your facebook URL",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text");	
						
$options[] = array( "name" => __('twitter','tee'),
			"desc" => "Your twitter URL",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text");	
						
$options[] = array( "name" => __('vimeo','tee'),
			"desc" => "Your vimeo URL",
			"id" => $shortname."_vimeo",
			"std" => "",
			"type" => "text");	
						
$options[] = array( "name" => __('google plus','tee'),
			"desc" => "Your google plus URL",
			"id" => $shortname."_googleplus",
			"std" => "",
			"type" => "text");	
						
$options[] = array( "name" => __('flickr','tee'),
			"desc" => "Your flickr URL",
			"id" => $shortname."_flickr",
			"std" => "",
			"type" => "text");	
						
$options[] = array( "name" => __('pinterest','tee'),
			"desc" => "Your pinterest URL",
			"id" => $shortname."_pinterest",
			"std" => "",
			"type" => "text");	
						
$options[] = array( "name" => __('tumblr','tee'),
			"desc" => "Your tumblr URL",
			"id" => $shortname."_tumblr",
			"std" => "",
			"type" => "text");	
						
$options[] = array( "name" => __('instagram','tee'),
			"desc" => "Your instagram URL",
			"id" => $shortname."_instagram",
			"std" => "",
			"type" => "text");
						
$options[] = array( "name" => __('linkedin','tee'),
			"desc" => "Your linkedin URL",
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text");
						
$options[] = array( "name" => __('rss','tee'),
			"desc" => "Your RSS feed URL",
			"id" => $shortname."_rss",
			"std" => "",
			"type" => "text");
			
/* Option Page 5 - CONTACT INFORMATIONS */
$options[] = array( "name" => __('Contact-Informations','tee'),
			"type" => "heading");							
					
$options[] = array( "name" => __('Address','tee'),
			"id" => $shortname."_address",
			"std" => "2301 Alton Road, Miami Beach, FL 33140 ",
			"type" => "textarea");
			
$options[] = array( "name" => __('Mail','tee'),
			"desc" => "Used also for the contact form.",
			"id" => $shortname."_mail",
			"std" => "",
			"type" => "text");
			
$options[] = array( "name" => __('Phone','tee'),
			"desc" => "The format you want.",
			"id" => $shortname."_phone",
			"std" => "",
			"type" => "text");
						
$options[] = array( "name" => __('Fax','tee'),
			"desc" => "The format you want.",
			"id" => $shortname."_fax",
			"std" => "",
			"type" => "text");

update_option('of_template',$options); 					  
update_option('of_shortname',$shortname);

}
}
?>