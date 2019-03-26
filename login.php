<?php 

include("header.php");
require_once('google_configuration.php');
require_once('facebook_configuration.php');
$loginUrl=$gclient->createAuthUrl();
$redirectURL = "http://localhost/dj/fb-callback.php";
$permissions = ['email'];
$loginFURL = $helper->getLoginUrl($redirectURL, $permissions);

if(isset($_SESSION['access_token'])){
  header('Location:index.php');
}

if(isset($_POST['submit'])){
	$email=mysqli_real_escape_string($connect,$_POST['email']);
	$password=mysqli_real_escape_string($connect,$_POST['password']);
	$email_exists=mysqli_query($connect,"SELECT * FROM users WHERE email='$email' and password='$password' ");
	$email_rows=mysqli_num_rows($email_exists);
	if($email_rows>0){
		$_SESSION['profile']=mysqli_fetch_array($email_exists);
		header("Location:index");
	}else{
		$_SESSION['error']="<div class='alert alert-danger' style='font-weight:bold;letter-spacing:2px;'>Please enter correct email and password</div>";
	}
}

?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class=" title text-center">
<h1><span class="bold">Login</span></h1>
<?php 
if(isset($_SESSION['registered_email'])){
	echo "<div class='alert alert-success' style='font-weight:bold;letter-spacing:2px;'>You are registered successfully,now you can login</div>";
	unset($_SESSION['registered_email']);
}
if(isset($_SESSION['error'])){
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
</div>
</div>
<div class="col-md-8 col-md-offset-2 padd-top-md  ">
<div class="row">
<div class="col-sm-6">
<a class="btn btn-block btn-facebook" onclick="window.location='<?php echo $loginFURL;?>' ">
<i class="ion ion-social-facebook"></i>
Login with Facebook
</a>
</div>
<div class="col-sm-6">
<a class="btn btn-google" onclick="window.location='<?php echo $loginUrl;?>' ">
<i class="ion ion-social-google"></i>
Login with Google
</a>
</div>
<div class="col-xs-6"></div>
</div>
<div class="row padd-top-xs padd-bottom-xs">
<div class="col-xs-12 text-center">
<strong>OR</strong>
</div>
</div>
<form action="" method="post">
<input type="hidden" name="_token" value="0ZExJRNbQUcivBzr0kQYe6ASGL3nME0Cl111Nsho">
<div class="col-sm-6">
<div class="form-group">
<label>Email</label>
<input type="text" class="form-control" name="email" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Password</label>
<input type="password" class="form-control" name="password" required>
</div>
</div>
<div class="col-xs-12">
<div class="checkbox">
<label><input type="checkbox" type="checkbox" name="remember" id="remember" value="true">Remember Me</label>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
</div>
<div class="form-group"><a href="password/reset_password.php">Forgot Password?</a></div>
</div>
<div class="col-sm-12 padd-top-xxs text-center">
<div>Don't have an account? <br><a class="btn btn-primary" href="sign-up">Sign Up</a></div>
</div>
</form>
</div>
</div>
</section>
<section class="padd-top-md"></section>
<?php include("footer.php");?>