<?php 

include("header.php");

if(isset($_GET['id'])){
$id=$_GET['id'];
$saved_news=$pdo->prepare("SELECT * FROM news WHERE id=?");
$saved_news->execute([$id]);
$saved_news=$saved_news->fetch();	
}

if(isset($_POST['submit'])){
	$name=$_POST['news_name'];
	$slug=slugify($name);
	$description=$_POST['description'];
    $date = date('Y-m-d').rand(1,10000000);
	if(!empty($_FILES['image']) && strlen($_FILES['image']['name'])>0){
	  $image = $date.$_FILES['image']['name'];
      $image_tmp =$_FILES['image']['tmp_name'];
      move_uploaded_file($image_tmp,"photos/".$image);
	}else{
		$image=$saved_news['image'];
	}
   	move_uploaded_file($image_tmp,"photos/".$image);
   	$pdo->prepare("UPDATE news SET name=?,description=?,image=?,slug=? WHERE id=?")->execute([$name,$description,$image,$slug,$id]);
   	header("Location:view_news.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	 <div class="market-updates">

	 	<form action="" method="post" enctype="multipart/form-data">
	 		<div class="form-group">
	 			<label for="news_name">News Name</label>
	 			<input type="text" name="news_name" id="news_name" class="form-control" 
	 			placeholder="Enter news name" required value="<?php echo $saved_news['name']?>">
	 		</div>
	 		<div class="form-group">
	 			<label for="description">News Description</label>
	 			<textarea name="description" id="description" cols="100" rows="8" class="form-control" required placeholder="Enter news description"><?php echo $saved_news['description']?></textarea>
	 		</div>
	 		<p class="alert alert-danger">
	 		* If you don't want to update your news image then ignore image field</p>
	 		<div class="form-group">
	 			<label for="image">News Image</label>
	 			<input type="file" name="image" id="image" class="form-control">
	 		</div>
	 		<input type="submit" name="submit" value="Save" class="btn btn-info btn-block">
	 	</form>

		</div>
</div>
</div>
</div>
<?php include("sidebar.php");?>
	<div class="clearfix"> </div>
</div>
<?php include("footer.php");?>