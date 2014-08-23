<?php

class WC_Piwik_Integration {
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'setup' ) );
	}

	public function setup() {
		global $woocommerce;

		if ( is_object( $woocommerce ) && version_compare( $woocommerce->version, '2.1', '>=' ) ) {
			add_action( 'woocommerce_thankyou', array( $this, 'add_tracking_code' ), 10, 1 );
		}
	}

	public function add_tracking_code( $order_id ) {
		if ( $this->should_tracker_be_output() ) {
			require_once( WC_PIWIK_PLUGIN_DIR . 'classes/class-wc-piwik-tracker.php' );

			$order = new WC_Order( $order_id );
			new WC_Piwik_Tracker( $order );
		}
	}

	private function should_tracker_be_output() {
		if ( $this->can_current_user_manage_options() )
			return false;

		if ( ! $this->is_wp_piwik_plugin_set_for_tracking() )
			return false;
		
		if ( ! $this->is_wp_piwik_plugin_active() )
			return false;

		return true;
	}

	private function can_current_user_manage_options() {
		return ( current_user_can('manage_options') );
	}

	private function is_wp_piwik_plugin_set_for_tracking() {
		$wp_piwik_global_settings = get_option( 'wp-piwik_global-settings' );

		return ( isset( $wp_piwik_global_settings['add_tracking_code'] ) && $wp_piwik_global_settings['add_tracking_code'] );
	}

	private function is_wp_piwik_plugin_active() {
		return ( isset( $GLOBALS['wp_piwik'] ) );
	}
}
