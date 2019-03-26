<?php 
session_start();
ob_start();
require_once("config.php");

if((isset($_POST['savedNews'])&&strlen($_POST['savedNews'])>0) || (isset($_POST['savedMusic'])&&strlen($_POST['savedMusic'])>0) || (isset($_POST['savedVideo'])&&strlen($_POST['savedVideo'])>0)){
$updatedComments="";
$post_slug=$_POST['slug'];
if(isset($_POST['savedNews'])){
$id=$_POST['commentId'];
$pdo->prepare("UPDATE news_comments SET text=? WHERE id=?")->execute([$_POST['savedNews'],$id]);
$commented=mysqli_query($connect,"SELECT * FROM news_comments WHERE news_slug='$post_slug' ORDER BY ID DESC ");
while($comt=mysqli_fetch_assoc($commented)){
$user_image=$comt['user_image'];
$user_name=$comt['user_name'];
$created_at=date("F jS, Y", strtotime($comt['created_at']));
$text=$comt['text'];
$id=$comt['id'];
$updatedComments.=<<<DELIMETER
<div class="col-xs-12 padd-top-xs comment-markup">
<img alt="" class="img-circle pull-left user-profile" src="$user_image" width="32px">
<p class="pull-left" style="margin-left: 15px; width: -webkit-calc(100% - 73px);">
<small class="user-name">$user_name</small>&nbsp;&nbsp;
DELIMETER;
if(isset($_SESSION['profile'])){
if($_SESSION['profile']['name']==$comt['user_name']){
$updatedComments.=<<<DELIMETER
<a class="text-muted edit-comment label label-info btn-pill" data-comment-id="$id" id="edit">Edit&nbsp;<i class="glyphicon glyphicon-edit"></i>
</a>
DELIMETER;
}}
$updatedComments.=<<<DELIMETER
<small class="text-muted date pull-right">&nbsp;$created_at</small>
<br>
<span class="comment">$text</span>
</p>
</div>
DELIMETER;
}
}

if(isset($_POST['savedMusic'])){
$updatedComments="";
$id=$_POST['commentId'];
$pdo->prepare("UPDATE music_comments SET text=? WHERE id=?")->execute([$_POST['savedMusic'],$id]);
$commented=mysqli_query($connect,"SELECT * FROM music_comments WHERE music_slug='$post_slug' ORDER BY ID DESC ");
while($comt=mysqli_fetch_assoc($commented)){
$user_image=$comt['user_image'];
$user_name=$comt['user_name'];
$created_at=date("F jS, Y", strtotime($comt['created_at']));
$text=$comt['text'];
$id=$comt['id'];
$updatedComments.=<<<DELIMETER
<div class="col-xs-12 padd-top-xs comment-markup">
<img alt="" class="img-circle pull-left user-profile" src="$user_image" width="32px">
<p class="pull-left" style="margin-left: 15px; width: -webkit-calc(100% - 73px);">
<small class="user-name">$user_name</small>&nbsp;&nbsp;
DELIMETER;
if(isset($_SESSION['profile'])){
if($_SESSION['profile']['name']==$comt['user_name']){
$updatedComments.=<<<DELIMETER
<a class="text-muted edit-comment label label-info btn-pill" data-comment-id="$id" id="edit">Edit&nbsp;<i class="glyphicon glyphicon-edit"></i>
</a>
DELIMETER;
}}
$updatedComments.=<<<DELIMETER
<small class="text-muted date pull-right">&nbsp;$created_at</small>
<br>
<span class="comment">$text</span>
</p>
</div>
DELIMETER;
}
}

if(isset($_POST['savedVideo'])){
$updatedComments="";
$id=$_POST['commentId'];
$pdo->prepare("UPDATE video_comments SET text=? WHERE id=?")->execute([$_POST['savedVideo'],$id]);
$commented=mysqli_query($connect,"SELECT * FROM video_comments WHERE video_slug='$post_slug' ORDER BY ID DESC ");
while($comt=mysqli_fetch_assoc($commented)){
$user_image=$comt['user_image'];
$user_name=$comt['user_name'];
$created_at=date("F jS, Y", strtotime($comt['created_at']));
$text=$comt['text'];
$id=$comt['id'];
$updatedComments.=<<<DELIMETER
<div class="col-xs-12 padd-top-xs comment-markup">
<img alt="" class="img-circle pull-left user-profile" src="$user_image" width="32px">
<p class="pull-left" style="margin-left: 15px; width: -webkit-calc(100% - 73px);">
<small class="user-name">$user_name</small>&nbsp;&nbsp;
DELIMETER;
if(isset($_SESSION['profile'])){
if($_SESSION['profile']['name']==$comt['user_name']){
$updatedComments.=<<<DELIMETER
<a class="text-muted edit-comment label label-info btn-pill" data-comment-id="$id" id="edit">Edit&nbsp;<i class="glyphicon glyphicon-edit"></i>
</a>
DELIMETER;
}}
$updatedComments.=<<<DELIMETER
<small class="text-muted date pull-right">&nbsp;$created_at</small>
<br>
<span class="comment">$text</span>
</p>
</div>
DELIMETER;
}
}

echo $updatedComments;
return $updatedComments;

}

