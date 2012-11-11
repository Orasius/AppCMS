<!DOCTYPE html>
<html>
  <head>
  <title>Hello App</title>
      <style>
          
           html, body {
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
    <script type="text/javascript">
       
        var  globalFileName;
        var  globalFileContent;
        var  globalURI;
        var  updatesJson = "hello";
        var  currentFile = '';
        var  currentData = '';
        var  appid = '{appid}';
        var  platformurl = 'http://www.appc.ms/cms/';
        
        
       {globalfiles}
       cfile[0] = 'lastUpdate';
        var lastUpdateData = '0';
     	
     	function checkUpdates()
        {
            
            $.ajax({
                   url: document.getElementById('globalURIField').value +  '/lastUpdate.txt',
                   type: 'GET',
                   processData: false,
                   dataType: 'text',
                   success: function(data) {
                        updateFromWeb(platformurl + 'appupdate.php?id='+appid + '&lastupdate='+data);
                   },
                   error: function(data,textStauts,errorThrown) {
                        console.log('Error! ' + errorThrown);
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
        }
        
        function myLoop () {  
            //  create a loop function
            setTimeout(function () {    //  call a 3s setTimeout when the loop is called
                       currentFile = cfile[i];
                       currentData = eval(cfile[i]+'Data');
                       console.log('File = '+currentData);          //  your code here
                       writeFile(currentFile+'.txt',currentData);
                       i++;                     //  increment the counter
                       if (i < cfile.length) {            //  if the counter < 10, call the loop function
                       myLoop();             //  ..  again which will trigger another 
                       }                        //  ..  setTimeout()
                       }, 10)
        }
        function onDeviceReady() {
            
            document.addEventListener("resume", onDeviceResume, false);
            window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, onFileSystemSuccess, fail);
            
            $.ajax({
                   url: document.getElementById('globalURIField').value +  '/lastUpdate.txt',
                   type: 'GET',
                   processData: false,
                   dataType: 'text',
                   success: function(data) {
                        if(data > 0){
                            checkUpdates();
                        }
                   
                   },
                   error: function(data,textStauts,errorThrown) {
                        i=0;
                        myLoop();
                   }
                   });
        }
        
        function onFileSystemSuccess(fileSystem) {
            globalURI = fileSystem.root.fullPath;
            document.getElementById('globalURIField').value = globalURI;
        }
        
      
        
        /************************ 
         Writing File
         *************************/
        
        function writeFile(fileName,data)
        {
            setFileName(fileName);
            setFileContent(data);
            loadFileSystemForWriting(fileName);
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
                        //console.log(data);
                        if(data != 'no')
                        {
                           newData = jQuery.parseJSON(data);
                            //console.log('Items = ' + newData.items.length);
                            for(c = 0;c < newData.items.length;c++)
                            {
                            	{checkPages}
                                    if(newData.items[c].title == 'lastUpdate'){
                                        lastUpdateData = stripslashes(newData.items[c].data);
                                    }
                            } 
                
                            i=0;
                            myLoop();
                        }
                        else{
                            console.log('No Update');
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
          <div style="position:fixed;top:80%;left:40%;color:#fff;font-size:20px;">
              Loading ...
          </div>
      </div>
      
      <input type="hidden" id="globalURIField" value="1" />
      {updatedFiles}
  </body>
</html>