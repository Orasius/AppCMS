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
                    
                                            Ext.Ajax.request({
                                               url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    Ext.getCmp('Gallery').removeAll();
                                                    pageData = getPageData('Gallery',response.responseText);
                                                    galleryValues = pageData.toString().split(',');       
					             for(s=0;s < galleryValues.length;s++)
                                                    {
                                                        Ext.getCmp('Gallery').add(Ext.create('Ext.Panel',
                                                        {
                                                             xtype:'panel',
                                                             html:'<img src="'+galleryValues[s]+'" width="100%" />',
                                                        }));
                                                    }
                                                },
						failure: function(){
								//card.setHtml('Could not load the data :(');
                                                }
                                            });
                    
                                        
					},
					painted:function(){
                                                 
                                            if(document.getElementById('GalleryUpdate').value == 'true'){
                                                            Ext.Ajax.request({
                                               url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    Ext.getCmp('Gallery').removeAll();
                                                    pageData = getPageData('Gallery',response.responseText);
                                                    galleryValues = pageData.toString().split(',');       
					             for(s=0;s < galleryValues.length;s++)
                                                    {
                                                        Ext.getCmp('Gallery').add(Ext.create('Ext.Panel',
                                                        {
                                                             xtype:'panel',
                                                             html:'<img src="'+galleryValues[s]+'" width="100%" />',
                                                        }));
                                                    }           
                                                    var intance = Ext.getCmp('Gallery');
                                                    var activeIndex = intance.indexOf(intance.getActiveItem());
                                                    document.getElementById('GalleryUpdate').value = 'false';
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