if((isset($_GET['newsEdit'])&&strlen($_GET['newsEdit'])>0) || (isset($_GET['musicEdit'])&&strlen($_GET['musicEdit'])>0) || (isset($_GET['videoEdit'])&&strlen($_GET['videoEdit'])>0)){
$editedComment="";
if(isset($_GET['newsEdit'])){
$comment_query=mysqli_query($connect,"SELECT * FROM news_comments WHERE id=".$_GET['newsEdit']);
while($comq=mysqli_fetch_assoc($comment_query)){
	$editedComment.=$comq['text'];
}
$commentId=$_GET['newsEdit'];
}

if(isset($_GET['musicEdit'])){
$comment_query=mysqli_query($connect,"SELECT * FROM music_comments WHERE id=".$_GET['musicEdit']);
while($comq=mysqli_fetch_assoc($comment_query)){
	$editedComment.=$comq['text'];
}
$commentId=$_GET['musicEdit'];
}

if(isset($_GET['videoEdit'])){
$comment_query=mysqli_query($connect,"SELECT * FROM video_comments WHERE id=".$_GET['videoEdit']);
while($comq=mysqli_fetch_assoc($comment_query)){
	$editedComment.=$comq['text'];
}
$commentId=$_GET['videoEdit'];
}

$response=[$editedComment,$commentId];
$response=json_encode($response);
echo $response;
return $response;

}

