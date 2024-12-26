<?php

/**
 * Fired during plugin activation
 *
 * @link       https://dizconto.com
 * @since      1.0.0
 *
 * @package    Dizconto
 * @subpackage Dizconto/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Dizconto
 * @subpackage Dizconto/includes
 * @author     Dizconto Ltd. <info@dizconto.com>
 */
class Dizconto_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        require_once plugin_dir_path(__FILE__) . 'pay/class-dizconto-pay-activator.php';
        Dizconto_Pay_Activator::activate();
	}

}
