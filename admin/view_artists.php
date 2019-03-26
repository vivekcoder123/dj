<?php 

include("header.php");
$artists=$pdo->query("SELECT * FROM artist");

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
    $artist=$pdo->prepare("SELECT * FROM artist WHERE id=?");
	$artist->execute([$id]);
	while($a=$artist->fetch()){
		unlink("photos/".$a['image']);
		if(strlen($a['gallery1'])>0 && file_exists("photos/".$a['gallery1'])){
			unlink("photos/".$a['gallery1']);
		}
		if(strlen($a['gallery2'])>0 && file_exists("photos/".$a['gallery2'])){
			unlink("photos/".$a['gallery2']);
		}
		if(strlen($a['gallery3'])>0 && file_exists("photos/".$a['gallery3'])){
			unlink("photos/".$a['gallery3']);
		}
		if(strlen($a['gallery4'])>0 && file_exists("photos/".$a['gallery4'])){
			unlink("photos/".$a['gallery4']);
		}
		if(strlen($a['gallery5'])>0 && file_exists("photos/".$a['gallery5'])){
			unlink("photos/".$a['gallery5']);
		}
		if(strlen($a['gallery6'])>0 && file_exists("photos/".$a['gallery6'])){
			unlink("photos/".$a['gallery6']);
		}
		if(strlen($a['gallery7'])>0 && file_exists("photos/".$a['gallery7'])){
			unlink("photos/".$a['gallery7']);
		}
		if(strlen($a['gallery8'])>0 && file_exists("photos/".$a['gallery8'])){
			unlink("photos/".$a['gallery8']);
		}
		if(strlen($a['gallery9'])>0 && file_exists("photos/".$a['gallery9'])){
			unlink("photos/".$a['gallery9']);
		}
	}
	$pdo->prepare("DELETE FROM artist WHERE id=?")->execute([$id]);
	header("Location:view_artists.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">All Artists</h2>
	<br>
	 <div class="market-updates">

	 	<table class="table table-striped table-bordered">
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Name</th>
	 				<th>Category</th>
	 				<th>Photo</th>
	 			</tr>
	 		</thead>
	 		<tbody>
	 			<?php 
	 			while($row=$artists->fetch()){
	 				$cat_id=$row['category_id'];
	 				$category=$pdo->prepare("SELECT name FROM artist_categories WHERE id=?");
	 				$category->execute([$cat_id]);
	 				$cat_array=$category->fetch();
	 				$cat_name=$cat_array['name'];
	 			 ?>
	 			<tr>
	 				<td><?php echo $row['id'] ?></td>
	 				<td><?php echo ucwords($row['name']) ?></td>
	 				<td><?php echo ucwords($cat_name) ?></td>
	 				<td><img src="photos/<?php echo $row['image'] ?>" height="100" width="100"></td>
	 				<td><a href="edit_artist.php?id=<?php echo $row['id']?>" class="btn btn-primary">Edit</a></td>
	 				<td><a href="view_artists.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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