<?php	
/**
 * Contains methods for customizing the theme customization screen.
 * 
 */
class tee_Customize {
   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    */
   public static function register ( $wp_customize ) {
   	  /**
   	  * COLORS SECTION
   	  **/
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'tee_options', 
         array(
            'title' => __( 'Tee Options', 'tee' ), //Visible title of section
            'priority' => 10, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize some example settings for tee.', 'tee'), //Descriptive tooltip
         ) 
      );
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'tee_color1', //Give it a SERIALIZED name (so all theme settings can live under one db record)
         array(
            'default' => '#555', //Default setting/value to save
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );
      $wp_customize->add_setting( 'tee_color2', //Give it a SERIALIZED name (so all theme settings can live under one db record)
         array(
            'default' => '#CCC', //Default setting/value to save
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );   
      $wp_customize->add_setting( 'tee_header_color', //Give it a SERIALIZED name (so all theme settings can live under one db record)
         array(
            'default' => '#FFF', //Default setting/value to save
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );       
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'tee_color1', //Set a unique ID for the control
         array(
            'label' => __( 'Color #1', 'tee' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'tee_color1', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'tee_color2', //Set a unique ID for the control
         array(
            'label' => __( 'Color #2', 'tee' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'tee_color2', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'tee_header_color', //Set a unique ID for the control
         array(
            'label' => __( 'Header Text Color', 'tee' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'tee_header_color', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      /**
   	  * BACKGROUNDS SECTION
   	  **/
	  $wp_customize->add_section( 'background_section' , array(
		    'title'      => __( 'Background  Options', 'tee' ),
		    'priority'   => 13,
	  ));
	  $wp_customize->add_setting( 'tee_bg_default', array(
            	'transport' => 'postMessage',
				'default' => get_template_directory_uri() . '/images/backgrounds/default.jpg',
	  ));
	  $wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'tee_bg_default',
		        array(
		            'label' => 'Default Header Image',
		            'section' => 'background_section',
		            'settings' => 'tee_bg_default'
		        )
	  ));
	  $wp_customize->add_setting( 'tee_bg', array(
            	'transport' => 'postMessage',
				'default' => get_template_directory_uri() . '/images/backgrounds/content_bg.png',
	  ));
	  $wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'tee_bg',
		        array(
		            'label' => 'First Background Pattern',
		            'section' => 'background_section',
		            'settings' => 'tee_bg'
		        )
	  ));
	  $wp_customize->add_setting( 'tee_bg_retina', array(
            	'transport' => 'postMessage',
				'default' => get_template_directory_uri() . '/images/backgrounds/content_bg@2X.png',
	  ));
	  $wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'tee_bg_retina',
		        array(
		            'label' => 'First Background (Retina)',
		            'section' => 'background_section',
		            'description' => 'Same image with doubled dimensions (@2x)',
		            'settings' => 'tee_bg_retina'
		        )
	  ));
	  $wp_customize->add_setting( 'tee_bg2', array(
            	'transport' => 'postMessage',
				'default' => get_template_directory_uri() . '/images/backgrounds/footer_bg.png',
	  ));
	  $wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'tee_bg2',
		        array(
		            'label' => 'Second Background Pattern',
		            'section' => 'background_section',
		            'settings' => 'tee_bg2'
		        )
	  ));
	  $wp_customize->add_setting( 'tee_bg2_retina', array(
            	'transport' => 'postMessage',
				'default' => get_template_directory_uri() . '/images/backgrounds/footer_bg@2X.png',
	  ));
	  $wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'tee_bg2_retina',
		        array(
		            'label' => 'Second Background (Retina)',
		            'section' => 'background_section',
		            'description' => 'Same image with doubled dimensions (@2x)',
		            'settings' => 'tee_bg2_retina'
		        )
	  ));
	  /**
   	  * BOXED SECTION
   	  **/
	  $wp_customize->add_section( 'boxed_section' , array(
		    'title'      => __( 'Boxed Layout  Options', 'tee' ),
		    'priority'   => 13,
	  ));  
	  $wp_customize->add_setting( 'tee_bg_boxed', array(
            	'transport' => 'postMessage',
				'default' => get_template_directory_uri() . '/images/backgrounds/footer_bg.png',
	  ));
	  $wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'tee_bg_boxed',
		        array(
		            'label' => 'Background Pattern',
		            'section' => 'boxed_section',
		            'settings' => 'tee_bg_boxed'
		        )
	  ));
	  $wp_customize->add_setting( 'tee_bg_boxed_retina', array(
            	'transport' => 'postMessage',
				'default' => get_template_directory_uri() . '/images/backgrounds/footer_bg@2X.png',
	  ));
	  $wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'tee_bg_boxed_retina',
		        array(
		            'label' => 'Retina version of the Background',
		            'section' => 'boxed_section',
		            'description' => 'Same image with doubled dimensions (@2x)',
		            'settings' => 'tee_bg_boxed_retina'
		        )
	  ));
      /**
   	  * FONTS SECTION
   	  **/
	  $wp_customize->add_section( 'fonts_section' , array(
		    'title'      => __( 'Fonts', 'tee' ),
		    'priority'   => 11,
	  ));
	  //get list of fonts, decode them and push them in a php array
		$json = file_get_contents("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAh5UVIJElMtiWS4hfK4nytIqVluUnRtsg", true);
		$decode = json_decode($json, true);
		$webfonts = array();
		foreach ($decode['items'] as $key => $value) {
			$item_family= $decode['items'][$key]['family'];
			$item_family_trunc =  str_replace(' ','+',$item_family);
			$webfonts[$item_family_trunc] = $item_family;
		}
	  $wp_customize->add_setting(
		    'font1',
		    array(
		        'default' => 'Open+Sans',
	  ));
	  $wp_customize->add_control(
		    'font1',
		    array(
		        'type' => 'select',
		        'label' => 'Font #1',
		        'section' => 'fonts_section',
		        'choices' => $webfonts,
	  ));
	  $wp_customize->add_setting(
		    'font2',
		    array(
		        'default' => 'Playfair+Display',
	  ));
	  $wp_customize->add_control(
		    'font2',
		    array(
		        'type' => 'select',
		        'label' => 'Font #2',
		        'section' => 'fonts_section',
		        'choices' => $webfonts,
	  ));
	  $wp_customize->add_setting(
		    'font_size_body',
		    array(
		        'default' => '1.6em',
	  ));
	  $wp_customize->add_control(
		    'font_size_body',
		    array(
		        'type' => 'text',
		        'label' => 'Body font size',
		        'section' => 'fonts_section',
	  ));
	  $wp_customize->add_setting(
		    'font_size_h1',
		    array(
		        'default' => '2.6em',
	  ));
	  $wp_customize->add_control(
		    'font_size_h1',
		    array(
		        'type' => 'text',
		        'label' => 'H1 font size',
		        'section' => 'fonts_section',
	  ));
	  $wp_customize->add_setting(
		    'font_size_h2',
		    array(
		        'default' => '2em',
	  ));
	  $wp_customize->add_control(
		    'font_size_h2',
		    array(
		        'type' => 'text',
		        'label' => 'H2 font size',
		        'section' => 'fonts_section',
	  ));
	  $wp_customize->add_setting(
		    'main_line_height',
		    array(
		        'default' => '1.8em',
	  ));
	  $wp_customize->add_control(
		    'main_line_height',
		    array(
		        'type' => 'text',
		        'label' => 'Main line height',
		        'section' => 'fonts_section',
	  ));
      /**
	  * LIVE PREVIEW
	  **/
      function customize_preview() {
		    ?>
		    <script type="text/javascript">
		        ( function( $ ) {
					// HEADER IMAGE
					wp.customize( 'tee_bg', function( value ) {
						value.bind( function( to ) {
							var url = 'url('+ to +')';
							$( '#main-container .colored-container').css({
						      "background": url
						    });
						});
					});
					wp.customize( 'tee_bg2', function( value ) {
						value.bind( function( to ) {
							var url = 'url('+ to +')';
							$( '#footer, .event-card, .table, \
							.table-responsive, \
							#members-directory-form,  \
							#groups-directory-form,  \
							#create-group-form, \
							#buddypress .activity[role=main], \
							#members-directory-form,  \
							#groups-directory-form, \
							#create-group-form, \
							#buddypress.activity-page, \
							#buddypress #item-header, \
							#buddypress form#whats-new-form').css({
						      "background": url
						    });
						});
					});
					//COLORS
					wp.customize('tee_header_color',function( value ) {
		                value.bind(function(to) {
		                    $('#header *').css('color', to );
		                });
		            });
					wp.customize('tee_color1',function( value ) {
		                value.bind(function(to) {
		                    $('body, \
							a:hover, \
							#main-container ul.pagination>li>a, \
							#main-container #sidebar .widget ul li:before, \
							.flexslider .slides .event, \
							#events-container .event, \
							#main-container #events-container .event-content h3 a, \
							.dropdown-menu>li>a, #close-address, \
							.panel-title:before, \
							.widget.buddypress div.item .item-title a, \
							#open-address, \
							.widget.buddypress div.item-options a.selected, \
							#signin #close-signin:hover').css('color', to );
		                    $('#main-container .pagination>.active>a, \
							#main-container .pagination>.active>span, \
							#main-container .pagination>.active>a:hover, \
							.widget.buddypress #bp-login-widget-form input[type="submit"], \
							.search-container form button').css('background-color', to );
							$('#main-container .pagination>.active>a, \
							#main-container .pagination>.active>span, \
							#main-container .pagination>.active>a:hover, \
							#main-container .event-card hr, \
							.wpb_vc_table td.vc_table_cell, \
							.table>tbody>tr>td').css('border-color', to );
		                });
		            });
		            wp.customize('tee_color2',function( value ) {
		                value.bind(function(to) {
		                    $('a, \
		                    #header #topbar *, \
							#main-container .btn-default i, \
							.colored, #main-container .dropcap, \
							.staff span, \
							.post .post-date, \
							.post .post-comments, \
							.post .post-tags, \
							.post-likes, \
							.post-categories, \
							.flexslider .slides .event-data, \
							#events-container .event-data, \
							.dropdown-menu>li, #main-container .event-card h2, \
							.timer_box:before, \
							.timer_box p, \
							#testimonials li:before, \
							#testimonials li span, \
							#open-address:hover, \
							#signin .btn-default i, \
							.widget.buddypress div.item .item-title a:hover, \
							.widget.buddypress span.activity, \
							#signin #close-signin, \
							.topic-info, #members-container .member h4,  \
							#footer a').css('color', to );
							$('#main-container ul.pagination>li>a, \
							.search-container input[type="text"], \
							.widget select, \
							.member-forum-table .row, \
							#signin .heading hr').css('border-color', to );
		                });
		            });wp.customize('tee_color3',function( value ) {
		                value.bind(function(to) {
		                    $('body').css('background-color', to );
		                });
		            });
					// FONTS
					wp.customize( 'font1', function( value ) {
						value.bind( function( to ) {
							WebFontConfig = {
							    google: { families: [to] }
							  };
							  (function() {
							    var wf = document.createElement('script');
							    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
							      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
							    wf.type = 'text/javascript';
							    wf.async = 'true';
							    var s = document.getElementsByTagName('script')[0];
							    s.parentNode.insertBefore(wf, s);
							  })();
							  var to2 = to.replace('+', ' ');
							$( 'body, \
							.buddypress-container .buddypress-page-title h1, \
							#buddypress h1, \
							#buddypress h2, \
							#buddypress h3, \
							#buddypress div.profile h4, \
							.item-title a' ).css('font-family', to2 );
						} );
					} );		        
					wp.customize( 'font2', function( value ) {
						value.bind( function( to ) {
							WebFontConfig = {
							    google: { families: [to] }
							  };
							  (function() {
							    var wf = document.createElement('script');
							    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
							      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
							    wf.type = 'text/javascript';
							    wf.async = 'true';
							    var s = document.getElementsByTagName('script')[0];
							    s.parentNode.insertBefore(wf, s);
							  })();
							  var to2 = to.replace('+', ' ');
							$( '
							h1, h2, h3, h4, h5, h6, \
							#navigation li, \
							#copyright, \
							#main-container .btn-default, \
							.gallery-item a span, \
							.caption, \
							.comment-meta, \
							.table th, .table tr td:first-child, \
							#main-container blockquote, \
							#main-cotainer .pagination>li>a, \
							#main-container .dropcap, \
							#contact-container, \
							.member-forum-table .row:first-child, \
							.post .post-author a span, \
							.event-card, \
							.event-data' ).css('font-family', to2 );
						} );
					} );
		        } )( jQuery )
		    </script>
		    <?php
	  }
	  if ( $wp_customize->is_preview() && ! is_admin() ) {
		    add_action( 'wp_footer', 'customize_preview', 21);
	  }
   }
}
// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'tee_Customize' , 'register' ) );