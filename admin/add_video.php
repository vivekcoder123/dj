<?php 

include("header.php");
if(isset($_POST['submit'])){
	$name=$_POST['video_name'];
	$slug=slugify($name);
	$link=trim($_POST['link']);
	$date = date('Y-m-d').rand(1,10000000);
	$image = $date.$_FILES['image']['name'];
   	$image_tmp =$_FILES['image']['tmp_name'];
   	move_uploaded_file($image_tmp,"photos/".$image);	
   	$category_id=$_POST['category'];
	$album_name=$_POST['album_name'];
	$remix_by=$_POST['remix_by'];
	$release_by=$_POST['release_by'];
	$pdo->prepare("INSERT INTO video (name,album,remix_by,release_by,slug,link,category_id,image,created_at) VALUES (?,?,?,?,?,?,?,?,?)")->execute([$name,$album_name,$remix_by,$release_by,$slug,$link,$category_id,$image,date('y-m-d')]);
	header("Location:view_video.php");
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
	 			<label for="video_name">Video Name</label>
	 			<input type="text" name="video_name" id="video_name" class="form-control" 
	 			placeholder="Enter video name" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="link">Video Link</label>
	 			<textarea name="link" id="link" class="form-control" placeholder="Paste embedded video link" required cols="100" rows="2"></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="image">Video Image</label>
	 			<input type="file" name="image" id="image" class="form-control" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="category">Video Category</label>
	 			<select name="category" id="category" class="form-control" required>
	 				<?php 
	 					$categories=$pdo->query("SELECT * FROM video_categories");
	 					while($row=$categories->fetch()){
	 				 ?>

					<option value="<?php echo $row['id']?>"><?php echo ucwords($row['name']) ?></option>

					<?php } ?>
	 			</select>
	 		</div>
	 		<div class="form-group">
	 			<label for="album_name">Album Name</label>
	 			<input type="text" name="album_name" id="album_name" class="form-control" required placeholder="Enter album name">
	 		</div>
	 		<div class="form-group">
	 			<label for="remix_by">Remix By</label>
	 			<input type="text" name="remix_by" id="remix_by" class="form-control" 
	 			placeholder="Enter remix by artist name" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="release_by">Released By</label>
	 			<input type="text" name="release_by" id="release_by" class="form-control" 
	 			placeholder="Enter released by company name" required>
	 		</div>
			<input type="submit" name="submit" class="btn btn-info btn-block" value="Save">
	 	</form>

		</div>
</div>
</div>
</div>
<?php include("sidebar.php");?>
	<div class="clearfix"> </div>
</div>
<?php include("footer.php");?>