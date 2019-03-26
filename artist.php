<?php 

include("header.php");
$cat_id=$_GET['category'];
$category=mysqli_query($connect,"SELECT * FROM artist_categories WHERE id='$cat_id' ");
$cats=mysqli_fetch_assoc($category);

?>
<section>
<div class="container clearfix ">
<div class="col-md-12 col-xs-12 padd-top-md padd-bottom-xs">
<div class="col-sm-6 col-xs-12 blocktitle title ">
<span class="light"><?php echo $cats['name'] ?></span>
</div>
<div class="col-sm-6 col-xs-12">
<span class="dropdown pull-right" style="margin-top:10px !important; margin-bottom:10px !important;">
<a type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Choose Category
<span class="caret"></span>
</a>
<ul class="dropdown-menu" aria-labelledby="dLabel">
<?php 
$artist_categories=mysqli_query($connect,"SELECT * FROM artist_categories");
while($rowa=mysqli_fetch_assoc($artist_categories)){
?>
<li><a href="artist.php?category=<?php echo $rowa['id']?>"><?php echo ucwords($rowa['name']) ?></a></li>
<?php } ?>
</ul>
</span>
</div>
</div>
<?php 
 $artists=mysqli_query($connect,"SELECT * FROM artist WHERE category_id='$cat_id' ");
  $rows=mysqli_num_rows($artists);
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
                  $artists =  mysqli_query($connect,"SELECT * FROM artist WHERE category_id='$cat_id' LIMIT ".($page-1)*$per_page.",".$per_page." ");
while($row=mysqli_fetch_assoc($artists)){
?>
<div class="col-md-3 col-sm-6 col-xs-12 padd-top-xxs single-album ">
<a href="artist-detail.php?name=<?php echo $row['slug']?>" class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $row['image']?>" class="img-responsive center-block" 
style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span>know more</span>
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $row['name'] ?></div>
</a>
</div>
<?php 
  } 
 }else{
 	 echo "<h3 class='text-center text-danger' style='font-weight:bold;'>No artist is available yet in <span class='light' style='text-transform:uppercase;'>".$cats['name']."</span> category</h3>";
 }	
?>
<div class="col-md-12 col-xs-12 padd-top-md  text-center">
<?php if($rows>12){ ?>
<ul class="pagination">
                <li>
                  <a href="artist.php?category=<?php echo $cat_id ?>&page=<?php echo $page-1?>">
                    <span>Prev</span>
                    <i class="fa fa-angle-left"></i>
                  </a>
                </li>
                
              <?php echo $middleNumbers;?>
                <li>
                  <a href="artist.php?category=<?php echo $cat_id ?>&page=<?php echo $page+1?>">
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