<?php
session_start();
include "../config.php";
include "../classes/User.php";
include "../3rdparty/PFBC/Form.php";
include "../functions/functions.php";

$user = new User();

/**********************/
/** FORM PROCESSING  **/
/**********************/

if(isset($_POST["form"])) {
	if(Form::isValid($_POST["form"])) {
		$user->id        = $_POST['id'];
		$user->firstname = $_POST['firstname'];
		$user->lastname  = $_POST['lastname'];
		$user->email     = $_POST['email'];
		$user->password  = $_POST['password'];
		$user->phone     = $_POST['phone'];
		$user->website   = $_POST['website'];
		$user->twitter   = $_POST['twitter'];
		$user->package   = $_POST['package'];
		
		$result = $DBC->Update($user,'users');
		if($result == true)
		{
			$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Client Saved Successfully!</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">Client Saved Successfully!</div>
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
		header("Location: " . $_SERVER["PHP_SELF"]."?id=".$_POST['id']);
	}
}	
else{

/***************************/
/**  END FORM PROCESSING  **/
/***************************/

ob_start();
$DBC->query = "SELECT firstname,lastname,email,phone,website,twitter,package FROM users WHERE id='".$_GET['id']."'";
$DBC->Load($user);

$form = new Form("editUser", 400);
$form->addElement(new Element_Hidden("form", "editUser"));
$form->addElement(new Element_Hidden("id", $_GET['id']));
$form->addElement(new Element_Textbox("First Name:", "firstname",array("required" => 1,"description"=>"Required Field","value"=>$user->firstname)));
$form->addElement(new Element_Textbox("Last Name:", "lastname",array("required" => 1,"description"=>"Required Field","value"=>$user->lastname)));
$form->addElement(new Element_Textbox("Email:", "email",array("required" => 1,"description"=>"Required Field","value"=>$user->email)));
$form->addElement(new Element_Textbox("Phone:", "phone",array("required" => 1,"description"=>"Required Field","value"=>$user->phone)));
$form->addElement(new Element_Textbox("Website:", "website",array("description"=>"With http://","value"=>$user->website)));
$form->addElement(new Element_Textbox("Twitter:", "twitter",array("value"=>$user->twitter)));
$form->addElement(new Element_Select("Package:", "package", $DBC->getPackages(),array("value"=>$user->package)));

$form->addElement(new Element_Button);
$form->render();
$body = ob_get_contents();
ob_end_clean();
}

$themeValues['base']    = './theme/';
$themeValues['title']   = 'Edit Client';
$themeValues['content'] = $body;
themeIt($themeValues);
?>