<?php

class Dizconto_Pay_Pix_Activator {

    public static function activate() {
        self::register_pix_payment_page();
    }

    private static function register_pix_payment_page() {
        require_once plugin_dir_path(__FILE__) . 'class-dizconto-pay-pix-gateway.php';
        $pix_gateway = new Dizconto_Pay_Pix_Gateway();
        $pix_gateway->register_pix_payment_page();
    }

}
