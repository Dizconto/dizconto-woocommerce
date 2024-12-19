const dizcontoCreditCardPaymentMethod = (() => {
    const paymentMethod = 'dizconto_pay_credit_card';

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
            <form>
                <div className="wc-block-components-text-input">
                    <input
                        type="text"
                        id="card-holder-name"
                        className="input-text"
                        required
                    />
                    <label htmlFor="card-holder-name">Cardholder Name</label>
                </div>
                <div className="wc-block-components-text-input">
                    <label htmlFor="card-number">Card Number</label>
                    <input
                        type="text"
                        id="card-number"
                        className="input-text"
                        required
                    />
                </div>
                <div className="wc-block-components-text-input form-row-first">
                    <label htmlFor="expiry-date">Expiry Date (MM/YY)</label>
                    <input
                        type="text"
                        id="expiry-date"
                        className="input-text"
                        required
                    />
                </div>
                <div className="wc-block-components-text-input form-row-last">
                    <label htmlFor="cvv">CVV</label>
                    <input
                        type="text"
                        id="cvv"
                        className="input-text"
                        required
                    />
                </div>
            </form>
        )
    }

    return {
        gatewayId: settings.id,
        paymentMethodId: paymentMethod,
        name: paymentMethod,
        ariaLabel: settings.title,
        label: <Label/>,
        content: <Content/>,
        edit: <Content/>,
        canMakePayment: () => true,
        supports: {
            features: settings.supports,
        },
    };
})()
window.wc.wcBlocksRegistry.registerPaymentMethod(dizcontoCreditCardPaymentMethod);