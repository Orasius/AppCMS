Ext.define('amSquared.view.CustomerService',{
	extend: 'Ext.Panel',
	xtype: 'customerServiceView',
	requires: ['Ext.Ajax'],
	
	masked: {
	    xtype: 'loadmask',
	    message: 'My message'
	},
	
	config:{
		title: 'Customer Service',
		setHtmlContent: true,
		fullscreen: true,
		scrollable:true,
		padding:20,
		
		listeners: {
			initialize:function(){
				var rootURI = document.getElementById('globalURIField').value;
				var card = this;
				card.setMasked({
				    xtype: 'loadmask',
				    message: 'Loading ... '
				});
				
				   	Ext.Ajax.request({
                                               url: rootURI+'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    pageData = getPageData('CustomerService',response.responseText);
                                                    card.setHtml(pageData);
                                                    card.setMasked(false);
                                                },
						failure: function(){
								card.setHtml('Could not load the data :(');
								card.setMasked(false);
						}
					});
			},
			painted: function(){
				if(document.getElementById('CustomerServiceUpdate').value == 'true'){
					var rootURI = document.getElementById('globalURIField').value;
					var card = this;
						card.setMasked({
				    		xtype: 'loadmask',
				    		message: 'Loading ... '
						});
				
				   	Ext.Ajax.request({
                                               url: rootURI+'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    pageData = getPageData('CustomerService',response.responseText);
                                                    card.setHtml(pageData);
                                                    card.setMasked(false);
                                                },
						failure: function(){
								card.setHtml('Could not load the data :(');
								card.setMasked(false);
						}
					});
				}
			}
		},
	},
});