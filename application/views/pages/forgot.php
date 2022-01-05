<article>
	<div class="container">
		<div class="row">
			<div class="col-md-6 box-sign">
				<form method="post" action="<?php echo base_url('homepage/user_login');?>" id="login_form">
					<h3>Forgot</h3><hr>
					<label>Enter Your Email Address*</label>
					<input type="Email" name="email" placeholder="Enter Your Email Address">

					<ul>
						<li><label><a href="<?php echo base_url('homepage/login');?>" style="width: auto;">Login</a></label></li>
					</ul>
					<br><br>

					<div style="text-align: center;"><input type="submit" name="submit_login" value="Forgot Password" style="background-color: rgba(27,179,245,.8); width: 40%; color: #fff;"></div>
				</form>
			</div>
		</div>
	</div>
</article>