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

<ul class="inline-list basketItemControls">
			
	<li><input type="number" step="1" min="0" name="cart[<?php echo $cart_item_key; ?>][qty]" value="<?php echo $cart_item['quantity']; ?>" title="Qty" class="input-text qty text" size="4" data-product_id="<?php echo esc_attr( $product->id ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" data-cart_item_key="<?php echo $cart_item_key; ?>" readonly /></li>
	
	<?php if($cart_item['quantity'] > 1) : ?>
	
		<li><a href="#" rel="nofollow" class="button line add minus <?php echo $product->is_purchasable() && $product->is_in_stock() ? 'reduceBasketItemQtyBtn' : ''; ?> product_type_<?php echo esc_attr( $product->product_type ); ?>">-</a></li>
		
	<?php endif; ?>
	
	<li><a href="#" rel="nofollow" class="button line add plus <?php echo $product->is_purchasable() && $product->is_in_stock() ? 'increaseBasketItemQtyBtn' : ''; ?> product_type_<?php echo esc_attr( $product->product_type ); ?>">+</a></li>
	
	<li class="inline">&times; <h5><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></h5><small>Excl Tax</small></li>
	
</ul>