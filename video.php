<?php 

include("header.php");
$cat_id=$_GET['category'];
$category=mysqli_query($connect,"SELECT * FROM video_categories WHERE id='$cat_id' ");
$cats=mysqli_fetch_assoc($category);

?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="col-sm-6 col-md-6 col-xs-12 blocktitle title ">
<span class="bold"><?php echo $cats['name'] ?> videos </span>
</div>
<div class="col-sm-6 col-md-6 col-xs-12">
<span class="dropdown pull-right" style="margin-top:10px !important; margin-bottom:20px !important;">
<a type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php echo ucwords($cats['name'])?>
<span class="caret"></span>
</a>
<ul class="dropdown-menu" aria-labelledby="dLabel">
<?php 
$video_categories=mysqli_query($connect,"SELECT * FROM video_categories");
while($rowa=mysqli_fetch_assoc($video_categories)){
?>
<li><a href="video.php?category=<?php echo $rowa['id']?>"><?php echo ucwords($rowa['name']) ?></a></li>
<?php } ?>
</ul>
</span>
</div>
</div>
<?php 
$latest_video=mysqli_query($connect,"SELECT * FROM video WHERE category_id='$cat_id' 
	ORDER BY ID DESC LIMIT 1 ");
$latest=mysqli_fetch_assoc($latest_video);
?>
<div class="col-md-8 col-xs-12 col-md-offset-2 padd-top-xxs  padd-bottom-lg">
<div class="embed-responsive embed-responsive-16by9 padd-top-xxs padd-bottom-xs">
<?php echo $latest['link'] ?>
</div>
</div>
<?php 
$videos=mysqli_query($connect,"SELECT * FROM video WHERE category_id='$cat_id' ");
$rows=mysqli_num_rows($videos);
  if($rows>0){
  if(isset($_GET['page'])){
                      $page=preg_replace('#[^0-9]#','',$_GET['page']);
                  }else{
                    $page=1;
                  }
$per_page=12;
 $last_page=ceil($rows/$per_page);
                  if($page<1){
                    $page=1;
                  }else if($page>$last_page){
                    $page=$last_page;
                  }
   $middleNumbers='';
                  $add1=$page+1;
                  $add2=$page+2;
                  $sub1=$page-1;
                  $sub2=$page-2;

                  if($page==1){
                    $middleNumbers.='<li class="page-item active"><a>'.$page.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&category='.$cat_id.'">'.$add1.'</a></li>';

                  }else if($page==$last_page){
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&category='.$cat_id.'">'.$sub1.'</a></li>';
                    $middleNumbers.='<li class="page-item active"><a>'.$page.'</a></li>';

                  }else if($page>2 && $page<$last_page-1){
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'&category='.$cat_id.'">'.$sub2.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&category='.$cat_id.'">'.$sub1.'</a></li>';
                    $middleNumbers.='<li class="page-item active"><a>'.$page.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&category='.$cat_id.'">'.$add1.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'&category='.$cat_id.'">'.$add2.'</a></li>';

                  }else if($page>1 && $page<$last_page){
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&category='.$cat_id.'">'.$sub1.'</a></li>';
                    $middleNumbers.='<li class="page-item active"><a>'.$page.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&category='.$cat_id.'">'.$add1.'</a></li>';

                  }
                  $videos =  mysqli_query($connect,"SELECT * FROM video WHERE category_id='$cat_id' LIMIT ".($page-1)*$per_page.",".$per_page." ");
while($row=mysqli_fetch_assoc($videos)){
?>
<div class="col-md-3 col-sm-3 col-xs-12 padd-top-xxs single-album ">
<a class="music-wrapper" href="video_single.php?name=<?php echo $row['slug']?>">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $row['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($row['created_at'])); ?></span>
</span>
<span class="playbutton">
<img src="img/play_white.svg" height="60">
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $row['name'] ?> - <?php echo $row['remix_by'] ?> </div>
</a>
</div>
<?php 
  } 
}else{
	 echo "<div class='col-md-12' style='position:relative;top:-75vh;'><h3 class='text-center text-danger' style='font-weight:bold;'>No video is available yet in <span class='light' style='text-transform:uppercase;'></span> category</h3></div>";
}
?>
<div class="col-md-12 col-xs-12 padd-top-md  text-center">
<?php if($rows>12){ ?>
<ul class="pagination">
                <li>
                  <a href="video.php?category=<?php echo $cat_id ?>&page=<?php echo $page-1?>">
                    <span>Prev</span>
                    <i class="fa fa-angle-left"></i>
                  </a>
                </li>
                
              <?php echo $middleNumbers;?>
                <li>
                  <a href="video.php?category=<?php echo $cat_id ?>&page=<?php echo $page+1?>">
                    <span>Next</span>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
              </ul>
  <?php } ?>
</div>
</div>
</section>
<section class="padd-top-md"></section>
<?php include("footer.php");?>