<?php
function tee_script() {
	if (!is_admin()) {

		wp_enqueue_script('jquery');

	    wp_register_script('jplugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '1', true);
	    wp_enqueue_script('jplugins');
		
		wp_register_script('jmain', get_template_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jmain');

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'tee_script');

function tee_traking_code_js() {
    if (!is_admin()) {
	    if (get_option('tee_google_analytics') != ""): ?>
	        <script type="text/javascript">
	            <?php echo get_option('tee_google_analytics'); ?>
	        </script>
		 <?php 
		 endif;
    }
}
add_action( 'wp_enqueue_scripts', 'tee_traking_code_js',100 );

function tee_the_custom_js() {
    if (!is_admin()) {
    	if (get_option('tee_custom_js') != ""): ?>
	        <script type="text/javascript">
	            <?php echo get_option('tee_custom_js'); ?>
	        </script>
		 <?php 
		 endif;
    }
}
add_action( 'wp_enqueue_scripts', 'tee_the_custom_js',100 );

function tee_navigation_fixed() {
    if (!is_admin()) {
    	if (get_option('tee_menu_fixed') == "true"): ?>
	        <script type="text/javascript">
	            /* WORKS WELL */
	            jQuery(document).ready(function() {
	            	/*CHECKING THE LAYOUT*/
					var isnavlayout2 = false;
					if(jQuery('#header').hasClass('layout_2')){
						isnavlayout2 = true;
					}
					/*ON SCROLL*/
					jQuery(window).bind('scroll', function(){
						var scroll = jQuery(window).scrollTop();
						if (isnavlayout2 == true){
							if (scroll > 200)  {
								jQuery('#header').addClass('fixed_navigation');
							}
							else{
								jQuery('#header').removeClass('fixed_navigation');
							}
						}
						else{
							if (scroll > 200)  {
								jQuery('#header').addClass('layout_2 fixed_navigation');
							}
							else{
								jQuery('#header').removeClass('layout_2 fixed_navigation');
							}
						}
						
					});
				});
	        </script>
		 <?php 
		 endif;
    }
}
add_action( 'wp_footer', 'tee_navigation_fixed',100 );