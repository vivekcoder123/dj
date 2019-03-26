<?php 

include("header.php");
$news=$pdo->query("SELECT * FROM news");

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$news=$pdo->prepare("SELECT * FROM news WHERE id=?");
	$news->execute([$id]);
	while($a=$news->fetch()){
		unlink("photos/".$a['image']);
	}
	$pdo->prepare("DELETE FROM news WHERE id=?")->execute([$id]);
	header("Location:view_news.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	<h2 class="text-center">All News</h2>
	<br>
	 <div class="market-updates">

	 	<table class="table table-striped table-bordered">
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Name</th>
	 				<th>Photo</th>
	 				<th>Created At</th>
	 			</tr>
	 		</thead>
	 		<tbody>
	 			<?php 
	 				while($row=$news->fetch()){
	 			 ?>
	 			<tr>
	 				<td><?php echo $row['id'] ?></td>
	 				<td><?php echo ucwords($row['name']) ?></td>
	 				<td><img src="photos/<?php echo $row['image'] ?>" height="100" width="100"></td>
	 				<td><?php echo date("F jS, Y", strtotime($row['created_at'])); ?></td>
	 				<td><a href="edit_news.php?id=<?php echo $row['id']?>" class="btn btn-primary">Edit</a></td>
	 				<td><a href="view_news.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
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