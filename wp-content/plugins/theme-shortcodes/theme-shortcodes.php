<?php
/*
Plugin Name: Tee Up Shortcodes
Plugin URI: http://themeforest.net
Description: Declares a plugin that will create some shortcodes in this theme
Version: 1.0
Author: 2F
Author URI: http://themeforest.net/user/doubleF
License: GPLv2
*/

/*
 * BUTTON
 */
function buttons($atts, $content = null) {
	extract(shortcode_atts(array(
		'button_url' => '#',
		'button_icon' => 'icon-star',
	), $atts));
	return '<a href="'. $button_url .'" class="btn btn-default"><i class="'. $button_icon .'"></i>' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'buttons');
function buttons_vc($atts, $content = null) {
	extract(shortcode_atts(array(
		'button_url' => '#',
		'button_icon' => 'icon-star',
		'button_content' => 'Button Content',
	), $atts));
	return '<a href="'. $button_url .'" class="btn btn-default"><i class="'. $button_icon .'"></i>' . $button_content . '</a>';
}
add_shortcode('button_vc', 'buttons_vc'); 
/*
 * DROPCAP
 */
function dropcaps($atts, $content = null) {
    return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'dropcaps');
/*
 * SEPARATION
 */
function breaker($atts, $content = null) {
    return '<hr>';
}
add_shortcode('separation', 'breaker');
/*
 * HIGHLIGHT
 */
function highlights($atts, $content = null) {
    return '<span class="highlight">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight', 'highlights');
/*
 * ALERT BOX
 */
function boxalerts($atts, $content = null) {
    return '<div class="alert alert-danger"><p>' . do_shortcode($content) . '</p></div>';
}
add_shortcode('boxalert', 'boxalerts'); 
/*
 * INFO BOX
 */
function boxinfos($atts, $content = null) {
    return '<div class="alert alert-info"><p>' . do_shortcode($content) . '</p></div>';
}
add_shortcode('boxinfo', 'boxinfos'); 
/*
 * TITLE
 */
function titles($atts, $content = null) {
	extract(shortcode_atts(array(
		'heading_title' => "Heading Title",
	), $atts));
    return '<!-- HEADLINE --><div class="heading"><h1>' . $heading_title . '</h1><hr></div>';
}
add_shortcode('title', 'titles'); 
/*
 * CONTACT FORM
 */
function contacts($atts, $content = null) {
	extract(shortcode_atts(array(
		'informations' => 'true',
		'title' => 'Get in touch now.',
	), $atts));
	ob_start();
	$informations_final = $informations;
	$title_final = $title;
	include(TEMPLATEPATH . '/inc/inc-contact.php');
    return ob_get_clean();
}
add_shortcode('contact', 'contacts');
/*
 * MAP
 */
function maps($atts, $content = null) {
	extract(shortcode_atts(array(
		'height' => 270,
		'gps' => "25.801541,-80.138023",
	), $atts));
	ob_start();
	$height_final = $height;
	$gps_final = $gps;
	include(TEMPLATEPATH . '/inc/inc-map.php');
    return ob_get_clean();
}
add_shortcode('map', 'maps');
/*
 * GALLERY
 */
function gallerys($atts, $content = null) {
	extract(shortcode_atts(array(
		'display' => 14,
		'button_url' => "#",
		'category' => '',
	), $atts));
	ob_start();
	$category_final = $category;
	$display_final = $display;
	$button_url_final = $button_url;
	include(TEMPLATEPATH . '/inc/inc-gallery.php');
    return ob_get_clean();
}
add_shortcode('tee_gallery', 'gallerys');
/*
 * EVENTS
 */
function eventss($atts, $content = null) {
	extract(shortcode_atts(array(
		'display' => 6,
		'button_url' => "#",
	), $atts));
	ob_start();
	$display_final = $display;
	$button_url_final = $button_url;
	include(TEMPLATEPATH . '/inc/inc-events.php');
    return ob_get_clean();
}
add_shortcode('events', 'eventss');
/*
 * COURSES
 */
function coursess($atts, $content = null) {
	extract(shortcode_atts(array(
		'display' => 6,
		'button_url' => "#",
	), $atts));
	ob_start();
	$display_final = $display;
	$button_url_final = $button_url;
	include(TEMPLATEPATH . '/inc/inc-courses.php');
    return ob_get_clean();
}
add_shortcode('courses', 'coursess');
/*
 * SPONSOR
 */
function sponsorss($atts, $content = null) {
	ob_start();
	include(TEMPLATEPATH . '/inc/inc-sponsors.php');
    return ob_get_clean();
}
add_shortcode('sponsors', 'sponsorss');
/*
 * STAFF
 */
function staffs($atts, $content = null) {
	ob_start();
	include(TEMPLATEPATH . '/inc/inc-staff.php');
    return ob_get_clean();
}
add_shortcode('staff', 'staffs');
 
/*
 * ADD SHORTCODES TO EDITOR BAR
 */
add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
    global $shortcode_tags;
    /** Any Shortcodes that should be excluded from this list should be added below */
    $exclude = array("wp_caption", "embed");
    echo '<select id="sc_select">
    <option>Insert Shortcode...</option>';
    echo '<option value="[button button_url=\'#\' button_icon=\'icon-star\'][/button]">Button</option>';
    echo '<option value="[highlight][/highlight]">Highlight</option>';
    echo '<option value="[title heading_title=\'Heading Title\' /]">Title</option>';
    echo '<option value="[dropcap][/dropcap]">Dropcap</option>';
    echo '<option value="[boxalert][/boxalert]">Box Alert</option>';
    echo '<option value="[boxinfo][/boxinfo]">Box Info</option>';
    echo '<option value="[separation/]">Separation</option>';
    echo '<option value="[contact informations=\'true\' title=\'Get in touch now.\' /]">Contact Form</option>';
    echo '<option value="[map height=\'270\' gps=\'25.801541,-80.138023\' /]">Map</option>';
    echo '<option value="[tee_gallery display=\'14\' button_url=\'#\' /]">Gallery</option>';
    echo '<option value="[events display=\'6\' button_url=\'#\' /]">Events</option>';
    echo '<option value="[sponsors/]">Sponsors</option>';
    echo '<option value="[staff/]">Staff</option>';
    echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
    echo '<script type="text/javascript">
		    jQuery(document).ready(function(){
		        jQuery("#sc_select").change(function() {
		            send_to_editor(jQuery("#sc_select :selected").val());
		                return false;
		            });
		        });
		  </script>';
}
?>