<?php include("header.php");?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-top-md padd-bottom-xs">
<div class="blocktitle title ">
<span class="light">News</span>
</div>
</div>
<?php 
$news=mysqli_query($connect,"SELECT * FROM news");
$rows=mysqli_num_rows($news);
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
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1.'</a></li>';

                  }else if($page==$last_page){
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1.'</a></li>';
                    $middleNumbers.='<li class="page-item active"><a>'.$page.'</a></li>';

                  }else if($page>2 && $page<$last_page-1){
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">'.$sub2.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1.'</a></li>';
                    $middleNumbers.='<li class="page-item active"><a>'.$page.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">'.$add2.'</a></li>';

                  }else if($page>1 && $page<$last_page){
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">'.$sub1.'</a></li>';
                    $middleNumbers.='<li class="page-item active"><a>'.$page.'</a></li>';
                    $middleNumbers.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">'.$add1.'</a></li>';

                  }
                  $news =  mysqli_query($connect,"SELECT * FROM news 
                  	LIMIT ".($page-1)*$per_page.",".$per_page." ");
while($row=mysqli_fetch_assoc($news)){
?>
<a href="feed.php?name=<?php echo $row['slug']?>" class="col-md-3 padd-top-xxs single-album">
<div class="music-wrapper">
<div class="image-wrapper">
<img src="admin/photos/<?php echo $row['image']?>" alt="Image not available" class="img-responsive center-block" style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span>Read more</span>
</span>
</div>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $row['name'] ?></div>
</a>
<?php 
  }
}else{
	echo "<h3 class='text-center text-danger' style='font-weight:bold;'>No news is available yet</h3>";
}
?>
<div class="col-md-12 padd-top-md  text-center">
<?php if($rows>12){ ?>
<ul class="pagination">
                <li>
                  <a href="news.php?page=<?php echo $page-1?>">
                    <span>Prev</span>
                    <i class="fa fa-angle-left"></i>
                  </a>
                </li>
                
              <?php echo $middleNumbers;?>
                <li>
                  <a href="news.php?page=<?php echo $page+1?>">
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