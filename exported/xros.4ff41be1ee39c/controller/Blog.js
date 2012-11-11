Ext.define('amSquared.controller.Blog',{
    extend: 'Ext.app.Controller',
           
    config:{
            refs:{
                rssPanel: 'blogView',
                rssList: 'list[id=BlogPanel]',
            },
           
            control:{
                rssList:{
                    itemtap:'showRSSContent',
                }
            }
           
    },
           
           
    showRSSContent: function( list, index,target, record, event, eOpts ) {
            this.getRssPanel().push({
                                   xtype:'panel',
                                   title: record.get('title'),
                                   html: record.get('content'),
                                   fullscreen:true,
                                   styleHtmlContent:true,
                                   scrollable:true,
                                   });
    }
});