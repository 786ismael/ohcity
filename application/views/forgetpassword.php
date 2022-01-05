<?php include('include/header.php');?>


<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->	
				<div class="col-md-3"></div>		
<div class="col-md-6  col-sm-6 sign-in" style="padding: 30px 0px;">
	<h4 class="text-center">forget Password</h4>
	<form class="register-form outer-top-xs" role="form" method="post" action="<?php echo base_url('home/forgot_password');?>">
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" class="form-control unicase-form-control text-input" name="email" id="exampleInputEmail1" >
		</div>
	  
		
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button btn-login-20">Login</button>
	</form>	
		<div class="social-sign-in outer-top-xs">
		<div class="text-center">

</div>
		
	</div>				
</div>
<!-- Sign-in -->
<div class="col-md-3"></div>
		</div><!-- /.row -->
		</div><!-- /.sigin-in-->


</div><!-- /.container -->
</div><!-- /.body-content -->
<?php include('include/footer.php');?>