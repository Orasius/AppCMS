Ext.define('IntermodalEurope.model.Exhibitors',{
	extend: 'Ext.data.Model',
	
	requires: [
        'Ext.data.Model',
	],

	config:{

			fields: [
		         'title','html'
		        ],
                        proxy: {
		            type: "localstorage",
		            id: "ExhibitorsList"            
		        }
	}	
});