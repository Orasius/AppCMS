Ext.define('IntermodalEurope.store.Exhibitors',{
	extend: 'Ext.data.Store',
	
	requires: [
        'Ext.data.Store'
	],

	config:{
                    model: 'IntermodalEurope.model.Exhibitors',
                    autoLoad: true,
                    sorters: 'title',
            
		    grouper: {
       			groupFn: function(record) {
           		return record.get('title')[0];
       			}
                    },
	}	
});