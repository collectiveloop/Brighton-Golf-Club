<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
?>
<div id="reviews">

	<h2 class="center"><?php
		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) )
			printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );
		else
			_e( 'Reviews', 'woocommerce' );
	?></h2>
	
</div>
</div>
</div>
</div>
</section>
	<div id="comments" class="colored-container">
		<div class="container">
		<?php if ( have_comments() ) : ?>

			<ol id="product-reviews" class="comment-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
		</div>
	</div>
<section class="container">
<div class="product">
<div class="woocommerce-tabs">
<div class="entry-content">


	<div class="row">
		<div class="col-md-3"></div>
		<div id="review-form">
		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '',	get_current_user_id(), $product->id ) ) : ?>
			<div class="col-md-6 animate_left_right">
				<?php $args = array(
					  'id_form'           => 'comment-form',
					  'id_submit'         => 'submit',
					  'comment_notes_before' => '',
					  'comment_notes_after' => '',
					  'title_reply'       => __( 'Send your reveiew', 'tee'),
					  'title_reply_to'    => __( 'Leave a review to %s', 'tee' ),
					  'cancel_reply_link' => __( 'Cancel review', 'tee' ),
					  'label_submit'      => __( 'Post review', 'tee' )
					  );
					  
					  if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$args['comment_field'] = '<p class="comment-form-rating"><select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
						</select></p>';
					  }
					  $args['comment_field'] .= '<div class="form-group comment-form-comment"><label for="comment" class="col-lg-2 control-label">' . __( 'Your Review', 'tee' ) . '</label><div class="col-lg-10"><textarea class="form-control" id="comment" name="comment" rows="4" aria-required="true"></textarea></div></div>';
	  			?>
				<?php 
				ob_start();
				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $args ) );
				echo str_replace('class="comment-form"','class="comment-form form-horizontal"',ob_get_clean());
				?>
				<!-- END COMMENT -->
			</div>

		<?php else : ?>
			<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
		<?php endif; ?>
		<div class="col-md-3"></div>
	</div>
</div>