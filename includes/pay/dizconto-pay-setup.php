<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

const WC_DIZCONTO_PAY_TITLE = 'Dizconto Pay';
const WC_DIZCONTO_PAY_GATEWAYS_DIR = DIZCONTO_PLUGIN_DIR . 'includes/pay/gateways/';

/**
 * Initialize the Dizconto Pay gateway.
 */
class Dizconto_Pay_Loader {
    public static function init() {
        add_action('plugins_loaded', [__CLASS__, 'load_dependencies']);

        // General Payment Gateway setup.
        add_filter('woocommerce_payment_gateways', [__CLASS__, 'add_payment_gateway']);

        // Support for cart checkout blocks.
        add_action('before_woocommerce_init', [__CLASS__, 'declare_cart_checkout_blocks_compatibility']);
        add_action('woocommerce_blocks_loaded', [__CLASS__, 'register_block_payment_method_type']);
    }

    /**
     * Load required dependencies.
     */
    public static function load_dependencies() {
        require_once WC_DIZCONTO_PAY_GATEWAYS_DIR . 'card/index.php';
        require_once WC_DIZCONTO_PAY_GATEWAYS_DIR . 'pix/index.php';
    }

    /**
     * Add the payment gateway to WooCommerce.
     */
    public static function add_payment_gateway($gateways) {
        $gateways[] = 'WC_Dizconto_Pay_Card_Gateway';
        $gateways[] = 'WC_Dizconto_Pay_Pix_Gateway';
        return $gateways;
    }

    /**
     * Declare compatibility with cart_checkout_blocks feature.
     */
    public static function declare_cart_checkout_blocks_compatibility() {
        if (class_exists('\Automattic\WooCommerce\Utilities\FeaturesUtil')) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
                'cart_checkout_blocks',
                DIZCONTO_PLUGIN_BASENAME,
                true
            );
        }
    }

    /**
     * Register block payment method type.
     */
    public static function register_block_payment_method_type() {
        if (!class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
            return;
        }
        function register_payment_method_types($payment_method_registry) {
            $payment_method_registry->register(new WC_Dizconto_Pay_Card_Block());
            $payment_method_registry->register(new WC_Dizconto_Pay_Pix_Block());
        }
        add_action('woocommerce_blocks_payment_method_type_registration', 'register_payment_method_types');
    }
}