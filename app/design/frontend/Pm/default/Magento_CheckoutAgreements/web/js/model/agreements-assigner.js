/**
 * Override the Apreement Assigner for the agreement validation to work properly
 * PM PS, 04.05.20, @link https://trello.com/c/ISWxDvZj/85-einrichtung-des-checkout-prozesses-implement-check-out-process
 */

/*global alert*/
define([
    'jquery'
], function ($) {
    'use strict';

    var agreementsConfig = window.checkoutConfig.checkoutAgreements;

    /** Override default place order action and add agreement_ids to request */
    return function (paymentData) {
        var agreementForm,
            agreementData,
            agreementIds;

        if (!agreementsConfig.isEnabled) {
            return;
        }

        agreementForm = $('#checkoutSteps  div[data-role=checkout-agreements] input');
        agreementData = agreementForm.serializeArray();
        agreementIds = [];

        agreementData.forEach(function (item) {
            agreementIds.push(item.value);
        });

        if (paymentData['extension_attributes'] === undefined) {
            paymentData['extension_attributes'] = {};
        }

        paymentData['extension_attributes']['agreement_ids'] = agreementIds;
    };
});
