<?php 

include("header.php");

if(isset($_GET['id'])){
	$id=$_GET['id'];
	$savedEvent=$pdo->prepare("SELECT * FROM events WHERE id=?");
	$savedEvent->execute([$id]);
	$savedEvent=$savedEvent->fetch();
}

if(isset($_POST['submit'])){
	$name=$_POST['event_name'];
	$slug=slugify($name);
	$description=$_POST['description'];
	$date = date('Y-m-d').rand(1,10000000);
	if(!empty($_FILES['image']) && strlen($_FILES['image']['name'])>0){
	  $image = $date.$_FILES['image']['name'];
      $image_tmp =$_FILES['image']['tmp_name'];
      move_uploaded_file($image_tmp,"photos/".$image);
	}else{
		$image=$savedEvent['image'];
	}
   	$event_date=$_POST['event_date'];
   	$artist_name=$_POST['artist_name'];
   	$venue=$_POST['venue'];
   	$pdo->prepare("UPDATE events SET name=?,description=?,event_date=?,venue=?,slug=?,image=?,artist_name=? WHERE id=?")->execute([$name,$description,$event_date,$venue,$slug,$image,$artist_name,$id]);
   	header("Location:view_events.php");
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
	 			<label for="event_name">Event Name</label>
	 			<input type="text" name="event_name" id="event_name" class="form-control" 
	 			placeholder="Enter event name" required value="<?php echo $savedEvent['name']?>">
	 		</div>
	 		<div class="form-group">
	 			<label for="description">Event Description</label>
	 			<textarea name="description" id="description" cols="100" rows="8" class="form-control" required placeholder="Enter event description"><?php echo $savedEvent['description']?></textarea>
	 		</div>
	 		<p class="alert alert-danger">
	 		* If you don't want to update your event image then ignore image field</p>
	 		<div class="form-group">
	 			<label for="image">Event Image</label>
	 			<input type="file" name="image" id="image" class="form-control">
	 		</div>
	 		<div class="form-group">
	 			<label for="event_date">Event Date</label>
	 			<input type="date" name="event_date" id="event_date" class="form-control" required value="<?php echo $savedEvent['event_date']?>">
	 		</div>
	 		<div class="form-group">
	 			<label for="artist_name">Event Artist Name</label>
	 			<input type="text" name="artist_name" id="artist_name" class="form-control" required 
	 			placeholder="Enter event artist name" value="<?php echo $savedEvent['artist_name']?>">
	 		</div>
	 		<div class="form-group">
	 			<label for="venue">Event Venue</label>
	 			<textarea name="venue" id="venue" class="form-control" required placeholder="Enter event venue" cols="100" rows="8"><?php echo $savedEvent['venue']?></textarea>
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