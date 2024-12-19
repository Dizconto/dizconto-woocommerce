<?php
/*
 * Plugin Name: Dizconto
 * Plugin URI: https://dizconto.com
 * Description: The urban lifestyle payments.
 * Version: 0.0.1
 *
 * Author: Dizconto Ltd.
 * Author URI: http://dizconto.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

// Define constants.
define( 'DIZCONTO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DIZCONTO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DIZCONTO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Plugin update checker.
require DIZCONTO_PLUGIN_DIR . 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$updateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/dizconto/dizconto-wordpress/',
    __FILE__,
    'dizconto-wordpress'
);
$updateChecker->setBranch('main');

// Initialize the plugin.
require_once DIZCONTO_PLUGIN_DIR . 'includes/setup.php';
Dizconto_Loader::init();


