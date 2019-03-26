<?php 

include("header.php");
$cat_id=$_GET['category'];
$category=mysqli_query($connect,"SELECT * FROM music_categories WHERE id='$cat_id' ");
$cats=mysqli_fetch_assoc($category);

?>
<section>
<div class="container clearfix ">
<div class="col-md-12 padd-bottom-xs" style="padding-top:25px;">
<div class="blocktitle title ">
<span class="light"><?php echo $cats['name'] ?></span>
<span class="bold">music releases</span>
</div>
</div>
<?php 

  $singles=mysqli_query($connect,"SELECT * FROM music WHERE category_id='$cat_id' ");
  $rows=mysqli_num_rows($singles);
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
                  $singles =  mysqli_query($connect,"SELECT * FROM music WHERE category_id='$cat_id' LIMIT ".($page-1)*$per_page.",".$per_page." ");

while($row=mysqli_fetch_array($singles)){
?>
<a href="song.php?name=<?php echo $row['slug']?>" class="col-md-3 padd-top-xxs single-album ">
<div class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $row['image']?>" class="img-responsive center-block" 
style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($row['created_at'])); ?></span>
</span>
<span class="playbutton">
<img src="img/play_white.svg" height="60">
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs">
<?php echo $row['name'] ?>
</div>
</div>
</a>
<?php 
  } 
}else{
 echo "<h3 class='text-center text-danger' style='font-weight:bold;'>No music is available yet in <span class='light' style='text-transform:uppercase;'>".$cats['name']."</span> category</h3>";
}
 ?>


<div class="col-md-12 padd-top-md  text-center">
<?php if($rows>12){ ?>
<ul class="pagination">
                <li>
                  <a href="music.php?category=<?php echo $cat_id ?>&page=<?php echo $page-1?>">
                    <span>Prev</span>
                    <i class="fa fa-angle-left"></i>
                  </a>
                </li>
                
              <?php echo $middleNumbers;?>
                <li>
                  <a href="music.php?category=<?php echo $cat_id ?>&page=<?php echo $page+1?>">
                    <span>Next</span>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
              </ul>
  <?php } ?>
</div>
</div>
</section>
<?php include("footer.php");?>