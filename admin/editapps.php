<?php
session_start();
include "../config.php";
include "../classes/App.php";
include "../3rdparty/PFBC/Form.php";
require_once '../3rdparty/phpthumb/ThumbLib.inc.php'; 
include "../functions/functions.php";

/**********************/
/** FORM PROCESSING  **/
/**********************/
$app = new App();
		
		
if(isset($_POST["form"])) {
	if(Form::isValid($_POST["form"])) {
		
		$uploadDir = '../upload/apps/'.$_POST['appid'];
		if($_FILES['icon']['tmp_name'] != '')
		{		
					
					$thumb = PhpThumbFactory::create($_FILES['icon']['tmp_name']);
					$thumb->adaptiveResize(72, 72);
					$filename = $uploadDir.'/icon.png';
					$thumb->save($filename);
					$thumb = NULLl;  
					
					
					$thumb57 = PhpThumbFactory::create($_FILES['icon']['tmp_name']);
					$thumb57->adaptiveResize(57, 57)->save($uploadDir.'/icon57.png');
					$thumb57 = NULL;
					
					$thumb114 = PhpThumbFactory::create($_FILES['icon']['tmp_name']);
					$thumb114->adaptiveResize(114, 114)->save($uploadDir.'/icon114.png');
					$thumb114 = NULL;
					
					
					$thumb36 = PhpThumbFactory::create($_FILES['icon']['tmp_name']);
					$thumb36->adaptiveResize(36, 36)->save($uploadDir.'/icon36.png');
					$thumb36 = NULL;
					
					
					$thumb48 = PhpThumbFactory::create($_FILES['icon']['tmp_name']);
					$thumb48->adaptiveResize(48, 48)->save($uploadDir.'/icon48.png');
					$thumb48 = NULL;
					
					
					$thumb96 = PhpThumbFactory::create($_FILES['icon']['tmp_name']);
					$thumb96->adaptiveResize(96, 96)->save($uploadDir.'/icon96.png');
					$thumb96 = NULL;
					
					move_uploaded_file($_FILES['icon']['tmp_name'], $uploadDir.'/icon500.png');	
					
					$app->appicon = $filename;
		}
		
		if($_FILES['splash']['tmp_name'])
		{
			$splashfilename =$uploadDir.'/splash.png';
					
			$splash = PhpThumbFactory::create($_FILES['splash']['tmp_name']);
			$splash->resize(320, 640)->save($splashfilename);
			$splash = NULL;
			move_uploaded_file($_FILES['splash']['tmp_name'], $uploadDir.'/splash@2x.png');
			$app->appsplash = $splashfilename;
		}		
					
			
			
		
		$app->id = $_POST['id'];
		$app->ownerid = $_POST['owner'];
		$app->apptitle = $_POST['apptitle'];
		$app->appdescription = $_POST['description'];
		$app->appkeywords = $_POST['keywords'];
		//$app->appicon = $filename;
		//$app->appsplash = $splashfilename;
		$app->basecolor = $_POST['basecolor'];
		$app->activecolor = $_POST['activecolor'];
		$app->statisticsappid = $_POST['statsid'];
		$app->googleappbundle = $_POST['googlebundle'];
		$app->pnappcode = $_POST['pnappcode'];
		$app->appstatus = $_POST['appstatus'];
		$result =$DBC->Update($app,'apps'); 
		if( $result == true )
		{
			$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">App Saved Successfully!</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">App Saved Successfully!</div>
                    	</div>
                    </div>
                </div>';
		}
		else {
			echo $result;
		}
		
	}
	else {
		/*Validation errors have been found.  We now need to redirect back to the 
		script where your form exists so the errors can be corrected and the form
		re-submitted.*/
		//echo "ERROR!";
		header("Location: " . $_SERVER["PHP_SELF"]."?id=".$_POST['id']);
	}

}
else{

/***************************/
/**  END FORM PROCESSING  **/
/***************************/
ob_start();

$DBC->query = "SELECT id,appid,ownerid,apptitle,appdescription,appkeywords,basecolor,activecolor,googleappbundle,pnappcode,appstatus FROM apps WHERE id='".$_GET['id']."'";
$DBC->Load($app);
//var_dump($app);
//echo $app->apptitle;
$form = new Form("editApp", 400);
$form->addElement(new Element_Hidden("form", "editApp"));
$form->addElement(new Element_Hidden("id", $_GET['id']));
$form->addElement(new Element_Hidden("appid", $app->appid));

$form->addElement(new Element_Textbox("App Name:", "apptitle",array("required" => 1,"description"=>"App Name","value"=>$app->apptitle)));

$form->addElement(new Element_Select("App Owner:", "owner", $DBC->getUsers(), array("value"=>$app->ownerid)));
$form->addElement(new Element_Textarea("Keywords:", "keywords",array("required" => 1,"description"=>"Keywords to be used in App Store and Android Market","value"=>$app->appkeywords)));
$form->addElement(new Element_Textarea("Description:", "description",array("required" => 1,"description"=>"App Description that appears in App Store and Android Market","value"=>$app->appdescription)));
$form->addElement(new Element_File("Icon","icon",array("description"=>"Upload icon only if you want to replace the current one. Icon should be 500x500px and in png format")));
$form->addElement(new Element_File("Spalsh Screen","splash",array("description"=>"Upload new splash ONLY if you want to replace the current one.Splash screen should be 480x960px and in png format")));
$form->addElement(new Element_Color("Base Color:", "basecolor", array("required" => 1,"description" => "The Base color of the App","value"=>$app->basecolor)));
$form->addElement(new Element_Color("Active Color:", "activecolor", array("required" => 1,"description" => "The Active color of the App","value"=>$app->activecolor)));

//$form->addElement(new Element_Textbox("Stats ID:", "statsid",array("description"=>"The statistics API ID from (AppFigure) ... leave blank if you didn't install it yet","value"=>$app->statisticsappid)));
$form->addElement(new Element_Textbox("Google Bundle:", "googlebundle",array("description"=>"The google bundle identifier, example: com.shloud.myApp","value"=>$app->googleappbundle)));
$form->addElement(new Element_Textbox("Push Notification App Code:", "pnappcode",array("description"=>"The application code from PushWoosh, leave blank if you didn't install it yet","value"=>$app->pnappcode)));
$form->addElement(new Element_Select("App Status:", "appstatus", array('development','done'), array("value"=>$app->appstatus)));

$form->addElement(new Element_Button);

$form->render();
$body = ob_get_contents();
ob_end_clean();
}
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Edit App';
$themeValues['content'] = $body;
themeIt($themeValues);
?>