if((isset($_POST['commentNews'])&&strlen($_POST['commentNews'])>0) || (isset($_POST['commentMusic'])&&strlen($_POST['commentMusic'])>0)  || (isset($_POST['commentVideo'])&&strlen($_POST['commentVideo'])>0)){
$comments="";
if(isset($_POST['commentNews'])){
$commentText=$_POST['commentNews'];
$post_slug=$_POST['news_slug'];
$pdo->prepare("INSERT INTO news_comments (text,news_slug,created_at,user_name,user_image) VALUES (?,?,?,?,?)")
->execute([$commentText,$post_slug,date('y-m-d'),$_SESSION['profile']['name'],$_SESSION['profile']['image']]);

$commented=mysqli_query($connect,"SELECT * FROM news_comments WHERE news_slug='$post_slug' ORDER BY ID DESC ");
while($comt=mysqli_fetch_assoc($commented)){
$user_image=$comt['user_image'];
$user_name=$comt['user_name'];
$created_at=date("F jS, Y", strtotime($comt['created_at']));
$text=$comt['text'];
$id=$comt['id'];
$comments.=<<<DELIMETER
<div class="col-xs-12 padd-top-xs comment-markup">
<img alt="" class="img-circle pull-left user-profile" src="$user_image" width="32px">
<p class="pull-left" style="margin-left: 15px; width: -webkit-calc(100% - 73px);">
<small class="user-name">$user_name</small>&nbsp;&nbsp;
DELIMETER;
if(isset($_SESSION['profile'])){
if($_SESSION['profile']['name']==$comt['user_name']){
$comments.=<<<DELIMETER
<a class="text-muted edit-comment label label-info btn-pill" data-comment-id="$id" id="edit">Edit&nbsp;<i class="glyphicon glyphicon-edit"></i>
</a>
DELIMETER;
}}
$comments.=<<<DELIMETER
<small class="text-muted date pull-right">&nbsp;$created_at</small>
<br>
<span class="comment">$text</span>
</p>
</div>
DELIMETER;
}
}
if(isset($_POST['commentMusic'])){
$commentText=$_POST['commentMusic'];
$post_slug=$_POST['music_slug'];
$pdo->prepare("INSERT INTO music_comments (text,music_slug,created_at,user_name,user_image) VALUES (?,?,?,?,?)")
->execute([$commentText,$post_slug,date('y-m-d'),$_SESSION['profile']['name'],$_SESSION['profile']['image']]);

$commented=mysqli_query($connect,"SELECT * FROM music_comments WHERE music_slug='$post_slug' ORDER BY ID DESC ");
while($comt=mysqli_fetch_assoc($commented)){
$user_image=$comt['user_image'];
$user_name=$comt['user_name'];
$created_at=date("F jS, Y", strtotime($comt['created_at']));
$text=$comt['text'];
$id=$comt['id'];
$comments.=<<<DELIMETER
<div class="col-xs-12 padd-top-xs comment-markup">
<img alt="" class="img-circle pull-left user-profile" src="$user_image" width="32px">
<p class="pull-left" style="margin-left: 15px; width: -webkit-calc(100% - 73px);">
<small class="user-name">$user_name</small>&nbsp;&nbsp;
DELIMETER;
if(isset($_SESSION['profile'])){
if($_SESSION['profile']['name']==$comt['user_name']){
$comments.=<<<DELIMETER
<a class="text-muted edit-comment label label-info btn-pill" data-comment-id="$id" id="edit">Edit&nbsp;<i class="glyphicon glyphicon-edit"></i>
</a>
DELIMETER;
}}
$comments.=<<<DELIMETER
<small class="text-muted date pull-right">&nbsp;$created_at</small>
<br>
<span class="comment">$text</span>
</p>
</div>
DELIMETER;
}
}
if(isset($_POST['commentVideo'])){
$commentText=$_POST['commentVideo'];
$post_slug=$_POST['video_slug'];
$pdo->prepare("INSERT INTO video_comments (text,video_slug,created_at,user_name,user_image) VALUES (?,?,?,?,?)")
->execute([$commentText,$post_slug,date('y-m-d'),$_SESSION['profile']['name'],$_SESSION['profile']['image']]);

$commented=mysqli_query($connect,"SELECT * FROM video_comments WHERE video_slug='$post_slug' ORDER BY ID DESC ");
while($comt=mysqli_fetch_assoc($commented)){
$user_image=$comt['user_image'];
$user_name=$comt['user_name'];
$created_at=date("F jS, Y", strtotime($comt['created_at']));
$text=$comt['text'];
$id=$comt['id'];
$comments.=<<<DELIMETER
<div class="col-xs-12 padd-top-xs comment-markup">
<img alt="" class="img-circle pull-left user-profile" src="$user_image" width="32px">
<p class="pull-left" style="margin-left: 15px; width: -webkit-calc(100% - 73px);">
<small class="user-name">$user_name</small>&nbsp;&nbsp;
DELIMETER;
if(isset($_SESSION['profile'])){
if($_SESSION['profile']['name']==$comt['user_name']){
$comments.=<<<DELIMETER
<a class="text-muted edit-comment label label-info btn-pill" data-comment-id="$id" id="edit">Edit&nbsp;<i class="glyphicon glyphicon-edit"></i>
</a>
DELIMETER;
}}
$comments.=<<<DELIMETER
<small class="text-muted date pull-right">&nbsp;$created_at</small>
<br>
<span class="comment">$text</span>
</p>
</div>
DELIMETER;
}
}

echo $comments;

}else{
	http_response_code(405);
}
?>