Ext.define('IntermodalEurope.view.FloorPlan',{
	extend: 'Ext.Panel',
	xtype: 'floorPlanView',
	requires: ['Ext.Ajax'],
	
	masked: {
	    xtype: 'loadmask',
	    message: 'My message'
	},
	
	config:{
		title: 'Floor Plan',
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
					    url: rootURI+'/FloorPlan.txt',
						timeout: 5000,
						disableCaching: false,
					    success: function(response){
					        var text = Encoder.htmlDecode(response.responseText);
							card.setHtml(text);
							card.setMasked(false);
					    },
						failure: function(){
								card.setHtml('Could not load the data :(');
								card.setMasked(false);
						}
					});
			},
			painted: function(){
				if(document.getElementById('FloorPlanUpdate').value == 'true'){
					var rootURI = document.getElementById('globalURIField').value;
					var card = this;
						card.setMasked({
				    		xtype: 'loadmask',
				    		message: 'Loading ... '
						});
				
				   	Ext.Ajax.request({
					    url: rootURI+'/FloorPlan.txt',
						timeout: 5000,
						disableCaching: false,
					    success: function(response){
					        var text = Encoder.htmlDecode(response.responseText);
							card.setHtml(text);
							card.setMasked(false);
							document.getElementById('FloorPlanUpdate').value = 'false';
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