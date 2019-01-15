<?php
/* 
* ADD PLUGINS
*/
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once(get_template_directory() . '/inc/theme-plugins/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'tee_required_plugins' );
function tee_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'                  => 'Theme Custom Post Types', // The plugin name
            'slug'                  => 'theme-custom-post-types', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/theme-plugins/theme-custom-post-types.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Theme Shortcodes', // The plugin name
            'slug'                  => 'theme-shortcodes', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/theme-plugins/theme-shortcodes.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Revolution Slider', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/theme-plugins/revslider.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
		array(
			'name'		=> 'Buddypress',
			'slug'		=> 'buddypress',
			'required'	=> false,
		),
		array(
			'name'		=> 'WordPress SEO by Yoast',
			'slug'		=> 'wordpress-seo',
			'required'	=> false,
		),
		array(
			'name'		=> 'WP SimpleWeather',
			'slug'		=> 'wp-simpleweather',
			'required'	=> false,
		),
        array(
            'name'					=> 'WPBakery Visual Composer', // The plugin name
            'slug'					=> 'js_composer', // The plugin slug (typically the folder name)
            'source'				=> get_stylesheet_directory() . '/inc/theme-plugins/js_composer.zip', // The plugin source
            'required'				=> true, // If false, the plugin is only 'recommended' instead of required
            'version'				=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'			=> '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'					=> 'Easy Table for Visual Composer', // The plugin name
            'slug'					=> 'easy-tables-vc', // The plugin slug (typically the folder name)
            'source'				=> get_stylesheet_directory() . '/inc/theme-plugins/easy-tables-vc.zip', // The plugin source
            'required'				=> true, // If false, the plugin is only 'recommended' instead of required
            'version'				=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'			=> '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'					=> 'Envato Toolkit', // The plugin name
            'slug'					=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
            'source'				=> get_stylesheet_directory() . '/inc/theme-plugins/envato-wordpress-toolkit-master.zip', // The plugin source
            'required'				=> false, // If false, the plugin is only 'recommended' instead of required
            'version'				=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'			=> '', // If set, overrides default API URL and points to an external URL
        )
    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'tee';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
        'parent_url_slug'   => 'themes.php',                // Default parent URL slug
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa( $plugins, $config );
}

/*
* BUDDYPRESS CUSTOM MENU (TOPBAR)
*/
if ( function_exists('bp_is_active') ) {
	function tee_buddypress_menu_top(){
		$current_member_url = bp_get_loggedin_user_link();
		if( bp_is_active( 'friends' ) ):
			$members_url = bp_get_members_directory_permalink();
		endif;
		if( bp_is_active( 'groups' ) ):
			$groups_url = bp_get_groups_directory_permalink();
		endif;
		if( bp_is_active( 'activity' ) ):
			$activity_url = bp_get_activity_directory_permalink();
		endif;
		$current_user = wp_get_current_user();
		if ( 0 == $current_user->ID ) {
		    echo'<li><span class="icon-user"></span><a href="#" id="open-signin">';
		    _e("Log In","tee"); 
		    echo'</a></li>';
		} else {
		    echo'<li><span class="icon-user"></span><a href="'. $current_member_url .'" id="buddypress-submenu">';
		    _e("Hello","tee"); 
		    echo', '. $current_user->user_login;
		    echo'</a>';
		    echo'<ul id="member-links">';
		    if( bp_is_active( 'friends' ) ):
			    echo '<li><a href="'.$members_url.'"><span class="icon-users"></span> '. __('Members','tee') .'</a></li>';
			endif;
		    if( bp_is_active( 'groups' ) ):
			    echo '<li><a href="'.$groups_url.'"><span class="icon-network"></span> '. __('Groups','tee') .'</a></li>';
			endif;
		    if( bp_is_active( 'activity' ) ):
			    echo '<li><a href="'.$activity_url.'"><span class="icon-new"></span> '. __('Activity','tee') .'</a></li>';
			endif;
		    echo'</ul>';
		    echo'</li>';
		}
	}
}
/*
* WPML LANGUAGE SWITCHER
*/
if (class_exists('SitePress')) {
	function getActiveLanguage() {
	  // fetches the list of languages
	  $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR');
	  $activeLanguage = 'Englsih';
	  // runs through the languages of the system, finding the active language
	  foreach($languages as $language) {
	    // tests if the language is the active one
	    if($language['active'] == 1) {
	      $activeLanguage = $language['native_name'];
	    }
	  }
	  return $activeLanguage;
	}
	function tee_languages_switcher(){
	    $languages = icl_get_languages('skip_missing=0&orderby=code');
	    if(!empty($languages)){
	    	echo'<a href="#" id="open-languages">'. getActiveLanguage() .'<span class="icon-arrow-down4"></span></a>';
	  		echo '<ul id="languages">';
	  			foreach($languages as $l){
	  				if(!$l['active'] == 1) {
		  				echo '<li><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
		  			}
		  		}
	  		echo '</ul>';
	    }
	}
}
/*
* TRANSPOSH LANGUAGE SWITCHER
*/
if(function_exists("transposh_widget")) { 
	function tee_languages_switcher(){
		echo do_shortcode ('[tp widget="flags/tpw_flags.php"]');
	}
}
/*
* VISUAL COMPOSER
*/
add_action( 'vc_before_init', 'tee_vcSetAsTheme' );
function tee_vcSetAsTheme() {
	vc_set_as_theme($disable_updater = true);
}