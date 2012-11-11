<?php
session_start();
include "../config.php";
include "../classes/Page.php";
include "../functions/functions.php";
include "templateheader.php";


function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


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
			echo $value[$i]."<hr>";
			$savedData.=$innerComma.'"'.$key.'":"'.addcslashes($value[$i], '"\\/').'"';
			$innerComma = ",";
		}
		$savedData.="}";
		$comma = ",";
	}
	//echo "<h1>".count($_POST['data']['title'])."</h1>";

	if($_POST['itemtitle'] AND $_POST['listcontent'])
	{
		$savedData.=$comma.'{"title":"'.$_POST['itemtitle'].'","html":"'.addcslashes($_POST['listcontent'], '"\\/').'"}';
	}
	$savedData.=']}';
	//echo $savedData;
	$page = new Page();
	$page->id = $pageID;
	$page->pagedata = addslashes(htmlentities($savedData));
	//echo $page->pagedata;
	//var_dump($page);
	$DBC->Update($page, 'pages');
	echo "DONE!";
	
}
else {
	$page = new Page();
	$DBC->query = "SELECT * from pages where id='".$_GET['id']."'";
	$DBC->Load($page);
	//$validText = str_replace("\\'", "\'", html_entity_decode($page->pagedata));
	$validText = html_entity_decode($page->pagedata);
	$soso = json_decode($validText,true);
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
	$form.="<div id='div".$i."' class=\"hiddenDiv\"><input type='text'  id='editTitle".$i."' name=\"data[title][".$i."]\" value='".$data[$i]['title']."'><br /><center><textarea name=\"data[html][".$i."]\" id='".$i."content' cols='50' rows='35'>".$data[$i]['html']."</textarea><a href=\"javascript:void('0');\" onclick=\"hideNavItem('".$i."')\">[SAVE]</a></center></div>";
	
}
$list.="</ul>";
$form.="<input type=\"text\" name=\"itemtitle\" />
		<br />
		<textarea name=\"listcontent\" id=\"Listcontent\" cols=\"50\" rows=\"20\"></textarea><script>loadHTML('List');</script><input type=submit></form>";

echo $list;
echo $form;

}

?>
</body>
</html>