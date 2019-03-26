<?php 

include("header.php");
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$pdo->prepare("DELETE FROM video_comments WHERE id=?")->execute([$id]);
	header("Location:video_comments.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">Video Comments</h2>
	<br>
	 <div class="market-updates">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Text</th>
					<th>User Name</th>
					<th>Video Slug</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$users=mysqli_query($connect,"SELECT * FROM video_comments");
					while($row=mysqli_fetch_assoc($users)){
				?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo $row['text'] ?></td>
					<td><?php echo $row['user_name'] ?></td>
					<td><?php echo $row['video_slug'] ?></td>
					<td><?php echo $row['created_at'] ?></td>
					<td><a href="video_comments.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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