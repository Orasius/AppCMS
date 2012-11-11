Ext.define('IntermodalEurope.view.IntermodalEurope',{
		extend: 'Ext.NavigationView',
		xtype: 'homePageView',
		
		
		requires: [
			'Ext.NavigationView',
		],
		
		config: {			
		items:[
			{
				xtype: 'panel',
				title: 'Intermodal Europe ',
				styleHtmlContent: true,
				fullscreen: true,
				scrollable:true,
				id: 'IntermodalEurope',
				layout: {
				        type: 'vbox',
				    },
				
				defaults: {
				        xtype: 'button',
				        margin: 10,
						padding:10,
						width: '250px',
						align: 'left',
				    },
				items:[
				],
			}
		],
		listeners:{
                initialize:function(){
           				Ext.Ajax.request({
                           		url: document.getElementById('globalURIField').value +  '/IntermodalEurope.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('IntermodalEurope').removeAll();
                                		eval(data.responseText);
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           			}
                  		});
           		},
                painted:function(){
                	if(document.getElementById('IntermodalEuropeUpdate').value == 'true'){
							Ext.Ajax.request({
                           		url: document.getElementById('globalURIField').value +  '/IntermodalEurope.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('IntermodalEurope').removeAll();
                                		eval(data.responseText);
                                		document.getElementById('IntermodalEuropeUpdate').value == 'false';
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           			}
                  			});
           			}
                }
           }
    },
});