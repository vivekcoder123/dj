<?php
	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '1739075792824353',
		'app_secret' => 'e05e988dddb16b1b2cf16727c94f7eb0'
	]);

	$helper = $FB->getRedirectLoginHelper();
?>