<?php
/**
 * Plugin Name: Respondr for WordPress & WooCommerce
 * Plugin URI: http://www.respondr.io
 * Description: This plugin integrates Respondr.io with your WooCommerce site
 * Version: 1.0
 * Author: Respondr
 * Author URI: http://www.respondr.io
 * License: GPL2
 */

define( 'PLUGIN_URL', plugins_url( '', __FILE__ ) );

if ( !function_exists('wp_get_current_user') ) {
	function wp_get_current_user() {
		require (ABSPATH . WPINC . '/pluggable.php');
		global $current_user;
		get_currentuserinfo();
		return $current_user;
	}
}

require_once( 'classes/respondr-settings.php' );
require_once( 'classes/respondr-enqueue.php' );
require_once( 'classes/respondr-piwik.php' );

class respondrMain {
	
	function __construct() {
		new respondrEnqueue();
		new respondrSettings();
		
		global $rpndr;
		$rpndr = new respondrPiwik();
		
		
		// USER ACTIONS
		$current_user = wp_get_current_user();
		if( !empty( $current_user->user_email ) ) { $this->user_login( '', $current_user ); };
		add_action( 'wp_login', array( $this, 'user_login' ), 10, 2 );
		add_action( 'user_register', array( $this, 'save_user' ) );
		
		// WOO ORDER
		add_action( 'woocommerce_order_status_completed', array( $this, 'newOrder' ) );
		
		// ADD TO CART
		add_action( 'woocommerce_cart_updated', array( $this, 'addToCart' ) );

	}
	
	// USER ACITON CALLBACKS
	function save_user( $user_id ) {
		global $rpndr;
		$rpndr->saveUser( $user_id );
	}
	
	function user_login( $user_login, $user ){
		global $rpndr;
		$rpndr->userLogin( $user_login, $user );
	}
	
	// WOO ORDER CALLBACK
	function newOrder( $order_id ) {
		global $rpndr;
		$rpndr->orderComplete( $order_id );
	}
	
	function addToCart() {
		global $rpndr;
		$rpndr->addToCart();
	}
	
}

new respondrMain();

?>