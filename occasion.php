<?php 

include("header.php");
$slug=$_GET['name'];
$event=mysqli_query($connect,"SELECT * FROM events WHERE slug='$slug' ");
$row=mysqli_fetch_assoc($event);
$latest3=mysqli_query($connect,"SELECT * FROM events ORDER BY ID DESC LIMIT 3 ");

?>
<section>
<div class="container clearfix ">
<div class="row  padd-top-md padd-bottom-xs">
<div class="col-sm-9">
<div class="blocktitle title">
<span class="light"><?php echo $row['name'] ?></span>
</div>
<div class="col-sm-5">
<img class="padd-top-xs padd-bottom-xs" src="admin/photos/<?php echo $row['image']?>" alt="<?php echo $row['name'] ?>" width="100%">

<button type="button" class="btn btn-md btn-black-border btn-block" data-toggle="modal" data-target="#myModal">
Book Ticket
</button>
<div class="padd-top-xs">
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
</div>
<div class="col-sm-7 mt-description">
<p><br><br><br><?php echo $row['name']?> - <?php echo $row['artist_name'] ?></p>
<p><?php echo date("F jS, Y", strtotime($row['event_date'])); ?></p>
<p><?php echo $row['venue'] ?></p>
<p>
<strong style="text-decoration:underline;">About Event</strong>
<br>
<?php echo $row['description'] ?>
</p>
</div>
</div>
<div class="col-md-3">
<div class="blocktitle title ">
<span class="light">Related Events</span>
</div>
<?php 
while($lats=mysqli_fetch_assoc($latest3)){
?>
<div class="padd-top-xxs single-album ">
<a href="occasion.php?name=<?php echo $lats['slug']?>" class="music-wrapper">
<div class="image-wrapper ">
<img src="admin/photos/<?php echo $lats['image']?>" class="img-responsive center-block" 
style="height:243px;width:100%;">
<span class="date-relased title">
<span>Read more</span>
</span>
</div>
<div class="title text-center bg-off padd-top-xxs padd-bottom-xxs"><?php echo $lats['name'] ?></div>
</a>
</div>
<?php } ?>
</div>
</div>
</div>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<form class="modal-content" id="bookEvent" name="bookEvent">
<input type="hidden" name="event" value="222">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Booking ticket for <?php echo $row['name'] ?></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-12">
<p class="alert alert-success padd-top-xxs padd-bottom-xxs scb" style="display:none;">
We'he received your enquiry. Thank you for contacting.
</p>
<p class="alert alert-danger padd-top-xxs padd-bottom-xxs erb" style="display:none;">
Oops! something went wrong. Please enter valid information and try submitting again.
</p>
</div>
<div class="col-sm-4">
<div class="form-group">
<label>First Name*</label>
<input type="text" class="form-control" name="first_name" required>
</div>
</div>
<div class="col-sm-5">
<div class="form-group">
<label>Last Name*</label>
<input type="text" class="form-control" name="last_name" required>
</div>
</div>
<div class="col-sm-3">
<div class="form-group">
<label>Attendees*</label>
<select name="attendees" class="form-control" required>
<option selected disabled="">Choose</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="email">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Phone*</label>
<input type="text" class="form-control" name="phone" required>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label>Message</label>
<textarea name="msg" cols="6" class="form-control"></textarea>
</div>
</div>
<div class="col-sm-12">
<small class="text-muted">*Our representatives will call you within 24 hours</small>
</div>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Submit</button>
<input type="reset" id="reset" style="display:none;">
</div>
</form>
</div>
</div>
<section class="padd-top-md"></section>
<?php include("footer.php");?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#bookEvent").submit(function(event){
            event.preventDefault();
            var first_name=$("input[name=first_name]").val();
            var last_name=$("input[name=last_name]").val();
            var attendees=$("select[name=attendees]").val();
            var email=$("input[name=email]").val();
            var phone=$("input[name=phone]").val();
            var msg=$("textarea[name=msg]").val();
            var event_name="<?php echo $row['name']?>";
            $.ajax({
                url: 'booking.php?event=true',
                type: 'POST',
                data: {first_name,last_name,attendees,email,phone,msg,event_name},
            })
            .done(function() {
                $(".scb").show();
                $(".erb").hide();
                $("#reset").trigger("click");
            })
            .fail(function() {
                $(".erb").show();
                $(".scb").hide();
            });
            
        });
    });
</script>