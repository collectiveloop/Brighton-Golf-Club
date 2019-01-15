<?php
/* 
* COMMENTS
*/
function tee_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'tee' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'tee' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article class="clearfix">
			<div class="comment-author vcard clearfix">
				<?php echo get_avatar( $comment, 75 ); ?>
				<div class="comment-meta">
					<?php printf( '%1$s %2$s',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span class="url"></span>' : ''
					); 
	                printf( '<a href="%1$s" class="comment-time"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'tee' ), get_comment_date(), get_comment_time() )
					);
					?>
				</div>
			</div>
			<div class="comment-text">
				<?php if ( '0' == $comment->comment_approved ){ ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tee' ); ?></p>
				<?php } ?>
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'tee' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-text -->
			<div class="reply pull-right">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="icon-pencil"></i> Reply', 'tee' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	</li>
	<?php
		break;
	endswitch; // end comment_type check
}
add_filter('comment_reply_link', 'tee_replace_reply_link_class');
function tee_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='btn btn-default", $class);
    return $class;
}
