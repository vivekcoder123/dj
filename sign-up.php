<?php 

include("header.php");
require_once('google_configuration.php');
$loginUrl=$gclient->createAuthUrl();

if(isset($_SESSION['access_token'])){
  header('Location:index');
}

if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$email_exists=mysqli_query($connect,"SELECT * FROM users WHERE email='$email' ");
	$email_rows=mysqli_num_rows($email_exists);
	if($email_rows>0){
		$_SESSION['email_exists']="<div class='alert alert-danger text-center' style='font-weight:bold;letter-spacing:2px;'>Email is already registered</div>";
	}else{
	$phone=$_POST['phone'];
	$dob=$_POST['dob'];
	$password=$_POST['password'];
	$cpassword=$_POST['password_confirmation'];
	$date = date('Y-m-d').rand(1,10000000);
	if(!empty($_FILES['profile']) && strlen($_FILES['profile']['name'])>0){
		$image = $date.$_FILES['profile']['name'];
	    $image_tmp =$_FILES['profile']['tmp_name'];
	    move_uploaded_file($image_tmp,"admin/photos/".$image);
	}else{
		$image="";
	}
	$address=$_POST['address'];
	$pdo->prepare("INSERT INTO users (name,email,phone,dob,password,image,address) 
	VALUES (?,?,?,?,?,?,?)")->execute([$name,$email,$phone,$dob,$password,'admin/photos/'.$image,$address]);
	$_SESSION['registered_email']=$email;
	header("Location:login");	
}
}

?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class=" title text-center">
<h1><span class="bold">Sign Up</span></h1>
</div>
</div>
<div class="col-md-8 col-md-offset-2 padd-top-md  ">
<div class="row">
<div class="col-sm-6">
<a href="https://www.allindiandjsclub.in/social/login/redirect/facebook" class="btn btn-block btn-facebook">
<i class="ion ion-social-facebook"></i>
Signup with Facebook
</a>
</div>
<div class="col-sm-6">
<a class="btn btn-google" onclick="window.location='<?php echo $loginUrl;?>' ">
<i class="ion ion-social-google"></i>
Signup with Google
</a>
</div>
<div class="col-xs-6"></div>
</div>
<div class="row padd-top-xs padd-bottom-xs">
<div class="col-xs-12 text-center">
<strong>OR</strong>
</div>
</div>
<?php 
if(isset($_SESSION['email_exists'])){
echo $_SESSION['email_exists'];
unset($_SESSION['email_exists']);
}
?>
<form method="post" action="" enctype="multipart/form-data">
<div class="col-sm-6">
<div class="form-group">
<label>Name (Required)</label>
<input type="text" class="form-control" name="name" 
value="<?php echo isset($_POST['name'])?$_POST['name']:''?>" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Email (Required)</label>
<input type="email" class="form-control" name="email" 
value="<?php echo isset($_POST['email'])?$_POST['email']:''?>" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Phone</label>
<input type="text" class="form-control" name="phone" value="<?php echo isset($_POST['phone'])?$_POST['phone']:''?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Date of Birth</label>
<input type="date" class="form-control" name="dob" value="<?php echo isset($_POST['dob'])?$_POST['dob']:''?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Password (Required)</label>
<input type="password" class="form-control" name="password" id="pass" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Confirm Password (Required)</label>
<input type="password" class="form-control" name="password_confirmation" id="cpass" required>
</div>
<p class="alert alert-danger" style="display:none;" id="error">Both passwords don't match</p>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Profile Image</label>
<input type="file" class="form-control" name="profile">
</div>
</div>
<div class="col-sm-12 padd-bottom-xxs">
<div class="form-group">
<label>Address</label>
<textarea name="address" cols="6" class="form-control"><?php echo isset($_POST['address'])?$_POST['address']:''?></textarea>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button class="btn btn-primary btn-block" id="submit" name="submit">Sign Up</button>
</div>
</div>
</form>
</div>
</div>
</section>
<section class="padd-top-md"></section>
<?php include("footer.php");?>
<script type="text/javascript">

	$(document).ready(function(){

		$("#cpass").keyup(function(){

			var password=$("#pass").val();
			var cpassword=$("#cpass").val();

			if(password !== cpassword){

				$("#error").show();
				$("#submit").attr("disabled",true);

			}else{

				$("#error").hide();
				$("#submit").attr("disabled",false);

			}

		});
	});

</script>