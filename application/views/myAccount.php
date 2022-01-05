

<?php include('include/header.php');?>
  <style type="text/css">
      
      .navbar-nav {
  
     padding-left: none !important;  
    
}
    </style>
<?php
$userData = $this->session->userdata('users');
if(empty($userData)){
	$userId = '';
  redirect('home');
}
else
{
	$userId = $userData['id'];
}


$siteUrl = site_url();
if(empty($userData['image'])){
  $no_img = $siteUrl.'assets/images/No_Image_Available.png';
}
else
{
  $no_img = $siteUrl.'uploads/images/'.$userData['image'];
}

?>
<div class="body-content">
	<div class="container">
		<div class="terms-conditions-page">
			<div class="row">
				<div class="col-md-12 terms-conditions">
	<h2 class="heading-title">My Account</h2>
	
<div class="profile-design">
<div class="container">
      <div class="row">

        <div class=" col-md-8  col-md-offset-2 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                <div class="pro-img-manage">
                <img alt="User Pic" src="<?php echo $no_img;?>" class="img-circle img-responsive">
                </div> 
                <h1><?php echo $userData['username'];?></h1>
                <a href="<?php echo site_url('home/view_load/sellerAccount');?>" class="btn btn-primary">Edit Profile</a>
                </div>
                
           
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>First Name</td>
                        <td><?php echo $userData['username'];?></td>
                      </tr>
                      <!-- <tr>
                        <td>Last Name</td>
                        <td>Sheikh</td>
                      </tr> -->
                      <!-- <tr>
                        <td>Date of Birth</td>
                        <td>01/24/1988</td>
                      </tr> -->
                   
                         <tr>
                             <tr>
                        <td>Phone Number</td>
                        <td><?php echo $userData['phone'];?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?php echo $userData['email'];?>"><?php echo $userData['email'];?></a></td>
                      </tr>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                  

                </div>
              </div>
            </div>
           
            
          </div>
        </div>
      </div>
    </div>	
</div>


</div>			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
		</div>
		</div>
  