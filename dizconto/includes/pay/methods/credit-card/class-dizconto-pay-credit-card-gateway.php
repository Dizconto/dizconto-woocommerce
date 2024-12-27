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
     * Inject the credit card payment fields into non-block templates.
     *
     * @since    1.0.0
     * @return void
     */
    public function payment_fields() {

        echo '<fieldset id="wc-' . esc_attr( $this->id ) . '-cc-form" class="wc-credit-card-form wc-payment-form" style="background:transparent; display: flex;">';

        do_action( 'woocommerce_credit_card_form_start', $this->id );

        echo '
        <div class="form-row form-row-wide">
            <label>Card Number <span class="required">*</span></label>
		    <input id="dizconto_cc_no" type="text" autocomplete="off">
		</div>
		<div class="form-row form-row-first">
			<label>Expiry Date <span class="required">*</span></label>
			<input id="dizconto_cc_exp" type="text" autocomplete="off" placeholder="MM / YY">
		</div>
		<div class="form-row form-row-last">
			<label>Card Code (CVC) <span class="required">*</span></label>
			<input id="dizconto_cc_cvv" type="password" autocomplete="off" placeholder="CVC">
		</div>
		<div class="clear"></div>
		';

        do_action( 'woocommerce_credit_card_form_end', $this->id );

        echo '<div class="clear"></div></fieldset>';

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
//        $order->set_transaction_id(); // Set transaction ID.
//        $order->save();
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