<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class WC_Dizconto_Pay_Pix_Block extends AbstractPaymentMethodType {
    private $gateway;
    protected $name = 'dizconto_pay_pix';
    public function initialize() {
        $this->gateway = new WC_Dizconto_Pay_Pix_Gateway();
    }
    public function is_active() {
        return $this->gateway->is_available();
    }
    public function get_payment_method_script_handles() {
        wp_register_script(
            'wc-dizconto-pay-pix-blocks-integration',
            DIZCONTO_PLUGIN_URL . 'build/pix-checkout.js',
            [
                'wc-blocks-registry',
                'wc-settings',
                'wp-element',
                'wp-html-entities',
            ],
            null,
            true
        );
        return [ 'wc-dizconto-pay-pix-blocks-integration' ];
    }
    public function get_payment_method_data() {
        return [
            'id' => $this->gateway->id,
            'title' => $this->gateway->title,
            'description' => $this->gateway->description,
            'supports' => $this->gateway->supports,
            'contentImage' => DIZCONTO_PLUGIN_URL . 'includes/assets/images/payment-methods/pix.webp',
        ];
    }
}