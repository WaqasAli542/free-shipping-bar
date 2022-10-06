define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'mage/translate'
], function ($, ko, Component, customerData) {
    'use strict';

    return Component.extend({
        initialize: function (config) {
            this._super();
            this.below_goal = ko.observable();
            var cartData = customerData.get('cart');
            this.below_goal(cartData().subtotalAmount);
            config.goal = +config.goal;

            cartData.subscribe(function (updatedCart) {
                this.below_goal(updatedCart.subtotalAmount);
            }, this);

            this.goalMessage = ko.computed(function () {
                if (typeof(this.below_goal())  === "undefined" || this.below_goal() === null || this.below_goal() < config.goal) {
                    return config.initialGoalMessage.replace("{{goal}}", "<span id='goal' style='color:" + config.goalColor + ";'>" + config.currency + config.goal.toFixed(2) + "</span>");
                }
                else if(this.below_goal() >= config.goal){
                    return config.achieveGoalMessage;
                }
            }, this);
        },
    });
});