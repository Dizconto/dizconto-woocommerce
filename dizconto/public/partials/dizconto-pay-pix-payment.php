<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Make sure the necessary parameters are set.
$order_id = $_GET['order'];
$order_key = $_GET['key'];
$is_check = $_GET['is_check'] ?? false;
if ( ! $order_id || ! $order_key ) {
    echo '<p>Order not found.</p>';
    return;
}

// Make sure order exists & the security key matches.
$order = wc_get_order($order_id);
if ( ! $order || $order->get_order_key() !== $order_key ) {
    echo '<p>Order not found.</p>';
    return;
}

// If order is paid, redirect to thank you page.
if ( $order->is_paid() ) {
    wp_redirect( $order->get_checkout_order_received_url() );
    exit;
}

// Redirect to built-in payment page, if the order is not of Pix payment method.
if ( $order->get_payment_method() !== 'dizconto_pay_pix' ) {
    wp_redirect( $order->get_checkout_payment_url() );
    exit;
}

// Define url for payment checking. It reloads the page to check payment status.
// If is_check parameter is set, a hint will be added.
$check_payment_url = add_query_arg(
    array( 'is_check' => 1 ),
    $_SERVER['REQUEST_URI']
);

// Load pix payment data.
$pix_code = "123123123123123";
$pix_qrcode_base64 = "data:image/jpeg;base64,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"

?>

<script>
    setTimeout(function () {
        window.location.href = '<?php echo $check_payment_url; ?>';
    }, <?php echo $is_check ? 5000 : 15000; ?>)
</script>

<div class="diz-mt-5 diz-text-center diz-w-80">
    <img src="<?php echo $pix_qrcode_base64; ?>" alt="QR Code" class="diz-w-full">
    <input class="diz-block diz-mx-auto diz-text-lg diz-w-full diz-text-center" value="<?php echo $pix_code; ?>" disabled />
    <?php if ( $is_check ) : ?>
    <p class="diz-mt-5 diz-text-sm">Please note that the payment may take a few minutes to process.</p>
    <?php endif; ?>
</div>
