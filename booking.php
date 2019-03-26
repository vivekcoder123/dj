<?php 

include("config.php");

if(isset($_GET['artist'])){
$pdo->prepare("INSERT INTO artist_booking (user_name,user_email,user_phone,artist_name,event_date,event_type,venue_name,city,country,approx_budget) VALUES (?,?,?,?,?,?,?,?,?,?)")->execute([$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['artist'],$_POST['event_date'],$_POST['event_type'],$_POST['venue'],$_POST['city'],$_POST['country'],$_POST['budget']]);
}

if(isset($_GET['event'])){
$pdo->prepare("INSERT INTO event_ticket_booking (first_name,last_name,attendees,email,phone,message,event_name) 
	VALUES (?,?,?,?,?,?,?)")->execute([$_POST['first_name'],$_POST['last_name'],$_POST['attendees'],$_POST['email'],$_POST['phone'],$_POST['msg'],$_POST['event_name']]);
}

?>