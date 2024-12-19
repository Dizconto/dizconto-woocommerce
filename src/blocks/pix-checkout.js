const dizcontoPixPaymentMethod = (() => {
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
            <div style={{ paddingBottom: 30, textAlign: 'center' }}>
                <img src={settings.contentImage} alt={'Pix logo'} width={400} style={{ display: 'block', margin: 'auto' }} />
                <p>You will be redirected to a payment page.</p>
            </div>
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

window.wc.wcBlocksRegistry.registerPaymentMethod(dizcontoPixPaymentMethod);