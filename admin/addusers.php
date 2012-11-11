<?php
session_start();
include "../config.php";
include "../classes/User.php";
include "../functions/functions.php";
include "../3rdparty/PFBC/Form.php";


/**********************/
/** FORM PROCESSING  **/
/**********************/

if(isset($_POST["form"])) {
	if(Form::isValid($_POST["form"])) {
		$user = new User();
		$user->firstname = $_POST['firstname'];
		$user->lastname  = $_POST['lastname'];
		$user->email     = $_POST['email'];
		$user->password  = md5($_POST['password']);
		$user->phone     = $_POST['phone'];
		$user->website   = $_POST['website'];
		$user->twitter   = $_POST['twitter'];
		$user->package   = $_POST['package'];
		
		$result = $DBC->Add($user,'users');
		if($result == true)
			$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Client Added Successfully!</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">Client Added Successfully!</div>
                    	</div>
                    </div>
                </div>';
		else {
			$body = $result;
		}
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
$form = new Form("addUser", 400);
$form->addElement(new Element_Hidden("form", "addUser"));
$form->addElement(new Element_Textbox("First Name:", "firstname",array("required" => 1,"description"=>"Required Field")));
$form->addElement(new Element_Textbox("Last Name:", "lastname",array("required" => 1,"description"=>"Required Field")));
$form->addElement(new Element_Email("Email:", "email",array("required" => 1,"description"=>"Required Field")));
$form->addElement(new Element_Textbox("Password:", "password",array("required" => 1,"description"=>"Required Field")));
$form->addElement(new Element_Textbox("Phone:", "phone",array("required" => 1,"description"=>"Required Field")));
$form->addElement(new Element_Textbox("Website:", "website",array("description"=>"With http://")));
$form->addElement(new Element_Textbox("Twitter:", "twitter"));
$form->addElement(new Element_Select("Package:", "package", $DBC->getPackages()));

$form->addElement(new Element_Button);
$form->render();
$body = ob_get_contents();
ob_end_clean();
}
$themeValues['base']    = './theme/';
$themeValues['title']   = 'Add Client';
$themeValues['content'] = $body;
themeIt($themeValues);
?>