Ext.define('amSquared.store.Blog',{
	extend: 'Ext.data.Store',
	
	requires: [
        'Ext.data.Store'
	],

	config:{
			model: 'amSquared.model.Blog',
			autoLoad: true,
	}	
});