<?PHP
session_start();
include "config.php";
include "functions/functions.php";
include "classes/User.php";
		
if(!$_POST)
{
	
		$user = new User();
		$DBC->query = "SELECT * FROM users WHERE id='".$_SESSION['user']['id']."'";
		$DBC->Load($user);
		
		
$body = '<form class="mws-form" action="'.$_SERVER['PHP_SELF'].'" method="POST">
<input type="hidden" name="id" value="'.$user->id.'">
<div class="mws-form-inline">
	<div class="mws-form-row">
		<label>First Name</label> 
		<div class="mws-form-item">
			<input type="text" class="mws-textinput" name="firstname" value="'.$user->firstname.'" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>Last Name</label> 
		<div class="mws-form-item">
			<input type="text" class="mws-textinput" name="lastname" value="'.$user->lastname.'" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>Email</label> 
		<div class="mws-form-item">
			<input type="text" class="mws-textinput" name="email" value="'.$user->email.'" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>Phone</label> 
		<div class="mws-form-item">
			<input type="text" class="mws-textinput" name="phone" value="'.$user->phone.'" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>Website</label> 
		<div class="mws-form-item">
			<input type="text" class="mws-textinput" name="website" value="'.$user->website.'" />
		</div>
	</div>
	<div class="mws-form-row">
		<label>Twitter</label> 
		<div class="mws-form-item">
			<input type="text" class="mws-textinput" name="twitter" value="'.$user->twitter.'" />
		</div>
	</div>
 	<div class="mws-button-row"><input type="submit" class="mws-button blue large" value="Update Profile" /></div>
</div>
</form>
';
}
else{
			$user = new User();
			foreach($_POST AS $key=>$value)
			{
				$user->$key = $value;
			}

			$DBC->Update($user,'users');
			$body='<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Profile Updated Successfully!</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
                    		<div id="mws-line-chart" style="width:100%; height:300px;">Profile Updated Successfully!</div>
                    	</div>
                    </div>
                </div>';
}

$themeValues['base']    = './theme/';
$themeValues['title']   = 'Update Profile';
$themeValues['content'] = $body;
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
themeIt($themeValues);
?>