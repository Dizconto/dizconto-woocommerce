<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class WC_Dizconto_Pay_Card_Block extends AbstractPaymentMethodType {
    private $gateway;
    protected $name = 'dizconto_pay_card';
    public function initialize() {
        $this->gateway = new WC_Dizconto_Pay_Card_Gateway();
    }
    public function is_active() {
        return $this->gateway->is_available();
    }
    public function get_payment_method_script_handles() {
        wp_register_script(
            'wc-dizconto-pay-card-blocks-integration',
            DIZCONTO_PLUGIN_URL . 'src/blocks/card-checkout.js',
            [
                'wc-blocks-registry',
                'wc-settings',
                'wp-element',
                'wp-html-entities',
            ],
            null,
            true
        );
        return [ 'wc-dizconto-pay-card-blocks-integration' ];
    }
    public function get_payment_method_data() {
        return [
            'id' => $this->gateway->id,
            'title' => $this->gateway->title,
            'description' => $this->gateway->description,
            'supports' => $this->gateway->supports,
        ];
    }
}