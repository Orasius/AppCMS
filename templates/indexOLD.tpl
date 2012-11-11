<!DOCTYPE html>
<html>
  <head>
  <title>Hello App</title>
      <style>
          
          html, body {
              height: 100%;
          }       
          #appLoadingIndicator {
              position: absolute;
              top: 50%;
              left: 50%;
              margin-top: -10px;
              margin-left: -50px;
              width: 100px;
              height: 20px;
          }
          
          #appLoadingIndicator > * {
              background-color: #FFFFFF;
              float: left;
              height: 20px;
              margin-left: 11px;
              width: 20px;
              -webkit-animation-name: appLoadingIndicator;
              -webkit-border-radius: 13px;
              -webkit-animation-duration: 0.8s;
              -webkit-animation-iteration-count: infinite;
              -webkit-animation-direction: linear;
              opacity: 0.3
          }
          
          #appLoadingIndicator > :nth-child(1) {
              -webkit-animation-delay: 0.18s;
          }
          
          #appLoadingIndicator > :nth-child(2) {
              -webkit-animation-delay: 0.42s;
          }
          
          #appLoadingIndicator > :nth-child(3) {
              -webkit-animation-delay: 0.54s;
          }
          
          @-webkit-keyframes appLoadingIndicator{
              0% {
                  opacity: 0.3
              }
              
              50% {
                  opacity: 1;
                  background-color:#1985D0
              }
              
              100% {
                  opacity:0.3
              }
          }
          
          
          .indiOff{
              font-size:22px;
              font-weight:bold;
              background-color:#000000;
              color:#ffffff;
              display:none;
              text-align:center;
          }
          .indiOn{
              font-size:22px;
              font-weight:bold;
              background-color:#000000;
              color:#ffffff;
              display:block;
              text-align:center;
              position: fixed;
              width: 100%;
              height: 100%;
              top: 0px;
              left: 0px;
              background-color: rgba(0,0,0,0.7); /* black semi-transparent */
              text-align:center;
              padding-top:100px;   
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
        var  lastupdate = '';
        
       {globalfiles}
    	
     	function checkUpdates()
        {
            updateFromWeb(platformurl + 'appupdate.php?id='+appid);
        }
        
        function onDeviceResume()
        {
            checkUpdates();
        }
        
        
        function writeCurrentFile()
        {
            writeFile(currentFile,currentData);
        }
        
        i=0;
        myLoop();
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
            checkUpdates();
        }
        
        function onFileSystemSuccess(fileSystem) {
            globalURI = fileSystem.root.fullPath;
            document.getElementById('globalURIField').value = globalURI;
        }
        
        
        /************************ 
         Reading File
         *************************/
        function readFile(fileName)
        {
            loadFileSystemForReading();
            setFileName(fileName);
        }
        
        function loadFileSystemForReading() {
            window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, gotFSRead, fail);
        }
        
        function gotFSRead(fileSystem) {
            fileSystem.root.getFile(globalFileName, {create: true}, gotFileEntryReader, fail);
        }
        
        function gotFileEntryReader(fileEntry) {
            fileEntry.file(gotFile, fail);
        }
        
        function gotFile(file){
            readAsText(file);
        }
        
        function readAsText(file) {
            var reader = new FileReader();
            reader.onloadend = function(evt) {
            };
            reader.readAsText(file);
        }
        
        function fail(evt) {
            alert(evt.target.error.code);
        }
        
        
        /************************ 
         End of Reading File
         *************************/
        
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
        
		function updateLastReading()
		{
			$.ajax({
                   url: platformurl+'updateApp.php?appID={appid}',
                   type: 'GET',
                   processData: false,
                   dataType: 'text',
                   success: function(data) {
                        i = 0;
                        myLoop();
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
                            	/*
                                if(newData.items[c].title == 'HTMLPage'){
                                    HTMLPageData = newData.items[c].data;
                                    //console.log("NEW HTML = " + HTMLPageData);
                                }*/
                            }
                            updateLastReading(); 
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
      <div id="appLoadingIndicator">
          <div></div>
          <div></div>
          <div></div>
      </div>
      <input type="hidden" id="globalURIField" value="1" />
      {updatedFiles}
  </body>
</html>