Ext.define('IntermodalEurope.view.Gallery',{
	extend: 'Ext.carousel.Carousel',
	xtype: 'galleryPageView',
	id:'Gallery',
	requires: [
        'Ext.carousel.Carousel',
	],
		
	config:{
			title: 'Gallery',
			fullscreen: true,
		    defaults: {
		        styleHtmlContent: true,
		       },
				listeners:{
					initialize:function(){
							$.ajax({
                  				url: document.getElementById('globalURIField').value +  '/Gallery.txt',
				                type: 'GET',
			                  	processData: false,
				                dataType: 'text',
				                  success: function(data) {
                				        galleryValues = data.toString().split(',');       
					                	for(s=0;s < galleryValues.length;s++)
                       					{
                       						Ext.getCmp('Gallery').add(Ext.create('Ext.Panel',
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
					
						if(document.getElementById('GalleryUpdate').value == 'true'){
							$.ajax({
                  				url: document.getElementById('globalURIField').value +  '/Gallery.txt',
				                type: 'GET',
			                  	processData: false,
				                dataType: 'text',
				                  success: function(data) {
                				        galleryValues = data.toString().split(',');       
					                	for(s=0;s < galleryValues.length;s++)
                       					{
                       						Ext.getCmp('Gallery').add(Ext.create('Ext.Panel',
                       									{
                                                             xtype:'panel',
                                                             html:'<img src="'+galleryValues[s]+'" width="100%" />',
                                                        })
                                            );
                       					}
                       					document.getElementById('GalleryUpdate').value == 'false';
                  					},
				                  error: function(data,textStauts,errorThrown) {
                  					}
                  			});	
                  		}
					}
				}
			},	
});