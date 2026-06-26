<?php
	$clientDetails = new stdClass();
	$clientDetails->redirect_uri = "/redirect";
	$clientDetails->grant_type = "client_credentials";
	$clientDetails->client_id = "15428";
	$clientDetails->client_secret = "ktiopma89nmzx8";
	$json_data = json_encode($clientDetails);
	$post = file_get_contents('https://www.orbyo.com/dev/internal/2.3/orbyo/oAuth/token',null,stream_context_create(array(
	'http' => array(
	'protocol_version' => 1.1,
	'user_agent'       => 'PHPExample',
	'method'           => 'POST',
	'header'           => "Content-type: application/json\r\n".
	"Connection: close\r\n" .
	"Content-length: " . strlen($json_data) . "\r\n",
	'content'          => $json_data,
	),
	)));
	
	if ($post) {
		$post = json_decode($post);
		$oauthToken = $post->access_token;
	}
	echo $oauthToken;
?>