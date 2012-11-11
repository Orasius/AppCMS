Ext.define('IntermodalEurope.view.Testimonials',{
	extend: 'Ext.Panel',
	xtype: 'testimonialsView',
	requires: ['Ext.Ajax'],
	
	masked: {
	    xtype: 'loadmask',
	    message: 'My message'
	},
	
	config:{
		title: 'Testimonials ',
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
                                                    pageData = getPageData('Testimonials',response.responseText);
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
				if(document.getElementById('TestimonialsUpdate').value == 'true'){
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
                                                    pageData = getPageData('Testimonials',response.responseText);
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