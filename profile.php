<?php 

include("header.php");
if(!isset($_SESSION['profile'])){
	header("Location:login");
}

if(isset($_POST['submit'])){

	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$dob=$_POST['dob'];
	$date = date('Y-m-d').rand(1,10000000);

	if(!empty($_FILES['profile']) && strlen($_FILES['profile']['name'])>0){
		$image = $date.$_FILES['profile']['name'];
	    $image_tmp =$_FILES['profile']['tmp_name'];
	    move_uploaded_file($image_tmp,"admin/photos/".$image);
	}else{
		$image=$_SESSION['profile']['image'];
	}

	$address=$_POST['address'];

	$id=$_SESSION['profile']['id'];

	$pdo->prepare("UPDATE users SET name=?,phone=?,dob=?,image=?,address=? WHERE id=?")->execute([$name,$phone,$dob,'admin/photos/'.$image,$address,$id]);

	$_SESSION['profile']['name']=$name;

	$_SESSION['profile']['phone']=$phone;

	$_SESSION['profile']['dob']=$dob;	

    $_SESSION['profile']['image']=$image;

	$_SESSION['profile']['address']=$address;

	$_SESSION['updated_success']="<div class='alert alert-info' 
	style='font-weight:bold;letter-spacing:2px;'>Profile updated successfully</div>";

}

?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="title text-center">
<h1><span class="bold">Profile</span></h1>
<?php 
if(isset($_SESSION['updated_success'])){
	echo $_SESSION['updated_success'];
	unset($_SESSION['updated_success']);
}
?>
</div>
</div>
<div class="col-md-8 col-md-offset-2 padd-top-md">
<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="_token" value="VULSpMGkQW58J3MTH5Xt0vQqfLXviBRLzCeRcCaa">
 <div class="col-sm-6">
<div class="form-group">
<label>Name (Required)</label>
<input type="text" class="form-control" name="name" value="<?php echo $_SESSION['profile']['name']?>" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Email (Required)</label>
<input type="text" class="form-control" value="<?php echo $_SESSION['profile']['email']?>" readonly required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Phone</label>
<input type="text" class="form-control" name="phone" value="<?php echo isset($_SESSION['profile']['phone'])?$_SESSION['profile']['phone']:''?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Date of Birth</label>
<input type="date" class="form-control" name="dob" value="<?php echo isset($_SESSION['profile']['dob'])?$_SESSION['profile']['dob']:''?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Profile Image</label>
<input type="file" class="form-control" name="profile" value="<?php echo isset($_SESSION['profile']['image'])?$_SESSION['profile']['image']:''?>">
</div>
<?php  
if(isset($_SESSION['profile']['image'])){
?>
<a href="<?php echo $_SESSION['profile']['image']?>" target="_blank">
	<img src="<?php echo $_SESSION['profile']['image']?>" alt="" height="100" width="100"></a>
<?php } ?>
</div>
<div class="col-sm-12 padd-bottom-xxs">
<div class="form-group">
<label>Address</label>
<textarea name="address" cols="6" class="form-control"><?php echo isset($_SESSION['profile']['address'])?$_SESSION['profile']['address']:''?></textarea>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
</div>
</div>
</form>
</div>
</div>
</section>
<section class="padd-top-md"></section>
<?php include("footer.php");?>