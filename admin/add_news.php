<?php 

include("header.php");
if(isset($_POST['submit'])){
	$name=$_POST['news_name'];
	$slug=slugify($name);
	$description=$_POST['description'];
    $date = date('Y-m-d').rand(1,10000000);
	$image = $date.$_FILES['image']['name'];
   	$image_tmp =$_FILES['image']['tmp_name'];
   	move_uploaded_file($image_tmp,"photos/".$image);
   	$pdo->prepare("INSERT INTO news (name,description,image,created_at,slug) VALUES (?,?,?,?,?)")->execute([$name,$description,$image,date('y-m-d'),$slug]);
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
	 			placeholder="Enter news name" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="description">News Description</label>
	 			<textarea name="description" id="description" cols="100" rows="8" class="form-control" required placeholder="Enter news description"></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="image">News Image</label>
	 			<input type="file" name="image" id="image" class="form-control" required>
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