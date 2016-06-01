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

<div id="basketContainer">
			
	<div class="iconic">
		
		<?php $cart_contents_count = apply_filters('woocommerce_side_cart_contents_count', WC()->cart->cart_contents_count); ?>
		
		<?php echo apply_filters('woocommerce_side_cart_menu_icon', '<a href="#" class="basketBtn"><span>'.$cart_contents_count.'</span></a>'); ?>
	
		<h5><?php echo apply_filters('woocommerce_side_cart_heading', __( 'Your Basket', 'woocommerce-side-cart' ) ); ?></h5>
		
		<a href="#" class="closeBasket">&times;</a>
		
	</div>
	
	<hr />
	
	<?php do_action('woocommerce_before_side_cart'); ?>
	
    	<form action="<?php echo WC()->cart->get_cart_url(); ?>" method="post" class="<?php echo apply_filters('woocommerce_side_cart_form_classes', 'cart'); ?>" id="basketForm">
        	
            <?php if ( $cart_contents_count == 0 ) : ?>
            
                <div class="row">
                    
                    <div class="column text-center">
                        
                        <img src="<?= plugins_url( 'assets/images/cart-empty.png', dirname(dirname(__FILE__)) ); ?>" width="67" height="84" alt="Empty basket">
                        
                        <p>Your cart is currently empty.</p>
                        
                        <a href="<?php echo site_url(); ?>/product-categories/" class="line button">Return to Shop</a>
                    
                    </div>
                
                </div>
                
            <?php else : ?>
    		
        		<?php wc_get_template('cart/cart-aside-items.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
        		
        		<hr />
        		
        		<?php wc_get_template('cart/cart-aside-totals.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
        		
        		<hr />
        		
        		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
        		
        		<?php $button_text = apply_filters('woocommerce_side_cart_button_text', __( 'Complete Order', 'woocommerce-side-cart' )); ?>
        		
        		<?php $button_classes = apply_filters('woocommerce_side_cart_button_classes', array('button')); ?>
        		
        		<div class="row">
	        		
	        		<div class="column">
        		
						<?php echo apply_filters('woocommerce_side_cart_button', '<button class="' . implode(' ', $button_classes) . '">' . $button_text . '</button>'); ?>
						
	        		</div>
	        		
        		</div>
        		
        		<?php do_action('woocommerce_side_cart_after_submit_button'); ?>

            <?php endif; ?>    
    	
    	</form>

	
	<?php do_action('woocommerce_after_side_cart'); ?>
		
</div>