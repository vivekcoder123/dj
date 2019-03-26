<?php 

include("header.php");

if(isset($_GET['id'])){
	$id=$_GET['id'];
	$artist=$pdo->prepare("SELECT * FROM artist WHERE id=?");
	$artist->execute([$id]);
	$row=$artist->fetch();
}


if(isset($_POST['submit'])){
	$name=$_POST['artist_name'];
	$description=$_POST['description'];
	$slug=slugify($name);
	$category_id=$_POST['category'];
	$date = date('Y-m-d').rand(1,10000000);

	$album_link=trim($_POST['album_link']);

	$video_link1=trim($_POST['video_link1']);

	$video_link2=trim($_POST['video_link2']);

	$video_link3=trim($_POST['video_link3']);

	if(!empty($_FILES['image']) && strlen($_FILES['image']['name'])>0){
	  $image = $date.$_FILES['image']['name'];
      $image_tmp =$_FILES['image']['tmp_name'];
      move_uploaded_file($image_tmp,"photos/".$image);
	}else{
		$image=$row['image'];
	}

	if(!empty($_FILES['image1']) && strlen($_FILES['image1']['name'])>0){
		$gallery1=$date.$_FILES['image1']['name'];
		$gallery1_tmp=$_FILES['image1']['tmp_name'];
		move_uploaded_file($gallery1_tmp,"photos/".$gallery1);
	}else{
		$gallery1=$row['gallery1'];
	}

	if(!empty($_FILES['image2']) && strlen($_FILES['image2']['name'])>0){
		$gallery2=$date.$_FILES['image2']['name'];
		$gallery2_tmp=$_FILES['image2']['tmp_name'];
		move_uploaded_file($gallery2_tmp,"photos/".$gallery2);
	}else{
		$gallery2=$row['gallery2'];
	}

	if(!empty($_FILES['image3']) && strlen($_FILES['image3']['name'])>0){
		$gallery3=$date.$_FILES['image3']['name'];
		$gallery3_tmp=$_FILES['image3']['tmp_name'];
		move_uploaded_file($gallery3_tmp,"photos/".$gallery3);
	}else{
		$gallery3=$row['gallery3'];
	}

	if(!empty($_FILES['image4']) && strlen($_FILES['image4']['name'])>0){
		$gallery4=$date.$_FILES['image4']['name'];
		$gallery4_tmp=$_FILES['image4']['tmp_name'];
		move_uploaded_file($gallery4_tmp,"photos/".$gallery4);
	}else{
		$gallery4=$row['gallery4'];
	}

	if(!empty($_FILES['image5']) && strlen($_FILES['image5']['name'])>0){
		$gallery5=$date.$_FILES['image5']['name'];
		$gallery5_tmp=$_FILES['image5']['tmp_name'];
		move_uploaded_file($gallery5_tmp,"photos/".$gallery5);
	}else{
		$gallery5=$row['gallery5'];
	}

	if(!empty($_FILES['image6']) && strlen($_FILES['image6']['name'])>0){
		$gallery6=$date.$_FILES['image6']['name'];
		$gallery6_tmp=$_FILES['image6']['tmp_name'];
		move_uploaded_file($gallery6_tmp,"photos/".$gallery6);
	}else{
		$gallery6=$row['gallery6'];
	}

	if(!empty($_FILES['image7']) && strlen($_FILES['image7']['name'])>0){
		$gallery7=$date.$_FILES['image7']['name'];
		$gallery7_tmp=$_FILES['image7']['tmp_name'];
		move_uploaded_file($gallery7_tmp,"photos/".$gallery7);
	}else{
		$gallery7=$row['gallery7'];
	}

	if(!empty($_FILES['image8']) && strlen($_FILES['image8']['name'])>0){
		$gallery8=$date.$_FILES['image8']['name'];
		$gallery8_tmp=$_FILES['image8']['tmp_name'];
		move_uploaded_file($gallery8_tmp,"photos/".$gallery8);
	}else{
		$gallery8=$row['gallery8'];
	}

	if(!empty($_FILES['image9']) && strlen($_FILES['image9']['name'])>0){
		$gallery9=$date.$_FILES['image9']['name'];
		$gallery9_tmp=$_FILES['image9']['tmp_name'];
		move_uploaded_file($gallery9_tmp,"photos/".$gallery9);
	}else{
		$gallery9=$row['gallery9'];
	}

$sql = "UPDATE artist SET name=?,description=?,slug=?,image=?,gallery1=?,gallery2=?,gallery3=?,gallery4=?,gallery5=?,gallery6=?,gallery7=?,gallery8=?,gallery9=?,category_id=?,album_link=?,video_link1=?,video_link2=?,video_link3=? WHERE id=?";
$pdo->prepare($sql)->execute([$name,$description,$slug,$image,$gallery1,$gallery2,$gallery3,$gallery4,$gallery5,$gallery6,$gallery7,$gallery8,$gallery9,$category_id,$album_link,$video_link1,$video_link2,$video_link3,$id]);
header("Location:view_artists.php");

}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
    <h2 class="text-center">Edit Artist</h2>
     <br>
	 <div class="market-updates">

	 	<form action="" method="post" enctype="multipart/form-data">
	 		<div class="form-group">
	 			<label for="artist_name">Artist Name</label>
	 			<input type="text" placeholder="Enter artist name" name="artist_name" class="form-control" 
	 			required id="artist_name" value="<?php echo $row['name']?>">
	 		</div>
	 		<div class="form-group">
	 			<label for="description">Artist Description</label>
	 			<textarea name="description" cols="100" rows="8" 
	 			placeholder="Enter description about artist" class="form-control" 
	 			id="description" required><?php echo $row['description']?></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="category">Artist Category</label>
	 			<select name="category" id="category" class="form-control" required>
	 				<?php
	 					$categories=$pdo->query('SELECT * FROM artist_categories');
	 					while($cats=$categories->fetch()){
	 				 ?>
	 				<option value="<?php echo $cats['id']?>" 
	 					<?php if($cats['id']==$row['category_id']){ ?> selected <?php }?>><?php echo ucwords($cats['name'])?></option>
	 				<?php } ?>
	 			</select>
	 		</div>
	 		<p class="alert alert-danger">
	 		* If you don't want to update your artist and gallery images then ignore images fields</p>
	 		<div class="form-group">
	 			<label for="image">Artist Main Image</label>
	 			<input type="file" name="image" id="image" class="form-control">
	 		</div>
	 		<div class="form-group">
	 			<div class="row">
	 				<div class="col-md-4">
	 					<label for="image1">Artist Gallery Image 1</label>
	 					<input type="file" name="image1" id="image1" class="form-control">
	 				</div>
	 				<div class="col-md-4">
	 					<label for="image2">Artist Gallery Image 2</label>
	 					<input type="file" name="image2" id="image2" class="form-control">
	 				</div>
	 				<div class="col-md-4">
	 					<label for="image3">Artist Gallery Image 3</label>
	 					<input type="file" name="image3" id="image3" class="form-control">
	 				</div>
	 			</div>
	 			<br>
	 			<div class="row">
	 				<div class="col-md-4">
	 					<label for="image4">Artist Gallery Image 4</label>
	 					<input type="file" name="image4" id="image4" class="form-control">
	 				</div>
	 				<div class="col-md-4">
	 					<label for="image5">Artist Gallery Image 5</label>
	 					<input type="file" name="image5" id="image5" class="form-control">
	 				</div>
	 				<div class="col-md-4">
	 					<label for="image6">Artist Gallery Image 6</label>
	 					<input type="file" name="image6" id="image6" class="form-control">
	 				</div>
	 			</div>
	 			<br>
	 			<div class="row">
	 				<div class="col-md-4">
	 					<label for="image7">Artist Gallery Image 7</label>
	 					<input type="file" name="image7" id="image7" class="form-control">
	 				</div>
	 				<div class="col-md-4">
	 					<label for="image8">Artist Gallery Image 8</label>
	 					<input type="file" name="image8" id="image8" class="form-control">
	 				</div>
	 				<div class="col-md-4">
	 					<label for="image9">Artist Gallery Image 9</label>
	 					<input type="file" name="image9" id="image9" class="form-control">
	 				</div>
	 			</div>
	 		</div>
	 		<div class="form-group">
	 			<label for="album_link">Artist Album Link</label>
	 			<textarea name="album_link" id="album_link" cols="100" rows="2" class="form-control"placeholder="Paste artist embedded album link"><?php echo $row['album_link']?></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="video_link1">Artist Video Link 1</label>
	 			<textarea placeholder="Paste artist embedded video link 1" 
	 			name="video_link1" id="video_link1" class="form-control" cols="100" rows="2"><?php echo $row['video_link1']?></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="video_link2">Artist Video Link 2</label>
	 			<textarea placeholder="Paste artist embedded video link 2" 
	 			name="video_link2" id="video_link2" class="form-control" cols="100" rows="2"><?php echo $row['video_link2']?></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="video_link3">Artist Video Link 3</label>
	 			<textarea placeholder="Paste artist embedded video link 3" 
	 			name="video_link3" id="video_link3" class="form-control" cols="100" rows="2"><?php echo $row['video_link3']?></textarea>
	 		</div>
	 		<input type="submit" name="submit" class="btn btn-primary btn-block" value="Save">
	 	</form>
		
		</div>
</div>
</div>
</div>
<?php include("sidebar.php");?>
	<div class="clearfix"> </div>
</div>
<?php include("footer.php");?>