define(
   [
       'jquery',
       'Magento_Checkout/js/view/summary/abstract-total'
   ],function ($,Component) {
       "use strict";
       return Component.extend({
           defaults: {
               template: 'Expert_FbShare/checkout/summary/fbdiscount'
           },
           isDisplayed : function(){
              var d = parseFloat(window.checkoutConfig.quoteData.fbdiscount);
               return d > 0;
           },
           getFacebookDiscount : function(){
               return "-"+this.getFormattedPrice(window.checkoutConfig.quoteData.fbdiscount);
           }
       });
   }
);