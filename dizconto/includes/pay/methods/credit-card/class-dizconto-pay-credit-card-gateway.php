<?php

class Dizconto_Pay_CreditCard_Gateway extends WC_Payment_Gateway {

    public function __construct() {

        // Gateway settings
        $this->id = 'dizconto_pay_credit_card';
        $this->icon = '';
        $this->has_fields = true;
        $this->method_title = WC_DIZCONTO_PAY_TITLE;
        $this->method_description = 'Take payments with credit cards.';

        // Form fields
        $this->title = 'Credit Card';

        // Supported features
        $this->supports = array(
            'products',
            'refunds'
        );

    }

    /**
     * Process payment for the credit card payment method.
     *
     * @since 1.0.0
     * @param $order_id
     * @return array
     */
    public function process_payment( $order_id )
    {
        $order = wc_get_order($order_id);
        $order->update_status('processing');
        return [
            'result'   => 'success',
            'redirect' => $order->get_checkout_order_received_url(),
        ];
    }

    /**
     * Process a refund for the credit card payment method.
     *
     * @since 1.0.0
     * @param $order_id
     * @param $amount
     * @param $reason
     * @return bool
     */
    public function process_refund( $order_id, $amount = null, $reason = '' ) {
        if ( $amount > 0) {
            return true;
        }
        return false;
    }

}