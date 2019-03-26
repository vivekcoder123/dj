<?php 

include("header.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$subscribers=$pdo->query("SELECT * FROM subscribers");

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$pdo->prepare("DELETE FROM subscribers WHERE id=?")->execute([$id]);
	header("Location:subscribers.php");
}

if(isset($_POST['submit'])){

	$text=$_POST['sendEmail'];
	$subject=$_POST['subject'];
	$mail = new PHPMailer(true);

	try {

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'vivekrautela000@gmail.com';
    $mail->Password = 'jarineee';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom("vivekrautela000@gmail.com", "DJ Website");
    while($row=$subscribers->fetch()){
    $email=$row['email'];
    $mail->addAddress($email);
	}
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $text;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();

} catch (Exception $e) {

    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

}

echo "<div class='alert alert-success text-center' style='font-weight:bold;letter-spacing:2px;'>Email sent successfully to all the subscribed users</div>";

header("Refresh:2;url=subscribers.php");

}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<div class="row">
		<div class="market-updates col-md-4">
		<form method="post" action="">
		<h2 class="text-center">Send Email</h2>
		<br>
		<div class="form-group">
		<input type="text" name="subject" class="form-control" placeholder="Enter subject">
		</div>
		<div class="form-group">
		<textarea name="sendEmail" cols="30" rows="10" class="form-control" placeholder="Enter text which you want to send in your subscribers email" required></textarea>
		</div>
		<input type="submit" value="Send" class="btn btn-info btn-block" name="submit">
		</form>
		</div>
		<div class="market-updates col-md-8">
		<h2 class="text-center">All Subscribers</h2>
		<br>
	 	<table class="table table-striped table-bordered">
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Email</th>
	 			</tr>
	 		</thead>
	 		<tbody>
	 			<?php 
	 			while($row=$subscribers->fetch()){
	 			 ?>
	 			<tr>
	 				<td><?php echo $row['id'] ?></td>
	 				<td><?php echo ucwords($row['email']) ?></td>
	 				<td><a href="subscribers.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
	 			</tr>
	 			<?php } ?>
	 		</tbody>
	 	</table>
		</div>
	</div>

	
	
</div>
</div>
</div>
<?php include("sidebar.php");?>
	<div class="clearfix"> </div>
</div>
<?php include("footer.php");?>