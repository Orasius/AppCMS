Ext.define('amSquared.view.Blog',{
	extend: 'Ext.navigation.View',
	xtype: 'blogView',
	requires: [
        'Ext.dataview.List',
        'Ext.Ajax'
	],
		
	config:{
				items:[
				{
					xtype: 'list',
					title:'Blog',
					id:'BlogPanel',
					store: 'Blog',
					itemTpl:'{title}',
					//cls: 'rssItem',
				}],
				listeners:{
		           initialize:function(){
    						jQuery.get(document.getElementById('globalURIField').value + '/Blog.txt', function(data) {
                          		 store = Ext.getCmp('Blog').getStore();
	                           	 store.setProxy({
                                          type: 'jsonp',
                                          url: 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q='+data,
                                          reader: {
                                                type: 'json',
                                                rootProperty: 'responseData.feed.entries'
                                          }
                           		});
                           		Ext.getCmp('Blog').getStore().load();
                			});
    				},
		           painted:function()
         		   {
         		   		if(document.getElementById('BlogUpdate').value == 'true'){
							jQuery.get(document.getElementById('globalURIField').value + '/Blog.txt', function(data) {
                          		 store = Ext.getCmp('Blog').getStore();
	                           	 store.setProxy({
                                          type: 'jsonp',
                                          url: 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q='+data,
                                          reader: {
                                                type: 'json',
                                                rootProperty: 'responseData.feed.entries'
                                          }
                           		});
                           		Ext.getCmp('Blog').getStore().load();
                           		document.getElementById('BlogUpdate').value = 'false';
                			});
                			
           				}
           		   },
           		}
	}	
});