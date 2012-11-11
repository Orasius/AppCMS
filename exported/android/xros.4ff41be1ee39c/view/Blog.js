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

    				},
		           painted:function()
         		   {
         		   		if(document.getElementById('BlogUpdate').value == 'true'){
                                            Ext.Ajax.request({
                                               url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
						timeout: 5000,
						disableCaching: false,
                                               success: function(response){
                                                   dataValue = getPageData('Blog',response.responseText);
                                                    store = Ext.getCmp('Blog').getStore();
                                                    store.setProxy({
                                                        type: 'jsonp',
                                                        url: 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q='+pageData,
                                                        reader: {
                                                            type: 'json',
                                                            rootProperty: 'responseData.feed.entries'
                                                        }
                                                    });
                                                    Ext.getCmp('Blog').getStore().load();
                                                },
						failure: function(){
								//ERROR!
						}
                                            });
                			
                                    }
           		   },
           		}
	}	
});