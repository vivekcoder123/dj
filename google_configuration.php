<?php 

require_once('GoogleApi/vendor/autoload.php');
$gclient=new Google_Client();
$gclient->setClientId('107598900486-hfp16n38eva2gbpfvhejd2ssmgstkukm.apps.googleusercontent.com');
$gclient->setClientSecret('Fu3Cx4YfLsEbIQxQHEW_GHj2');
$gclient->setApplicationName('google login');
$gclient->setRedirectUri('http://localhost/dj/g-callback.php');
$gclient->addScope('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email');

?>