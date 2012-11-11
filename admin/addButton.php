<?PHP 
session_start();
include "../config.php";
$title = $_POST['title'];
$buttonType = $_POST['buttonType'];
$pageId = $_POST['pageid'];
$customfunction = $_POST['customfunction'];
//var_dump($_POST);
if(file_exists('../upload/'.$_SESSION['randomfile']) )
{
$buttons = file_get_contents('../upload/'.$_SESSION['randomfile']);
$buttonsArray = unserialize($buttons);	
}
$count = count($buttonsArray);
$buttonsArray[$count]['title'] = ucfirst($title);
$buttonsArray[$count]['buttonType'] = $buttonType;
$buttonsArray[$count]['pageId'] = $pageId;
$buttonsArray[$count]['customfunction'] = $customfunction;


file_put_contents('../upload/'.$_SESSION['randomfile'], serialize($buttonsArray));

for($i=0;$i<count($buttonsArray);$i++)
{
	echo "Title:".$buttonsArray[$i]['title']." === Page Type:".$buttonsArray[$i]['buttonType']."<hr>";
}
?>
