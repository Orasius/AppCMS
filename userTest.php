<?PHP 
include "config.php";
include "functions/functions.php";
//include "functions/functions.php";

//echo $DBC->checkCredentials('iraqwebsite@yahoo.com', '11');
//echo "<hr>";
//var_dump($DBC->getUserPages(9));
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Welcome to XRoS CMS';
$themeValues['content'] = 'Content Goes here!';

$themeValues['appLinks']['pageID'][0] = '4';
$themeValues['appLinks']['pageID'][1] = '6';
$themeValues['appLinks']['pageID'][2] = '8';
$themeValues['appLinks']['pageID'][3] = '23';

$themeValues['appLinks']['pageTitle'][0] = 'Link 1';
$themeValues['appLinks']['pageTitle'][1] = 'Link 2';
$themeValues['appLinks']['pageTitle'][2] = 'Link 3';
$themeValues['appLinks']['pageTitle'][3] = 'Link 4';


themeIt($themeValues);
?>