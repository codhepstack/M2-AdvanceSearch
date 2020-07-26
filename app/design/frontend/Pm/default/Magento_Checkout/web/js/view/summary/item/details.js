/**
 * Override the detail JS file to laod additional JS function for updting the qty of items from checkout summary section
 * PM PS, 04.05.20, @link https://trello.com/c/ISWxDvZj/85-einrichtung-des-checkout-prozesses-implement-check-out-process
 */

define([
    'uiComponent',
    'jquery',
    'Magento_Checkout/js/action/get-totals',
    'Magento_Customer/js/customer-data',
    'mage/validation',
    'mage/translate',
    'ko',
    'mage/storage',
    'mage/url',
    'mage/cookies'
], function (Component, $, getTotalsAction, customerData, validation, $t, ko, storage, urlBuilder) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Magento_Checkout/summary/item/details'
        },

        updateQtyDelay: 500,
        updateQtyTimeout: 0,

        initialize: function () {
            this._super();
        },

        /**
         * @param {Object} quoteItem
         * @return {String}
         */
        getValue: function (quoteItem) {
            return quoteItem.name;
        },

        /**
         * Plus item qty
         *
         * @param item
         * @param event
         */
        plusQty: function (item, event) {
            var self = this;

            clearTimeout(this.updateQtyTimeout);

            var target = $(event.target).prev().children(".item_qty"),
            itemId = parseInt(target.attr("id")),
            qty = parseInt(target.val());
            if(!isNaN(qty)){
                qty += 1;

                target.val(qty);
                this._ajax('pmcheckout/ajax/cartUpdate', {
                    item_id: itemId, //change item id according to test
                    item_qty: qty //qty you want to update
                });
            }
        },

        /**
         * Minus item qty
         *
         * @param item
         * @param event
         */
        minusQty: function (item, event) {
            var self = this;

            clearTimeout(this.updateQtyTimeout);

            var target = $(event.target).next().children(".item_qty"),
            itemId = parseInt(target.attr("id")),
            qty = parseInt(target.val());
            if(!isNaN(qty)){
                if(qty > 1){
                    qty -= 1;
                }
                
                target.val(qty);

                this._ajax('pmcheckout/ajax/cartUpdate', {
                    item_id: itemId, //change item id according to test
                    item_qty: qty //qty you want to update
                });
            }
        },

        changeQty: function (item, event) {
            var target = $(event.target),
            itemId = parseInt(target.attr("id")),
            qty = parseInt(target.val());

            // Remove all existing errors
            $(target).next('span.qty_error').remove();

            if(!isNaN(qty)){
                this._ajax('pmcheckout/ajax/cartUpdate', {
                    item_id: itemId, //change item id according to test
                    item_qty: qty //qty you want to update
                });
            } else {
                var errorTxt = $t('Error. Only numbers allowed');
                $(target).after('<span class="qty_error">'+errorTxt+'</span>');
                return false;
            }
        },

        /**
         * @author: NA
         * @date:23.06.2020
         * @link:https://trello.com/c/vc14GwHF/26-magento-shops-mwst-mehrwertsteuer-tax-shipping-infos
         * @description: to get the dynamic value of Tax from the admin using data helper to display on the checkout inkl. MwSt OR zzgl. Mswt
         * get Tax value from using the Pixelmechanics\Checkout\Model\CustomConfigProvider
        */
        getvatPriceInfo: function(){
            return window.checkoutConfig.vatPriceInformation;
        },

        /**
         * @author: NA
         * @date:23.06.2020
         * @link:https://trello.com/c/vc14GwHF/26-magento-shops-mwst-mehrwertsteuer-tax-shipping-infos
         * @description: to get the dynamic value of Tax from the admin using data helper to display on the checkout inkl. MwSt OR zzgl. Mswt
         * get Tax value from using the Pixelmechanics\Checkout\Model\CustomConfigProvider
        */
        getvatSubtotalInfo: function(){
            return window.checkoutConfig.vatSubtotalInformation;
        },

        /**
         * @param {String} url - ajax url
         * @param {Object} data - post data for ajax call
         * @param {Object} elem - element that initiated the event
         * @param {Function} callback - callback method to execute after AJAX success
         */
        _ajax: function (url, data) {
            var sections = ['cart'];
            $.extend(data, {
                'form_key': $.mage.cookies.get('form_key')
            });
            $.ajax({
                url: urlBuilder.build(url),
                data: data,
                type: 'post',
                dataType: 'json',
                context: this,
            }).done(function (response) {
                    // The mini cart reloading
                    customerData.reload(sections, true);

                    // The totals summary block reloading
                    var deferred = $.Deferred();
                    getTotalsAction([], deferred);
                })
                .fail(function (error) {
                    console.log(JSON.stringify(error));
                });
        }
    });
});
