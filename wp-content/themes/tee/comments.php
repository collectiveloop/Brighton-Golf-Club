<?php
/**
 * The template for displaying Comments.
 */
if ( post_password_required() )
	return;
?>
<?php if ( have_comments() ) { ?>
	<div id="comments" class="colored-container">
		<div class="container">
			<ol class="comment-list">
				<?php
					wp_list_comments( array( 'callback' => 'tee_comment' ));
				?>
			</ol> 
			<p><?php paginate_comments_links(); ?></p> 
		</div>    
	</div>     
	<!-- END COMMENT-CONTAINER -->
<?php } ?>
<section class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 animate_left_right">
			<?php $args = array(
				  'id_form'           => 'comment-form',
				  'id_submit'         => 'submit',
				  'comment_notes_before' => '',
				  'comment_notes_after' => '',
				  'title_reply'       => __( 'Send your Comment', 'tee'),
				  'title_reply_to'    => __( 'Leave a Reply to %s', 'tee' ),
				  'cancel_reply_link' => __( 'Cancel Reply', 'tee' ),
				  'label_submit'      => __( 'Post Comment', 'tee' )
				  );
  			?>
			<?php 
			ob_start();
			comment_form($args);
			echo str_replace('class="comment-form"','class="comment-form form-horizontal"',ob_get_clean());
			?>
			<!-- END COMMENT -->
		</div>
		<div class="col-md-3"></div>
	</div>
</section>
<!-- END CONTAINER -->