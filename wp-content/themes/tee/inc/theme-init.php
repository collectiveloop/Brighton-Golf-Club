<?php
/**
 * THEMES INIT
 */
/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}
if ( ! function_exists( 'tee_setup' ) ) :
/**
 * Tee Up setup.
 * Set up theme defaults and registers support for various WordPress features.
 */
function tee_setup() {
	/*
	 * Make Tee Up available for translation.
	 *
	 */
	load_theme_textdomain( 'tee', get_template_directory() . '/languages' );
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'tee' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	// Enable support for Post Thumbnails, and declare 2 sizes.
	add_image_size( 'tee-full-width', 1038, 576, true );
	add_image_size( 'tee-events', 332, 166, true );
}
endif; // tee_setup
add_action( 'after_setup_theme', 'tee_setup' );

/**
 * Adjust content_width value for image attachment template.
 */
function tee_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'tee_content_width' );
/**
 * Getter function for Featured Content Plugin.
 */
function tee_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Tee Up.
	 */
	return apply_filters( 'tee_get_featured_posts', array() );
}
/**
 * A helper conditional function that returns a boolean value.
 */
function tee_has_featured_posts() {
	return ! is_paged() && (bool) tee_get_featured_posts();
}
/**
 * Register three Tee Up widget areas.
 */
function tee_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'tee' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Sidebar that appears on the right for the blog page.', 'tee' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'tee' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears in the footer section of the site.', 'tee' ),
		'before_widget' => '<aside id="%1$s" class="widget col-md-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'tee_widgets_init' );
/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 */
function tee_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'tee' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'tee_wp_title', 10, 2 );
/**
 * POSTMETADATAS
 */
function tee_entry_meta() {
	$permalink = get_permalink();
	$postcategories = get_the_category_list( __( ', ', 'tee' ) );
	$posttags = get_the_tag_list( '', __( ', ', 'tee' ) );
	
	echo'<ul class="list-unstyled postmetadatas">';
    	echo '<li class="post-author"><a href="#">';
    	echo '<span>'. get_the_author() .'</span>';
    	echo get_avatar( get_the_author_meta( 'ID' ), 120 );
    	echo '</a></li>';
    	if ( is_single() ):
    		echo '<li class="post-date"><i class="icon-clock"></i> ';
	    	echo the_time('F j, Y');
	    	echo '</li>';
	    	echo '<li class="post-comments"><i class="icon-comment"></i> <a href="#comments">';
    	else :
	    	echo '<li class="post-date"><i class="icon-clock"></i> <a href="'. $permalink .'">';
	    	echo the_time('F j, Y');
	    	echo '</a></li>';
	    	echo '<li class="post-comments"><i class="icon-comment"></i> <a href="'. $permalink .'">';
    	endif;
    	echo comments_number( '0', '1', '%' );
    	echo '</a></li>';
    	if($postcategories != ""){
    		echo'<li class="post-categories"><i class="icon-bookmarks"></i> '. $postcategories .'</li>';
    	}
    	if($posttags != ""){
    		echo '<li class="post-tags"><i class="icon-bookmarks"></i> '. $posttags .'</li>';
		}
	echo'</ul>';
}
/**
 * PAGINATION - Displays navigation to next/previous set of posts when applicable.
 */
function tee_paging_nav() {
	if( is_singular() )
		return;
	global $wp_query;
	if( $wp_query->max_num_pages <= 1 )
		return;
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );
	
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="center"><ul class="pagination">' . "\n";
	
	if ( get_previous_posts_link() ){
		$previous_posts_link =  explode('"',get_previous_posts_link()); $npl_url=$previous_posts_link[1];
		echo '<li><a href="'. $previous_posts_link[1] .'"><i class="icon-arrow-left3"></i></a></li>';
	}	
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) ){
			echo '<li><a href="#" class="disabled">&#8230;</a></li>';
		}
	}
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li><a href="#" class="disabled">&#8230;</a></li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	if ( get_next_posts_link() ){
		$next_posts_link = explode('"',get_next_posts_link()); $npl_url=$next_posts_link[1];
		echo '<li><a href="'. $next_posts_link[1] .'"><i class="icon-arrow-right3"></i></a></li>';
	}
	echo '</ul></div>' . "\n";
}


/**
 * DATE FORMAT => YEAR-MO-DA HO:MI to default one
 */
function tee_events_date($dates) {
	// GET DATES
	$the_day = substr($dates, 8, -6);
    $the_year = substr($dates, 0, 4);
    $the_month = substr($dates, 5, -9);
    
    //MONTH NAME FROM NUMBER
    switch ($the_month) {
	    case "01":
	        $the_month_final = __( "January", "tee");
	        break;
	    case "02":
	        $the_month_final = __( "February", "tee");
	        break;
	    case "03":
	        $the_month_final = __( "March", "tee");
	        break;
	    case "04":
	        $the_month_final = __( "April", "tee");
	        break;
	    case "05":
	        $the_month_final = __( "May", "tee");
	        break;
	    case "06":
	        $the_month_final = __( "June", "tee");
	        break;
	    case "07":
	        $the_month_final = __( "July", "tee");
	        break;
	    case "08":
	        $the_month_final = __( "August", "tee");
	        break;
	    case "09":
	        $the_month_final = __( "September", "tee");
	        break;
	    case "10":
	        $the_month_final = __( "October", "tee");
	        break;
	    case "11":
	        $the_month_final = __( "November", "tee");
	        break;
	    case "12":
	        $the_month_final = __( "December", "tee");
	        break;
	}
	
	// GET THE FORMAT
	$date_format = get_option( 'tee_events_date_format' );
	
	/*"Day Month Year","Month Day Year"*/
	if ($date_format == "Day Month Year") {
		$output = $the_day .' '. $the_month_final .' '. $the_year;
	} 
	if ($date_format == "Month Day Year") {
		$output = $the_month_final .' '. $the_day .' '. $the_year;
	}
	
	return $output;
}
