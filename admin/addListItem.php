<?PHP 
session_start();
include "../config.php";
$title = $_POST['title'];
$content = addcslashes($_POST['content'], '"\\/');
if(file_exists('../upload/'.$_SESSION['randomfile']) )
{
$list = file_get_contents('../upload/'.$_SESSION['randomfile']);
$listArray = unserialize($list);	
}
$count = count($listArray);
$listArray[$count]['title'] = ucfirst($title);
$listArray[$count]['content'] = $content;

array_sort_by_column($listArray,'title');
//var_dump($listArray);
file_put_contents('../upload/'.$_SESSION['randomfile'], serialize($listArray));

for($i=0;$i<count($listArray);$i++)
{
	echo "Title:".$listArray[$i]['title']." --- Content:".$listArray[$i]['content']."<hr>";
}



function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}
?>
