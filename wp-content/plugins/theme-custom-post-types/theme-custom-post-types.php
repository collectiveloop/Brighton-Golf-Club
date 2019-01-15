<?php
/*
Plugin Name: Tee Custom Post Types
Plugin URI: http://themeforest.net
Description: Declares a plugin that will create all the custom post types for TEE UP
Version: 1.0
Author: 2F
Author URI: http://themeforest.net/user/doubleF
License: GPLv2
*/
/*
* GALLERY POST TYPE
*/
add_action( 'init', 'create_gallery_type' );
function create_gallery_type() {
	register_post_type('gallery', array(
    'label' => __('Gallery','tee'),
    'singular_label' => __('Gallery', 'tee'),
    'public' => true,
    'show_ui' => true,
	'exclude_from_search' =>true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title', 'thumbnail')
  ));
  register_taxonomy( 'gallery_category', 'gallery', array( 'hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => true ) );
}
/*
* EVENT POST TYPE
*/
add_action( 'init', 'create_event_type' );
function create_event_type() {
	register_post_type('events', array(
    'label' => __('Events','tee'),
    'singular_label' => __('Event', 'tee'),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'has_archive' => true,
	'exclude_from_search' =>true,
    'hierarchical' => false,
    'supports' => array('title', 'thumbnail','editor')
  ));
  flush_rewrite_rules();
}
/*
* COURSES POST TYPE
*/
add_action( 'init', 'create_course_type' );
function create_course_type() {
	register_post_type('courses', array(
    'label' => __('Courses','tee'),
    'singular_label' => __('Course', 'tee'),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'has_archive' => true,
	'exclude_from_search' =>true,
    'hierarchical' => false,
    'supports' => array('title', 'thumbnail','editor')
  ));
  flush_rewrite_rules();
}
/*
* SPONSOR POST TYPE
*/
add_action( 'init', 'create_sponsor_type' );
function create_sponsor_type() {
	register_post_type('sponsor', array(
    'label' => __('Sponsors','tee'),
    'singular_label' => __('Sponsor', 'tee'),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
	'exclude_from_search' =>true,
    'supports' => array('title', 'thumbnail')
  ));
}
/*
* TESTIMONIALS POST TYPE
*/
add_action( 'init', 'create_testimonial_type' );
function create_testimonial_type() {
	register_post_type('testimonial', array(
    'label' => __('Testimonials','tee'),
    'singular_label' => __('Testimonial', 'tee'),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
	'exclude_from_search' =>true,
    'supports' => array('title','editor')
  ));
}
/*
* FAQ POST TYPE
*/
add_action( 'init', 'create_faq_type' );
function create_faq_type() {
	register_post_type('faq', array(
    'label' => __('FAQs','tee'),
    'singular_label' => __('Question', 'tee'),
    'public' => true,
    'show_ui' => true,
	'exclude_from_search' =>true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title','editor')
  ));
}
/*
* STAFF POST TYPE
*/
add_action( 'init', 'create_staff_type' );
function create_staff_type() {
	register_post_type('staff', array(
    'label' => __('Staff','tee'),
    'singular_label' => __('Teammate', 'tee'),
    'public' => true,
	'exclude_from_search' =>true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title','editor', 'thumbnail')
  ));
}
?>