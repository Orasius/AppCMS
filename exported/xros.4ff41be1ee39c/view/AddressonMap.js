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
					jQuery.get(document.getElementById('globalURIField').value + '/AddressonMap.txt', function(data) {
                      mapValues = data.toString().split(',');
                      Ext.getCmp('AddressonMap').setMapOptions({
                                                          center : new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                          zoom :10,
                                                          });
                      
                      var marker2 = new google.maps.Marker({
                                                           position: new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                           //title : 'Sencha HQ',
                                                           map: Ext.getCmp('AddressonMap').getMap(),
                                                           });
                      
                     
                	});
				},
				painted:function()
          		{
					if(document.getElementById('AddressonMapUpdate').value == 'true'){
						jQuery.get(document.getElementById('globalURIField').value + '/AddressonMap.txt', function(data) {
                      		mapValues = data.toString().split(',');
                      		Ext.getCmp('AddressonMap').setMapOptions({
                                                          center : new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                          zoom :10,
                                                          });
                      
                      		var marker2 = new google.maps.Marker({
                                                           position: new google.maps.LatLng(mapValues[1],mapValues[0]),
                                                           //title : 'Sencha HQ',
                                                           map: Ext.getCmp('AddressonMap').getMap(),
                                                           });
                      
                     
                		});
                		document.getElementById('AddressonMapUpdate').value == 'false';
					}
           		}
		},
	}	
});