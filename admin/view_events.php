<?php 

include("header.php");
$events=$pdo->query("SELECT * FROM events");

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$events=$pdo->prepare("SELECT * FROM events WHERE id=?");
	$events->execute([$id]);
	while($a=$events->fetch()){
		unlink("photos/".$a['image']);
	}
	$pdo->prepare("DELETE FROM events WHERE id=?")->execute([$id]);
	header("Location:view_events.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">All Events</h2>
	<br>
	 <div class="market-updates">

	 	<table class="table table-striped table-bordered">
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Name</th>
	 				<th>Date</th>
	 				<th>Photo</th>
	 				<th>Venue</th>
	 				<th>Artist</th>
	 			</tr>
	 		</thead>
	 		<tbody>
	 			<?php 
	 			while($row=$events->fetch()){
	 			 ?>
	 			<tr>
	 				<td><?php echo $row['id'] ?></td>
	 				<td><?php echo ucwords($row['name']) ?></td>
	 				<td><?php echo date("F jS, Y", strtotime($row['event_date'])); ?></td>	 				
	 				<td><img src="photos/<?php echo $row['image'] ?>" height="100" width="100"></td>
	 				<td><?php echo ucwords($row['venue']) ?></td>
	 				<td><?php echo ucwords($row['artist_name']) ?></td>
	 				<td><a href="edit_event.php?id=<?php echo $row['id']?>" class="btn btn-primary">Edit</a></td>
	 				<td><a href="view_events.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
	 			</tr>
	 			<?php } ?>
	 		</tbody>
	 	</table>

		</div>
</div>
</div>
</div>
<?php include("sidebar.php");?>
	<div class="clearfix"> </div>
</div>
<?php include("footer.php");?>