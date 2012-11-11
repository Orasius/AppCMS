Ext.define('IntermodalEurope.view.IntermodalEurope',{
		extend: 'Ext.NavigationView',
		xtype: 'homePageView',
		
		requires: [
			'Ext.NavigationView',
		],
		
		config: {			
		items:[
			{
				xtype: 'panel',
				title: 'Intermodal Europe ',
				styleHtmlContent: true,
				fullscreen: true,
				scrollable:true,
				id: 'IntermodalEurope',
				layout: {
				        type: 'vbox',
				    },
				
				defaults: {
				        xtype: 'button',
				        margin: 10,
						padding:10,
						width: '250px',
						align: 'left',
				    },
				items:[
				],
			}
		],
		listeners:{
                initialize:function(){
                            Ext.Ajax.request({
                                        url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
                                        timeout: 5000,
                                        disableCaching: false,
                                        success: function(response){
                                               Ext.getCmp('IntermodalEurope').removeAll();
                                		var b0;
                   				var b1;
                   				var b2;
                   				var b3;
                   				var b4;
                   				var b5;
                   				var b6;
                   				var b7;
                        		
                                                dataValue = getPageData('IntermodalEurope',response.responseText);
                                                navValues = dataValue.toString().split('|'); 
                                                
                                                for(m=0;m<navValues.length;m++)
                                                {
                                                       buttonValues = navValues[m].toString().split(',');
                                                       if(m == 0)
                                                       {
                               
                                                            b0 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b0})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b0);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 1)
                                                       {
                               
                                                            b1 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b1})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b1);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 2)
                                                       {
                               
                                                            b2 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b2})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b2);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 3)
                                                       {
                               
                                                            b3 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b3})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b3);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 4)
                                                       {
                               
                                                            b4 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b4})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b4);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 5)
                                                       {
                               
                                                            b0 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b5})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b5);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                      if(m == 6)
                                                       {
                               
                                                            b0 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b6})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b6);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       
                                                }
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		//console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           		}
                  		});
           		},
                painted:function(){
                	if(document.getElementById('IntermodalEuropeUpdate').value == 'true'){
                                        Ext.Ajax.request({
                                        url: document.getElementById('globalURIField').value +'/.'+appid+'.dat',
                                        timeout: 5000,
                                        disableCaching: false,
                                        success: function(response){
                                               Ext.getCmp('IntermodalEurope').removeAll();
                                               //Ext.getCmp('IntermodalEurope').getStore().getProxy().clear();
                                		var b0;
                   				var b1;
                   				var b2;
                   				var b3;
                   				var b4;
                   				var b5;
                   				var b6;
                   				var b7;
                        		
                                                dataValue = getPageData('IntermodalEurope',response.responseText);
                                                navValues = dataValue.toString().split('|'); 
                                                
                                                for(m=0;m<navValues.length;m++)
                                                {
                                                       buttonValues = navValues[m].toString().split(',');
                                                       if(m == 0)
                                                       {
                               
                                                            b0 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b0})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b0);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 1)
                                                       {
                               
                                                            b1 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b1})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b1);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 2)
                                                       {
                               
                                                            b2 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b2})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b2);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 3)
                                                       {
                               
                                                            b3 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b3})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b3);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 4)
                                                       {
                               
                                                            b4 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b4})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b4);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                       if(m == 5)
                                                       {
                               
                                                            b0 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b5})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b5);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                      if(m == 6)
                                                       {
                               
                                                            b0 = buttonValues[2];
                                                            if(buttonValues[1] == 'page')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          this.up('homePageView').push({xtype: b6})
                                                                                  }});
                                                            }
                                                            if(buttonValues[1] == 'customfunction')
                                                            {
                                                                    Ext.getCmp('IntermodalEurope').add(
                                                                                  {
                                                                                  xtype: 'button',
                                                                                  text: buttonValues[0],
                                                                                  ui: 'round',
                                                                                  handler: function(){
                                                                                          window.plugins.childBrowser.showWebPage(b6);
                                                                                  }});
                                                            }
                                                            
                                                       }
                                                    document.getElementById('IntermodalEuropeUpdate').value == 'false';
                                                       
                                                }
                            		},
                            		error: function(data,textStauts,errorThrown) {
                                		//console.log('Error in Navigation! '+textStauts + '- ' + ' / '+ errorThrown);
                           		}
                  		});
							
                        }
                }
           }
    },
});