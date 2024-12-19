<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://dizconto.com
 * @since      1.0.0
 *
 * @package    Dizconto
 * @subpackage Dizconto/admin/partials
 */

// Register the settings section
register_setting('dizconto', 'dizconto_options', [
    'sanitize_callback' => function($input) {
        $input['dizconto_api_key'] = sanitize_text_field($input['dizconto_api_key']);
        $input['dizconto_api_secret'] = sanitize_text_field($input['dizconto_api_secret']);
        return $input;
    }
]);

// Register a new section in the "dizconto" page.
add_settings_section(
    'dizconto_api_section',
    __('API Settings', 'dizconto'),
    function() {
    },
    'dizconto'
);

// Register a new field for the API key
add_settings_field(
    'dizconto_api_key',
    __('API Key', 'dizconto'),
    function() {
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
    },
    'dizconto',
    'dizconto_api_section'
);

// Register a new field for the API secret
add_settings_field(
    'dizconto_api_secret',
    __('API Secret', 'dizconto'),
    function() {
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
    },
    'dizconto',
    'dizconto_api_section'
);

?>

<div class="wrap">

    <!--  TITLE  -->
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <!--  QUICK ACTIONS  -->
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
    <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
        <p>You can manage the payment methods in <a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-settings&tab=checkout' ) ); ?>">WooCommerce -> Settings -> Payments.</a></p>
    <?php else : ?>
        <p><?php esc_html_e( 'Dizconto Pay requires WooCommerce to be installed and activated.', 'dizconto' ); ?></p>
        <p><a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=plugin-information&plugin=woocommerce' ) ) ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'dizconto' ); ?></a></p>
    <?php endif; ?>

</div>