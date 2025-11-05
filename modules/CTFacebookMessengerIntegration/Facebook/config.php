<?php
	session_start();
	include 'Facebook/autoload.php';
	

	$facebookAppConfig = array('appId' => '606041165929304','appSecret' => 'd3645db790a691c434c4cd9ec382133b','defaultGraphVersion' => 'v24.0', 'graphAPIEndPoint' => 'https://graph.facebook.com/v24.0/');

	$fb = new Facebook\Facebook([
	  'app_id' => '606041165929304', // Replace {app-id} with your app id
	  'app_secret' => 'd3645db790a691c434c4cd9ec382133b', // Replace {app_secret} with your app secret
	  'default_graph_version' => 'v24.0',
	]);

?>