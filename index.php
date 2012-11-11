<?PHP 
session_start();

if(!$_SESSION['user']['id'])
{
	header("Location: login.php");
}
else{
	
include "config.php";
include "functions/functions.php";
//include "functions/functions.php";

//echo $DBC->checkCredentials('iraqwebsite@yahoo.com', '11');
//echo "<hr>";
//var_dump($DBC->getUserPages(9));

			
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Welcome to App CMS';
$themeValues['content'] = '<h1>Welcome to App CMS, please select from the left nav menu</h1>';
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
//var_dump($_SESSION['appLinks']);
themeIt($themeValues);
/*
$themeValues['appLinks']['pageID'][0] = '4';
$themeValues['appLinks']['pageID'][1] = '6';
$themeValues['appLinks']['pageID'][2] = '8';
$themeValues['appLinks']['pageID'][3] = '23';

$themeValues['appLinks']['pageTitle'][0] = 'Link 1';
$themeValues['appLinks']['pageTitle'][1] = 'Link 2';
$themeValues['appLinks']['pageTitle'][2] = 'Link 3';
$themeValues['appLinks']['pageTitle'][3] = 'Link 4';
*/	
}
?>
