/**
 * Search Suite Autocomplete JS file.
 * PM PS, 30.04.20, @link - https://trello.com/c/fR4dyPJV/96-styling-der-basissuchfunktion-im-standard-von-magento-styling-of-magento-default-search-functionality
 */
define([
    'jquery',
    'uiComponent',
    'ko'
], function ($, Component, ko) {
    'use strict';


    return Component.extend({
        defaults: {
            template: 'Pixelmechanics_SearchAutocomplete/autocomplete',
            showPopup: ko.observable(false),
            result: {
                suggest: {
                    data: ko.observableArray([])
                },
                product: {
                    data: ko.observableArray([]),
                    size: ko.observable(0),
                    url: ko.observable('')
                }
            },
            anyResultCount: false
        },


        initialize: function () {
            var self = this;
            this._super();

            this.anyResultCount = ko.computed(function () {
                var sum = self.result.suggest.data().length + self.result.product.data().length;
                if (sum > 0) {
                    return true; }
                return false;
            }, this);
        },

    });
});
