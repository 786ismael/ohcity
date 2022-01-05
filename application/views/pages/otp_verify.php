<article>
		<div class="container">
			<div class="row">
				<div class="col-md-6 box-sign">
				<form method="post" action="<?php echo base_url('homepage/user_otp');?>" id="otp_form">
					<h3>Otp Form</h3><hr>

					<label>Phone*</label>
					<input type="text" name="phone" id="phone" placeholder="Phone Number" value="<?php echo isset($_GET['phone'])?$_GET['phone']:'';?>">

					<label>Otp Code*</label>
					<input type="text" name="code" id="code" placeholder="Code">

					<ul>
						<li><label><a href="<?php echo base_url('homepage/login');?>" style="width: auto;">Login</a></label></li>
					</ul>
					<br><br>

					<div style="text-align: center;"><input type="submit" name="submit_otp" value="Submit Otp" style="background-color: rgba(27,179,245,.8); width: 40%; color: #fff;"></div>
					</form>
				</div>
			</div>
		</div>
</article>