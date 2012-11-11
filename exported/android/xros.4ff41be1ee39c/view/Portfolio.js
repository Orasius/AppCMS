Ext.define('amSquared.view.Portfolio',{
	extend: 'Ext.carousel.Carousel',
	xtype: 'portfolioView',
	id:'Portfolio',
	requires: [
        'Ext.carousel.Carousel',
	],
		
	config:{
			title: 'Portfolio',
			fullscreen: true,
		    defaults: {
		        styleHtmlContent: true,
		       },
				listeners:{
					initialize:function(){
                    
                                            Ext.Ajax.request({
                                               url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    pageData = getPageData('Portfolio',response.responseText);
                                                    galleryValues = pageData.toString().split(',');       
					             for(s=0;s < galleryValues.length;s++)
                                                    {
                                                        Ext.getCmp('Portfolio').add(Ext.create('Ext.Panel',
                                                        {
                                                             xtype:'panel',
                                                             html:'<img src="'+galleryValues[s]+'" width="100%" />',
                                                        }));
                                                    }
                                                },
						failure: function(){
								card.setHtml('Could not load the data :(');
								card.setMasked(false);
						}
                                            });
                    
                                        
					},
					painted:function(){
                                                 
                                            if(document.getElementById('PortfolioUpdate').value == 'true'){
                                                            Ext.Ajax.request({
                                               url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    pageData = getPageData('Portfolio',response.responseText);
                                                    galleryValues = pageData.toString().split(',');       
					             for(s=0;s < galleryValues.length;s++)
                                                    {
                                                        Ext.getCmp('Portfolio').add(Ext.create('Ext.Panel',
                                                        {
                                                             xtype:'panel',
                                                             html:'<img src="'+galleryValues[s]+'" width="100%" />',
                                                        }));
                                                    }
                                                    document.getElementById('PortfolioUpdate').value = 'false';
                                                },
						failure: function(){
								// Error
						}
                                            });
                        
                                            }
					}
				}
			},	
});