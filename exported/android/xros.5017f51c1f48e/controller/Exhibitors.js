Ext.define('IntermodalEurope.controller.Exhibitors',{
           extend: 'Ext.app.Controller',
           
           config:{
          		 refs:{
          	 		exhPanel: 'exhibitorsView',
		           	exhList: 'list[id=Exhibitors]',
         		  },
           
           		control:{
	           		exhList:{
    		       		itemtap:'showContent',
           			}
           		}
           
        	},
           
           showContent: function( list, index,target, record, event, eOpts ) {
           			this.getExhPanel().push({
                                   xtype:'panel',
                                   title: record.get('title'),
                                   html: record.get('html'),
                                   fullscreen:true,
                                   styleHtmlContent:true,
                                   scrollable:true,
                    });
           }
});