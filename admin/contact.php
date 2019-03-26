<?php 

include("header.php");
$queries=$pdo->query("SELECT * FROM contact");

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$pdo->prepare("DELETE FROM contact WHERE id=?")->execute([$id]);
	header("Location:contact.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">All Queries</h2>
	<br>
	 <div class="market-updates">

	 	<table class="table table-striped table-bordered">
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>FirstName</th>
	 				<th>LastName</th>
	 				<th>Email</th>
	 				<th>Phone</th>
	 				<th>Message</th>
	 			</tr>
	 		</thead>
	 		<tbody>
	 			<?php 
	 				while($row=$queries->fetch()){
	 			 ?>
	 			<tr>
	 				<td><?php echo $row['id'] ?></td>
	 				<td><?php echo $row['first_name'] ?></td>
	 				<td><?php echo $row['last_name'] ?></td>
	 				<td><?php echo $row['email'] ?></td>
	 				<td><?php echo $row['phone'] ?></td>
	 				<td><?php echo $row['msg'] ?></td>
	 				<td><a href="contact.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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