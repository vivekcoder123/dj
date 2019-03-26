<?php include("header.php");?>

<section>
<div class="padd-bottom-xs" style="padding-top:35px;">
<div class="container clearfix ">
<div class="col-md-12">
<div class="mega-slideshow clearfix no-padding p0 slideshow dark-control super">
<?php 
$latest10_music=mysqli_query($connect,"SELECT * FROM music ORDER BY ID DESC LIMIT 10");
while($lats10=mysqli_fetch_assoc($latest10_music)){
?>
<a href="song.php?name=<?php echo $lats10['slug']?>" class="col-md-4 no-padding col-sm-3 single-album">
<div class="image-wrapper ">
<img data-lazy="admin/photos/<?php echo $lats10['image']?>" class="img-responsive center-block" alt="<?php echo $lats10['name']?>" style="height:210px;width:100%;">
<span class="label-white title" style="padding:5px !important">new</span>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($lats10['created_at'])); ?></span>
</span>
</div>
</a>
<?php } ?>
</div>
</div>
<div class="slidehowmore text-center col-md-12 super">
<div class="homepage--inline"><span class="title high">New Release</span></div>
</div>
</div>
</div>
</div>
</section>

<?php 
$music_categories=mysqli_query($connect,"SELECT * FROM music_categories");
while($music_cats=mysqli_fetch_assoc($music_categories)){
?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-bottom-xxs padd-top-xs">
<h2 class="blocktitle title ">
<span class="light">latest</span>
<span class="bold"><?php echo $music_cats['name'] ?></span>
</h2>
</div>
<div class="omg-slideshow col-md-12 clearfix no-padding p0 slideshow dark-control">
<?php 
$latest6_music=mysqli_query($connect,"SELECT * FROM music WHERE category_id=".$music_cats['id']." ORDER BY ID DESC LIMIT 6");
while($rowm=mysqli_fetch_assoc($latest6_music)){
?>
<a href="song.php?name=<?php echo $rowm['slug']?>" class="col-md-2  col-sm-3 padd-top-xxs single-album">
<div class="image-wrapper ">
<img data-lazy="admin/photos/<?php echo $rowm['image']?>" class="img-responsive center-block" alt="<?php echo $rowm['name']?>" style="height:148px;width:100%;">
<span class="label-white title" style="padding:5px !important">new</span>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($rowm['created_at'])); ?></span>
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $rowm['name'] ?></div>
</a>
<?php } ?>
</div>
<div class="col-md-12 text-center">
<a href="music.php?category=<?php echo $music_cats['id']?>" class="btn btn-md btn-black-border wow animated fadeIn">view more</a>
</div>
</div>
</section>
<?php } ?>

<?php 
$video_categories=mysqli_query($connect,"SELECT * FROM video_categories");
while($video_cats=mysqli_fetch_assoc($video_categories)){
?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-bottom-xxs padd-top-xs">
<h2 class="blocktitle title ">
<span class="light">latest</span>
<span class="bold"><?php echo $video_cats['name'] ?> videos</span>
</h2>
</div>
<div class="omg-slideshow col-md-12 clearfix no-padding p0 slideshow dark-control">
<?php 
$latest6_videos=mysqli_query($connect,"SELECT * FROM video WHERE category_id=".$video_cats['id']." ORDER BY ID DESC LIMIT 6");
while($rowv=mysqli_fetch_assoc($latest6_videos)){
?>
<a href="video_single.php?name=<?php echo $rowv['slug']?>" class="col-md-2 col-sm-3 wow animated fadeIn padd-top-xxs single-album">
<div class="image-wrapper ">
<img data-lazy="admin/photos/<?php echo $rowv['image']?>" class="img-responsive center-block" alt="<?php echo $rov['name']?>" style="height:148px;width:100%;">
<span class="label-white title" style="padding:5px !important">new</span>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($rowv['created_at'])); ?></span>
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs">Daru Badnaam (Remix) | DJ Chirag Dubai</div>
</a>
<?php } ?>
</div>
<div class="col-md-12  text-center">
<a href="video.php?category=<?php echo $video_cats['id']?>" class="btn btn-md btn-black-border wow animated fadeIn">view more</a>
</div>
</div>
</section>
<?php } ?>

