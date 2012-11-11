<?php
session_start();
include "../config.php";
include "../functions/functions.php";

switch($_GET['page'])
{
	case 'user': $query = "SELECT id,firstname,lastname,email,website,twitter FROM users";$className = 'users';$title = "List Clients" ;break;
	case 'apps': $query = "SELECT id,apptitle,appicon FROM apps";$className = 'apps';$title = "List Apps";break;
	case 'pagetypes':$query = "SELECT id,title,icon,description FROM pagestype";$className = 'pagestype';$title = "List Page Types"; break;
	case 'page':$query = "SELECT id,pagetype,appid FROM pages";$className = 'pages';break;
	default: exit(0);
}
$DBC->query = $query;
$body = $DBC->getGrid($className,$title);

$themeValues['base']    = './theme/';
$themeValues['title']   = $title;
$themeValues['content'] = $body;
themeIt($themeValues);
include "footer.php";

?>