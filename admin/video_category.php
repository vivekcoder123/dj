<?php 
include("header.php");
$categories=$pdo->query('SELECT * FROM video_categories');

if(isset($_POST['submit'])){
$name=$_POST['cat_name'];
$slug=slugify($name);
$sql = "INSERT INTO video_categories (name,slug) VALUES (?,?)";
$pdo->prepare($sql)->execute([$name,$slug]);
header("Location:video_category.php");
}

if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$sql="DELETE FROM video_categories WHERE id=?";
	$pdo->prepare($sql)->execute([$id]);
	header("Location:video_category.php");
}

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	 <div class="market-updates">

	 	<div class="row">
	 		<div class="col-md-4">
	 			<h2>Create Category</h2>
	 			<br>
	 			<form action="" method="post">
	 				<div class="form-group">
	 				<input type="text" placeholder="Enter category name" name="cat_name" class="form-control" required>
	 				</div>
	 				<input type="submit" name="submit" value="Save" class="btn btn-primary">
	 			</form>
	 		</div>
	 		<div class="col-md-8">
	 			<h2>All Categories</h2>
	 			<br>
	 			<table class="table table-striped table-bordered">
	 				<thead>
	 					<tr>
	 						<th>Id</th>
	 						<th>Name</th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<?php  
	 					 while($row=$categories->fetch()){
	 					?>
	 					<tr>
	 						<td><?php echo $row['id'] ?></td>
	 						<td><?php echo ucwords($row['name']) ?></td>
	 						<td><a href="video_category.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
	 					</tr>
	 				<?php } ?>
	 				</tbody>
	 			</table>
	 		</div>
	 	</div>

		</div>
</div>
</div>
</div>
<?php include("sidebar.php");?>
	<div class="clearfix"> </div>
</div>
<?php include("footer.php");?>