<?php
//CSS,JS file
include_once('includes/theme-files.php');
// Menu Register
include_once('includes/menu-files.php');
//custom post
include_once('includes/custom-post.php');

//Widgets
include_once('includes/widgets-i.php');
//Pagination
include_once('includes/v-pagination.php');



// option tree setup for theme option
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
include_once( 'option-tree/ot-loader.php' );
include_once( 'includes/theme-options.php' );
//Custom Meta Box
include_once('includes/v-meta-boxes.php');









?>