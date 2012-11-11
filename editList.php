<?php
session_start();
include "config.php";
include "classes/Page.php";
include "functions/functions.php";

if($_POST)
{
	
	$pageID = $_POST['id'];
	$savedData = '{"items":[';
	$comma="";
	//echo count($order);
	for($i=0;$i<count($_POST['data']['title']);$i++)
	{
		$savedData.=$comma."{";
		$innerComma = "";
		foreach ($_POST['data'] as $key => $value) {
			//echo $value[$i]."<br />";
			//echo $value[$i]."<hr>";
			$savedData.=$innerComma.'"'.$key.'":"'.str_replace('"',"'",$value[$i]).'"';
			$innerComma = ",";
		}
		$savedData.="}";
		$comma = ",";
	}
	//echo "<h1>".count($_POST['data']['title'])."</h1>";

	if($_POST['itemtitle'] AND $_POST['listcontent'])
	{
		$savedData.=$comma.'{"title":"'.ucfirst($_POST['itemtitle']).'","html":"'.str_replace('"',"'",$_POST['listcontent']).'"}';
	}
	$savedData.=']}';
        
        $savedData = removeHTMLlines($savedData);
	//echo $savedData;
	$page = new Page();
	$page->id = $pageID;
	$page->pagedata = addslashes(htmlentities($savedData));
	//echo "<h1>".$savedData."<h1>";
	//var_dump($page);
	$DBC->Update($page, 'pages');
	$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-error">Update</span>
                    </div>
                    <div class="mws-panel-body">
                    	Updated Successfully!
                    </div>    	
                </div>';
	
}
else {
	$page = new Page();
	$DBC->query = "SELECT * from pages where id='".$_GET['id']."'";
	$DBC->Load($page);
	//$validText = str_replace("\\'", "\'", html_entity_decode($page->pagedata));
	
	$validText = html_entity_decode($page->pagedata);
        $validText = htmlspecialchars_decode($validText);
        $validText = preg_replace('!\s+!smi', ' ',$validText);
	//var_dump($validText);

	$soso = json_decode(stripslashes($validText),true);
	//echo "<h1>".$validText."</h1>";
	//var_dump($soso);
	$data = $soso['items'];
	//var_dump($data);
	//echo "<h1>".count($data)."</h1>";
	array_sort_by_column($data,'title');
	//var_dump($data);

	$form.="<form action=\"".$_SERVER['PHP_SELF']."\" method=post>";
$form.="<input type='hidden' name='id' value='".$_GET['id']."' />";
$list="<ul>";
$comma = "";
for($i=0;$i<count($data);$i++)
{
	//echo "<h1>".$data[$i]['html']."</h1>";
	$comma = ",";
	$list.="<li><span id='title".$i."'>".$data[$i]['title']."</span> -- <a href=\"javascript:void('0');\" onclick=\"editNavItem('".$i."');loadHTML('".$i."');\">Edit</a></li>";
	$form.="<div id='div".$i."' class=\"hiddenDiv\"><center><div style=\"width:600px;background-color:#fff;border:2px solid black;\"><b>Title:</b> <input type='text' id='editTitle".$i."' name=\"data[title][".$i."]\" value='".$data[$i]['title']."' size=\"90\"><hr><textarea name=\"data[html][".$i."]\" id='".$i."content' cols='80' rows='25'>".$data[$i]['html']."</textarea><a href=\"javascript:void('0');\" onclick=\"hideNavItem('".$i."')\">[SAVE]</a></div></center></div>'<script type=\"text/javascript\">CKEDITOR.replace('".$i."content');</script>";
	
}
$list.="</ul>";
$form.="<hr> Title :<input type=\"text\" name=\"itemtitle\" />
		<br />
                Description: <textarea name=\"listcontent\" id=\"Listcontent\" cols=\"50\" rows=\"20\"></textarea><input type=submit></form>";
$body = $list;
$body.= $form;

}

$themeValues['base']    = './theme/';
$themeValues['title']   = 'Edit List';
$themeValues['content'] = $body;
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];
$themeValues['appName'] = $_SESSION['appTitle'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
themeIt($themeValues);
?>