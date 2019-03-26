<?php 

include("header.php");
$search_query=$_GET['q'];

?>
<section>

<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="blocktitle title">
<span class="bold">music</span>
</div>
</div>
<?php 
$music_search=mysqli_query($connect,"SELECT * FROM music WHERE name LIKE '%$search_query%' ");
$music_rows=mysqli_num_rows($music_search);
if($music_rows>0){
while($ms=mysqli_fetch_assoc($music_search)){
?>
<a href="song.php?name=<?php echo $ms['slug']?>" class="col-md-3 padd-top-xxs single-album ">
<div class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $ms['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($ms['created_at'])); ?></span>
</span>
<span class="playbutton">
<img src="img/play_white.svg" height="60">
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs">
<?php echo $ms['name'] ?>
</div>
</div>
</a>
<?php 
}
}else{
echo "<div class='text-danger bold'>No music found with the keyword <span style='text-transform:uppercase;'>".$search_query."</span></div>";
}
?>
</div>

<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="blocktitle title">
<span class="bold">Videos</span>
</div>
</div>
<?php 
$video_search=mysqli_query($connect,"SELECT * FROM video WHERE name LIKE '%$search_query%' ");
$video_rows=mysqli_num_rows($video_search);
if($video_rows>0){
while($vs=mysqli_fetch_assoc($video_search)){
?>
<a href="video_single.php?name=<?php echo $vs['slug']?>" class="col-md-3 padd-top-xxs single-album ">
<div class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $vs['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
 <div class="overlay cover-image"></div>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($vs['created_at'])); ?></span>
</span>
<span class="playbutton">
<img src="img/play_white.svg" height="60">
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs">
<?php echo $vs['name'] ?>
</div>
</div>
</a>
<?php 
}
}else{
echo "<div class='text-danger bold'>No video found with the keyword <span style='text-transform:uppercase;'>".$search_query."</span></div>";
}
?>
</div>

<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="blocktitle title ">
<span class="light">Artist</span>
</div>
</div>
<?php 
$artist_search=mysqli_query($connect,"SELECT * FROM artist WHERE name LIKE '%$search_query%' ");
$artist_rows=mysqli_num_rows($artist_search);
if($artist_rows>0){
while($as=mysqli_fetch_assoc($artist_search)){
?>
<div class="col-md-3 padd-top-xxs single-album ">
<a href="artist-detail.php?name=<?php echo $as['slug']?>" class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $as['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span>know more</span>
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $as['name'] ?></div>
</a>
</div>
<?php 
}
}else{
echo "<div class='text-danger bold'>No artist found with the keyword <span style='text-transform:uppercase;'>".$search_query."</span></div>";
} 
?>
</div>

<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="blocktitle title ">
<span class="light">News</span>
</div>
</div>
<?php  
$news_search=mysqli_query($connect,"SELECT * FROM news WHERE name LIKE '%$search_query%' ");
$news_rows=mysqli_num_rows($news_search);
if($news_rows>0){
while($ns=mysqli_fetch_assoc($news_search)){
?>
<div class="col-md-3 padd-top-xxs single-album ">
<a href="feed.php?name=<?php echo $ns['slug']?>" class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $ns['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
<span class="date-relased title">
<span>Read more</span>
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $ns['name'] ?></div>
</a>
</div>
<?php 
} 
}else{
echo "<div class='text-danger bold'>No news found with the keyword <span style='text-transform:uppercase;'>".$search_query."</span></div>";
}
?>
</div>

<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="blocktitle title ">
<span class="light">events</span>
</div>
</div>
<?php  
$event_search=mysqli_query($connect,"SELECT * FROM events WHERE name LIKE '%$search_query%' ");
$event_rows=mysqli_num_rows($event_search);
if($event_rows>0){
while($es=mysqli_fetch_assoc($event_search)){
?>
<div class="col-md-3 padd-top-xxs single-album">
<a href="occasion.php?name=<?php echo $es['slug']?>" class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $es['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
<span class="date-relased title">
<span>Read more</span>
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $es['name'] ?></div>
</a>
</div>
<?php 
} 
}else{
echo "<div class='text-danger bold'>No event found with the keyword <span style='text-transform:uppercase;'>".$search_query."</span></div>";
}
?>
</div>

</section>

<section class="padd-top-md"></section>

<?php include("footer.php");?>