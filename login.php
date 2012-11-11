<?php
session_start();
include "config.php";
include "functions/functions.php";
if($_SESSION['user']['id'])
{
	//header("http://localhost/shloudform/index.php");
	//var_dump($_SESSION['user']);
	//session_destroy();
	header("Location: index.php");
	echo "<a href='index.php'>Click HERE</a>";
}
else {
	if($_POST['username'] == NULL OR $_POST['password'] == NULL)
	{
		$theme = file_get_contents('theme/login.php');
		$theme = str_replace('{base}', './theme/', $theme);
		echo $theme;
	}
	else {
		$userDetails = $DBC->checkCredentials($_POST['username'],$_POST['password']);
		//var_dump($userDetails);
		if($userDetails != -1)
		{
			$pages = $DBC->getUserPages($userDetails['id']);
			
			$_SESSION['user']['id'] = $userDetails['id'];
			$_SESSION['user']['firstname'] = $userDetails['firstname'];
			$_SESSION['user']['lastname'] = $userDetails['lastname'];
			$_SESSION['appLinks'] = $pages;
			
			$userApp = $DBC->getUserApp($userDetails['id']);
			$_SESSION['appID'] = $userApp['appID'];
			$_SESSION['appUID']= $userApp['appUID'];
			$_SESSION['appTitle']= $userApp['appTitle'];
			$_SESSION['appPNCODE'] = $userApp['appPNCODE'];
			
			header("Location: index.php");
			echo "<a href='index.php'>Click HERE</a>";
			//var_dump($_SESSION); 
		}
		else {
			echo "<h1>ERROR</h1>";
		}
	}
	
	
}
?>