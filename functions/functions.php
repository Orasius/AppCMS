<?PHP 

function removeHTMLlines($text)
{
	
	$text = htmlentities($text); //make remaining items html entries.
	//$text = nl2br($text); //add html line returns
	$text = addslashes($text);
	$text = str_replace(chr(10), " ", $text); //remove carriage returns
	$text = str_replace(chr(13), " ", $text); //remove carriage returns
	return $text;
}


function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


function themeIt($array)
{
	$theme = file_get_contents('theme/header.php');
	$theme.= file_get_contents('theme/sidelinks.php');
	$theme.= file_get_contents('theme/body.php');
	$theme.= file_get_contents('theme/footer.php');
	
	foreach($array AS $key=>$value)
	{
		if(is_array($value))
		{
			$loop = "";
			$templateLoop = getTextBetweenTags($theme,$key);
			//$count = 0;
			foreach ($value as $key2 => $value2) {
				for($i=0;$i<count($value2);$i++)
				{
					//echo "KEY 2".$key2." - VALUE 2".$value2[$i]."<br />";
					if($count == 0)
						$loop[$i]= str_replace('{'.$key2.'}', $value2[$i], $templateLoop[1]);
					else 
						$loop[$i]= str_replace('{'.$key2.'}', $value2[$i], $loop[$i]);
				}	
				$count++;
					
			}
			$theme = str_replace($templateLoop[0], implode("", $loop), $theme);	
		}
		else {
			$theme = str_replace('{'.$key.'}', $value, $theme);
		}
	}
	
	echo $theme;
	 
}


function exportTemplateParse($array,$template)
{
	foreach($array AS $key=>$value)
		$template = str_replace('{'.$key.'}', $value, $template);
	return $template;
}

function getTextBetweenTags($string, $tagname) {
    $pattern = "/{".$tagname."}([\w\W]*?){\/".$tagname."}/";
    preg_match($pattern, $string, $matches);
    return $matches;
}


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////// PUSH NOTIFICATION FUNCTION //////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function doPostRequest($url, $data, $optional_headers = null) {
        $params = array(
            'http' => array(
                'method' => 'POST',
                'content' => $data
            ));
        if ($optional_headers !== null)
            $params['http']['header'] = $optional_headers;
 
        $ctx = stream_context_create($params);
        $fp = fopen($url, 'rb', false, $ctx);
        if (!$fp)
            throw new Exception("Problem with $url, $php_errmsg");
 
        $response = @stream_get_contents($fp);
        if ($response === false)
            return false;
        return $response;
    }
 
    function pwCall( $action, $data = array() ) {
        $url = 'https://cp.pushwoosh.com/json/1.2/' . $action;
        $json = json_encode( array( 'request' => $data ) );
        $res = doPostRequest( $url, $json, 'Content-Type: application/json' );
        //print_r( @json_decode( $res, true ) );
        return @json_decode( $res, true );
    }
    
    
    
    /* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
  //if the zip file already exists and overwrite is false, return false
  if(file_exists($destination) && !$overwrite) { return false; }
  //vars
  $valid_files = array();
  //if files were passed in...
  if(is_array($files)) {
    //cycle through each file
    foreach($files as $file) {
      //make sure the file exists
      if(file_exists($file)) {
        $valid_files[] = $file;
      }
    }
  }
  //if we have good files...
  if(count($valid_files)) {
    //create the archive
    $zip = new ZipArchive();
    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
      return false;
    }
    //add the files
    foreach($valid_files as $file) {
      $zip->addFile($file,$file);
    }
    //debug
    //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
    
    //close the zip -- done!
    $zip->close();
    
    //check to make sure the file exists
    return file_exists($destination);
  }
  else
  {
    return false;
  }
}
?>