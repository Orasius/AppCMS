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
							$.ajax({
                  				url: document.getElementById('globalURIField').value +  '/Portfolio.txt',
				                type: 'GET',
			                  	processData: false,
				                dataType: 'text',
				                  success: function(data) {
                				        galleryValues = data.toString().split(',');       
					                	for(s=0;s < galleryValues.length;s++)
                       					{
                       						Ext.getCmp('Portfolio').add(Ext.create('Ext.Panel',
                       									{
                                                             xtype:'panel',
                                                             html:'<img src="'+galleryValues[s]+'" width="100%" />',
                                                        })
                                            );
                       					}
                  					},
				                  error: function(data,textStauts,errorThrown) {
                  					}
                  			});
						
					},
					painted:function(){
					
						if(document.getElementById('PortfolioUpdate').value == 'true'){
							$.ajax({
                  				url: document.getElementById('globalURIField').value +  '/Portfolio.txt',
				                type: 'GET',
			                  	processData: false,
				                dataType: 'text',
				                  success: function(data) {
                				        galleryValues = data.toString().split(',');       
					                	for(s=0;s < galleryValues.length;s++)
                       					{
                       						Ext.getCmp('Portfolio').add(Ext.create('Ext.Panel',
                       									{
                                                             xtype:'panel',
                                                             html:'<img src="'+galleryValues[s]+'" width="100%" />',
                                                        })
                                            );
                       					}
                       					document.getElementById('PortfolioUpdate').value == 'false';
                  					},
				                  error: function(data,textStauts,errorThrown) {
                  					}
                  			});	
                  		}
					}
				}
			},	
});