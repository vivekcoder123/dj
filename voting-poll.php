<?php include("header.php");?>
<section>
<div class="container clearfix">
<div class="row">
<div class="col-md-9">
<div class="padd-top-md padd-bottom-xs">
<div class="blocktitle title ">
<span class="bold">Vote</span>
<span class="light">your favourites</span>
</div>
</div>
<div class="row no-padding">
</div>
<div class="col-xs-12 padd-top-md text-center">
</div>
</div>
<div class="col-md-3">
<div class="padd-top-md padd-bottom-xs">
<div class="blocktitle title ">
<span class="bold">Latest</span>
<span class="light">Music</span>
</div>
</div>
<div class="single-album padd-bottom-xs">
<?php 
$latest3_music=mysqli_query($connect,"SELECT * FROM music ORDER BY ID DESC LIMIT 3");
while($lats3=mysqli_fetch_assoc($latest3_music)){
?>
<a href="song.php?name=<?php echo $lats3['slug']?>" class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $lats3['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($lats3['created_at'])); ?></span>
</span>
<span class="playbutton">
<img src="img/play_white.svg" height="60">
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs">
<?php echo $lats3['name'] ?>
</div>
</a>
<?php } ?>
</div>
</div>
</div>
</div>
</section>
<section class="padd-top-md"></section>
<?php include("footer.php");?>