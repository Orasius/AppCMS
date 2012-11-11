<?PHP
session_start();

include "config.php";
include "functions/functions.php";

$error='<div id="mws-error-container">
                	<div id="mws-error-code">
                		<h1>Error <span>404</span></h1>
                    </div>
                    <p id="mws-error-message">The page does not exsist!.</p>
                </div>';
                
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Error - Not Found!';
$themeValues['content'] = $error;
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
//var_dump($_SESSION['appLinks']);
themeIt($themeValues);


?>