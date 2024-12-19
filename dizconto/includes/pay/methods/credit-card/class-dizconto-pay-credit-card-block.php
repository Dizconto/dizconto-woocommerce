<?php

require_once plugin_dir_path(dirname(__FILE__)) . 'credit-card/class-dizconto-pay-credit-card-gateway.php';

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class Dizconto_Pay_CreditCard_Block extends AbstractPaymentMethodType {

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

    }

    private $gateway;
    protected $name = 'dizconto_pay_credit_card';

    /**
     * The initialization function for this payment method.
     *
     * @since    1.0.0
     * @return void
     */
    public function initialize() {
        $this->gateway = new Dizconto_Pay_CreditCard_Gateway();
    }

    /**
     * Determine if this payment method is active.
     *
     * @since    1.0.0
     * @return mixed
     */
    public function is_active() {
        return $this->gateway->is_available();
    }

    /**
     * The public scripts passed to the frontend for this payment method.
     *
     * @since    1.0.0
     * @return array
     */
    public function get_payment_method_script_handles() {
        $scriptHandle = 'dizconto-pay-credit-card-block-integration';
        wp_register_script(
            $scriptHandle,
            DIZCONTO_PLUGIN_URL . 'build/credit-card-checkout.js',
            [
                'wc-blocks-registry',
                'wc-settings',
                'wp-element',
                'wp-html-entities',
            ],
            null,
            true
        );
        return [ $scriptHandle ];
    }

    /**
     * The public data passed to the frontend for this payment method.
     *
     * @since    1.0.0
     * @return array
     */
    public function get_payment_method_data() {
        return [
            'id' => $this->gateway->id,
            'title' => $this->gateway->title,
            'supports' => $this->gateway->supports,
        ];
    }
}
