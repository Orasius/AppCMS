<?PHP
include "config.php";
include "functions/functions.php";

$appid = $_GET['appID'];
$DBC->query = "UPDATE apps SET lastupdate = NOW() WHERE appid='".$appid."'";
$DBC->execute();
?>