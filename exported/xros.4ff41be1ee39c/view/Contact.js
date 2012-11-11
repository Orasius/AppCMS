Ext.define('amSquared.view.Contact',{
		extend: 'Ext.NavigationView',
		xtype: 'contactView',
		
		
		requires: [
			'Ext.NavigationView',
		],
		
		config: {			
		items:[
			{
				xtype: 'panel',
				title: 'Contact',
				styleHtmlContent: true,
				fullscreen: true,
				scrollable:true,
				id: 'Contact',
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
                           		url: document.getElementById('globalURIField').value +  '/Contact.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('Contact').removeAll();
                                		eval(data.responseText);
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           			}
                  		});
           		},
                painted:function(){
                	if(document.getElementById('ContactUpdate').value == 'true'){
							Ext.Ajax.request({
                           		url: document.getElementById('globalURIField').value +  '/Contact.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('Contact').removeAll();
                                		eval(data.responseText);
                                		document.getElementById('ContactUpdate').value == 'false';
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