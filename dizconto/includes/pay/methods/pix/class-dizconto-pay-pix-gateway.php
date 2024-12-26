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

        // Admin form fields
        $this->init_form_fields();
        $this->init_settings();
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'update_admin_options' ) );


    }

    /**
     * Initialize the admin form fields for Pix payment method.
     *
     * @since    1.0.0
     * @return void
     */
    public function init_form_fields() {
        $this->form_fields = array(
            'slug'       => array(
                'title'       => 'Payment Page Slug',
                'type'        => 'text',
                'description' => 'This controls the slug of the page which the user sees during Pix checkout (e.g. https://example.com/pix).',
                'default'     => 'pix'
            ),
            'expiration' => array(
                'title'       => 'Expiration Delay',
                'type'        => 'number',
                'description' => 'This controls the time in seconds after which the Pix payment will expire (e.g. 900 seconds for 15 minutes).',
                'default'     => 15 * 60
            )
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

    /**
     * Register custom payment page for Pix checkout.
     *
     * @since    1.0.0
     * @return void
     */
    public function register_pix_payment_page() {
        $page_id = $this->get_option('_pix_page_id');
        $current_page = get_page($page_id);
        if ( $current_page && $current_page->post_status == 'publish' ) {
            return $page_id;
        }
        $page_slug = $this->get_option('slug');
        $parent_page_id = wc_get_page_id('checkout');
        $args = [
            'post_name' => $page_slug,
            'post_title' => 'Pix Payment',
            'post_content' => '<p>page content</p>',
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_parent' => $parent_page_id
        ];
        $post_id = wp_insert_post($args);
        $this->update_option( '_pix_page_id', $post_id );
        return $post_id;
    }

    /**
     * Update admin options for Pix payment method.
     * Incl. the slug change for the custom Pix payment page.
     *
     * @since    1.0.0
     * @return void
     */
    public function update_admin_options() {
        $post_id = $this->register_pix_payment_page();
        $oldSlug = $this->get_option('slug');
        $this->process_admin_options();
        $newSlug = $this->get_option('slug');
        if ($oldSlug != $newSlug) {
            $page = get_page($post_id);
            $page->post_name = $newSlug;
            wp_update_post($page);
        }
    }

}