<?php

class Dizconto_Pay_Pix_Gateway extends WC_Payment_Gateway {

    public function __construct() {

        // Gateway settings
        $this->id = 'dizconto_pay_pix';
        $this->icon = '';
        $this->has_fields = false;
        $this->method_title = 'Dizconto Pay';
        $this->method_description = 'Take payments with Pix.';

        // Form fields
        $this->title = 'Pix';

        // Supported features
        $this->supports = array(
            'products',
            'refunds'
        );


    }

    /**
     * Process payment for Pix payment method.
     *
     * @since    1.0.0
     * @param $order_id
     * @return array
     */
    public function process_payment( $order_id )
    {
        $order = wc_get_order($order_id);
        $order->update_status('payment_pending');
        return [
            'result'   => 'success',
            'redirect' => $order->get_checkout_order_received_url(),
        ];
    }

    /**
     * Process a refund for Pix payment method.
     *
     * @since    1.0.0
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