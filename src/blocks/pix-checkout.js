const pixPaymentMethod = (() => {
    const paymentMethod = 'dizconto_pay_pix';

    const settings = window.wc.wcSettings.getSetting(paymentMethod + '_data', {});

    const Label = () => {
        return (
            <p>
                {settings.title}
            </p>
        )
    }

    const Content = () => {
        return (
            <p>
                {settings.description}
            </p>
        )
    }
    return {
        gatewayId: settings.id,
        paymentMethodId: paymentMethod,
        name: paymentMethod,
        ariaLabel: settings.title,
        label: <Label />,
        content: <Content />,
        edit: <Content />,
        canMakePayment: () => true,
        supports: {
            features: settings.supports,
        },
    };
})()

window.wc.wcBlocksRegistry.registerPaymentMethod(pixPaymentMethod);