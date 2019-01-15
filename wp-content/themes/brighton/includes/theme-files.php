<?php
function bra_theme_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'bra_theme_jquery');
function brighton_theme_files() {
	global $wp_styles;
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );	
	/* Registering Styles */
    wp_register_style( 'bootstrap-a', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1', 'all' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '1', 'all' );
	wp_register_style( 'normalize-a', get_template_directory_uri() . '/css/normalize.css', array(), '1', 'all' );
	wp_register_style( 'main-a', get_template_directory_uri() . '/css/main.css', array(), '1', 'all' );	wp_register_style( 'datepicker-a', get_template_directory_uri() . '/css/zebra_datepicker.css', array(), '1', 'all' );	wp_register_style( 'owl-carousel-a', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1', 'all' );	wp_register_style( 'owl-theme-a', get_template_directory_uri() . '/css/owl.theme.css', array(), '1', 'all' );	wp_register_style( 'style-a', get_template_directory_uri() . '/css/style.css', array(), time(), 'all' );	wp_register_style( 'responsive-a', get_template_directory_uri() . '/css/responsive.css', array(), '1', 'all' );
	/* Enqueue Styles */
    wp_enqueue_style( 'bootstrap-a', get_stylesheet_uri(), array(), '1', 'all' );
	wp_enqueue_style( 'font-awesome', get_stylesheet_uri(), array(), '1', 'all' );
	wp_enqueue_style( 'normalize-a', get_stylesheet_uri(), array(), '1', 'all' );
	wp_enqueue_style( 'main-a', get_stylesheet_uri(), array(), '1', 'all' );	wp_enqueue_style( 'datepicker-a', get_stylesheet_uri(), array(), '1', 'all' );	wp_enqueue_style( 'owl-carousel-a', get_stylesheet_uri(), array(), '1', 'all' );	wp_enqueue_style( 'owl-theme-a', get_stylesheet_uri(), array(), '1', 'all' );	wp_enqueue_style( 'style-a', get_stylesheet_uri(), array(), '1', 'all' );	wp_enqueue_style( 'responsive-a', get_stylesheet_uri(), array(), '1', 'all' );
	// Loads our main stylesheet.
	wp_enqueue_style( 'brighton-main-style', get_stylesheet_uri() );
	// Loads all javascript files
	// Masonry
	wp_enqueue_script( 'jquery-masonry', array( 'jquery' ) );
	wp_enqueue_script('v-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js',array('jquery'),'1.0',true);	
	wp_enqueue_script('v-plugins', get_template_directory_uri() . '/js/plugins.js',array('jquery'),'1.0',true);		wp_enqueue_script('v-datepicker', get_template_directory_uri() . '/js/zebra_datepicker.js',array('jquery'),'1.0',true);	
	// active jquery file
	wp_enqueue_script('v-main', get_template_directory_uri() . '/js/main.js',array('jquery'),'1.0',true);		
}
add_action('wp_enqueue_scripts', 'brighton_theme_files');
?>