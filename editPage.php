<?php
session_start();
if(!$_SESSION['editrandomfile'])
	$_SESSION['editrandomfile'] = uniqid('list_').".txt";

//echo $_SESSION['editrandomfile'];
include "config.php";
include "classes/Page.php";
include "functions/functions.php";


if($_POST != NULL) {
	//var_dump($_POST);
	$filePath = './upload/apps/'.$DBC->getAppsUnique($_POST['appid']).'/';
	//echo $filePath;
	//echo "<h1>".$DBC->getAppsUnique($_POST['appid'])."</h1>";
	$pageData = "";
	switch($_POST['pagetypetitle'])
	{
		case 'Video': 
						move_uploaded_file($_FILES['videophoto']['tmp_name'], $filePath.$_FILES['videophoto']['name']);
						$videoPoster = $filePath.$_FILES['videophoto']['name'];
						$videoURL = $_POST['videourl'];
						$pageData = $videoURL.",".$videoPoster;
						break;
		
		case 'Audio': $pageData = $_POST['audiourl'];break;
		
		case 'HTML': $pageData= removeHTMLlines(str_replace('"',"'",$_POST['HTMLcontent']));break;
			
		case 'List': 
					if(file_exists('../upload/'.$_SESSION['editrandomfile']) )
					{
					$list = file_get_contents('../upload/'.$_SESSION['editrandomfile']);
					$listArray = unserialize($list);	
					}
					
					$json = "items:[";
					for($i=0;$i<count($listArray);$i++)
					{
						$json.='{"title":"'.$listArray[$i]['title'].'","html":"'.$listArray[$i]['content'].'"},
						';
					}
					$json = substr($json,0, -3);
					$json.="]";
					
					$pageData = addslashes(htmlentities($json));
					unlink('../upload/'.$_SESSION['editrandomfile']);
					break;
		
		case 'Gallery': 
						$newUploads = "";
							//echo "<h1>".count($_FILES['upload'])."</h1>";
							for($i=0;$i<=count($_FILES['upload']);$i++)
							{
								if($_FILES['upload']['tmp_name'][$i])
								{
									$filename = $filePath.str_replace(' ','_',$_FILES['upload']['name'][$i]);
							//echo "<h1>".$filename."</h1>";
									move_uploaded_file($_FILES['upload']['tmp_name'][$i], $filename);
									//$newUploads.=','.$filename;
                                                                       $newUploads.=',http://www.appc.ms/cms/upload/apps/'.$DBC->getAppsUnique($_POST['appid']).'/'.$_FILES['upload']['name'][$i];
								}
							}		
						$pageData = $_POST['order'].$newUploads;
						//echo "<h1>".$pageData."</h1>";
						//echo $pageData;
						break;
			
		case 'Map': $pageData = $_POST['longitude'].",".$_POST['latitude'];break;
			
		case 'RSS': $pageData = $_POST['rssurl'];break;
			
		default: exit(0);
	}
	$page = new Page();
	$page->id       = $_POST['id'];
	//$page->title    = $_POST['title'];
	//$page->xtype    = $_POST['xtype'];
	$page->appid    = $_POST['appid'];
	//$page->pagetype = $_POST['pagetype'];
	$page->pagedata = $pageData;
	//$page->lastupdate= 'NOW()';
	
	if($DBC->Update($page, 'pages') == true)	
	{
		$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-speech-bubble">Update Page</span>
                    </div>
                    <div class="mws-panel-body">
                    	<center>Updated Successfully!</center>
                    </div>    	
                </div>';
	}
	else{
		$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-error">Error</span>
                    </div>
                    <div class="mws-panel-body">
                    	Error in Updating!
                    </div>    	
                </div>';
	}
	
	$themeValues['base']    = './theme/';
	$themeValues['title']   = 'Edit Page';
	$themeValues['content'] = $body;
	$themeValues['appLinks'] = $_SESSION['appLinks'];
	$themeValues['firstname'] = $_SESSION['user']['firstname'];
	$themeValues['lastname'] = $_SESSION['user']['lastname'];
	$themeValues['appName'] = $_SESSION['appTitle'];

	$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
	$themeValues['appName'] = $appDetails['appTitle'];
//var_dump($_SESSION['appLinks']);
	themeIt($themeValues);
	
}	
else
{
$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$page = new Page();
//
//
//
// CHECK IF THE USER HAS THE OWNERSHIP OF THIS APP!
//
//
//

$DBC->query = "SELECT * FROM pages WHERE id='".$_GET['id']."'";
$DBC->Load($page);

if($page->appid != $appDetails['appID'])
header("Location: 404.php");


$pageType = $DBC->getPageTypes($page->pagetype);

/**********************/
/** FORM PROCESSING  **/
/**********************/
	
$pagesList = $DBC->getPagesList(6);

if($pageType['title'] == 'Gallery')
{
	$galleryData = explode(",", $page->pagedata);
	//var_dump($galleryData);
	$gallery = "<ul id=\"sortable\">";
	$comma = "";
	for($i=0;$i<count($galleryData);$i++)
	{
		if($galleryData[$i] != '')
		{
		$gallery.="<li id=\"".$galleryData[$i]."\"><img src=\"".$galleryData[$i]."\" width=\"150\" height=\"250\"/><br /><a href=\"javascript:void(0);\" onclick=\"deleteGallery('".$galleryData[$i]."');\">[DELETE]</a></li>";
		$orderText.=$comma.$galleryData[$i];
		$comma = ",";	
		}
	}
	$gallery.="</ul>";	
}
if($pageType['title'] == 'Map')
{
	$coordinates = explode(",", $page->pagedata);
}
if($pageType['title'] == 'Video')
{
	$videoData = explode(",", $page->pagedata);
}

if($pageType['title'] == 'List')
{
	header("Location: editList.php?id=".$page->id);
}

if($pageType['title'] == 'Navigation')
{
	header("Location: editNav.php?id=".$page->id);
}

$form =

'<h1>'.$pageType['title'].'</h1>
<form class="mws-form" name="form" action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data">
<div class="mws-form-inline">
<input type="hidden" name="id" value="'.$page->id.'" />
<input type="hidden" name="appid" value="'.$page->appid.'" />
<input type="hidden" name="pagetypetitle" value="'.$pageType['title'].'" />		
	<div id="extra"></div>

	<br />
	 <div class="mws-button-row"><input type="submit" class="mws-button blue large" value="Edit Page" /></div>
</div>
</form>
<div id="RSS" class="hiddenDiv">
	<div class="mws-form-row">
		<label>RSS URL:</label>
		<div class="mws-form-item">	 
			<input type="text" name="rssurl" class="mws-textinput" value="'.$page->pagedata.'"/>
		</div>
	</div>
</div>
<div id="Audio" class="hiddenDiv">
	<div class="mws-form-row">
		<label>Audio URL:</label> 

	<div class="mws-form-item">
		<input type="text" class="mws-textinput" name="audiourl" value="'.$page->pagedata.'"/>
	</div>
	</div>
</div>

<div id="Video" class="hiddenDiv">
	<div class="mws-form-row">
		<label>Video Splash Photo:</label> 
		<input type="file" name="videophoto" /> [Photo dimensions 480x640]
	</div>
	<div class="mws-form-row">
		<label>Video URL:</label>
		<div class="mws-form-item"> 
			<input type="text" class="mws-textinput" name="videourl" value="'.$videoData[0].'"/>
		</div>
	</div>
</div>

<div id="HTML" class="hiddenDiv">
	Page Content: <textarea id="HTMLcontent" name="HTMLcontent" cols="50" rows="30">'.$page->pagedata.'</textarea>
</div>
<div id="Gallery" class="hiddenDiv">
<div style="overflow:auto;">'.$gallery.'</div><br /><br />
<input type="hidden" name="order" size="50" id="orderText" value="'.$orderText.'"/>
<br />
Upload more photos: <input name="upload[]" type="file" multiple accept="image/gif,image/png,image/jpeg" />
</div>
<div id="List" class="hiddenDiv">
	<div id="listResult">
	</div>
	<br />
	<form id="listForm">
		<input type="text" name="listtitle" id="listtitle" />
		<br />
		<textarea name="listcontent" id="Listcontent" cols="50" rows="20"></textarea>
		<br />
		<input type="button" value="Add" onclick="addIt();">
	</form>		
</div>
<div id="Map" class="hiddenDiv">
	<div class="mws-form-row">
		<label>Longitude:</label>
		<div class="mws-form-item">
			<input type="text" name="longitude" class="mws-textinput" value="'.$coordinates[0].'" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>Latitude:</label>
		<div class="mws-form-item">
			<input type="text" name="latitude" class="mws-textinput" value="'.$coordinates[1].'" />
		</div>
	</div>
</div>

<div id="Navigation" class="hiddenDiv">
	<div id="navigationResult">
	</div>
	<br />
	<form id="navigationForm">
		Button Title: <input type="text" name="buttontitle" id="buttontitle" />
		<br />
		Button Function: <select name="buttonType" id="buttonType" onChange="showNavItem(this);">
			<option value="null">
				---- SELECT Navigation ---
			</option>
			<option value="page">
				Page
			</option>
			<option value="customfunction">
				Custom Function
			</option>
		</select>
		<br />
			<div id="pageHiddenDiv" class="hiddenDiv">
				<select name="apppages" id="apppages">
					'.$pagesList.'
				</select>
			</div>
			<div id="customfunctionHiddenDiv" class="hiddenDiv">
				Custom Function: <br /><textarea name="customFunction" id="customFunction" rows="20" cols="50"></textarea>
			</div>
		<br />
		<input type="button" value="Add Button" onclick="addButton();">
		</form>		
</div>
<script>
getPageElementsString(\''.$pageType['title'].'\');
</script>
<script type="text/javascript">
	CKEDITOR.replace( \'HTMLcontent\' );
</script>
';


$themeValues['base']    = './theme/';
$themeValues['title']   = 'Edit Page';
$themeValues['content'] = $form;
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];
$themeValues['appName'] = $_SESSION['appTitle'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
//var_dump($_SESSION['appLinks']);
themeIt($themeValues);


}
/***************************/
/**  END FORM PROCESSING  **/
/***************************/

?>