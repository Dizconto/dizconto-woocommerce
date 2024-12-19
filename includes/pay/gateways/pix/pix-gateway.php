<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WC_Dizconto_Pay_Pix_Gateway extends WC_Payment_Gateway {

    public function __construct() {

        // Gateway settings
        $this->id = 'dizconto_pay_pix';
        $this->icon = '';
        $this->has_fields = false;
        $this->method_title = 'Dizconto Pay';
        $this->method_description = 'Take payments with Pix.';

        // Form fields
        $this->title = 'Pix';
        $this->description = 'Pay with Pix.';

        // Supported features
        $this->supports = array(
            'products',
            'refunds'
        );


    }

    public function process_payment( $order_id )
    {
        $order = wc_get_order($order_id);
        $order->update_status('processing');
        return [
            'result'   => 'success',
            'redirect' => $order->get_checkout_order_received_url(),
        ];
    }

    public function process_refund( $order_id, $amount = null, $reason = '' ) {
        if ( $amount > 0) {
            return true;
        }
        return false;
    }

}