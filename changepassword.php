<?PHP
session_start();
include "config.php";
include "functions/functions.php";
include "classes/User.php";

if(!$_POST['oldpassword'])
{
$body = '<form class="mws-form" action="'.$_SERVER['PHP_SELF'].'" method="POST">
<div class="mws-form-inline">
	<div class="mws-form-row">
		<label>Old Password</label> 
		<div class="mws-form-item">
			<input type="password" class="mws-textinput" name="oldpassword" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>New Password</label> 
		<div class="mws-form-item">
			<input type="password" class="mws-textinput" name="newpassword" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>Confirm New Password</label> 
		<div class="mws-form-item">
			<input type="password" class="mws-textinput" name="confirmpassword" />
		</div>
	</div>
 	<div class="mws-button-row"><input type="submit" class="mws-button blue large" value="Change Password" /></div>
</div>
</form>
';
}
else{
$oldPassword = $_POST['oldpassword'];
$newPassword = $_POST['newpassword'];
$confirmPassword = $_POST['confirmpassword'];

	if($newPassword == $confirmPassword)
	{
		$user = new User();
		$DBC->query = "SELECT id,password FROM users WHERE id='".$_SESSION['user']['id']."'";
		$DBC->Load($user);
		//$body=$_SESSION['user']['id']."<h2>Old Password:".$user->password." - OLD ENTERTED Password: ".md5($oldPassword)."</h2>";
		if( md5($oldPassword) == $user->password )
		{
			$user->password = md5($newPassword);
			$DBC->Update($user,'users');
			$body='<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Password Changed Successfully!</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">Password Changed Successfully!</div>
                    	</div>
                    </div>
                </div>';
		}
		else
		{
			$body.= '<h1>Error in changing the password<br />Make sure you entered your old password correctly</h1><form class="mws-form" action="'.$_SERVER['PHP_SELF'].'" method="POST">
<div class="mws-form-inline">
<div class="mws-form-row">
		<label>Old Password</label> 
	<div class="mws-form-item">
		<input type="password" class="mws-textinput" name="oldpassword" />
	</div>
</div>
<div class="mws-form-row">
		<label>New Password</label> 
	<div class="mws-form-item">
		<input type="password" class="mws-textinput" name="newpassword" />
	</div>
</div>
<div class="mws-form-row">
		<label>Confirm New Password</label> 
	<div class="mws-form-item">
		<input type="password" class="mws-textinput" name="confirmpassword" />
	</div>
</div>
 <div class="mws-button-row"><input type="submit" class="mws-button blue large" value="Change Password" /></div>
</div>
</form>
';
		}
	}
	else{
	$body = '<h1>Error in changing the password<br />The confirmed password does not match the new password entered</h1><form class="mws-form" action="'.$_SERVER['PHP_SELF'].'" method="POST">
<div class="mws-form-inline">
<div class="mws-form-row">
		<label>Old Password</label> 
	<div class="mws-form-item">
		<input type="password" class="mws-textinput" name="oldpassword" />
	</div>
</div>
<div class="mws-form-row">
		<label>New Password</label> 
	<div class="mws-form-item">
		<input type="password" class="mws-textinput" name="newpassword" />
	</div>
</div>
<div class="mws-form-row">
		<label>Confirm New Password</label> 
	<div class="mws-form-item">
		<input type="password" class="mws-textinput" name="confirmpassword" />
	</div>
</div>
 <div class="mws-button-row"><input type="submit" class="mws-button blue large" value="Change Password" /></div>
</div>
</form>
';
	}
}

$themeValues['base']    = './theme/';
$themeValues['title']   = 'Chart - Stats';
$themeValues['content'] = $body;
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
themeIt($themeValues);
?>