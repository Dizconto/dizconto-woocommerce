<?php

class Dizconto_Pay_Activator {

    public static function activate() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'pay/methods/pix/class-dizconto-pay-pix-activator.php';
        Dizconto_Pay_Pix_Activator::activate();
    }

}
