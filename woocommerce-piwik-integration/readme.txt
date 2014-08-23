=== WooCommerce Piwik integration ===
Contributors: CoenJacobs
Tags: woocommerce, piwik
Donate link: http://coenjacobs.me/en/donate/
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Provides support for Piwik integration via the WP-Piwik plugin in your WooCommerce powered store.

== Description ==

This plugin integrates your WooCommerce store with the [WP-Piwik plugin](http://wordpress.org/extend/plugins/wp-piwik/) plugin, providing support for tracking your checkout process through Piwik. Please note that you need your own Piwik installation for this plugin (and WP-Piwik) to function, look at the [Piwik website](http://piwik.org/) to get more information.

Starting WooCommerce 2.1, this integration will no longer be part of WooCommerce and will only be available by using this plugin. More information about this in the [FAQ](http://wordpress.org/extend/plugins/woocommerce-piwik-integration/faq/).

Contributions are welcome via the [GitHub repository](https://github.com/coenjacobs/wc-piwik-integration).

== Installation ==

1. Download the plugin file to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installation’s wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.

Or use the automatic installation wizard through your admin panel, just search for this plugins name.

== Frequently Asked Questions ==

= Where can I find the setting for this plugin? =

This plugin has no settings. It just integrates WooCommerce with your own [Piwik](http://piwik.org/) install and the [WP-Piwik plugin](http://wordpress.org/extend/plugins/wp-piwik/).

= Why does this plugin say it is doing nothing? =

Starting the WooCommerce 2.1 release, the Piwik integration for WooCommerce is no longer part of the WooCommerce plugin.

Until you've updated to WooCommerce 2.1, this plugin puts itself in some sort of hibernate mode.

You can leave this plugin activated and it will seamlessly take over the integration that once was in the WooCommerce plugin, once you update to the next version.

== Changelog ==

= 1.0 - 22/11/2013 =
 * Feature: Plugin checks for required WooCommerce version or doesn't do anything
 * Tweak: Split up logic and output into classes, powered by a lean bootstrap script

= 0.1.1 - 17/05/2013 =
 * Fix: Make this compatible with versions before WooCommerce 2.1

= 0.1 - 02/05/2013 =
 * Initial release to get this up on wordpress.org
