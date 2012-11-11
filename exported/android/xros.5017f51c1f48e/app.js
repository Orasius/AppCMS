//<debug>
Ext.Loader.setPath({
    'Ext': 'sdk/src'
});
//</debug>

Ext.application({
    name: 'IntermodalEurope',

    requires: [
        'Ext.MessageBox'
    ],

    models:['Exhibitors'],
    stores: ['Exhibitors'],
    controllers:['Exhibitors'],
    views: ['Main','Gallery','About','FloorPlan','Sponsors','ContactInfo','HotelBooking','VisitAmsterdam','PressRelease','Day1Seminars','Day2Seminars','Day3Seminars','Exhibitors','IntermodalEurope','Contact','VisitorsInformation','Seminars'],
                
                
    icon: {
        57: 'resources/icons/Icon.png',
        72: 'resources/icons/Icon~ipad.png',
        114: 'resources/icons/Icon@2x.png',
        144: 'resources/icons/Icon~ipad@2x.png'
    },
    
    phoneStartupScreen: 'resources/loading/Homescreen.jpg',
    tabletStartupScreen: 'resources/loading/Homescreen~ipad.jpg',

    launch: function() {
        // Destroy the #appLoadingIndicator element
        //Ext.fly('appLoadingIndicator').destroy();
        document.getElementById('loadingDiv').className = 'hiddenDiv';
        // Initialize the main view
        Ext.Viewport.add(Ext.create('IntermodalEurope.view.Main'));
    },

    onUpdated: function() {
        Ext.Msg.confirm(
            "Application Update",
            "This application has just successfully been updated to the latest version. Reload now?",
            function() {
                window.location.reload();
            }
        );
    }
});
