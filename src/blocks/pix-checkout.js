const pixPaymentMethod = (() => {
    const paymentMethod = 'dizconto_pay_pix';

    const settings = window.wc.wcSettings.getSetting(paymentMethod + '_data', {});
    const label = window.wp.htmlEntities.decodeEntities(settings.title);
    const Content = () => {
        return window.wp.htmlEntities.decodeEntities(settings.description);
    };

    return {
        gatewayId: settings.id,
        paymentMethodId: paymentMethod,
        name: paymentMethod,
        label: label,
        ariaLabel: label,
        content: Object( window.wp.element.createElement )( Content, null ),
        edit: Object( window.wp.element.createElement )( Content, null ),
        canMakePayment: () => true,
        supports: {
            features: settings.supports,
        },
    };
})()

window.wc.wcBlocksRegistry.registerPaymentMethod(pixPaymentMethod);