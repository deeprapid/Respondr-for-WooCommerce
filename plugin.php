<?php
/**
 * Plugin Name: Respondr for WordPress & WooCommerce
 * Plugin URI: http://www.respondr.io
 * Description: This plugin installs Respondr into your WooCommerce site
 * Version: 2.0.2
 * Author: Respondr
 * Author URI: http://www.respondr.io
 * License: GPL2
 */

define( 'RSPNDR_PLUGIN_URL', plugins_url( '', __FILE__ ) );

if ( !function_exists('wp_set_current_user') ) {
	function wp_set_current_user($id, $name = '') {
		global $current_user;

		if ( isset( $current_user ) && ( $current_user instanceof WP_User ) && ( $id == $current_user->ID ) )
			return $current_user;

		$current_user = new WP_User( $id, $name );

		setup_userdata( $current_user->ID );

		/**
		 * Fires after the current user is set.
		 *
		 * @since 2.0.1
		 */
		do_action( 'set_current_user' );

		return $current_user;
	}
}

if ( !function_exists('get_currentuserinfo') ) {
	function get_currentuserinfo() {
		global $current_user;

		if ( ! empty( $current_user ) ) {
			if ( $current_user instanceof WP_User )
				return;

			// Upgrade stdClass to WP_User
			if ( is_object( $current_user ) && isset( $current_user->ID ) ) {
				$cur_id = $current_user->ID;
				$current_user = null;
				wp_set_current_user( $cur_id );
				return;
			}

			// $current_user has a junk value. Force to WP_User with ID 0.
			$current_user = null;
			wp_set_current_user( 0 );
			return false;
		}

		if ( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) {
			wp_set_current_user( 0 );
			return false;
		}

		/**
		 * Filter the current user.
		 *
		 * The default filters use this to determine the current user from the
		 * request's cookies, if available.
		 *
		 * Returning a value of false will effectively short-circuit setting
		 * the current user.
		 *
		 * @since 3.9.0
		 *
		 * @param int|bool $user_id User ID if one has been determined, false otherwise.
		 */
		$user_id = apply_filters( 'determine_current_user', false );
		if ( ! $user_id ) {
			wp_set_current_user( 0 );
			return false;
		}

		wp_set_current_user( $user_id );
	}
}

if ( !function_exists('wp_get_current_user') ) {
	function wp_get_current_user() {
		global $current_user;
		get_currentuserinfo();
		return $current_user;
	}
}

require_once( 'classes/respondr-settings.php' );
require_once( 'classes/respondr-enqueue.php' );
require_once( 'classes/respondr.php' );

class respondrMain {
	
	function __construct() {
		
		new respondrEnqueue();
		new respondrSettings();
		
		global $rpndr;
		$rpndr = new Respondr();
		
		
		// USER ACTIONS
		$current_user = wp_get_current_user();
		if( !empty( $current_user->user_email ) ) { $this->user_login( '', $current_user ); };
		
		add_action( 'user_register', array( $this, 'save_user' ) );
		
		// WOO ORDER
		add_action( 'woocommerce_order_status_pending', array( $this, 'newOrder' ) );
		
		
		// ADD TO CART
		add_action( 'woocommerce_cart_updated', array( $this, 'addToCart' ) );
		
		// VIEW PAGE
		add_action('wp', array( $this, 'pageView' ) );
		

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
		$rpndr->newOrder( $order_id );
	}
	
	// ADD TO CART
	function addToCart() {
		global $rpndr;
		$rpndr->addToCart();
	}
	
	// VIEW PROD
	function pageView($query){
		global $rpndr;
		if( 'product' == get_post_type() && !is_archive( 'product_cat' ) ){
			$rpndr->viewProd();
		} elseif (isset($query->query_vars["s"])) {
			$rpndr->siteSearch($query->query_vars["s"]);		
		} elseif ( is_front_page() ) {
			$rpndr->viewPage();
		} elseif ( !isset($query->query_vars["cat"]) && is_archive( 'product_cat' ) ) {
			$rpndr->viewCat();
		} elseif( is_page( 'Checkout' ) && isset( $_GET['order-received'] ) ) {
			$rpndr->newOrder( $_GET['order-received'] );
		} else {
			$rpndr->viewPage();
		}
	}

	
}

new respondrMain();

?>