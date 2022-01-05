<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<!-- Latest compiled and minified CSS -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontcss/css/custom.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<header>
	<div class="clearfix">
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="left-box">
							<ul>
								<li><i class="fa fa-phone"></i><a href="#" title="">000-123-4567</a> </li>
								<li><i class="fa fa-envelope"></i><a href="#" title="">info@demo.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-5">
						<div class="right-box">
							<ul>
								<li><a href="#" title=""><i class="fa fa-facebook-f"></i></a></li>
								<li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" title=""><i class="fa fa-instagram"></i></a></li>
								<li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
		</div>
		</div>
	</div>
	<div class="clearfix">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="<?php echo base_url('homepage/');?>"><img src="<?php echo base_url();?>assets/frontcss/images/cot.png" alt="" title="" width="70%"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('homepage/');?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Service
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Service 1</a>
          <a class="dropdown-item" href="#">Service 2</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Service 3</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#">Contact Us</a>
      </li>
      <li class="nav-item new"><a class="btn btn-outline-success my-2 my-sm-0 top-ad" href="<?php echo base_url('homepage/ads');?>"><i class="fa fa-edit"></i> Submit A New Ad</a></li>
      <li class="nav-item new"><a class="btn btn-outline-success my-2 my-sm-0 top-ad" href="<?php echo base_url('homepage/ads_list');?>"><i class="fa fa-edit"></i> Listings</a></li>
      <?php
       $logged_inuser = $this->session->userdata('logged_in');
       if(!empty($logged_inuser))
       {
       	?>
       	<li class="nav-item new"><a class="btn btn-outline-success my-2 my-sm-0 toplog" href="<?php echo base_url('homepage/logout');?>"><i class="fa fa-file-text"></i> | Logout</a></li>
       	<?php

       }
       else
       {
      ?>
      <li class="nav-item new"><a class="btn btn-outline-success my-2 my-sm-0 toplog" href="<?php echo base_url('homepage/signup');?>"><i class="fa fa-file-text"></i> | Register</a></li>
      <li class="nav-item new"><a class="btn btn-outline-success my-2 my-sm-0 toplog" href="<?php echo base_url('homepage/login');?>"><i class="fa fa-sign-in"></i> | Login</a></li>
      <?php } ?>
    </ul>
  </div>
</nav>
</div>
</div>
</header>
<style>
img.d-block.w-100 {
    height: 400px !important;
}
</style>