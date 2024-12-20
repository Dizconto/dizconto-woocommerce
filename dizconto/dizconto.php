<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dizconto.com
 * @since             1.0.0
 * @package           Dizconto
 *
 * @wordpress-plugin
 * Plugin Name:       Dizconto
 * Plugin URI:        https://dizconto.com
 * Description:       A payment gateway for Brazil.
 * Version:           1.0.0
 * Author:            Dizconto Ltd.
 * Author URI:        https://dizconto.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dizconto
 * Domain Path:       /languages
 * Requires Plugins:  woocommerce
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DIZCONTO_VERSION', '1.0.0' );
define( 'DIZCONTO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DIZCONTO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dizconto-activator.php
 */
function activate_dizconto() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-dizconto-activator.php';
	Dizconto_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dizconto-deactivator.php
 */
function deactivate_dizconto() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-dizconto-deactivator.php';
	Dizconto_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dizconto' );
register_deactivation_hook( __FILE__, 'deactivate_dizconto' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-dizconto.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dizconto() {

	$plugin = new Dizconto();
	$plugin->run();

}
run_dizconto();
