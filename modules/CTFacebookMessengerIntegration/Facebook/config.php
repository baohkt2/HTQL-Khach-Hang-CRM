<?php
	session_start();
	include 'Facebook/autoload.php';
	
	//old was 408843694883343 and secretid is 9ab24ed934ce5d6d8e2f3a7369c35def

	$facebookAppConfig = array('appId' => '907638254476979','appSecret' => '1c3fc65f6695326732c5c04c436be5b9','defaultGraphVersion' => 'v19.0', 'graphAPIEndPoint' => 'https://graph.facebook.com/v19.0/');

	$fb = new Facebook\Facebook([
	  'app_id' => '907638254476979', // Replace {app-id} with your app id
	  'app_secret' => '1c3fc65f6695326732c5c04c436be5b9', // Replace {app_secret} with your app secret
	  'default_graph_version' => 'v19.0',
	]);

?>