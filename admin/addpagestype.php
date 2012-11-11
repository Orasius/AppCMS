<?php
session_start();
include "../config.php";
include "../classes/User.php";
include "../3rdparty/PFBC/Form.php";
require_once '../3rdparty/phpthumb/ThumbLib.inc.php'; 
include "../functions/functions.php";

/**********************/
/** FORM PROCESSING  **/
/**********************/

if(isset($_POST["form"])) {
	if(Form::isValid($_POST["form"])) {

		try{
			$thumb = PhpThumbFactory::create($_FILES['icon']['tmp_name']);
			//$thumb = PhpThumbFactory::create('upload/icons/RSSmultimodal512.png');
			$thumb->adaptiveResize(96, 96);
			$filename = '../upload/icons/'.str_replace(" ", "_", $_POST['title']).str_replace(" ", "_", $_FILES['icon']['name']);
			$thumb->save($filename);
			$thumb = NULLl;  
		}
		catch(Exception $e)
		{
			echo $e;
		}
		
		
		$DBC->query = "INSERT INTO pagestype (id,title,icon,description) VALUES (null,'".$_POST['title']."','".$filename."','".$_POST['description']."')";
		$result = $DBC->execute();
		if($result == true)
		{
			$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Page Type Added Successfully!</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">Page Type Added Successfully!</div>
                    	</div>
                    </div>
                </div>';
		}
		else {
			echo $result;
		}
		//header("Location: " . $_SERVER["PHP_SELF"]);
	}
	else {
		/*Validation errors have been found.  We now need to redirect back to the 
		script where your form exists so the errors can be corrected and the form
		re-submitted.*/
		//echo "ERROR!";
		header("Location: " . $_SERVER["PHP_SELF"]);
	}
}	
else{

/***************************/
/**  END FORM PROCESSING  **/
/***************************/

ob_start();
$form = new Form("addPageType", 400);
$form->addElement(new Element_Hidden("form", "addPageType"));
$form->addElement(new Element_Textbox("Page Type Title:", "title",array("required" => 1,"description"=>"Page type title, like Gallery, RSS, List ... etc")));
$form->addElement(new Element_File("Icon","icon",array("required" => 1)));
$form->addElement(new Element_Textarea("Description:", "description",array("required" => 1,"description"=>"Type Description")));

$form->addElement(new Element_Button);
$form->render();
$body = ob_get_contents();
ob_end_clean();
}
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Add Page Type';
$themeValues['content'] = $body;
themeIt($themeValues);
?>