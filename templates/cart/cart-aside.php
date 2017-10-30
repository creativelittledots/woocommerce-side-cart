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

do_action('woocommerce_before_side_cart');

?>

<aside class="side-cart woocommerce">
    
    <div class="side-cart__container js-side-cart-container">
			
    	<div class="side-cart__iconic">
    		
    		<a href="<?php echo wc_get_cart_url(); ?>" class="side-cart__icon">
        		
        		<span class="side-cart__number">
        		
        		    <?php echo apply_filters('woocommerce_side_cart_contents_count', WC()->cart->cart_contents_count); ?>
        		    
        		</span>
        		
    		</a>
    	
    		<h5 class="side-cart__top_title"><?php echo apply_filters('woocommerce_side_cart_heading', __( 'Your Basket', 'woocommerce-side-cart' ) ); ?></h5>
    		
    		<a href="#" class="js-side-cart-close side-cart__close">&times;</a>
    		
    	</div>
    	
    	<form action="<?php echo wc_get_cart_url(); ?>" method="post" class="js-side-cart-form side-cart__form">
        	
            <?php if ( WC()->cart->cart_contents_count == 0 ) : ?>
            
                <?php wc_get_template( 'cart/cart-aside-empty.php',  array(), false, $woocommerce_side_cart->plugin_path() . '/templates/' ); ?>
                
            <?php else : ?>
    		
        		<?php wc_get_template('cart/cart-aside-items.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
        		
        		<div class="side-cart__footer">
        		
            		<?php wc_get_template('cart/cart-aside-totals.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
            		
            		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
            		
        		</div>
    
            <?php endif; ?>    
    	
    	</form>
    	
    </div>
		
</aside>

<?php do_action('woocommerce_after_side_cart'); ?>