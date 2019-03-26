<?php 
include("header.php");
$slug=$_GET['name'];
$news=mysqli_query($connect,"SELECT * FROM news WHERE slug='$slug' ");
$row=mysqli_fetch_assoc($news);
$latest3=mysqli_query($connect,"SELECT * FROM news ORDER BY ID DESC LIMIT 3 ");
?>
<section>
<div class="container clearfix ">
<div class="col-md-9 padd-top-md padd-bottom-xs">

<div class="clearfix"></div>
<div class="blocktitle title ">
<span class="light"><?php echo $row['name'] ?></span>
</div>
<p class="padd-bottom-xxs&quot;">
<small class="text-muted"><?php echo date("F jS, Y", strtotime($row['created_at'])); ?></small>
</p>
<img src="<?php echo $row['image']?>" alt="<?php echo $row['name']?>" width="100%">
<div class="padd-top-md mt-description">
<p><?php echo $row['description'] ?></p>
</div>
<div class="row">
<div class="col-xs-12 padd-bottom-xs">
<div class="sharethis-inline-share-buttons st-left  st-inline-share-buttons st-animated" id="st-1"><div class="st-total st-hidden">
  <span class="st-label"></span>
  <span class="st-shares">
    Shares
  </span>
</div><div class="st-btn st-first" data-network="facebook" style="display: inline-block;">
  <svg fill="#fff" preserveAspectRatio="xMidYMid meet" height="1em" width="1em" viewBox="0 0 40 40">
  <g>
    <path d="m21.7 16.7h5v5h-5v11.6h-5v-11.6h-5v-5h5v-2.1c0-2 0.6-4.5 1.8-5.9 1.3-1.3 2.8-2 4.7-2h3.5v5h-3.5c-0.9 0-1.5 0.6-1.5 1.5v3.5z"></path>
  </g>
</svg>
  
</div><div class="st-btn" data-network="twitter" style="display: inline-block;">
  <svg fill="#fff" preserveAspectRatio="xMidYMid meet" height="1em" width="1em" viewBox="0 0 40 40">
  <g>
    <path d="m31.5 11.7c1.3-0.8 2.2-2 2.7-3.4-1.4 0.7-2.7 1.2-4 1.4-1.1-1.2-2.6-1.9-4.4-1.9-1.7 0-3.2 0.6-4.4 1.8-1.2 1.2-1.8 2.7-1.8 4.4 0 0.5 0.1 0.9 0.2 1.3-5.1-0.1-9.4-2.3-12.7-6.4-0.6 1-0.9 2.1-0.9 3.1 0 2.2 1 3.9 2.8 5.2-1.1-0.1-2-0.4-2.8-0.8 0 1.5 0.5 2.8 1.4 4 0.9 1.1 2.1 1.8 3.5 2.1-0.5 0.1-1 0.2-1.6 0.2-0.5 0-0.9 0-1.1-0.1 0.4 1.2 1.1 2.3 2.1 3 1.1 0.8 2.3 1.2 3.6 1.3-2.2 1.7-4.7 2.6-7.6 2.6-0.7 0-1.2 0-1.5-0.1 2.8 1.9 6 2.8 9.5 2.8 3.5 0 6.7-0.9 9.4-2.7 2.8-1.8 4.8-4.1 6.1-6.7 1.3-2.6 1.9-5.3 1.9-8.1v-0.8c1.3-0.9 2.3-2 3.1-3.2-1.1 0.5-2.3 0.8-3.5 1z"></path>
  </g>
</svg>
  
</div><div class="st-btn" data-network="googleplus" style="display: inline-block;">
  <img src="https://platform-cdn.sharethis.com/img/googleplus.svg">
  
</div><div class="st-btn st-last" data-network="whatsapp" style="display: inline-block;">
  <img src="https://platform-cdn.sharethis.com/img/whatsapp.svg">
  
</div></div>
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
$comments=mysqli_query($connect,"SELECT * FROM news_comments WHERE news_slug='$slug' ORDER BY ID DESC ");
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
<div class="col-md-3 padd-top-md padd-bottom-xs">
<div class="blocktitle title">
<span class="light">Latest News</span>
</div>
<?php 
while($lats=mysqli_fetch_assoc($latest3)){
?>
<div class="padd-top-xxs single-album ">
<a href="feed.php?name=<?php echo $lats['slug']?>" class="music-wrapper">
<div class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $lats['image']?>" alt="Image not available" class="img-responsive center-block">
<span class="date-relased title" style="height:243px;width:100%;">
<span>Read more</span>
</span>
</div>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $lats['name'] ?></div>
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
      var news_slug="<?php echo $slug ?>";
      $.ajax({
        url: 'commentPost.php',
        type: 'POST',
        data: {commentNews:commentText,news_slug:news_slug},
      })
      .done(function(data) {
        toastr.success('Thanks for your valuable comment', 'Success!');
        $("#reset").trigger("click");
        $("#comments").html(data);
      })
      .fail(function(data) {
        toastr.error('Your comment can not be empty', 'Error!');
      });
    });

    $(document).on("click","#edit",function(){
      var newsEdit=$(this).data("comment-id");
        $.ajax({
        url: 'commentPost.php',
        type: 'GET',
        data: {newsEdit:newsEdit},
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
        data: {savedNews:savedComment,commentId:commentId,slug:slug},
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