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

<a href="<?php WC()->cart->get_cart_url(); ?>" class="js-side-cart-open side-cart-icon">
    
    <span><?php echo WC()->cart->cart_contents_count; ?></span>
    
</a>