<?php 

include("header.php");
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
	header("Location:users.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">All Users</h2>
	<br>
	 <div class="market-updates">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$users=mysqli_query($connect,"SELECT * FROM users");
					while($row=mysqli_fetch_assoc($users)){
				?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['email'] ?></td>
					<td><a href="users.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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