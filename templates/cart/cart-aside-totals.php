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

<div class="side-cart__totals">

	<?php wc_get_template( 'cart/cart-totals.php' ); ?>

</div>