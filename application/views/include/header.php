
<?php $this->session->flashdata('welcome');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetsf/css/custom.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- 	<link href="https:/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="<?php echo base_url();?>assetsf/js/jquery-1.11.1.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<title>Dove Cot Market</title>
</head>
<body>
	<!-----------------------------HEADER SECTION START------------------------------>
	<header>
		<style type="text/css">
			.terms-conditions-page {
    background: #fff;
    padding: 30px;
    margin: 15px;
    box-shadow: 0px 0px 50px #c7c7c7; border-radius: 5px; 
}

		</style>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<a href="<?php echo base_url();?>" title="Dove Cot Market">
						<img src="<?php echo base_url('assetsf/images/images/logo-dove-cot-market.png');?>" alt="Dove Cot Market" title="Dove Cot Market">
					</a>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<div>
						<span class="searchbar" style="padding-left:95px">
							<span class="bar"><i class="fas fa-search"></i></span>
							<input type="text" name="Search" placeholder="Search" class="search">
							<input type="submit" class="btn" value="Search">
						</span>
						<ul class="topbar">
							<?php $userData = $this->session->userdata('users');
                             if(empty($userData)){?> 
                                <li style="margin-top: 10px;"><a href="<?php echo base_url('home/view_load/sign-in');?>" title="My Account"><i class="fas fa-sign-in-alt"></i>Sign In</a></li>
							<li><a href="<?php echo base_url('home/view_load/sign_up');?>" title="My Account"><i class="fas fa-user-plus"></i> Sign Up</a></li>

	                             
								<?php }else{?>

								<li class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Category"><i class="fas fa-user"></i>
						         My Account
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						        	
                                      
                                     
						          <a class="dropdown-item" href="<?php echo base_url();?>home/view_load/addsetting" title="Category 1">Ads</a>
						          <a class="dropdown-item" href="" title="Category 1">Message</a>
						         
						          <a class="dropdown-item" href="<?php echo base_url();?>home/view_load/addpost" title="Category 1">Add post</a>
						          <a class="dropdown-item" href="<?php echo base_url('home/logout');?>" title="Category 1">Logout</a>
						         
												        </div>
						      </li>
									
								<?php
							      }
							     ?>
							
							
							
							<li><a href="#" title="My Cart"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
			<!-- 				<li>
								<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
							</li> -->

                       
						</ul>
					</div>
					<div>
						<nav class="navbar navbar-expand-lg navbar-light">
						   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="navbar-toggler-icon"></span>
						  </button>
						  <div class="collapse navbar-collapse" id="navbarNavDropdown">
						    <ul class="navbar-nav">
						      <li class="nav-item">
						        <a class="nav-link" href="<?php echo base_url();?>" title="Home">Home <span class="sr-only">(current)</span></a>
						      </li>
						      <!--    <li class="nav-item">
						        <a class="nav-link" href="" title="About Us">Sevices</a>
						      </li> -->
						      <li class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Category">
						          Category
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						        	<?php $category=$this->webservice_model->get_all('category');
                                      foreach ($category as $key => $value) {
                                      
                                      
						        	?> 
						          <a class="dropdown-item" href="<?php echo site_url('home/view_load/productpage/'.$value['id']);?>" title="Category 1"><?php echo $value['category_name']?></a>
						           <?php  
						            }?>
												        </div>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="<?php echo base_url('home/view_load/about_us');?>" title="About Us">About Us</a>
						      </li>
						   <!--    <li class="nav-item">
						        <a class="nav-link" href="<?php echo base_url('home/view_load/contact_us');?>" title="Contact Us">Contact Us</a>
						      </li> -->
						    </ul>
						  </div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-----------------------------HEADER SECTION CLOSE------------------------------>