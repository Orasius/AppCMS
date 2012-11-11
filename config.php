<?PHP
include "classes/DB.php";
$DBC = new DB();
$DBC->host = "localhost";
$DBC->username = "root";
$DBC->password = "";
$DBC->database = "";

$DBC->connect();

?>
