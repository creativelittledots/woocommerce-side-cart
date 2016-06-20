<?php 
	
/**
 *
 * Override this template by copying it to yourtheme/woocommerce/cart/cart-aside-items.php
 *
 * @author 		Creative Little Dots
 * @package 	WooCommerce/Templates
 * @version     1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
?>

<div class="items js-side-cart-items">
		
	<?php foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item) : 
		
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key ); 
		$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		
	?>
	
		<?php if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) : ?>
		
			<div class="item">
				
				<h5 class="itemName">
					
					<?php
											
					if ( ! $_product->is_visible() )
						echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
						
					else
						echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );

					?>	
					
					| 
					
					<a href="<?php echo wp_nonce_url( add_query_arg( 'remove_item', $cart_item_key ), 'woocommerce-cart' ); ?>" class="remove removeBasketItem" title="<?php echo __('Remove this item', 'woocommerce-side-cart'); ?>">Remove</a>
					
				</h5>
				
			
				<?php 
					
					// Meta data
					echo WC()->cart->get_item_data( $cart_item );

       				// Backorder notification
       				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
       					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
					
					/**
					* woocommerce_side_cart_after_product_title hook
					*
					* @hooked woocommerce_side_cart_item_controls - 10
					*/
					
					do_action('woocommerce_side_cart_after_product_title', $_product, $cart_item, $cart_item_key); 
					
				?>
				
			</div>
		
		<?php endif;  ?>
		
	<?php endforeach; ?>
	
</div>