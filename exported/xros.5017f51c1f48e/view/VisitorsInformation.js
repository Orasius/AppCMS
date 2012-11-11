Ext.define('IntermodalEurope.view.VisitorsInformation',{
		extend: 'Ext.NavigationView',
		xtype: 'visitorsInformationView',
		
		
		requires: [
			'Ext.NavigationView',
		],
		
		config: {			
		items:[
			{
				xtype: 'panel',
				title: 'Visitors Information',
				styleHtmlContent: true,
				fullscreen: true,
				scrollable:true,
				id: 'VisitorsInformation',
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
                           		url: document.getElementById('globalURIField').value +  '/VisitorsInformation.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('VisitorsInformation').removeAll();
                                		eval(data.responseText);
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           			}
                  		});
           		},
                painted:function(){
                	if(document.getElementById('VisitorsInformationUpdate').value == 'true'){
							Ext.Ajax.request({
                           		url: document.getElementById('globalURIField').value +  '/VisitorsInformation.txt',
                           		type: 'GET',
                           		processData: false,
                           		dataType: 'text',
                           			success: function(data) {
                           				Ext.getCmp('VisitorsInformation').removeAll();
                                		eval(data.responseText);
                                		document.getElementById('VisitorsInformationUpdate').value == 'false';
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