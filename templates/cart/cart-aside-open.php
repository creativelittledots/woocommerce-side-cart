<?php 
	
/**
 *
 * Override this template by copying it to yourtheme/woocommerce/cart/cart-aside-open.php
 *
 * @author 		Creative Little Dots
 * @package 	WooCommerce/Templates
 * @version     1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
?>

<a href="<?php echo wc_get_cart_url(); ?>" class="js-side-cart-icon js-side-cart-open side-cart__icon side-cart__icon--outer  side-cart__icon--mob">
    
    <span class="side-cart__number js-side-cart-number"><?php echo WC()->cart->cart_contents_count; ?></span>
    
</a>