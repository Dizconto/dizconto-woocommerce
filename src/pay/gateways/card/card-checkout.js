const createCardPaymentMethod = (() => {
    const paymentMethod = 'dizconto_pay_card';

    const settings = window.wc.wcSettings.getSetting(paymentMethod + '_data', {});
    const label = window.wp.htmlEntities.decodeEntities(settings.title);

    const CardPaymentMethod = () => {
        return window.wp.htmlEntities.decodeEntities(settings.description);
    }

    return {
        gatewayId: settings.id,
        paymentMethodId: paymentMethod,
        name: paymentMethod,
        label: label,
        ariaLabel: label,
        content: Object( window.wp.element.createElement )( CardPaymentMethod, null ),
        edit: Object( window.wp.element.createElement )( CardPaymentMethod, null ),
        canMakePayment: () => true,
        supports: {
            features: settings.supports,
        },
    };
})()

window.wc.wcBlocksRegistry.registerPaymentMethod(createCardPaymentMethod);