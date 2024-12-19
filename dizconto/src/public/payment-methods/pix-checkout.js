import { decodeEntities } from '@wordpress/html-entities';
import { getSetting } from '@woocommerce/settings';
import { registerPaymentMethod } from '@woocommerce/blocks-registry';

const dizcontoPixPaymentMethod = (() => {
    const paymentMethod = 'dizconto_pay_pix';

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
            <div style={{ paddingBottom: 30, textAlign: 'center' }}>
                <img src={settings.contentImage} alt={'Pix logo'} width={300} style={{ display: 'block', margin: 'auto' }} />
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
registerPaymentMethod(dizcontoPixPaymentMethod);