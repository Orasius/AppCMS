Ext.define('IntermodalEurope.view.Day3Seminars',{
	extend: 'Ext.Panel',
	xtype: 'seminarsDay3View',
	requires: ['Ext.Ajax'],
	
	masked: {
	    xtype: 'loadmask',
	    message: 'My message'
	},
	
	config:{
		title: 'Day 3 Seminars',
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
					    url: rootURI+'/Day3Seminars.txt',
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
				if(document.getElementById('Day3SeminarsUpdate').value == 'true'){
					var rootURI = document.getElementById('globalURIField').value;
					var card = this;
						card.setMasked({
				    		xtype: 'loadmask',
				    		message: 'Loading ... '
						});
				
				   	Ext.Ajax.request({
					    url: rootURI+'/Day3Seminars.txt',
						timeout: 5000,
						disableCaching: false,
					    success: function(response){
					        var text = Encoder.htmlDecode(response.responseText);
							card.setHtml(text);
							card.setMasked(false);
							document.getElementById('Day3SeminarsUpdate').value = 'false';
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