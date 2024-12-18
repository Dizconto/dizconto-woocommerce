<?php

class Dizconto_Loader {

    public static function init() {
        // Init plugin
        add_filter( 'plugin_action_links_' . DIZCONTO_PLUGIN_BASENAME, [__CLASS__, 'add_plugin_action_links'] );

        // Initialize features.
        self::init_features();
    }

    public static function add_plugin_action_links ( $actions ) {
        $links = array(
            '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=dizconto_pay' ) . '">Settings</a>',
            '<a href="mailto:info@dizconto.com">Support</a>',
        );
        $actions = array_merge( $links, $actions );
        return $actions;
    }

    private static function init_features() {
        // Dizconto Pay.
        require_once DIZCONTO_PLUGIN_DIR . 'src/pay/dizconto-pay-setup.php';
        Dizconto_Pay_Loader::init();
    }
}
