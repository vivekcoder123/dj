<?php
include("header.php");
$slug=$_GET['name'];
$video=mysqli_query($connect,"SELECT * FROM video WHERE slug='$slug' ");
$row=mysqli_fetch_assoc($video);
$cat_id=$row['category_id'];
$latest3=mysqli_query($connect,"SELECT * FROM video WHERE category_id='$cat_id' 
ORDER BY ID DESC LIMIT 3 ");
?>
<section>
<div class="container clearfix padd-top-md">
<div class="col-md-9">
<div class="clearfix"></div>
<div class="blocktitle title">
<span class="bold"><?php echo $row['name'] ?></span>
</div>
<div class="clearfix padd-bottom-xs"></div>
<div class="embed-responsive embed-responsive-16by9 padd-top-xxs padd-bottom-xs">
<?php echo $row['link'] ?>
</div>
<div class="padd-top-xs mt-description">
<p>Song: <?php echo $row['name'] ?> <br />Remix By: <?php echo $row['remix_by'] ?> <br />Release By: <?php echo $row['release_by'] ?></p>
</div>
<div class="clearfix padd-bottom-xs"></div>
<div class="row">
<div class="col-xs-12 padd-bottom-xs">
<div class="sharethis-inline-share-buttons"></div>
</div>
<div class="col-xs-12">
<div class="blocktitle title">
<span class="light">Comments</span>
</div>
<?php if(!isset($_SESSION['profile'])){ ?>
<p style="margin-top: 15px;" class="alert alert-danger"><strong><a href="login">Login</a></strong> to post comment</p>
<?php }else{ ?>
<form>
<div class="col-xs-12">
<div class="padd-top-xs d-t">
<div class="child text-center">
<img src="<?php echo $_SESSION['profile']['image']?>" alt="" class="img-circle" width="32px" height="32px">
<br>
<span class="title"><?php echo $_SESSION['profile']['name']?></span>
</div>
<div class="child">
<textarea name="comment" id="commentText" rows="2" class="form-control pull-left user-comment"></textarea>
</div>
</div>
<div class="padd-top-xxs pull-right">
<a type="button" class="btn btn-primary pull-right post" id="commentPost">Post</a>
<input type="reset" id="reset" style="display:none;">
</div>
</div>
</form>
<?php } ?>
</div>
</div>
<div class="clearfix"></div>
<div class="row" id="comments">
<?php 
$comments=mysqli_query($connect,"SELECT * FROM video_comments WHERE video_slug='$slug' ORDER BY ID DESC ");
while($comt=mysqli_fetch_assoc($comments)){
?>
<div class="col-xs-12 padd-top-xs comment-markup">
<img alt="" class="img-circle pull-left user-profile" src="<?php echo $comt['user_image']?>" width="32px">
<p class="pull-left" style="margin-left: 15px; width: -webkit-calc(100% - 73px);">
<small class="user-name"><?php echo $comt['user_name'] ?></small>&nbsp;&nbsp;
<?php 
if(isset($_SESSION['profile'])){
if($_SESSION['profile']['name']==$comt['user_name']){ ?>
<a class="text-muted edit-comment label label-info btn-pill" data-comment-id="<?php echo $comt['id']?>" id="edit">Edit&nbsp;<i class="glyphicon glyphicon-edit"></i>
</a>
<?php }} ?>
<small class="text-muted date pull-right">&nbsp;<?php echo date("F jS, Y", strtotime($comt['created_at'])); ?></small>
<br>
<span class="comment"><?php echo $comt['text'] ?></span>
</p>
</div>
<?php } ?>
</div>
<div id="editCommentModal" class="modal" role="dialog" aria-hidden="false">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">×</button>
<h4 class="modal-title">Edit Comment</h4>
</div>
<div class="modal-body">
<input type="hidden" id="commentId" value="">
<div class="form-group">
<label for="edit-comment">Comment</label>
<textarea name="comment" id="edit-comment" cols="30" rows="10" class="form-control saveComment"></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" id="saveComment">Save</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="padd-bottom-xs">
<div class="blocktitle title">
<span class="bold">Latest</span>
<span class="light">Videos</span>
 </div>
</div>
<?php 
while($lats=mysqli_fetch_assoc($latest3)){
?>
<div class="single-album padd-bottom-xs">
<a href="video_single.php?name=<?php echo $lats['name']?>" class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $lats['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
<div class="overlay cover-image"></div>
<span class="date-relased title">
<span><?php echo date("F jS, Y", strtotime($lats['created_at'])); ?></span>
</span>
<span class="playbutton">
<img src="img/play_white.svg" height="60">
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs">
<?php echo $lats['name'] ?>
</div>
</a>
</div>
<?php } ?>
</div>
</div>
</section>
<section class="padd-top-md"></section>
<?php include("footer.php");?>
<script type="text/javascript">
  $(document).ready(function(){

    $(document).on("click","#commentPost",function(){
      var commentText=$("#commentText").val();
      var video_slug="<?php echo $slug ?>";
      $.ajax({
        url: 'commentPost.php',
        type: 'POST',
        data: {commentVideo:commentText,video_slug:video_slug},
      })
      .done(function(data) {
        toastr.success('Thanks for your valuable comment', 'Success!');
        $("#reset").trigger("click");
        $("#comments").html(data);
      })
      .fail(function(data) {
        toastr.error('Your comment can not be empty', 'Error!');
      })
    });

    $(document).on("click","#edit",function(){
      var videoEdit=$(this).data("comment-id");
        $.ajax({
        url: 'commentPost.php',
        type: 'GET',
        data: {videoEdit:videoEdit},
      })
      .done(function(data) {
        data=JSON.parse(data);
        $("#edit-comment").html(data[0]);
        $("#commentId").val(data[1]);
      })
      .fail(function(data) {
        toastr.error('Some internal server problem occured', 'Error!');
      });
      $("#editCommentModal").modal("show");
    });

    $(document).on("click","#saveComment",function(){
      var savedComment=$(".saveComment").val();
      var commentId=$("#commentId").val();
      var slug="<?php echo $slug?>";
      $.ajax({
        url: 'commentPost.php',
        type: 'POST',
        data: {savedVideo:savedComment,commentId:commentId,slug:slug},
      })
      .done(function(data) {
        toastr.success('Comment has been updated successfully', 'Success!');
        $("#comments").html(data);
      })
      .fail(function(data) {
        toastr.error('Comment can not be saved', 'Error!');
      });
      $("#editCommentModal").modal("hide");
    });

  });
</script>