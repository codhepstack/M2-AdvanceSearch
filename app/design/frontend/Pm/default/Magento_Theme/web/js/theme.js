/**
 * Override the theme js file to remove the cart summary sticky behaviour
 * PM JM - 22.07.20 - @link - https://trello.com/c/26cm9eRM/151-minor-adjustments-in-shopping-cart-and-checkout
 */

define([
    'jquery',
    'mage/smart-keyboard-handler',
    'mage/mage',
    'mage/ie-class-fixer',
    'domReady!'
], function ($, keyboardHandler) {
    'use strict';

    if ($('body').hasClass('checkout-cart-index')) {
        if ($('#co-shipping-method-form .fieldset.rates').length > 0 &&
            $('#co-shipping-method-form .fieldset.rates :checked').length === 0
        ) {
            $('#block-shipping').on('collapsiblecreate', function () {
                $('#block-shipping').collapsible('forceActivate');
            });
        }
    }

    // $('.cart-summary').mage('sticky', {
    //     container: '#maincontent'
    // });

    $('.panel.header > .header.links').clone().appendTo('#store\\.links');

    keyboardHandler.apply();
});
