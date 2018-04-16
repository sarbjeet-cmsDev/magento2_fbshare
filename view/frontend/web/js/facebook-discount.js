define(['jquery','uiComponent','https://connect.facebook.net/en_US/sdk.js'], function($,Component) {
    'use strict';
    return Component.extend({   
        defaults: {
            appId:null,
            url:null,
            product_url:null,
            product_id:null
        },
        initialize:function(){
            this._super();
            this.initFacebookApp();
            return this;
        },
        initFacebookApp:function(){
            if(this.appId){
                FB.init({
                    appId      : this.appId,
                    cookie     : true,
                    xfbml      : true, 
                    version    : 'v2.12'
                });
            }
        },
        shareProduct:function(){
            var product_url = this.product_url;
            var product_id = this.product_id;
            var req_url = this.url;
            FB.login(function(response){
                console.log(response);
                if (response.status === 'connected'){
                    var userID = response.authResponse.userID;
                    FB.ui({
                      method: 'share',
                      href: 'https://google.com'//product_url
                    }, function(response){
                        if(!response.error_code){
                            $('body').trigger('processStart');
                            $.post(req_url,{
                                product_id:product_id,
                                userId:userID,
                            },function(response){

                            }).always(function(){
                                $('body').trigger('processStop');
                            });
                        }
                    });
                }
            });
        }
    });
});