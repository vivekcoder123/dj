<?php 

include("header.php");

$users=mysqli_query($connect,"SELECT * FROM users");
$users=mysqli_num_rows($users);
$subscribers=mysqli_query($connect,"SELECT * FROM subscribers");
$subscribers=mysqli_num_rows($subscribers);
$messages=mysqli_query($connect,"SELECT * FROM contact");
$messages=mysqli_num_rows($messages);

?>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <?php include("navbar.php");?>
	<div class="inner-block">
<!--market updates updates-->
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<a href="users.php" style="color:white;">
						<div class="col-md-8 market-update-left">
						<h3><?php echo $users ?></h3>
						<h4>Registered Users</h4>
					</a>
						</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-file-text-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
				<a href="subscribers.php" style="color:white;">
				 	<div class="col-md-8 market-update-left">
					<h3><?php echo $subscribers ?></h3>
					<h4>Subscribers</a></h4>
				</a>
				 	 </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
				<a href="contact.php" style="color:white;">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $messages ?></h3>
						<h4>Messages</a></h4>
					</div>
				</a>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"> </i>
					</div>
				  <div class="clearfix"> </div>
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