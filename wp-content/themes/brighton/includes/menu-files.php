<?php 


	// For main menu support and mobile menu also top menu item
	add_action('init', 'wpj_register_menu');
	function wpj_register_menu() {
		if (function_exists('register_nav_menu')) {
			register_nav_menu( 'wpj-main-menu', __( 'Main Menu', 'Brighton' ) );
		}
	}
    register_nav_menu( 'footer-menu', __( 'Footer Menu', 'Brighton' ) );    register_nav_menu( 'footer-trems-menu', __( 'Footer Terms & Condition Menu', 'Brighton' ) );
	function wpj_default_menu() {
		echo '<ul class="nav navbar-nav">';
		if ('page' != get_option('show_on_front')) {
			echo '<li><a href="'. home_url() . '/">Home</a></li>';
		}
		wp_list_pages('title_li=');
		echo '</ul>';
	}
	
	
?>