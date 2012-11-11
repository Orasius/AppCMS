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
	                Ext.getCmp('Exhibitors').getStore().load();
                },
                painted:function()
                {
                	if(document.getElementById('ExhibitorsUpdate').value == 'true'){
						Ext.getCmp('Exhibitors').getStore().load();
						document.getElementById('ExhibitorsUpdate').value = 'false';
					}
                },
                show:function(){
                    
                },
                updatedata:function(){
                   
                }
           }
           
	}	
});