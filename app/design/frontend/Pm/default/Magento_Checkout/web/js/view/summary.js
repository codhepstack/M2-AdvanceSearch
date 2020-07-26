/**
 * Override checkout summary JS 
 * PM PS, 04.05.20, @link https://trello.com/c/ISWxDvZj/85-einrichtung-des-checkout-prozesses-implement-check-out-process
 */

define([
    'jquery',
    'ko',
    'Magento_Checkout/js/model/step-navigator',
    'uiComponent',
    'Magento_Checkout/js/model/totals'
], function ($, ko, stepNavigator, Component, totals) {
    'use strict';

    return Component.extend({
        isLoading: totals.isLoading,

        isVisible: function () {
            return stepNavigator.isProcessed('shipping');
        },
        initialize: function () {
            $(function() {
                $('body').on("click", '#place-order-trigger', function () {
                    $(".payment-method._active").find('.action.primary.checkout').trigger( 'click' );
                });
            });
            var self = this;
            this._super();
        }
    });
});
