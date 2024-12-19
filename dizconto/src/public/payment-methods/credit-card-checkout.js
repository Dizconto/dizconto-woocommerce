import { decodeEntities } from '@wordpress/html-entities';
import { getSetting } from '@woocommerce/settings';
import { registerPaymentMethod } from '@woocommerce/blocks-registry';

const dizcontoCreditCardPaymentMethod = (() => {
    const paymentMethod = 'dizconto_pay_credit_card';

    const settings = getSetting(paymentMethod + '_data', {});
    const title = decodeEntities(settings.title);

    const Label = () => {
        return (
            <p>
                {title}
            </p>
        )
    }

    const Content = () => {
        return (
            <div style={{ display: 'flex', paddingBottom: 30 }}>
                <form style={{ flex: 1 }}>
                    <div className="wc-block-components-text-input">
                        <input
                            type="text"
                            autoComplete="cc-name"
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
                            autoComplete="cc-number"
                            id="card-number"
                            className="input-text"
                            required
                        />
                    </div>
                    <div className="wc-block-components-text-input form-row-first">
                        <label htmlFor="expiry-date">Expiry Date (MM/YY)</label>
                        <input
                            type="text"
                            autoComplete="cc-exp"
                            id="expiry-date"
                            className="input-text"
                            required
                        />
                    </div>
                    <div className="wc-block-components-text-input form-row-last">
                        <label htmlFor="cvv">CVV</label>
                        <input
                            type="text"
                            autoComplete="cc-csc"
                            id="cvv"
                            className="input-text"
                            required
                        />
                    </div>
                </form>
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
registerPaymentMethod(dizcontoCreditCardPaymentMethod);