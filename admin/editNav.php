<?php
session_start();
include "../config.php";
include "../classes/Page.php";
include "../functions/functions.php";
include "header.php";

if(!$_POST)
{
$id = $_GET['id'];
$page = new Page();
$DBC->query = "SELECT * from pages where id='".$id."'";

$DBC->Load($page);

$soso = json_decode(html_entity_decode($page->pagedata),true);
$data = $soso['items'];
//echo count($data);
//var_dump($data);
$form.="<form action=\"".$_SERVER['PHP_SELF']."\" method=post>";
$form.="<input type='hidden' name='id' value='".$id."' />";
$list="<ul id='vertical_sortable'>";
$comma = "";
for($i=0;$i<count($data);$i++)
{
	$order.= $comma.$i;
	$comma = ",";
	$list.="<li id='".$i."'>".$data[$i]['title']." -- <a href=\"javascript:void('0');\" onclick=\"editNavItem('".$i."')\">Edit</a></li>";
	$form.="<input type='hidden' name=\"data[type][".$i."]\" value='".$data[$i]['type']."'>";
	if($data[$i]['type'] == 'customfunction')
	{
		$form.="<div id='div".$i."' class=\"hiddenDiv\"><input type='text' name=\"data[title][".$i."]\" value='".$data[$i]['title']."'><br /><textarea name=\"data[data][".$i."]\" cols='20' rows='15'>".$data[$i]['data']."</textarea><a href=\"javascript:void('0');\" onclick=\"hideNavItem('".$i."')\">[SAVE]</a></div>";
	}
		//$form.="<div id='div".$data[$i]['title']."' class=\"hiddenDiv\"><textarea name='data[".$i."]['data']' id='custom".$data[$i]['title']."' cols='20' rows='15'>".$data[$i]['data']."</textarea><br ><input type='button' value='Save' onclick=\"updateCS('".$data[$i]['title']."');\"><br /><a href=\"javascript:void('0');\" onclick=\"hideNavItem('".$data[$i]['title']."')\">[X]</a></div>";
	else
	{
		$form.="<div id='div".$i."' class=\"hiddenDiv\"><input type='text' name=\"data[title][".$i."]\" value='".$data[$i]['title']."'><br /><select name=\"data[data][".$i."]\">".$DBC->getPagesList($page->appid,$data[$i]['data'])."</select><br /><a href=\"javascript:void('0');\" onclick=\"hideNavItem('".$i."')\">[SAVE]</a></div>";	
	}
		//$form.="<div id='div".$data[$i]['title']."' class=\"hiddenDiv\"><select name='data[".$i."]['data']' id='page".$data[$i]['title']."'>".$DBC->getPagesList($page->appid)."</select><br /><br /><a href=\"javascript:void('0');\" onclick=\"hideNavItem('".$data[$i]['title']."')\">[X]</a></div>";
	
}
$list.="</ul>";	
$form.='
Button Title: <input type="text" name="buttontitle" />
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
					'.$DBC->getPagesList($page->appid).'
				</select>
			</div>
		
			<div id="customfunctionHiddenDiv" class="hiddenDiv">
				Custom Function: <br /><textarea name="customFunction" id="customFunction" rows="20" cols="50"></textarea>
			</div>
		<br />';
$form.="<input type='hidden' name='navOrder' id='navOrder' value='".$order."' /><input type=submit></form>";

echo $list;
echo $form;
}
else {
	$pageID = $_POST['id'];
	//echo $_POST['navOrder'];
	$order = explode(",",$_POST['navOrder']);
	//var_dump($_POST['data']);
	$savedData = '{"items":[';
	$comma="";
	//echo count($order);
	for($i=0;$i<count($order);$i++)
	{
		$savedData.=$comma."{";
		$innerComma = "";
		foreach ($_POST['data'] as $key => $value) {
			//echo $value[$i]."<br />";
			$savedData.=$innerComma.'"'.$key.'":"'.$value[$order[$i]].'"';
			$innerComma = ",";
		}
		$savedData.="}";
		$comma = ",";
	}
	
	if($_POST['buttontitle'] AND $_POST['buttonType'])
	{
		if($_POST['buttonType'] == 'page')
						{
							$navData = $_POST['apppages']; 
						}
						else
						{
							$navData = $_POST['customFunction']; 	
						}
		$savedData.=$comma.'{"title":"'.$_POST['buttontitle'].'","type":"'.$_POST['buttonType'].'","data":"'.$navData.'"}';
	}
	$savedData.=']}';
	//echo $savedData;
	$page = new Page();
	$page->id = $pageID;
	$page->pagedata = addslashes(htmlentities($savedData));
	//echo $savedData;
	$DBC->Update($page, 'pages');
	echo "DONE!";
}
?>
<!-- <div style="position:absolute;top:50;left:400;" id="editArea"></div>-->
</body>
</html>