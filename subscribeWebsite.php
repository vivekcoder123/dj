<?php 

require("config.php");
$email=$_POST['email'];
$subscriber=mysqli_query($connect,"SELECT * FROM subscribers WHERE email='$email' ");
$subscriber_exists=mysqli_num_rows($subscriber);
if($subscriber_exists>0){
	http_response_code(405);
}else{
	$pdo->prepare("INSERT INTO subscribers (email) VALUES (?)")->execute([$email]);
}

?>