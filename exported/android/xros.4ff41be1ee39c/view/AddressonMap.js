Ext.define('amSquared.view.AddressonMap',{
	extend: 'Ext.Map',
	xtype: 'addressonMapView',
	requires: [
        'Ext.Map',
	],


	config:{
		title: 'Address on Map',
		id: 'AddressonMap',
		mapOptions : {
            zoom : 10,
            mapTypeId : google.maps.MapTypeId.ROADMAP, // ROADMAP , HYBRID, SATELLITE , TERRAIN
            navigationControl: true,
            navigationControlOptions: {
                style: google.maps.NavigationControlStyle.DEFAULT
            }
        },
		listeners: {
                        maprender: function(comp, map) {
                                    Ext.Ajax.request({
                                               url: document.getElementById('globalURIField').value+'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    pageData = getPageData('AddressonMap',response.responseText);
                                                    mapValues = pageData.toString().split(',');
                                                    Ext.getCmp('AddressonMap').setMapOptions({
                                                          center : new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                          zoom :10,
                                                          });
                      
                                                    var marker2 = new google.maps.Marker({
                                                           position: new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                           //title : 'Sencha HQ',
                                                           map: Ext.getCmp('AddressonMap').getMap(),
                                                           });
                                                },
						failure: function(){
								// Error in Map
						}
					});
                    
                        },
			painted:function()
          		{
                            if(document.getElementById('AddressonMapUpdate').value == 'true'){
                		
                		Ext.Ajax.request({
                                               url: document.getElementById('globalURIField').value+'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                    pageData = getPageData('AddressonMap',response.responseText);
                                                    mapValues = pageData.toString().split(',');
                                                    Ext.getCmp('AddressonMap').setMapOptions({
                                                          center : new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                          zoom :10,
                                                          });
                      
                                                    var marker2 = new google.maps.Marker({
                                                           position: new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                           //title : 'Sencha HQ',
                                                           map: Ext.getCmp('AddressonMap').getMap(),
                                                           });
                                                },
						failure: function(){
								// Error in Map
						}
					});
                    
                		document.getElementById('AddressonMapUpdate').value == 'false';
                            }
           		}
		},
	}	
});