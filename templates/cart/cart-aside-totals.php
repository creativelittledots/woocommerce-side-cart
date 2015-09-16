<?php
	
 /**
 *
 * Override this template by copying it to yourtheme/woocommerce/cart/cart-totals.php
 *
 * @author 		Creative Little Dots
 * @package 	WooCommerce/Templates
 * @version     1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="row collapse total" id="basketTotals">
			
	<div class="small-4 columns">
		
		<h5>Subtotal</h5>
		
	</div>
	
	<div class="small-4 columns text-right">
		
		<h5><?php wc_cart_totals_subtotal_html(); ?></h5>
		
		<small>Excl. Tax</small>
		
	</div>
	
	<div class="small-4 columns text-right">
		
		<h5><?php wc_cart_totals_order_total_html(); ?></h5>
		
		<small>Incl. Tax</small>
		
	</div>
	
</div>