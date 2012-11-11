Ext.define('amSquared.view.Home',{
		extend: 'Ext.NavigationView',
		xtype: 'homePageView',
		
		
		requires: [
			'Ext.NavigationView',
		],
		
		config: {			
		items:[
			{
				xtype: 'panel',
				title: 'Home',
				styleHtmlContent: true,
				fullscreen: true,
				scrollable:true,
				id: 'Home',
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
                           		url: document.getElementById('globalURIField').value +  '/Home.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('Home').removeAll();
                                		eval(data.responseText);
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           			}
                  		});
           		},
                painted:function(){
                	if(document.getElementById('HomeUpdate').value == 'true'){
							Ext.Ajax.request({
                           		url: document.getElementById('globalURIField').value +  '/Home.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('Home').removeAll();
                                		eval(data.responseText);
                                		document.getElementById('HomeUpdate').value == 'false';
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