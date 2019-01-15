<?php
/**
 * CUSTOMIZE THE VISUAL COMPOSER FOR THE TEMPLATE
 */
 //REMOVE SOME ELEMENTS
 vc_remove_element("vc_wp_search");
 vc_remove_element("vc_wp_meta");
 vc_remove_element("vc_wp_recentcomments");
 vc_remove_element("vc_wp_calendar");
 vc_remove_element("vc_wp_pages");
 vc_remove_element("vc_wp_tagcloud");
 vc_remove_element("vc_wp_custommenu");
 vc_remove_element("vc_wp_text");
 vc_remove_element("vc_wp_search");
 vc_remove_element("vc_wp_posts");
 vc_remove_element("vc_wp_links");
 vc_remove_element("vc_wp_categories");
 vc_remove_element("vc_wp_archives");
 vc_remove_element("vc_wp_rss");
 //CUSTOM ELEMENTS
vc_map( array(
   "name" => __("Tee Separation", "tee"),
   "base" => "separation",
   "class" => "",
   "show_settings_on_create" => false,
   "category" => 'Tee'
));
vc_map( array(
   "name" => __("Tee Sponsors", "tee"),
   "base" => "sponsors",
   "description" => __("Display all the sponsors (only full width please, no columns).", "tee"),
   "class" => "",
   "show_settings_on_create" => false,
   "category" => 'Tee'
));
vc_map( array(
   "name" => __("Tee Staff", "tee"),
   "base" => "staff",
   "description" => __("Display all the staff (only full width please, no columns).", "tee"),
   "class" => "",
   "show_settings_on_create" => false,
   "category" => 'Tee'
));
vc_map( array(
   "name" => __("Tee Courses", "tee"),
   "base" => "courses",
   "description" => __("Display all the courses (only full width please, no columns).", "tee"),
   "class" => "",
   "category" => 'Tee',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button Url", "tee"),
         "param_name" => "button_url",
         "value" => "#",
         "description" => __("Link to the courses page, where all the events are displayed.", "tee")
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number events displayed", "tee"),
         "param_name" => "display",
         "value" => "6",
         "description" => __("Only number please (between 3 and 16, 6 is advised).", "tee")
      )
   )
));
vc_map( array(
   "name" => __("Tee Events", "tee"),
   "base" => "events",
   "description" => __("Display all the events (only full width please, no columns).", "tee"),
   "class" => "",
   "category" => 'Tee',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button Url", "tee"),
         "param_name" => "button_url",
         "value" => "#",
         "description" => __("Link to the events page, where all the events are displayed.", "tee")
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number events displayed", "tee"),
         "param_name" => "display",
         "value" => "6",
         "description" => __("Only number please (between 3 and 16, 6 is advised).", "tee")
      )
   )
));
vc_map( array(
   "name" => __("Tee Gallery", "tee"),
   "base" => "tee_gallery",
   "description" => __("Display all the gallery posts (only full width please, no columns).", "tee"),
   "class" => "",
   "category" => 'Tee',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button Url", "tee"),
         "param_name" => "button_url",
         "value" => "#",
         "description" => __("Link to the gallery page, where all the photos are displayed.", "tee")
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number images displayed", "tee"),
         "param_name" => "display",
         "value" => "14",
         "description" => __("Only number please (between 8 and 32, 14 is advised).", "tee")
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Category", "tee"),
         "param_name" => "category",
         "value" => "",
         "description" => __("If you want to display only a special category just copy/past the slug catgeory.", "tee")
      ),
   )
));
vc_map( array(
   "name" => __("Tee Contact", "tee"),
   "base" => "contact",
   "description" => __("Display the contact form, using the address email typed into the options panel.", "tee"),
   "class" => "",
   "category" => 'Tee',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Form Title", "tee"),
         "param_name" => "title",
         "value" => __("Get in touch now.", "tee")
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Display information in the form ? true or false", "tee"),
         "param_name" => "informations",
         "value" => __("true", "tee")
      )
   )
));
vc_map( array(
   "name" => __("Tee Large Title", "tee"),
   "base" => "title",
   "description" => __("Title which looks like to page title.", "tee"),
   "class" => "",
   "category" => 'Tee',
   "params" => array(
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Heading Title", "tee"),
         "param_name" => "heading_title",
         "value" => __("Title here", "tee")
      )
   )
));
vc_map( array(
   "name" => __("Tee Map", "tee"),
   "base" => "map",
   "description" => "Display the map.",
   "class" => "",
   "category" => 'Tee',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Map Height", "tee"),
         "param_name" => "height",
         "value" => "270"
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("GPS coordinates", "tee"),
         "param_name" => "gps",
         "value" => "25.801541,-80.138023",
         "description" => __('Find out them here -> <a href="http://itouchmap.com/latlong.html">LatLong</a>, just copy/past.', "tee")
      )
   )
));
vc_map( array(
   "name" => __("Tee Button", "tee"),
   "base" => "button_vc",
   "description" => __("Button with theme's style.", "tee"),
   "class" => "",
   "category" => 'Tee',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button Content", "tee"),
         "param_name" => "button_content",
         "value" => __("Button Content", "tee")
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button URL", "tee"),
         "param_name" => "button_url",
         "value" => "#"
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon Name", "tee"),
         "param_name" => "button_icon",
         "value" => "icon-star",
         "description" => __('Find out them here -> <a href="'. get_template_directory_uri() . '/inc/theme-icons/demo.html" target="_blank">Icons Catalog</a>, just copy/past.', "tee")
      )
   )
));


		