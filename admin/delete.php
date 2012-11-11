<?php
session_start();
include "../config.php";
include "../functions/functions.php";

if($DBC->Delete($_GET['className'], $_GET['id']))
	$body = "Deleted Successfully!";
else {
	$body = "Error";
}
include "footer.php";


$themeValues['base']    = './theme/';
$themeValues['title']   = 'Deleted Successfully';
$themeValues['content'] = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">'.$body.'</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">'.$body.'<br />You will be redirected automatically.<br />If not redirected please <a href="'.$_SERVER['HTTP_REFERER'].'">click here</a></div>
                    	</div>
                    </div>
                </div><meta http-equiv="refresh" content="3;URL=\''.$_SERVER['HTTP_REFERER'].'\'">';
                
themeIt($themeValues);
var_dump($_SERVER);
?>