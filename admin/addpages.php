<?php
session_start();
if(!$_SESSION['randomfile'])
	$_SESSION['randomfile'] = uniqid('list_').".txt";

//echo $_SESSION['randomfile'];
include "../config.php";
include "../classes/Page.php";
include "../functions/functions.php";

/**********************/
/** FORM PROCESSING  **/
/**********************/
$filePath = '../upload/apps/'.$DBC->getAppsUnique($_POST['appid']).'/';
if($_POST != NULL) {
	
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
		
		case 'HTML': $pageData=removeHTMLlines($_POST['HTMLcontent']);break;
			
		case 'List': 
					if(file_exists('../upload/'.$_SESSION['randomfile']) )
					{
					$list = file_get_contents('../upload/'.$_SESSION['randomfile']);
					$listArray = unserialize($list);	
					}
					
					$json = "{\"items\":[";
					$comma = "";
					for($i=0;$i<count($listArray);$i++)
					{
						$json.=$comma.'{"title":"'.$listArray[$i]['title'].'","html":"'.str_replace('"',"'",$listArray[$i]['content']).'"}';
						$comma = ",";
					}
					$json.="]}";
					
					$pageData = addslashes(htmlentities($json));
					unlink('../upload/'.$_SESSION['randomfile']);
					break;
		
		case 'Navigation': 
					if(file_exists('../upload/'.$_SESSION['randomfile']) )
					{
					$list = file_get_contents('../upload/'.$_SESSION['randomfile']);
					$listArray = unserialize($list);	
					}
					
					$json = "{\"items\":[";
					$comma = "";
					for($i=0;$i<count($listArray);$i++)
					{
						if($listArray[$i]['buttonType'] == 'page')
						{
							$navData = $listArray[$i]['pageId']; 
						}
						else
						{
							$navData = $listArray[$i]['customfunction']; 	
						}
						$json.=$comma.'{"title":"'.$listArray[$i]['title'].'","type":"'.$listArray[$i]['buttonType'].'","data":"'.$navData.'"}';
						$comma = ",";
					}
					$json.="]}";
					
					$pageData = addslashes(htmlentities($json));
					unlink('../upload/'.$_SESSION['randomfile']);
					echo "Saved!";
					break;
					
		case 'Gallery': 
						$gallery = "items:[";
						for($i=0;$i<=count($_FILES['upload']);$i++)
						{
							if($_FILES['upload']['tmp_name'][$i] != null)
							{
							$filename = $filePath.str_replace(' ','_',$_FILES['upload']['name'][$i]);
							//echo "<h1>".$filename."</h1>";
							move_uploaded_file($_FILES['upload']['tmp_name'][$i], $filename);
							$gallery.='{html:\'<img src="'.$filename.'" />\'},';
							}
						}
						$gallery.="]";
						//echo $gallery;
						$pageData = addslashes(htmlentities($gallery));
						break;
			
		case 'Map': $pageData = $_POST['longitude'].",".$_POST['latitude'];break;
			
		case 'RSS': $pageData = $_POST['rssurl'];break;
			
		default: exit(0);
	}
	$page = new Page();
	$page->id       = null;
	$page->title    = $_POST['title'];
	$page->xtype    = $_POST['xtype'];
	$page->appid    = $_POST['appid'];
	$page->pagetype = $_POST['pagetype'];
	$page->pagedata = $pageData;
	//$page->lastupdate= 'NOW()';
	
	$DBC->Add($page, 'pages');
	$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Page Added Successfully!</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">Page Added Successfully!</div>
                    	</div>
                    </div>
                </div>';
}	
else
{
$pagesList = $DBC->getPagesList(10);

$form = '						
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-list">Add Page</span>
                    </div>
                    <div class="mws-panel-body">

<form class="mws-form" name="form" action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data">
<div class="mws-form-inline">
	<div class="mws-form-row">
            <label>Select App</label>
            <div class="mws-form-item large">
                    <select name="appid">
						'.$DBC->getAppsSelect().'
					</select>
            </div>
    </div>

	<div class="mws-form-row">
            <label>Page Title</label>
            <div class="mws-form-item large">
                   <input type="text" name="title" class="mws-textinput" />
            </div>
    </div>

	<div class="mws-form-row">
            <label>xType (no space string)</label>
            <div class="mws-form-item large">
                    <input type="text" name="xtype" class="mws-textinput" />
            </div>
    </div>

	<div class="mws-form-row">
            <label>Page Type</label>
            <div class="mws-form-item large">
                   <select name="pagetype" onChange="getPageElements(this)">
					'.$DBC->getPageTypesSelect().'
			   </select>
            </div>
    </div>
	<input type="hidden" id="pagetypetitle" name="pagetypetitle" />
	<div id="extra"></div>
</div>
	<div class="mws-button-row">
		<input type="submit" value="Add Page"  class="mws-button red"/>
	</div>
</form>
</div>    
</div>


<div id="RSS" class="hiddenDiv">
	<div class="mws-form-row">
            <label>RSS URL</label>
            <div class="mws-form-item large">
                   <input type="text" name="rssurl" class="mws-textinput" />
            </div>
    </div>
</div>

<div id="Audio" class="hiddenDiv">
	<div class="mws-form-row">
            <label>Audio URL</label>
            <div class="mws-form-item large">
                   <input type="text" name="audiourl" class="mws-textinput" />
            </div>
    </div>	
</div>

<div id="Video" class="hiddenDiv">
	<div class="mws-form-row">
            <label>Video Photo</label>
            <div class="mws-form-item large">
                   <input type="file" name="videophoto" /> [Photo dimensions 480x640]
            </div>
    </div>	
	<div class="mws-form-row">
            <label>Video URL</label>
            <div class="mws-form-item large">
                   <input type="text" name="videourl" class="mws-textinput" />
            </div>
    </div>
</div>

<div id="HTML" class="hiddenDiv">
	<div class="mws-form-row">
            <textarea id="HTMLcontent" name="HTMLcontent" cols="100" rows="100"></textarea>
    </div>
</div>
<div id="Gallery" class="hiddenDiv">
	<!-- <div class="mws-form-row"> -->
		<input name="upload[]" type="file" multiple accept="image/gif,image/png,image/jpeg" />
	<!--</div>-->
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
            <label>Longitude</label>
            <div class="mws-form-item large">
                   <input type="text" name="longitude" class="mws-textinput" />
            </div>
    </div>
    <div class="mws-form-row">
            <label>Latitude</label>
            <div class="mws-form-item large">
                    <input type="text" name="latitude" class="mws-textinput" />
            </div>
    </div>
</div>

<div id="Navigation" class="hiddenDiv">
	<div id="navigationResult">
	</div>
	<br />
	<form id="navigationForm" class="mws-form" >
		<div class="mws-form-row">
        	    <label>Button Title</label>
           		<div class="mws-form-item large">
                   <input type="text" name="buttontitle" id="buttontitle" class="mws-textinput" />
            	</div>
    	</div>
	    <div class="mws-form-row">
        	    <label>Button Function</label>
           		<div class="mws-form-item large">
                   <select name="buttonType" id="buttonType" onChange="showNavItem(this);">
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
            	</div>
    	</div>
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
';
$body = $form;
}
/***************************/
/**  END FORM PROCESSING  **/
/***************************/

include "footer.php";
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Add Page';
$themeValues['content'] = $body;
themeIt($themeValues);

?>
