<?php 

include("header.php");
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$pdo->prepare("DELETE FROM event_ticket_booking WHERE id=?")->execute([$id]);
	header("Location:event_ticket_booking.php");
}

if(isset($_GET['status'])){
	$status=$_GET['status'];
	$id=$_GET['id'];
	$pdo->prepare("UPDATE event_ticket_booking SET status=? WHERE id=?")->execute([$status,$id]);
	header("Location:event_ticket_booking.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">Event Ticket Bookings</h2>
	<br>
	 <div class="market-updates">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Attendees</th>
					<th>Email</th>
					<th>Phone Number</th>
					<th>Message</th>
					<th>Event Name</th>
					<th>Current Status</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$users=mysqli_query($connect,"SELECT * FROM event_ticket_booking");
					while($row=mysqli_fetch_assoc($users)){
				?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo $row['first_name'] ?></td>
					<td><?php echo $row['last_name'] ?></td>
					<td><?php echo $row['attendees'] ?></td>
					<td><?php echo strlen($row['email'])>0?$row['email']:"No email" ?></td>
					<td><?php echo $row['phone'] ?></td>
					<td><?php echo strlen($row['message'])>0?$row['message']:"No message" ?></td>
					<td><?php echo $row['event_name'] ?></td>
					<?php if($row['status']=="pending"){ ?>
					<td><a href="event_ticket_booking.php?status=completed&id=<?php echo $row['id']?>" class="btn btn-warning">Pending</a></td>
					<?php }else{ ?>
					<td><a href="event_ticket_booking.php?status=pending&id=<?php echo $row['id']?>" class="btn btn-success">Completed</a></td>
					<?php } ?>
					<td><a href="event_ticket_booking.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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