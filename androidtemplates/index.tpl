<!DOCTYPE html>
<html>
  <head>
  <title>{appname}</title>
      <style>
        html,body {
            height: 100%;
        }
        .hiddenDiv{
            display:none;
        }    
      </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" />
	<meta charset="utf-8">
    <script type="text/javascript" charset="utf-8" src="cordova-1.9.0.js"></script>
    <script type="text/javascript" charset="utf-8" src="jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="PushNotification.js"></script>
    <script type="text/javascript" src="childbrowser.js"></script>
    <script type="text/javascript">
       
        var  globalFileName;
        var  globalFileContent;
        var  globalURI;
        var  updatesJson = "hello";
        var  currentFile = '';
        var  currentData = '';
        var  appid = '{appid}';
        var  platformurl = 'http://www.appc.ms/cms/';
        var  lastupdate = '';
        
        allData = '{globalfiles}';
        	
        function getPageData(pageName,jsonData)
        {
            getData = jQuery.parseJSON(jsonData);
            for(c = 0;c < getData.entries.length;c++)
            {	
                if(getData.entries[c].title == pageName)
                    pageData = getData.entries[c].data;
            }
            return pageData;
        }
     

        function checkUpdates()
        {
    			$.ajax({
                                url: document.getElementById('globalURIField').value+'/.'+appid+'.dat',
                                type: 'GET',
                                processData: false,
                                dataType: 'text',
                                success: function(response){
                                            newData = jQuery.parseJSON(response.responseText);
                                            lastUpdate = newData.entries[0].data;
                                            updateFromWeb(platformurl + 'androidupdate.php?id='+appid+'&lastupdate='+lastUpdate);
				 },
                                failure: function(){
                                        // Fail to update
                                }
				});					
        }
        
        function onDeviceResume()
        {
        	 checkUpdates();
        }
        
        
        function writeCurrentFile()
        {
            writeFile(currentFile,currentData);
            console.log('WRITING FILE = ' + currentFile);
        }
        

        function onDeviceReady() {
            document.addEventListener("resume", onDeviceResume, false);
            window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, onFileSystemSuccess, fail);
        }
        
        function onFileSystemSuccess(fileSystem) {
            globalURI = fileSystem.root.fullPath;
            //fileSystemRoot = fileSystem.root;
            document.getElementById('globalURIField').value = globalURI;
            setFileName('.'+appid+'.dat');
            setFileContent(allData);
            gotFSWrite(fileSystem,'.'+appid+'.dat');
        }
        
        
        function fail(evt) {
            console.log(evt);
        }
        
        
        /************************ 
         Writing File
         *************************/
        
         function writeFile(fileName,data)
         {
             setFileName(fileName);
             setFileContent(data);
             loadFileSystemForWriting(fileName);
             //gotFSWrite(fileSystem,fileName);
         }
        
         function loadFileSystemForWriting(fileName) 
         {
             window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, gotFSWrite, fail);
         }
         
        
        function gotFSWrite(fileSystem,fileName) {
        	fileSystem.root.getFile(globalFileName, {create: true,exclusive: false}, gotFileEntryWriter, fail);
        }
                
        
        function gotFileEntryWriter(fileEntry) {
            fileEntry.createWriter(gotFileWriter, fail);
        }
        
        
        function gotFileWriter(writer) {
            
            writer.onwrite = function(evt) {
            	conole.log('WRITTEN');
            	//console.write('Current Writing File = ' + globalFileName);
            	//console.write('Current Writing File Data = ' + globalFileContent);
            };
            writer.write(globalFileContent);
        }
    
        function setFileName(fileName)
        {
            globalFileName = fileName;
        }
        
        function setFileContent(data)
        {
            globalFileContent = data;
        }
        
        
        /************************ 
         End of Writing File
         *************************/
        
        /**********************
         Reading files from Web
         ***********************/
        function getWebFileContent(userurl)
        {
            document.getElementById('indi').className = 'indiOn';
            $.ajax({
                   url: userurl,
                   type: 'GET',
                   processData: false,
                   dataType: 'text',
                   success: function(data) {
                        document.getElementById('indi').className = 'indiOff';
                        updatesJson = data;
                   },
                   error: function(data,textStauts,errorThrown) {
                        console.log('Error! ' + errorThrown);
                   }
                   });
        }
        
		
        function updateFromWeb(userurl)
        {
            $.ajax({
                   url: userurl,
                   type: 'GET',
                   processData: false,
                   dataType: 'text',
                   success: function(data) {
                        if(data != 'no')
                        {
                        	currentFile='.'+appid+'.dat';
                        	currentData = data;
                        	//console.log('UPDATE DATA = ' + data);
                        	writeCurrentFile();
                        	document.getElementById('updateData').value = 'YES';
                                {checkPages}
                        }
                        else{
                            //console.log('No Update');
                        }
                   },
                   error: function(data,textStauts,errorThrown) {
                        console.log('Error! ' + errorThrown);
                   }
                   });
        }
	function onBodyLoad()
	{		
		document.addEventListener("deviceready", onDeviceReady, false);	
		document.addEventListener("deviceready", initPushwoosh, true);
		
		document.addEventListener('push-notification', function(event) {
                    /*
                        CODE FOR RECEIVING NOTIFICATION
			var title = event.notification.title;
                        var userData = event.notification.userdata;
                        console.warn('user data: ' + JSON.stringify(userData));
                        navigator.notification.alert(title);
                    */
                });
        		
  	}
        
        
        
        function html_entity_decode (string, quote_style) {
            var hash_map = {},
            symbol = '',
            tmp_str = '',
            entity = '';
            tmp_str = string.toString();
            
            if (false === (hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style))) {
                return false;
            }
            
            // fix &amp; problem
            // http://phpjs.org/functions/get_html_translation_table:416#comment_97660
            delete(hash_map['&']);
            hash_map['&'] = '&amp;';
            
            for (symbol in hash_map) {
                entity = hash_map[symbol];
                tmp_str = tmp_str.split(entity).join(symbol);
            }
            tmp_str = tmp_str.split('&#039;').join("'");
            
            return tmp_str;
        }
        
    
        
        function stripslashes(str) {
            str=str.replace(/\\'/g,'\'');
            str=str.replace(/\\"/g,'"');
                            str=str.replace(/\\0/g,'\0');
                            str=str.replace(/\\\\/g,'\\');
                            return str;
                            }
                            
    </script>
    <script id="microloader" type="text/javascript" src="sdk/microloader/development.js"></script>
    <script type="text/javascript" src="encoder.js"></script>
  </head>
  <body onload="onBodyLoad()">
      <div id="loadingDiv">
		<img src="loading.png" width="100%" height="100%" />
		<div style="position:fixed;top:80%;left:40%;color:#000;font-size:20px;">
			Loading ...
		</div>
	</div>
      <input type="hidden" id="globalURIField" value="1" />
      <input type="hidden" id="updateData" value="false" />
       {updatedFiles}
  </body>
</html>