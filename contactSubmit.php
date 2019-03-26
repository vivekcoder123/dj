<?php 

require_once("config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if($_POST['first_name'] && $_POST['last_name'] && $_POST['email'] && $_POST['phone'] && $_POST['msg']){
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$msg=$_POST['msg'];

$pdo->prepare("INSERT INTO contact (first_name,last_name,email,phone,msg) VALUES (?,?,?,?,?)")
->execute([$first_name,$last_name,$email,$phone,$msg]);

}else{
	http_response_code(405);
}

 $mail = new PHPMailer(true);
try {
    $email="vivekrautela000@gmail.com";
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'vivekrautela000@gmail.com';
    $mail->Password = 'jarineee';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom("vivekrautela000@gmail.com", "DJ Website");
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Dj Website Contact Us Queries';
    $contactForm="";
    $contactForm.=<<<DELIMETER
	<html>
    <head>
    </head>
    <body>
	<h3>First Name : $first_name</h3>
	<h3>Last Name : $last_name</h3>
	<h3>Email : $email</h3>
	<h3>Phone : $phone</h3>
	<h3>Message : $msg</h3>
    </body>
    </html>
DELIMETER;
    $mail->Body = $contactForm;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>