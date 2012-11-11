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
				      type: 'ajax',
                      url: document.getElementById('globalURIField').value + '/Exhibitors.txt',
                      reader: {
                          type: 'json',
                          rootProperty: 'items'
                      }
                  }
	}	
});