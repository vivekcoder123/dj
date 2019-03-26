<?php 
include("header.php");
$slug=$_GET['name'];
$artist=mysqli_query($connect,"SELECT * FROM artist WHERE slug='$slug' ");
$row=mysqli_fetch_assoc($artist);
$cat_id=$row['category_id'];
$latest3=mysqli_query($connect,"SELECT * FROM artist WHERE category_id='$cat_id' 
ORDER BY ID DESC LIMIT 3 ");
?>
    <section>
        <div class="container clearfix ">
            <div class="col-md-9 padd-top-md padd-bottom-xs">
                <div class="row">
                    <div class="col-md-5">
                        <div class="blocktitle title">
                            <span class="light"><?php echo $row['name']?></span>
                        </div>
                        <img class="padd-top-xs padd-bottom-xs" src="admin/photos/<?php echo $row['image']?>" width="100%" alt="<?php echo $row['name']?>">
                        <div class="padd-bottom-xxs text-center">
                                                    </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-md btn-black-border btn-block" data-toggle="modal" data-target="#myModal">
                            Book Now
                        </button>
                        <!--  Gallery Starts -->
                        <h5 class="title clearfix padd-top-xs padd-bottom-xxs text-center">
                            Photo Gallery
                        </h5>
                        <div class="row lightbox-gallery">
                            <div class="col-xs-12">

                                <?php 
                                    for($i=1;$i<=9;$i++){
                                        if(strlen($row['gallery'.$i])>0){
                                 ?>

                                    <div class="col-xs-4" style="padding:3px;">
                                        <div class="shadow-z3 placeholder">
                                            <a href="admin/photos/<?php echo $row['gallery'.$i]?>" class="open_lightbox_image">
                                                <img alt="image"  class="img-responsive"  src="admin/photos/<?php echo $row['gallery'.$i]?>" style="height:108px;width:100%;">
                                            </a>
                                        </div>
                                    </div>

                                <?php 
                                    }
                                } 
                                ?>
                                                            </div>
                        </div>
                        <div class="padd-top-xs">
                            <div class="sharethis-inline-share-buttons"></div>
                        </div>
                    </div>
                    <div class="col-md-7 padd-top-lg mt-description">
                        <div class="clearfix"></div>
                        <p style="text-align:center;">
                        <strong>ABOUT - <?php echo $row['name']?></strong></p>
<p style="text-align:left;"><?php echo $row['description']?></p>

<?php 
if(strlen($row['album_link'])>0){
?>
<p style="text-align:center;"><strong><span class="text_exposed_show">MUSIC</span></strong></p>
<p style="text-align:center;"><strong>
    <span class="text_exposed_show"><?php echo $row['album_link']?></span></strong></p>
<?php } ?>

<?php
if(strlen($row['video_link1'])>0 || strlen($row['video_link2'])>0 || strlen($row['video_link3'])>0){
?>
<p style="text-align: center;"><strong><span class="text_exposed_show">VIDEOS</span></strong></p>
<?php } ?>

<?php 
if(strlen($row['video_link1'])>0){
?>
<p style="text-align:center;"><strong>
    <span class="text_exposed_show"><?php echo $row['video_link1']?></span></strong></p>
<?php } ?>

<?php 
if(strlen($row['video_link2'])>0){
?>
<p style="text-align:center;"><strong>
    <span class="text_exposed_show"><?php echo $row['video_link2']?></span></strong></p>
<?php } ?>

<?php 
if(strlen($row['video_link3'])>0){
?>
<p style="text-align:center;"><strong>
    <span class="text_exposed_show"><?php echo $row['video_link3']?></span></strong></p>
<?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 padd-top-md padd-bottom-xs">
                <div class="blocktitle title ">
                    <span class="light">Related Artist</span>
                </div>
              <?php 
                while($lats=mysqli_fetch_assoc($latest3)){
               ?>
                   <div class="padd-bottom-xxs padd-top-xs single-album" style="padding-bottom: 0px;padding-top: 10px;">
                        <a href="artist-detail.php?name=<?php echo $lats['name']?>" class="music-wrapper">
                            <div class="image-wrapper ">
                                <img src="admin/photos/<?php echo $lats['image']?>" class="img-responsive center-block" style="height:243px;width:100%;">
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
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="contactArtist" name="contactArtist">
                <input type="hidden" name="artist" value="45">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Booking Form</h4>
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name*</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone*</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Artist</label>
                                <input type="text" value="<?php echo $row['name']?>" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Event Date*</label>
                                <input type="date" name="event_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Type of Event*</label>
                                <select name="event_type" class="form-control" required>
                                    <option selected disabled>Choose</option>
                                    <option value="Club Night">Club Night</option>
                                    <option value="Private Party">Private Party</option>
                                    <option value="Engagement party">Engagement party</option>
                                    <option value="Bachelor's Party">Bachelor's Party</option>
                                    <option value="Wedding Event">Wedding Event</option>
                                    <option value="Post Wedding">Post Wedding</option>
                                    <option value="College Fest">College Fest</option>
                                    <option value="Corporate Event">Corporate Event</option>
                                    <option value="Open Air">Open Air</option>
                                    <option value="Government">Government</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Venue Name*</label>
                                <input type="text" name="venue" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>City*</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Approx Budget in (INR/USD)*</label>
                                <input type="text" name="budget" class="form-control" required>
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
        $("#contactArtist").submit(function(event){
            event.preventDefault();
            var name=$("input[name=name]").val();
            var email=$("input[name=email]").val();
            var phone=$("input[name=phone]").val();
            var artist="<?php echo $row['name']?>";
            var event_date=$("input[name=event_date]").val();
            var event_type=$("select[name=event_type]").val();
            var venue=$("input[name=venue]").val();
            var city=$("input[name=city]").val();
            var country=$("input[name=country]").val();
            var budget=$("input[name=budget]").val();
            $.ajax({
                url: 'booking.php?artist=true',
                type: 'POST',
                data: {name,email,phone,artist,event_date,event_type,venue,city,country,budget},
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