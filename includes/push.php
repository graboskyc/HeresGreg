<?php

function PushChan() {

	if(strlen(PUSHBULLETAPIKEY)>4) {
		@session_start();
		
		$key = PUSHBULLETAPIKEY;

		$url = 'https://api.pushbullet.com/v2/pushes';
		$body = 'New video of '.APPNAME.' uploaded!';
		if(isset($_SESSION['un'])) { $body = 'New video of '.APPNAME.' uploaded by ' . ucfirst($_SESSION['un']); }

		$fields = array(
			'active' => true,
			'body' => $body,
			'title' => "New video of ".APPNAME."!",
			'type' => "link",
			'url' => SITEURL,
			'channel_tag' => PUSHBULLETCHAN.""
		);

		//url-ify the data for the $_POST
		$data = json_encode($fields);

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD, $key);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							'Content-Type: application/json',
							'Content-Length: ' . strlen($data)
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		//execute post
		$response = curl_exec($ch);

		//close connection
		curl_close($ch);
	}
}
?>