Ext.define('amSquared.view.Services',{
		extend: 'Ext.NavigationView',
		xtype: 'servicesView',
		
		
		requires: [
			'Ext.NavigationView',
		],
		
		config: {			
		items:[
			{
				xtype: 'panel',
				title: 'Services',
				styleHtmlContent: true,
				fullscreen: true,
				scrollable:true,
				id: 'Services',
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
                           		url: document.getElementById('globalURIField').value +  '/Services.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('Services').removeAll();
                                		eval(data.responseText);
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           			}
                  		});
           		},
                painted:function(){
                	if(document.getElementById('ServicesUpdate').value == 'true'){
							Ext.Ajax.request({
                           		url: document.getElementById('globalURIField').value +  '/Services.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('Services').removeAll();
                                		eval(data.responseText);
                                		document.getElementById('ServicesUpdate').value == 'false';
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