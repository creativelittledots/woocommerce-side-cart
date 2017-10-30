<?php 
	
/**
 *
 * Override this template by copying it to yourtheme/woocommerce/cart/cart-aside-item-controls.php
 *
 * @author 		Creative Little Dots
 * @package 	WooCommerce/Templates
 * @version     1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<ul class="side-cart__controls js-side-cart-item-controls">
			
	<li class="side-cart__control_item">
	
		<input type="number" step="1" min="0" name="cart[<?php echo $cart_item_key; ?>][qty]" value="<?php echo $cart_item['quantity']; ?>" title="Qty" class="input-text qty js-side-cart-change-qty text side-cart__qty" size="4" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" data-cart_item_key="<?php echo $cart_item_key; ?>" />
	
	</li>
	
	<li class="side-cart__control_item">
	
		&times; 
		
	</li>
	
	<li class="side-cart__control_item">
		
		<strong>
		
			<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $product ), $cart_item, $cart_item_key ); ?>
		
		</strong>
		
	</li>
	
</ul>