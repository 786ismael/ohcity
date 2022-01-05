<?php include('include/header.php');?>
<?php $id=$this->uri->segment('4');
 //$idi=$this->session->set_userdata('users',$id);
?>
<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->	
				<div class="col-md-3"></div>		
<div class="col-md-6  col-sm-6 sign-in" style="padding: 30px 0px;">
	<h4 class="text-center">New Password</h4>
	<form class="register-form outer-top-xs" role="form" method="post" action="<?php echo base_url('home/forgotreset');?>">
		<input type="hidden" name="user_id" value="<?php echo $id;?>">
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">password <span>*</span></label>
		    <input type="password" class="form-control unicase-form-control text-input" name="password" id="exampleInputEmail1" >
		    <span class="text-danger" style="color: red;"><?php echo form_error('password'); ?></span>
		</div>

		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Confirm password <span>*</span></label>
		    <input type="password" class="form-control unicase-form-control text-input" name="cpassword" id="exampleInputEmail1" >
		     <span class="text-danger" style="color: red;"><?php echo form_error('cpassword'); ?></span>
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
</div>


<?php include('include/footer.php');?>