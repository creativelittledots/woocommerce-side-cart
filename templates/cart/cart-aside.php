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

<<<<<<< HEAD
<aside class="side-cart woocommerce">
    
    <div class="side-cart-container">
			
    	<div class="iconic">
    		
    		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="side-cart-icon">
        		
        		<span>
        		
        		    <?php echo apply_filters('woocommerce_side_cart_contents_count', WC()->cart->cart_contents_count); ?>
        		    
        		</span>
        		
    		</a>
    	
    		<h5><?php echo apply_filters('woocommerce_side_cart_heading', __( 'Your Basket', 'woocommerce-side-cart' ) ); ?></h5>
    		
    		<a href="#" class="js-side-cart-close">&times;</a>
    		
    	</div>
    	
    	<form action="<?php echo WC()->cart->get_cart_url(); ?>" method="post" class="js-side-cart-form">
        	
            <?php if ( WC()->cart->cart_contents_count == 0 ) : ?>
            
                <?php wc_get_template( 'cart/cart-empty.php' ); ?>
                
            <?php else : ?>
    		
        		<?php wc_get_template('cart/cart-aside-items.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
        		
        		<div class="side-cart-footer">
        		
            		<?php wc_get_template('cart/cart-aside-totals.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
            		
            		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
            		
        		</div>
    
            <?php endif; ?>    
    	
    	</form>
    	
    </div>
		
</aside>

<?php do_action('woocommerce_after_side_cart'); ?>
=======
<aside class="side-cart">
			
	<div class="iconic">
		
		<a href="#" class="side-cart-icon">
    		
    		<span>
    		
    		    <?php echo apply_filters('woocommerce_side_cart_contents_count', WC()->cart->cart_contents_count); ?>
    		    
    		</span>
    		
		</a>
	
		<h5><?php echo apply_filters('woocommerce_side_cart_heading', __( 'Your Basket', 'woocommerce-side-cart' ) ); ?></h5>
		
		<a href="#" class="js-side-cart-close">&times;</a>
		
	</div>
	
	<hr />
	
	<?php do_action('woocommerce_before_side_cart'); ?>
	
	<form action="<?php echo WC()->cart->get_cart_url(); ?>" method="post" class="js-side-cart-form">
    	
        <?php if ( WC()->cart->cart_contents_count == 0 ) : ?>
        
            <div class="row">
                
                <div class="column text-center">
                    
                    <img src="<?= plugins_url( 'assets/images/cart-empty.png', dirname(dirname(__FILE__)) ); ?>" width="67" height="84" alt="Empty basket">
                    
                    <p>Your cart is currently empty.</p>
                    
                    <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="line button">Return to Shop</a>
                
                </div>
            
            </div>
            
        <?php else : ?>
		
    		<?php wc_get_template('cart/cart-aside-items.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
    		
    		<hr />
    		
    		<?php wc_get_template('cart/cart-aside-totals.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/'); ?>
    		
    		<hr />
    		
    		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
    		
    		<div class="row">
        		
        		<div class="column">
    		
				    <button class="<?php implode(' ', apply_filters('woocommerce_side_cart_button_classes', array('button'))); ?>"><?php apply_filters('woocommerce_side_cart_button_text', __( 'Complete Order', 'woocommerce-side-cart' )); ?></button>
					
        		</div>
        		
    		</div>
    		
    		<?php do_action('woocommerce_side_cart_after_submit_button'); ?>

        <?php endif; ?>    
	
	</form>

	
	<?php do_action('woocommerce_after_side_cart'); ?>
		
</aside>
>>>>>>> master
