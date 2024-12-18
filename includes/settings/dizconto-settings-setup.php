<?php

class Dizconto_Settings_Setup {

    public static function init() {
        add_action( 'admin_menu', [__CLASS__, 'dizconto_settings_page'] );
        add_action( 'admin_init', [__CLASS__, 'dizconto_settings_init'] );
        add_filter( 'plugin_action_links_' . DIZCONTO_PLUGIN_BASENAME, [__CLASS__, 'add_plugin_action_links'] );
    }

    /**
     * Plugin action links
     * @param $actions
     * @return string[]
     */
    public static function add_plugin_action_links ( $actions ) {
        $links = array(
            '<a href="' . admin_url( 'admin.php?page=dizconto' ) . '">Settings</a>',
            '<a href="mailto:info@dizconto.com">Support</a>',
        );
        $actions = array_merge( $links, $actions );
        return $actions;
    }


    /**
     * Add the top level menu page.
     */
    public static function dizconto_settings_page() {
        add_menu_page(
            'Dizconto Settings',    // Page title
            'Dizconto',             // Menu title
            'manage_options',
            'dizconto',             // Menu slug
            [__CLASS__, 'dizconto_options_page_html']
        );
    }


    /**
     * The setting's page fields.
     * @return void
     */
    public static function dizconto_settings_init() {
        // Register a new setting for "dizconto" page.
        register_setting('dizconto', 'dizconto_options', [
            'sanitize_callback' => [__CLASS__, 'sanitize_dizconto_options'] // Optional: Add a sanitization function
        ]);

        // Register a new section in the "dizconto" page.
        add_settings_section(
            'dizconto_section_api',
            __('API Settings', 'dizconto'),
            [__CLASS__, 'dizconto_section_api_callback'],
            'dizconto'
        );

        // Register a new field for the API key
        add_settings_field(
            'dizconto_api_key',
            __('API Key', 'dizconto'),
            [__CLASS__, 'dizconto_api_key_cb'],
            'dizconto',
            'dizconto_section_api'
        );

        // Register a new field for the API secret
        add_settings_field(
            'dizconto_api_secret',
            __('API Secret', 'dizconto'),
            [__CLASS__, 'dizconto_api_secret_cb'],
            'dizconto',
            'dizconto_section_api'
        );
    }

    public static function dizconto_api_key_cb($args) {
        // Get the stored API key
        $options = get_option('dizconto_options');
        ?>
        <input
            type="text"
            id="dizconto_api_key"
            name="dizconto_options[dizconto_api_key]"
            value="<?php echo isset($options['dizconto_api_key']) ? esc_attr($options['dizconto_api_key']) : ''; ?>"
            class="regular-text"
        />
        <?php
    }

    public static function dizconto_api_secret_cb($args) {
        // Get the stored API secret
        $options = get_option('dizconto_options');
        ?>
        <input
            type="password"
            id="dizconto_api_secret"
            name="dizconto_options[dizconto_api_secret]"
            value="<?php echo isset($options['dizconto_api_secret']) ? esc_attr($options['dizconto_api_secret']) : ''; ?>"
            class="regular-text"
        />
        <?php
    }

    public static function sanitize_dizconto_options($input) {
        // Sanitize the API key and secret
        $input['dizconto_api_key'] = sanitize_text_field($input['dizconto_api_key']);
        $input['dizconto_api_secret'] = sanitize_text_field($input['dizconto_api_secret']);
        return $input;
    }

    public static function dizconto_options_page_html() {
        // Check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // Show error/update messages
        settings_errors('dizconto_messages');
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <a href="mailto:info@dizconto.com" class="button button-link">
                <?php esc_html_e( 'Support', 'dizconto' ); ?>
            </a>
            <hr style="margin: 25px 0;" />
            <form action="options.php" method="post">
                <?php
                // Output security fields for the registered setting "dizconto"
                settings_fields('dizconto');
                // Output setting sections and their fields
                do_settings_sections('dizconto');
                // Output the save settings button
                submit_button(__('Save Settings', 'dizconto'));
                ?>
            </form>
            <hr style="margin: 25px 0;" />
            <h2><?php esc_html_e( 'Dizconto Pay', 'dizconto' ); ?></h2>
            <p>You can manage the payment methods in <a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-settings&tab=checkout' ) ); ?>">WooCommerce -> Settings -> Payments.</a></p>
        </div>
        <?php
    }

    public static function dizconto_section_api_callback($args) {
        ?>
        <p id="<?php echo esc_attr($args['id']); ?>">
            <?php esc_html_e('Enter your API credentials below to connect to the Dizconto API.', 'dizconto'); ?>
        </p>
        <?php
    }
}