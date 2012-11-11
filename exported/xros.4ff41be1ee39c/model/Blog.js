Ext.define('amSquared.model.Blog',{
	extend: 'Ext.data.Model',
	
	requires: [
        'Ext.data.Model',
	],

	config:{

			fields: [
		         'title', 'link', 'author', 'contentSnippet', 'content'
		        ],
		        
		        proxy: {
				      type: 'jsonp',
                      url: 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&q=',
                      reader: {
                          type: 'json',
                          rootProperty: 'responseData.feed.entries'
                      }
                  }
	}	
});