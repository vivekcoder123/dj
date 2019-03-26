<?php 

include("header.php");
$music=$pdo->query("SELECT * FROM music");

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$music=$pdo->prepare("SELECT * FROM music WHERE id=?");
	$music->execute([$id]);
	while($a=$music->fetch()){
		unlink("photos/".$a['image']);
	}
	$pdo->prepare("DELETE FROM music WHERE id=?")->execute([$id]);
	header("Location:view_music.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">All Music</h2>
	<br>
	 <div class="market-updates">

	 	<table class="table table-striped table-bordered">
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Name</th>
	 				<th>Category</th>
	 				<th>Photo</th>
	 				<th>Artist Name</th>
	 				<th>Released By</th>
	 			</tr>
	 		</thead>
	 		<tbody>
	 			<?php 
	 			while($row=$music->fetch()){
	 				$cat_id=$row['category_id'];
	 				$category=$pdo->prepare("SELECT name FROM music_categories WHERE id=?");
	 				$category->execute([$cat_id]);
	 				$cat_array=$category->fetch();
	 				$cat_name=$cat_array['name'];
	 			 ?>
	 			<tr>
	 				<td><?php echo $row['id'] ?></td>
	 				<td><?php echo ucwords($row['name']) ?></td>
	 				<td><?php echo ucwords($cat_name) ?></td>
	 				<td><img src="photos/<?php echo $row['image'] ?>" height="100" width="100"></td>
	 				<td><?php echo ucwords($row['artist_name']) ?></td>
	 				<td><?php echo ucwords($row['release_by']) ?></td>
	 				<td><a href="edit_music.php?id=<?php echo $row['id']?>" class="btn btn-primary">Edit</a></td>
	 				<td><a href="view_music.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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