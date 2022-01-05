<style type="text/css">

</style>
<article>
	
		<div class="container">
			<div class="row">
				<div class="col-md-6 box-sign">
				<form method="post" action="<?php echo base_url('homepage/user_login');?>" id="login_form">
					<h3>Sign In</h3><hr>
					<label>Enter Your Phone Number*</label>
					<input type="text" name="phone" placeholder="Enter Your Phone Number">

					<label>Enter Your Password*</label>
					<input type="Password" name="password" placeholder="Enter Your Password">
					<ul>
						<li><label><input type="checkbox" name="remember_me" id="" value="remember_me" style="width: auto;"> Remember me!</label></li>
						<li><a href="<?php echo base_url('homepage/forgot');?>">Forgot your Password?</a></li>
					</ul>
					<br><br>

					<div style="text-align: center;"><input type="submit" name="submit_login" value="LOG IN" style="background-color: rgba(27,179,245,.8); width: 40%; color: #fff;"></div>
					</form>
					<button style="background-color: #3d5c98"><i class="fa fa-facebook-f"></i> Sign In with Facebook</button>
					<button style="background-color: #22aadf"><i class="fa fa-envelope"></i> Sign In with Gmail</button>
				</div>
			</div>
		</div>
	
</article>