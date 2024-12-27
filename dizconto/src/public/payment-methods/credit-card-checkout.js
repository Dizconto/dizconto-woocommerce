import { decodeEntities } from '@wordpress/html-entities';
import { getSetting } from '@woocommerce/settings';
import { registerPaymentMethod } from '@woocommerce/blocks-registry';
import { TextInput } from '@woocommerce/blocks-components';

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
            <div className="diz-flex diz-pb-8">
                <form className="wc-block-components-form diz-flex-1">
                    <TextInput id="card-holder-name" label="Cardholder Name" type="text" autoComplete="cc-name" required  />
                    <TextInput id="card-number" label="Card Number" type="text" autoComplete="cc-number" required  />
                    <TextInput id="card-expiry-date" label="Expiry Date" type="text" autoComplete="cc-exp" className="form-row-first" required  />
                    <TextInput id="card-cvv" label="CVV" type="text" autoComplete="cc-csc" className="form-row-last" required  />
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