<?php
	session_start();
	include 'Facebook/autoload.php';

	$redirectUri = 'https://shonta-miry-nobuko.ngrok-free.dev/vtigercrm/index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTFacebook';

	//old was 408843694883343 and secretid is 9ab24ed934ce5d6d8e2f3a7369c35def

	$facebookAppConfig = array('appId' => '2172701849919651','appSecret' => '75b95d0f8d8d156b520fb38bd0c9fbee','defaultGraphVersion' => 'v24.0', 'graphAPIEndPoint' => 'https://graph.facebook.com/v24.0/');

	$fb = new Facebook\Facebook([
	  'app_id' => '2172701849919651', // Replace {app-id} with your app id
	  'app_secret' => '75b95d0f8d8d156b520fb38bd0c9fbee', // Replace {app_secret} with your app secret
	  'default_graph_version' => 'v24.0',
	]);

?>

<!-- https://www.facebook.com/v24.0/dialog/oauth?app_id=2172701849919651&cbt=1761813264863&channel_url=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df4062bc76dadcc289%26domain%3Dshonta-miry-nobuko.ngrok-free.dev%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fshonta-miry-nobuko.ngrok-free.dev%252Ff6bda5ed1c0477e6e%26relation%3Dopener&client_id=2172701849919651&display=popup&domain=shonta-miry-nobuko.ngrok-free.dev&e2e=%7B%7D&fallback_redirect_uri=https%3A%2F%2Fshonta-miry-nobuko.ngrok-free.dev%2Fvtigercrm%2Findex.php%3Fparent%3DSettings%26module%3DCTFacebookMessengerIntegration%26view%3DCTFacebookMessengerIntegrationList&locale=en_US&logger_id=fe975a92902731f11&origin=1&redirect_uri=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfcbc7a5cdefb31041%26domain%3Dshonta-miry-nobuko.ngrok-free.dev%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fshonta-miry-nobuko.ngrok-free.dev%252Ff6bda5ed1c0477e6e%26relation%3Dopener%26frame%3Dfe8d224fdd63b1e94&response_type=token%2Csigned_request%2Cgraph_domain&scope=%5B%22public_profile%22%2C%22pages_show_list%22%2C%22pages_messaging%22%2C%22pages_manage_metadata%22%2C%22business_management%22%5D&sdk=joey&version=v24.0 -->