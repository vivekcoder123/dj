<?php 

include("header.php");
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$pdo->prepare("DELETE FROM artist_booking WHERE id=?")->execute([$id]);
	header("Location:artist_booking.php");
}

if(isset($_GET['status'])){
	$status=$_GET['status'];
	$id=$_GET['id'];
	$pdo->prepare("UPDATE artist_booking SET status=? WHERE id=?")->execute([$status,$id]);
	header("Location:artist_booking.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">Artist Bookings</h2>
	<br>
	 <div class="market-updates">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>User Name</th>
					<th>User Email</th>
					<th>User Phone</th>
					<th>Artist Name</th>
					<th>Event Date</th>
					<th>Event Type</th>
					<th>Venue Name</th>
					<th>City</th>
					<th>Country</th>
					<th>Approx Budget</th>
					<th>Current Status</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$users=mysqli_query($connect,"SELECT * FROM artist_booking");
					while($row=mysqli_fetch_assoc($users)){
				?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo $row['user_name'] ?></td>
					<td><?php echo $row['user_email'] ?></td>
					<td><?php echo $row['user_phone'] ?></td>
					<td><?php echo $row['artist_name'] ?></td>
					<td><?php echo date("F jS, Y", strtotime($row['event_date'])); ?></td>
					<td><?php echo $row['event_type'] ?></td>
					<td><?php echo $row['venue_name'] ?></td>
					<td><?php echo $row['city'] ?></td>
					<td><?php echo $row['country'] ?></td>
					<td><?php echo $row['approx_budget'] ?></td>
					<?php if($row['status']=="pending"){ ?>
					<td><a href="artist_booking.php?status=completed&id=<?php echo $row['id']?>" class="btn btn-warning">Pending</a></td>
					<?php }else{ ?>
					<td><a href="artist_booking.php?status=pending&id=<?php echo $row['id']?>" class="btn btn-success">Completed</a></td>
					<?php } ?>
					<td><a href="artist_booking.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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