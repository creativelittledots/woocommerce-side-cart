<?php
/**
 *
 * Override this template by copying it to yourtheme/woocommerce/cart/cart-aside.php
 *
 * @author 		Creative Little Dots
 * @package 	WooCommerce/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_side_cart; 

?>

<aside id="basket" class="woocommerce">
			
	<div class="iconic">
		
		<?php $cart_contents_count = apply_filters('woocommerce_side_cart_contents_count', WC()->cart->cart_contents_count); ?>
		
		<?php echo apply_filters('woocommerce_side_cart_menu_icon', '<a href="#" class="basketBtn"><span>'.$cart_contents_count.'</span></a>'); ?>
	
		<h5><?php echo apply_filters('woocommerce_side_cart_heading', __( 'Your Basket', 'woocommerce-side-cart' ) ); ?></h5>
		
		<a href="#" class="closeBasket">&times;</a>
		
	</div>
	
	<hr />
	
	<form action="<?php echo WC()->cart->get_cart_url(); ?>" method="post" class="<?php echo apply_filters('woocommerce_side_cart_form_classes', 'cart'); ?>" id="basketForm">
		
		<?php wc_get_template('cart/cart-aside-items.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
		
		<hr />
		
		<?php wc_get_template('cart/cart-aside-totals.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
		
		<hr />
		
		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		
		<?php $button_text = apply_filters('woocommerce_side_cart_button_text', __( 'Complete Order', 'woocommerce-side-cart' )); ?>
		
		<?php $button_classes = apply_filters('woocommerce_side_cart_button_classes', array('button')); ?>
		
		<?php echo apply_filters('woocommerce_side_cart_button', '<button class="' . implode(' ', $button_classes) . '">' . $button_text . '</button>'); ?>
		
		<?php do_action('woocommerce_side_cart_after_submit_button'); ?>
	
	</form>
		
</aside>