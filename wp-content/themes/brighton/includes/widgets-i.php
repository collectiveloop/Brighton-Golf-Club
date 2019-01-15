<?php

add_filter('widget_text', 'do_shortcode');
function dolcidicarmel_theme_widgets() {
    register_sidebar( array(
        'name' => __( 'Sidebar', 'A brief history Sidebar' ),
        'id' => 'about_us_sidebar',
        'description' => __( 'Widgets for about us brief history sidebar .', 'theme-slug' ),
        'before_widget' => '<div class="sidebar_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="text-center">',
        'after_title' => '</h2>',
    ) );       	register_sidebar( array(
        'name' => __( 'Weather Sidebar', 'Weather Sidebar' ),
        'id' => 'footer_sidebar',
        'description' => __( 'Widgets for footer Weather .', 'theme-slug' ),
        'before_widget' => '<div class="sidebar_widget_footer">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title"><h3>',
        'after_title' => '</h3></div>',
    ) );    

}	
add_action('widgets_init', 'dolcidicarmel_theme_widgets');





?>