<?php
/**
 * Woocommerce Compatibility
 */
// THEME SUPPORT
add_theme_support( 'woocommerce' );

// USE HOMEMADE CSS
define('WOOCOMMERCE_USE_CSS', false);

// CHANGE NUMBER OF PRODUCTS DISPLAYED
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

// CUSTOM DETAILS
add_action( 'woocommerce_after_shop_loop_item', 'tee_remove_add_to_cart_buttons', 1 );
function tee_remove_add_to_cart_buttons() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}
add_action( 'woocommerce_after_shop_loop_item', 'tee_change_info_buttons', 1 );
function tee_change_info_buttons() {
    add_action( 'woocommerce_after_shop_loop_item', 'tee_product_button' );
}
function tee_product_button() {
	global $product;
	echo '<a href="' . get_permalink( $product->id ) . '" class="button add_to_cart_button product_type_external btn btn-default"><i class="icon-cart"></i> ';
	_e("Add to cart","tee");
	echo '</a>';
}
//HEADER CART
function tee_wc_print_mini_cart() {
	if (function_exists('is_woocommerce')) {
	?>
	<div id="tee_mini_cart_wrap">
		<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
			<ul class="tee-mini-cart-products">
				<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
					$_product = $cart_item['data'];

					// Only display if allowed
					if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
						continue;

					// Get price
					$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
					$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
					?>

					<li class="tee-mini-cart-product">
						<span class="tee-mini-cart-thumbnail">
							<?php echo $_product->get_image(); ?>
						</span>
						<span class="tee-mini-cart-info">

							<a class="tee-mini-cart-title" href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
								<h4><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></h4>
							</a>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_price', '<span class="tee-mini-cart-price">' . __('Unit Price', 'tee') . ':' . $product_price . '</span>', $cart_item, $cart_item_key ); ?>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="tee-mini-cart-quantity">' . __('Quantity', 'tee') . ':' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key ); ?>
						</span>
					</li>

				<?php endforeach; ?>
			</ul><!-- end .tee-mini-cart-products -->
		<?php else : ?>
			<p class="tee-mini-cart-product-empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>
		<?php endif; ?>

		<?php if (sizeof( WC()->cart->get_cart()) > 0) : ?>
			<h4 class="center tee-mini-cart-subtotal"><?php _e( 'Cart Subtotal', 'woocommerce' ); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></h4>
			<div class="center">
			<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button cart btn btn-default"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
			<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button alt checkout btn btn-default"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
	<?php
	}
}