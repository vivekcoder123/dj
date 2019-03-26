<?php

	session_start();
	require_once("config.php");
	require_once("facebook_configuration.php");

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location:login.php');
		exit();
	}

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

	$response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
	$userData = $response->getGraphNode()->asArray();
	$_SESSION['access_token'] = (string) $accessToken;
    $name=$userData['first_name'];
    $email=$userData['email'];
    $image=$userData['picture']['url'];
    $phone="";
    $dob="";
    $password="";
    $address="";
    $email_exists=mysqli_query($connect,"SELECT * FROM users WHERE email='$email' ");
    $email_rows=mysqli_num_rows($email_exists);

    if($email_rows==0){ 
    $pdo->prepare("INSERT INTO users (name,email,phone,dob,password,image,address) 
    VALUES (?,?,?,?,?,?,?)")->execute([$name,$email,$phone,$dob,$password,$image,$address]);
    }

    $user=mysqli_query($connect,"SELECT * FROM users WHERE email='$email' ");
    $_SESSION['profile']=mysqli_fetch_assoc($user);
    var_dump($_SESSION['profile']);
    header('Location:index');
    exit();

?>