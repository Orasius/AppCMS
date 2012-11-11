<?php
session_start();
include "../config.php";
include "../functions/functions.php";

$themeValues['base']    = './theme/';
$themeValues['title']   = 'Welcome to AppCMS';
$themeValues['content'] = "<h1>Welcome to AppCMS</h1><h4>Please choose a link from the side nav</h4>";
themeIt($themeValues);
?>