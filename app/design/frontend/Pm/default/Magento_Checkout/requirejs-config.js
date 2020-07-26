/**
 * Load the mixins in the require JS 
 * PM PS, 04.05.20, @link https://trello.com/c/ISWxDvZj/85-einrichtung-des-checkout-prozesses-implement-check-out-process
 */

var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/view/summary/item/details': {
                'Magento_Checkout/js/mixin/details-mixin': true
            }
        }
    }
};