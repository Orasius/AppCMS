<?PHP 
session_start();
include "../config.php";

if(file_exists('../upload/'.$_SESSION['randomfile']) )
{
$list = file_get_contents('../upload/'.$_SESSION['randomfile']);
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

//echo nl2br($json);
?>