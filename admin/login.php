<?php

session_start(); 
ob_start();
require_once("../config.php");
if(isset($_POST['submit'])){
	$email=trim(mysqli_real_escape_string($connect,$_POST['email']));
	$password=trim(mysqli_real_escape_string($connect,$_POST['password']));
	if($email=="djadminemail" && $password=="djadminpassword"){
		$_SESSION['admin_email']=$email;
		header("Location:index.php");
	}else{
		echo "<div class='alert alert-danger text-center'>Please enter correct email and password</div>";
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
    <script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
<script src="js/skycons.js"></script>
</head>
<body>	
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">Log In</h2>
	<br>
	 <div class="market-updates">
			<form action="" method="post">
				<div class="form-group">
					<input type="text" name="email" placeholder="Enter admin email" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="password" name="password" placeholder="Enter admin password" 
					class="form-control" required>
				</div>
				<input type="submit" name="submit" value="Submit" class="btn btn-info btn-block">
			</form>
		   <div class="clearfix"> </div>
		</div>
</div>
</div>
</div>
<?php include("sidebar.php");?>
	<div class="clearfix"> </div>
</div>
<?php include("footer.php");?>