<section>
<div class="container clearfix border-grey b-top">
<div class="col-md-12 padd-bottom-xxs padd-top-xs" style="padding-left:0px;padding-top:0px;">
<h2 class="blocktitle title">
<span class="light">latest</span>
<span class="bold">Events</span>
</h2>
</div>
<div class="omg-slideshow col-md-12 clearfix no-padding p0 slideshow dark-control">
<?php 
$events=mysqli_query($connect,"SELECT * FROM events ORDER BY ID DESC LIMIT 6");
while($rowe=mysqli_fetch_assoc($events)){
?>
<a href="occasion.php?name=<?php echo $rowe['slug']?>" class="col-md-2  col-sm-3 wow animated fadeIn  padd-top-xxs single-album">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $rowe['image']?>" class="img-responsive center-block" alt="<?php echo $rowe['name']?>" style="height:148px;width:100%;">
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($rowe['event_date'])); ?></span>
</span>
</div>
<div class="title text-center  bg-off padd-top-xxs padd-bottom-xxs"><?php echo $rowe['name'] ?></div>
</a>
<?php } ?>
</div>
<div class="col-md-12  text-center">
<a href="events" class="btn btn-md btn-black-border wow animated fadeIn">View more</a>
</div>
</div>
</section>

<section>
<div class="container clearfix border-grey b-top">
<div class="col-md-8 padd-bottom-xs padd-top-xs" style="padding-top:0px">
<div class="col-md-12 padd-bottom-xxs padd-top-xs" style="padding-left:0px;padding-top:10px;">
<h2 class="blocktitle title">
<span class="light">latest</span>
<span class="bold">news</span>
</h2>
</div>
<div class="row xs-first">
<?php 
$news=mysqli_query($connect,"SELECT * FROM news ORDER BY ID DESC LIMIT 8");
while($rown=mysqli_fetch_assoc($news)){
?>
<a href="feed.php?name=<?php echo $rown['slug']?>" class="col-md-3 wow animated fadeIn  padd-top-xxs single-album">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $rown['image']?>" class="img-responsive center-block" alt="World Music Day 2017" style="height:148px;width:100%;">
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($rown['created_at'])); ?></span>
</span>
</div>
<div class="title text-center  bg-off padd-top-xxs padd-bottom-xxs"><?php echo $rown['name'] ?></div>
</a>
<?php } ?>
</div>
<div class="col-md-12  text-center">
<a href="news" class="btn btn-md btn-black-border wow animated fadeIn">View more</a>
</div>
</div>
<div class="col-md-4 padd-bottom-xs padd-top-xs border-grey b-left" style="padding-top:10px;">
<h2 class="blocktitle title">
<span class="light">Like us on Facebook</span>
</h2>
<div class="fb-page padd-top-xs" data-href="https://m.facebook.com/allindiandjsclub/" data-tabs="timeline" data-height="460" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://m.facebook.com/allindiandjsclub/" class="fb-xfbml-parse-ignore"><a href="https://m.facebook.com/allindiandjsclub/">AIDC </a></blockquote></div>
</div>
</div>
</section>

<?php 
$artist_categories=mysqli_query($connect,"SELECT * FROM artist_categories");
while($artist_cats=mysqli_fetch_assoc($artist_categories)){
?>
<section>
<div class="container clearfix border-grey b-top">
<div class="col-md-12 padd-bottom-xxs padd-top-xs">
<h2 class="blocktitle title ">
<span class="bold"><?php echo $artist_cats['name'] ?></span>
<span class="light">artists</span>
</h2>
</div>
<div class="omg-slideshow col-md-12 clearfix no-padding p0 slideshow dark-control" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
<?php 
$top8_artists=mysqli_query($connect,"SELECT * FROM artist WHERE category_id=".$artist_cats['id']." ORDER BY ID ASC LIMIT 8");
while($rowa=mysqli_fetch_assoc($top8_artists)){
?>
<a href="artist-detail.php?name=<?php echo $rowa['slug']?>" class="col-md-2 col-sm-3 wow animated fadeIn padd-top-xxs single-album">
<div class="image-wrapper ">
<img data-lazy="admin/photos/<?php echo $rowa['image']?>" class="img-responsive center-block" alt="<?php echo $rowa['name']?>" style="height:148px;width:100%;">
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $rowa['name'] ?></div>
</a>
<?php } ?>
</div>
<div class="col-md-12 padd-bottom-xxs padd-top-xs text-center" style="padding-top:0px;">
<a href="artist.php?category=<?php echo $artist_cats['id']?>" class="btn btn-md btn-black-border">view all</a>
</div>
</div>
</section>
<?php } ?>

<?php include("footer.php");?>