<?php

class respondrEnqueue {
	
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'respondrScripts' ) );
	}
	
	function respondrScripts() {
		wp_enqueue_script( 'rsp_tracker', RSPNDR_PLUGIN_URL.'/includes/respondr_tracker.js', array( 'jquery' ), null, false );
		wp_localize_script( 'rsp_tracker', 'respondrVars', array( 'siteId' => get_option( 'respondr_siteid' ), 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}
}

?>