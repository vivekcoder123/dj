<?php 

include("header.php");
if(isset($_POST['submit'])){
	$name=$_POST['event_name'];
	$slug=slugify($name);
	$description=$_POST['description'];
	$date = date('Y-m-d').rand(1,10000000);
	$image = $date.$_FILES['image']['name'];
   	$image_tmp =$_FILES['image']['tmp_name'];
   	move_uploaded_file($image_tmp,"photos/".$image);
   	$event_date=$_POST['event_date'];
   	$artist_name=$_POST['artist_name'];
   	$venue=$_POST['venue'];
   	$pdo->prepare("INSERT INTO events (name,description,event_date,venue,slug,image,artist_name) VALUES (?,?,?,?,?,?,?)")->execute([$name,$description,$event_date,$venue,$slug,$image,$artist_name]);
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
	 			placeholder="Enter event name" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="description">Event Description</label>
	 			<textarea name="description" id="description" cols="100" rows="8" class="form-control" required placeholder="Enter event description"></textarea>
	 		</div>
	 		<div class="form-group">
	 			<label for="image">Event Image</label>
	 			<input type="file" name="image" id="image" class="form-control" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="event_date">Event Date</label>
	 			<input type="date" name="event_date" id="event_date" class="form-control" required>
	 		</div>
	 		<div class="form-group">
	 			<label for="artist_name">Event Artist Name</label>
	 			<input type="text" name="artist_name" id="artist_name" class="form-control" required 
	 			placeholder="Enter event artist name">
	 		</div>
	 		<div class="form-group">
	 			<label for="venue">Event Venue</label>
	 			<textarea name="venue" id="venue" class="form-control" required placeholder="Enter event venue" cols="100" rows="8"></textarea>
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