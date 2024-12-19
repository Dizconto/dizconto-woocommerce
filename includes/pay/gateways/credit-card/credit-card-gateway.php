<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WC_Dizconto_Pay_Credit_Card_Gateway extends WC_Payment_Gateway {

    public function __construct() {

        // Gateway settings
        $this->id = 'dizconto_pay_credit_card';
        $this->icon = '';
        $this->has_fields = true;
        $this->method_title = WC_DIZCONTO_PAY_TITLE;
        $this->method_description = 'Take payments with credit cards.';

        // Form fields
        $this->title = 'Credit Card';
        $this->description = 'Pay with your credit card.';

        // Supported features
        $this->supports = array(
            'products',
            'refund'
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

}