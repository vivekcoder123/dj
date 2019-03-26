<?php 

include("header.php");
$videos=$pdo->query("SELECT * FROM video");

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$videos=$pdo->prepare("SELECT * FROM video WHERE id=?");
	$videos->execute([$id]);
	while($a=$videos->fetch()){
		unlink("photos/".$a['image']);
	}
	$pdo->prepare("DELETE FROM video WHERE id=?")->execute([$id]);
	header("Location:view_video.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">All Videos</h2>
	<br>
	 <div class="market-updates">

	 	<table class="table table-striped table-bordered">
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Name</th>
	 				<th>Category</th>
	 				<th>Photo</th>
	 				<th>Album Name</th>
	 				<th>Remix By</th>
	 				<th>Released By</th>
	 			</tr>
	 		</thead>
	 		<tbody>
	 			<?php 
	 			while($row=$videos->fetch()){
	 				$cat_id=$row['category_id'];
	 				$category=$pdo->prepare("SELECT name FROM video_categories WHERE id=?");
	 				$category->execute([$cat_id]);
	 				$cat_array=$category->fetch();
	 				$cat_name=$cat_array['name'];
	 			 ?>
	 			<tr>
	 				<td><?php echo $row['id'] ?></td>
	 				<td><?php echo ucwords($row['name']) ?></td>
	 				<td><?php echo ucwords($cat_name) ?></td>
	 				<td><img src="photos/<?php echo $row['image'] ?>" height="100" width="100"></td>
	 				<td><?php echo ucwords($row['album']) ?></td>
	 				<td><?php echo ucwords($row['remix_by']) ?></td>
	 				<td><?php echo ucwords($row['release_by']) ?></td>
	 				<td><a href="edit_video.php?id=<?php echo $row['id']?>" class="btn btn-primary">Edit</a></td>
	 				<td><a href="view_video.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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