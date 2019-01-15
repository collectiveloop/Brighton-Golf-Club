<?php
/**
 * Tee Up functions and definitions
 *
 */
/* 
 * INCLUDE FILES
*/
//THEME INIT
require_once(get_template_directory() . '/inc/theme-init.php');
//CUSTOM LOGIN
require_once(get_template_directory() . '/inc/theme-login.php');
//THEME COMMENTS
require_once(get_template_directory() . '/inc/theme-comments.php');
//THEME FORMS
require_once(get_template_directory() . '/inc/theme-forms.php');
//WIDGETS
require_once(get_template_directory() . '/inc/theme-widget.php');
// Enqueue scripts and styles for the front end.
require_once(get_template_directory() . '/inc/theme-styles.php');
require_once(get_template_directory() . '/inc/theme-scripts.php');
// Add Theme Customizer functionality.
require_once get_template_directory() . '/inc/theme-customizer.php';
// Options Panel
require_once(get_template_directory() . '/inc/theme-panel/admin-functions.php');
require_once(get_template_directory() . '/inc/theme-panel/admin-interface.php');
require_once(get_template_directory() . '/inc/theme-panel/theme-settings.php');
//CUSTOMIZE VISUAL COMPOSER
if (class_exists('Vc_Manager')){
	require_once(get_template_directory() . '/inc/theme-custom-composer.php');
}
// THEME METABOXES
require_once(get_template_directory() . '/inc/theme-metaboxes.php');
// THEME WOOCOMMERCE
require_once(get_template_directory() . '/inc/theme-woocommerce.php');
// THEME PLUGINS
require_once(get_template_directory() . '/inc/theme-plugins.php');



