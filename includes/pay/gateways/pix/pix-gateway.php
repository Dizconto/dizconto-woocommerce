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
            'refund'
        );


    }

}