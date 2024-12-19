<?php

/**
 * The functionality of the plugin specific to Dizconto Pay (payment gateway).
 *
 * @link       https://dizconto.com
 * @since      1.0.0
 *
 * @package    Dizconto
 * @subpackage Dizconto/pay
 */

/**
 * The functionality of the plugin specific to Dizconto Pay (payment gateway).
 *
 * Implements the WooCommerce payment gateway for Dizconto Pay.
 *
 * @package    Dizconto
 * @subpackage Dizconto/pay
 * @author     Dizconto Ltd. <info@dizconto.com>
 */
class Dizconto_Pay {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        define('WC_DIZCONTO_PAY_TITLE', 'Dizconto Pay');
    }

    /**
     * Declare compatibility with Cart Checkout Blocks.
     * @return void
     */
    public function declare_cart_checkout_blocks_compatibility()
    {
        if (class_exists('\Automattic\WooCommerce\Utilities\FeaturesUtil')) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
                'cart_checkout_blocks',
                $this->plugin_name,
                true
            );
        }
    }

    /**
     * Add the Dizconto Pay's payment gateways to WooCommerce's gateways list.
     *
     * @since    1.0.0
     * @param $methods
     * @return mixed
     */
    public function add_payment_gateways( $methods ) {
        $methods[] = 'Dizconto_Pay_Pix_Gateway';
        $methods[] = 'Dizconto_Pay_CreditCard_Gateway';
        return $methods;
    }

    /**
     * Register the Dizconto Pay's payment method types.
     *
     * @return void
     */
    public function register_block_payment_method_type() {
        if (!class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
            return;
        }
        add_action('woocommerce_blocks_payment_method_type_registration', function($payment_method_registry) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'pay/methods/pix/class-dizconto-pay-pix-block.php';
            $payment_method_registry->register(new Dizconto_Pay_Pix_Block($this->plugin_name, $this->version));

            require_once plugin_dir_path(dirname(__FILE__)) . 'pay/methods/credit-card/class-dizconto-pay-credit-card-block.php';
            $payment_method_registry->register(new Dizconto_Pay_CreditCard_Block($this->plugin_name, $this->version));
        });
    }

}