<?php

class Dizconto_Loader {

    public static function init() {
        // Initialize features.
        self::init_features();
    }

    private static function init_features() {
        // Dizconto Settings
        require_once DIZCONTO_PLUGIN_DIR . 'includes/settings/dizconto-settings-setup.php';
        Dizconto_Settings_Setup::init();

        // Dizconto Pay.
        require_once DIZCONTO_PLUGIN_DIR . 'includes/pay/dizconto-pay-setup.php';
        Dizconto_Pay_Loader::init();
    }
}
