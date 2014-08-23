<?php

class WC_Piwik_Tracker {
	private $order_id;

	public function __construct( $order ) {
		global $woocommerce;

		// Get tracking code
		ob_start();
		?>
		try {
			// Add order items
			<?php if ( $order->get_items() ) foreach( $order->get_items() as $item ) : $_product = $order->get_product_from_item( $item ); ?>

				piwikTracker.addEcommerceItem(
					"<?php echo esc_js( $_product->get_sku() ); ?>",			// (required) SKU: Product unique identifier
					"<?php echo esc_js( $item['name'] ); ?>",					// (optional) Product name
					"<?php
						if ( isset( $_product->variation_data ) )
							echo esc_js( woocommerce_get_formatted_variation( $_product->variation_data, true ) );
					?>",	// (optional) Product category. You can also specify an array of up to 5 categories eg. ["Books", "New releases", "Biography"]
					<?php echo esc_js( $order->get_item_total( $item ) ); ?>,	// (recommended) Product price
					<?php echo esc_js( $item['qty'] ); ?> 						// (optional, default to 1) Product quantity
				);

			<?php endforeach; ?>

			// Track order
			piwikTracker.trackEcommerceOrder(
				"<?php echo esc_js( $order->get_order_number() ); ?>",	// (required) Unique Order ID
				<?php echo esc_js( $order->get_total() ); ?>,			// (required) Order Revenue grand total (includes tax, shipping, and subtracted discount)
				false,													// (optional) Order sub total (excludes shipping)
				<?php echo esc_js( $order->get_total_tax() ); ?>,		// (optional) Tax amount
				<?php echo esc_js( $order->get_shipping() ); ?>,		// (optional) Shipping amount
				false 													// (optional) Discount offered (set to false for unspecified parameter)
			);
		} catch( err ) {}
		<?php
		$code = ob_get_clean();
		$woocommerce->add_inline_js( $code );
	}
}