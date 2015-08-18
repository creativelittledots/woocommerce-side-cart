<?php
/*
* Plugin Name: WooCommerce Side Cart
* Description: Add a side menu to your theme to display and control cart items.
* Version: 1.0.0
* Author: Creative Little Dots
* Author URI: http://creativelittledots.co.uk
*
* Text Domain: woocommerce-side-cart
* Domain Path: /languages/
*
* Requires at least: 3.8
* Tested up to: 4.1.1
*
* Copyright: © 2009-2015 Creative Little Dots
* License: GNU General Public License v3.0
* License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists('is_woocommerce_active') ) {
	return;
}

// Check if WooCommerce is active
if ( ! is_woocommerce_active() ) {
	
	return;
	
}


class WC_Side_Cart {
	
	public $version 	= '1.0.0';
	
	public $appendedToMenu = false;
	
	public function __construct() {
		
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		
		// Enqueue Scripts
		add_action( 'wp_enqueue_scripts', array($this, 'woocommerce_side_cart_scripts') );
		
		// Enqueue Styles
		add_action( 'wp_enqueue_scripts', array($this, 'woocommerce_side_cart_styles') );
		
		// Add Basket Button to Current Menu
		add_filter( 'wp_nav_menu_items', array($this, 'woocommerce_side_cart_menu_item'), 10, 2 );
		
		// Add Side Menu to Action
		add_action( 'woocommerce_side_cart', array($this, 'woocommerce_add_side_cart_menu') );
		
		// Backfall to default cart item filter
		add_filter( 'woocommerce_side_cart_item_product', array($this, 'woocommerce_side_cart_item_product'), 10, 3);
		add_filter( 'woocommerce_side_cart_item_name', array($this, 'woocommerce_side_cart_item_name'), 10, 3);
		add_filter( 'woocommerce_side_cart_item_price', array($this, 'woocommerce_side_cart_item_price'), 10, 3);
		
		// Controls
		add_action( 'woocommerce_side_cart_after_product_title', array($this, 'woocommerce_side_cart_item_controls'), 10, 3 );
		
		// Always calculate cart totals
		add_action( 'woocommerce_after_calculate_totals', array($this, 'woocommerce_side_cart_always_calculate_totals') );
		
		// Add to cart fragments
		add_filter( 'add_to_cart_fragments', array($this, 'woocommerce_side_cart_fragments') );
		
		// Ajax
		add_action( 'wp_ajax_change_cart_item_quantity' , array($this, 'change_cart_item_qty') );
		add_action( 'wp_ajax_nopriv_change_cart_item_quantity' , array($this, 'change_cart_item_qty') );
				
	}
	
	public function init() {
		load_plugin_textdomain( 'woocommerce-side-cart', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	
	public function activate() {
		
		global $wpdb;

		$version = get_option( 'woocommerce_side_cart_version', false );
		
		if ( $version == false ) {
			
			add_option( 'woocommerce_side_cart_version', $this->version );

			// Update from previous versions

			// delete old option
			delete_option( 'woocommerce_composite_products_extension_active' );
				
		} elseif ( version_compare( $version, $this->version, '<' ) ) {

			update_option( 'woocommerce_side_cart_version', $this->version );
		}

	}
	
	/**
	 * Deactivate extension.
	 * @return void
	 */
	public function deactivate() {

		delete_option( 'woocommerce_side_cart_version' );
		
	}
	
	public function woocommerce_side_cart_scripts() {
		
		global $woocommerce_side_cart;
		
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		$dependencies = array( 'jquery' );

		if ( class_exists( 'WC_Bundles' ) )
			$dependencies[] = 'wc-add-to-cart-bundle';

		// Add any custom script dependencies here
		// Examples: custom product type scripts and component layered filter scripts
		$dependencies = apply_filters( 'woocommerce_add_side_cart_script_dependencies', $dependencies );
		
		wp_enqueue_script('woocommerce_add_side_cart', $woocommerce_side_cart->plugin_url() . '/assets/js/woocommerce_side_cart' . $suffix . '.js', $dependencies, $woocommerce_side_cart->version, true);
		
	}
	
	public function woocommerce_side_cart_styles() {
		
		global $woocommerce_side_cart;
		
		wp_enqueue_style('woocommerce_add_side_cart', $woocommerce_side_cart->plugin_url() . '/assets/css/woocommerce_side_cart.css', array(), $woocommerce_side_cart->version);
		
	}
	
	public function plugin_url() {
		return plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
	}

	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	public function plugins_loaded() {
		
		global $woocomerce;	
		
	}
	
	public function woocommerce_side_cart_menu_item( $items, $args ) {
		
		if($this->appendedToMenu)
			return $items;
		
		$cart_contents_count = apply_filters('woocommerce_side_cart_contents_count', WC()->cart->cart_contents_count);
		
		$menu_item_text = apply_filters('woocommerce_side_cart_menu_item_text', 'View Basket');
		
		$icon = apply_filters('woocommerce_side_cart_menu_icon', '<a href="#" class="basketBtn hide-for-medium-down"><span>'.$cart_contents_count.'</span>' . $menu_item_text . '</a>');
	
	    $items .= apply_filters('woocommerce_side_cart_menu_item', '<li id="sideCartMenuBtn">' . $icon . '</li>', $items, $args);
	    
	    $this->appendedToMenu = true;
	    
	    return $items;
	    
	}
	
	public function woocommerce_add_side_cart_menu() {
		
		global $woocommerce_side_cart;
	
		wc_get_template('cart/cart-aside.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/');
		
	}
	
	public function woocommerce_side_cart_item_product($_product, $cart_item, $cart_item_key) {
		
		return apply_filters('woocommerce_cart_item_product', $_product, $cart_item, $cart_item_key);
		
	}
	
	public function woocommerce_side_cart_item_name($_name, $cart_item, $cart_item_key) {
		
		return apply_filters('woocommerce_cart_item_name', $_name, $cart_item, $cart_item_key);
		
	}
	
	public function woocommerce_side_cart_item_price($_price, $cart_item, $cart_item_key) {
		
		return apply_filters('woocommerce_cart_item_price', $_price, $cart_item, $cart_item_key);
		
	}
	
	public function woocommerce_side_cart_composite_items($_product, $cart_item, $cart_item_key) {
		
		global $woocommerce_side_cart;
		
		$args = array(
			'product' => $_product, 
			'cart_item' => $cart_item, 
			'cart_item_key' => $cart_item_key
		);
		
		wc_get_template('cart/cart-aside-composite-items.php', $args, false, $woocommerce_side_cart->plugin_path() . '/templates/');
		
	}
	
	public function woocommerce_side_cart_item_controls($_product, $cart_item, $cart_item_key) {
		
		global $woocommerce_side_cart;
		
		$args = array(
			'product' => $_product, 
			'cart_item' => $cart_item, 
			'cart_item_key' => $cart_item_key
		);
		
		wc_get_template('cart/cart-aside-item-controls.php', $args, false, $woocommerce_side_cart->plugin_path() . '/templates/');
		
	}
	
	public function woocommerce_side_cart_always_calculate_totals($cart) {
			
		$cart->total = max( 0, apply_filters( 'woocommerce_calculated_total', round( $cart->cart_contents_total + $cart->tax_total + $cart->shipping_tax_total + $cart->shipping_total + $cart->fee_total, $cart->dp ), $cart ) );
		
	}
	
	public function woocommerce_side_cart_fragments($fragments) {
		
		global $woocommerce_side_cart;
		
		$fragments['.basketBtn span'] = '<span>' . apply_filters('woocommerce_side_cart_contents_count', WC()->cart->cart_contents_count) . '</span>';
		    
	    ob_start();
	    
	    wc_get_template('cart/cart-aside-items.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/');
	    
	    $html = ob_get_contents();
	    
	    ob_end_clean();
	    
	    $fragments['#basket #basketItems'] = $html;
	    
	    ob_start();
	    
	    wc_get_template('cart/cart-aside-totals.php', array(), false, $woocommerce_side_cart->plugin_path() . '/templates/');
	    
	    $html = ob_get_contents();
	    
	    ob_end_clean();
	    
	    $fragments['#basket #basketTotals'] = $html;
	
	    return $fragments;
		
	}
	
	public function change_cart_item_qty() {
		
		ob_start();
			
		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		
		$quantity          = empty( $_POST['quantity'] ) ? 0 : wc_stock_amount( $_POST['quantity'] );
		
		$product_status    = get_post_status( $product_id );
		
		$cart_item_key = $_POST['cart_item_key'];
		
		if ( WC()->cart->set_quantity( $cart_item_key, $quantity, true ) && 'publish' === $product_status ) {
			
			if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
				
				wc_add_to_cart_message( $product_id );
				
			}
			
			// Return fragments
			
			WC_Ajax::get_refreshed_fragments();
			
		} else {
			
			// If there was an error adding to the cart, redirect to the product page to show any errors
			
			$data = array(
				
				'error'       => true,
				
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
				
			);
			
			wp_send_json( $data );
			
		}
		
		die();	
		
	}
	
}

$GLOBALS[ 'woocommerce_side_cart' ] = new WC_Side_Cart();