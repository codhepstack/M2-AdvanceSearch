/**
 * Mixins for detail js of checkout
 * PM PS, 04.05.20, @link https://trello.com/c/ISWxDvZj/85-einrichtung-des-checkout-prozesses-implement-check-out-process
 */

define([
    'Magento_Checkout/js/model/quote',
    'Magento_Catalog/js/price-utils'
], function(
    quote,
    priceUtils
) {
    'use strict';

    return function (target) {
        return target.extend({
            /**
             * @param {*} price
             * @return {*|String}
             */
            getFormattedPrice: function (price) {
                return priceUtils.formatPrice(price, quote.getPriceFormat());
            }
        });
    }
});