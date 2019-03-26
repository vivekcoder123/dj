<?php

session_start();
require_once("config.php");
require_once('google_configuration.php');

if(isset($_SESSION['access_token'])){

  $gclient->setAccessToken($_SESSION['access_token']);

}

else if(isset($_GET['code'])){

  $token=$gclient->fetchAccessTokenWithAuthCode($_GET['code']);
  $_SESSION['access_token']=$token;

}
else{

  header('Location:login.php');
  exit();

}

$oAuth=new Google_Service_Oauth2($gclient);
$userdata=$oAuth->userinfo_v2_me->get();

  $name=$userdata['name'];
  $email=$userdata['email'];
  $image=$userdata['picture'];
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

  header('Location:index');
  exit();

 ?>