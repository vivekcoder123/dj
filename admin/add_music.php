<?php 

include("header.php");
if(isset($_POST['submit'])){
	$category_id=$_POST['category'];
	$name=$_POST['music_name'];
	$slug=slugify($name);
	$date = date('Y-m-d').rand(1,10000000);
	$image = $date.$_FILES['image']['name'];
   	$image_tmp =$_FILES['image']['tmp_name'];
   	move_uploaded_file($image_tmp,"photos/".$image);
   	$link=trim($_POST['link']);
   	$vlink=trim($_POST['vlink']);
   	$artist_name=$_POST['artist_name'];
   	$release_by=$_POST['release_by'];
   	$pdo->prepare("INSERT INTO music (name,artist_name,release_by,image,slug,link,category_id,created_at,vlink) VALUES (?,?,?,?,?,?,?,?,?)")->execute([$name,$artist_name,$release_by,$image,$slug,$link,$category_id,date('y-m-d'),$vlink]);
   	header("Location:view_music.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">Create Music</h2>
	<br>
	 <div class="market-updates">

	 	<form action="" method="post" enctype="multipart/form-data">
	 		<div class="form-group">
	 			<label for="category">Music Category</label>
	 			<select name="category" id="category" class="form-control" required>
	 				<?php 
	 					$categories=$pdo->query("SELECT * FROM music_categories");
	 					while($row=$categories->fetch()){
	 				 ?>

	 				 <option value="<?php echo $row['id']?>"><?php echo ucwords($row['name'])?></option>

	 				<?php } ?>
	 			</select>
	 		</div>
	 		<div class="form-group">
	 			<label for="music_name">Music Title</label>
				<input type="text" name="music_name" id="music_name" placeholder="Enter music title" 
				class="form-control" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="image">Music Image</label>
	 			<input type="file" name="image" id="image" class="form-control" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="link">Music Link</label>
	 			<textarea name="link" id="link" class="form-control" 
	 			placeholder="Paste embedded music link" required cols="100" rows="2"></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="vlink">Video Link</label>
	 			<textarea name="vlink" id="vlink" class="form-control" 
	 			placeholder="Paste embedded video link" cols="100" rows="2"></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="artist_name">Music Artist Name</label>
	 			<input type="text" name="artist_name" id="artist_name" class="form-control" 
	 			placeholder="Enter artist name" required>
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