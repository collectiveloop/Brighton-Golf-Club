<?php
/**
 * THEMES FORMS
 */
/**
 * SEARCHFORM
*/
function tee_searchform( $form ) {
   $form = ' <!-- SEARCH FORM -->
   <div class="search-container">
        <form role="search" method="get" action="' . home_url( '/' ) . '" >
            <input class="menu-search-input" placeholder="'. __( 'Search...','tee' ) .'" type="text" value="" name="s" id="s">
            <input type="hidden" name="searchsubmit" id="searchsubmit" value="true" />
			<button type="submit" id="searchsubmit" name="searchsubmit"><i class="icon-search"></i></button>
        </form>
    </div><!-- END .SEARCHFORM -->';
    return $form;
}
add_filter( 'get_search_form', 'tee_searchform' );
  
if (get_option('tee_search') == "true") {
	add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
	function add_search_box( $items, $args ) {
		if( 'primary' === $args -> theme_location ) {
			$items .= '<li class="menu-search"><a href="#" id="search-toggle"><span class="icon-search"></span></a>';
			$items .= '<div class="search-container">
		        <form role="search" method="get" action="' . home_url( '/' ) . '" >
		            <input class="menu-search-input" placeholder="'. esc_attr__( 'Search...' ) .'" type="text" value="' . get_search_query() . '" name="s" id="s">
		            <input type="hidden" name="searchsubmit" id="searchsubmit" value="true" />
					<button type="submit" name="searchsubmit"><i class="icon-search"></i></button>
		        </form>
			</div>';
			$items .= '</li>';
		}
	    return $items;
	}
}
/**
 * COMMENT FORM
 */
add_filter( 'comment_form_default_fields', 'tee_comment_form_fields' );
function tee_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author" class="control-label col-lg-2">' . __( 'Name','tee' ) . '</label> ' .
                    '<div class="col-lg-10"><input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></div></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email" class="control-label col-lg-2">' . __( 'Email','tee' ) . '</label> ' .
                    '<div class="col-lg-10"><input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></div></div>',
        'url'    => '',
    );
    
    return $fields;
}

add_filter( 'comment_form_defaults', 'tee_comment_form' );
function tee_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment" class="col-lg-2 control-label">' . __( 'Comment', 'tee' ) . '</label> 
            <div class="col-lg-10"><textarea class="form-control" id="comment" name="comment" rows="4" aria-required="true"></textarea></div>
        </div>';
    return $args;
}

add_action('comment_form', 'tee_comment_button' );
function tee_comment_button() {
    echo '<div class="form-group"><div class="col-lg-offset-2 col-lg-10"><button class="btn btn-default" type="submit"><i class="icon-pencil"></i>' . __( 'Post Comment','tee' ) . '</button></div></div>';
}