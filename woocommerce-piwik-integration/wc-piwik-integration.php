<?php

/*
Plugin Name: WooCommerce Piwik integration
Description: Provides support for Piwik integration via the WP-Piwik plugin in your WooCommerce powered store.
Author: Coen Jacobs
Author URI: http://coenjacobs.me
Version: 1.0
*/

define( 'WC_PIWIK_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

include( 'classes/class-wc-piwik-integration.php' );

global $wc_piwik_integration;
$wc_piwik_integration = new WC_Piwik_Integration();