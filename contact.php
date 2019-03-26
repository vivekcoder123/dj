<?php include("header.php");?>
<section>
<div class="container clearfix" style="margin-top:60px;">

<div class="col-md-12 padd-bottom-xs">
<div class=" title text-center">
<h1 style="margin-top:0px;"><span class="bold">Contact us</span></h1>
</div>
</div>
<form class="row" name="contact" id="contact">
<div class="col-xs-12">
</div>
<div class="col-sm-6">
<div class="form-group">
<label>First Name*</label>
<input type="text" class="form-control" name="first_name" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Last Name*</label>
<input type="text" class="form-control" name="last_name" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="email" required>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Phone*</label>
<input type="text" class="form-control" name="phone" required>
</div>
</div>
<div class="col-sm-12 padd-bottom-xxs">
<div class="form-group">
<label>Message*</label>
<textarea name="msg" cols="6" class="form-control" required></textarea>
<small class="text-muted">*Our representatives will call you within 24 hours</small>
<div class="alert alert-info text-center bold" style="display:none;" id="messageLoading">Please wait , Message is sending...</div>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">Submit</button>
<input type="reset" id="reset" style="display:none;">
</div>
</div>
</form>


</div>
</section>
<section class="padd-top-md"></section>
<?php include("footer.php");?>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("submit","#contact",function(event){
			event.preventDefault();
			var first_name=$("input[name=first_name]").val();
			var last_name=$("input[name=last_name]").val();
			var email=$("input[name=email]").val();
			var phone=$("input[name=phone]").val();
			var msg=$("textarea[name=msg]").val();
			$.ajax({
				url: 'contactSubmit.php',
				type: 'POST',
				data: {first_name:first_name,last_name:last_name,email:email,phone:phone,msg:msg},
				beforeSend:function(){
					$("#messageLoading").show();
				}
			})
			.done(function() {
				toastr.success('We have received your query,we will try to reply you as soon as possible', 'Success!');
				$("#reset").trigger("click");
				$("#messageLoading").hide();
			}).fail(function() {
				toastr.error('Oops! something went wrong. Please enter valid information and try submitting again', 'Error!');
				$("#messageLoading").hide();
			});			
		});
	});
</script>