<?PHP
session_start();
include "config.php";
include "classes/Page.php";
include "functions/functions.php";
if($_POST)
{

/*
pwCall( 'createMessage', array(
        'application' => $_SESSION['appPNCODE'],
        'username' => 'Hamurabi',
        'password' => 'oro1981',
        'notifications' => array(
                    array(
                        'send_date' => $schedule,
                        'content' => $content,
                        'ios_badges' => 1
                    )
                )
            )
        );*/
			//var_dump($_POST);
			//echo "<h1>".$osos = strtotime($_POST['datetime'])."</h1>";
			//echo "<h1>".date('Y-m-d H:i',$osos)."</h1>";
			$content = $_POST['pncontent'];
			if($_POST['sendingnow'] == 'on'){
				$sendingDate = 'now';
			}
			else {
				$sendingDate = date('Y-m-d H:i',strtotime($_POST['datetime']) - 3600); // To make GMT
			}
			//echo $content;
			//echo "<hr>";
			//echo $sendingDate;
			$dataArray = array(
                        'send_date' => $sendingDate,
                        'content' => $content,
                        'ios_badges' => 1
                    );
			if($_POST['url'] != NULL)
				$dataArray['url'] = $_POST['url'];
					
			$sendingArray = array(
       					 'application' => $_SESSION['appPNCODE'],
       					 'username' => 'Hamurabi',
       					 'password' => 'oro1981',
       					 'notifications' => array($dataArray)
       					 );
				
			//var_dump($dataArray);		 
			$result = pwCall( 'createMessage', $sendingArray);
			//var_dump($result);
			//echo "<h1>".$result[status_code]."</h1>";
			foreach ($result as $key => $value) {
				if($key == 'status_code'){
					if($value == 200)
					{
						$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-speech-bubble">Successfully Sent</span>
                    </div>
                    <div class="mws-panel-body">
                    	<center>Your Push Notification Sent Successfully</center>
                    </div>    	
                </div>';
					break;	
					}
				else{
					$body = '<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-speech-bubble">Error</span>
                    </div>
                    <div class="mws-panel-body">
                    	<center>Error in Sending the Code!<br />Error Code:'.$key.' = '.$value.'</center>
                    </div>    	
                	</div>';
					}
				}
					
			}
		
}
else{
$body=
'<h1>Send Push Notifications</h1>				
<form class="mws-form" name="pnform" action="'.$_SERVER['PHP_SELF'].'" method="post">
	 <div class="mws-form-row">
		<label>Content (Max 170 character):</label>
		<div class="mws-form-item">	 
			<textarea name="pncontent" class="mws-textarea"></textarea>
		</div>
	</div>
	<div class="mws-form-row">
		<label>URL (optional)</label>
		<div class="mws-form-item">
            <input type="text" name="url" class="mws-textinput" />
        </div>
	</div>
	
	<div class="mws-form-row">
		<label>Sending Now?</label>
		<div class="mws-form-item">
            <input type="checkbox" name="sendingnow" checked="checked" onclick="toggleItem(\'dateTimePicker\');" />
        </div>
	</div>
	
		<div class="hiddenDiv" id="dateTimePicker">
			<div class="mws-form-row">
                                    <label>Select Date/Time to schedule your notification</label>
                                   <div class="mws-form-item">
                                   		<input type="text" name="datetime" class="mws-textinput mws-dtpicker" readonly="readonly" />
                                    </div>
                                </div>
	   </div>
	 <div class="mws-button-row"><input type="submit" class="mws-button blue large" value="Send Push Notification" /></div>
</form>';
}        

$themeValues['base']    = './theme/';
$themeValues['title']   = 'Push Notifcation';
$themeValues['content'] = $body;
$themeValues['appLinks'] = $_SESSION['appLinks'];
$themeValues['firstname'] = $_SESSION['user']['firstname'];
$themeValues['lastname'] = $_SESSION['user']['lastname'];

$appDetails = $DBC->getUserApp($_SESSION['user']['id']);
$themeValues['appName'] = $appDetails['appTitle'];
themeIt($themeValues);                        
?>