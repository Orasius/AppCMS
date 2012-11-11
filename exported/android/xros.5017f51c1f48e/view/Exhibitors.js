Ext.define('IntermodalEurope.view.Exhibitors',{
	extend: 'Ext.navigation.View',
	xtype: 'exhibitorsView',
	requires: [
        'Ext.navigation.View',
	],
		
	config:{
           
           items:[
                  {
                  xtype: 'list',
                  title:'Exhibitors ',
                  id:'Exhibitors',
                  indexBar:true,
			      grouped: true,
                  store: 'Exhibitors',
                  itemTpl:'{title}',
                  }],
            listeners:{
                initialize:function(){
                        Ext.Ajax.request({
                            url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
                            timeout: 5000,
                            disableCaching: false,
                            success: function(response){
                                    Ext.getCmp('Exhibitors').getStore().getProxy().clear();
                                    pageData = getPageData('Exhibitors',response.responseText);
                                    getData = jQuery.parseJSON(Encoder.htmlDecode(pageData));
                                    for(c = 0;c < getData.items.length;c++)
                                    {	
                                        var ins = Ext.create('IntermodalEurope.model.Exhibitors',{title:getData.items[c].title,html: getData.items[c].html});
                                        ins.save();
                                    }
                                    Ext.getCmp('Exhibitors').getStore().load();
                         },
                         failure: function(){
                        	 	//Error
                         }
                    });
                },
                painted:function()
                {
                	if(document.getElementById('ExhibitorsUpdate').value == 'true'){
                            Ext.Ajax.request({
                            url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
                            timeout: 5000,
                            disableCaching: false,
                            success: function(response){
                                    Ext.getCmp('Exhibitors').getStore().getProxy().clear();
                                    pageData = getPageData('Exhibitors',response.responseText);
                                    getData = jQuery.parseJSON(Encoder.htmlDecode(pageData));
                                    for(c = 0;c < getData.items.length;c++)
                                    {	
                                        var ins = Ext.create('IntermodalEurope.model.Exhibitors',{title:getData.items[c].title,html: getData.items[c].html});
                                        ins.save();
                                    }
                                    Ext.getCmp('Exhibitors').getStore().load();
                            },
                            failure: function(){
                        	 	//Error
                            }
                        });
                        document.getElementById('ExhibitorsUpdate').value = 'false';
			}
                }
            }
           
	}	
});