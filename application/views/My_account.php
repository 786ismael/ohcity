
<?php include('include/header.php');?>

<?php
$userData = $this->session->userdata('users');
if(empty($userData)){
  $userId = '';
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

<style>

/*user profile css start*/
.userdrop .dropdown-menu{
  left: inherit;
  right: 0px;
  padding: 0px;
  border-radius: 0px;
  top: 42px;
}
.userdrop .dropdown-menu li{
  display: block !important;
  padding: 0px !important;
}
.userdrop .dropdown-menu li a{
color: #5d5d5d !important;
    text-transform: uppercase;
    padding: 14px !important;
    border-bottom: 1px solid #d6d3d3;
}
.userdrop .dropdown-menu li:last-child a{
border: none;
}
.userdrop span{
    margin-right: 6px;
}
.main-prof{
  background-color: #fff;
}
.user-profile{
  margin: 40px;
}
.user-photos img{
width: 200px;
}
.photos-content h1{
     font-size: 22px;
    text-transform: capitalize;
}
.photos-content ul li a{
   color: #8a8686;
  font-size: 14px;
}
.photos-content ul li a i{
margin-right:2px;
}
.photos-content p{
    color: #8a8686;
    font-size: 14px;
    margin-top: 19px;
}
.ads-sold li{
    background-color: #34495e;
    text-align: left;
    width: 31%;
       padding: 14px 0 14px 17px;
    margin-right: 10px;
        font-size: 26px;
        color: #fff;
}
.ads-sold li span{
   font-size: 15px;
   text-transform: uppercase;
}
.ads-sold{
  margin-top: 50px;
}
.ads-sold li:nth-child(2){
  background-color: #3498db;
}
.ads-sold li:nth-child(3){
  background-color: #1abc9c;
}
.profile-tabs .nav-tabs{
 border-top: 1px solid #f1f1f1;
 border-bottom: none;
}
.profile-tabs .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
  border: none;
  color: red;
} 
.profile-tabs .nav-tabs>li>a:hover{
  border: none;
  background: none;
}
.nav-tabs>li>a{
    border: 0px;
    color: #555;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 600;
        padding: 15px 0;
}
.nav-tabs>li{
      border-right: 1px solid #f1f1f1;
      width: 14%;
      text-align: center;
}
.tabs-bar20{
  background-color: #fff;
  padding: 20px;
  margin-top: 30px;
}
.tabs-bar20 h1{
 font-size: 20px;
 margin: 0px;
 padding: 0px;
}
.tabls-d td{
padding: 10px 0 !important;
    font-size: 14px;
}
.tabls-d table{
width: 40%;
margin-top: 20px;
}
.edit-form{
  margin-top: 20px;
}
.edit-form .form-control{
      border-radius: 0px;
    box-shadow: none;
    height: 42px;
    border-color: #ccc;
}
.edit-form textarea{
  height: 201px !important;
}
.image-deit img{
     width: 200px;
    height: 200px;
    min-width: 100%;
    min-height: 100%;
    object-fit: cover;
}

.image-deit input{
      position: absolute;
    visibility: hidden;
}
.btn-up button{
  background-color:#f60;
  border-radius: 0px;
}
/*user profile css end*/
</style>


<section class="user-profile">
 <div class="container">
  <div class="main-prof">
   <div class="clearfix">
    <div class="col-md-6 no-padding">
    <div class="row">


      <div class="col-md-5 ">
      <div class="user-photos">
      <img src="<?php echo $no_img;?>" alt=""> 
     </div> 
      </div>

   <div class="col-md-6">
    <div class="photos-content">
     <h1><?php echo $userData['username']; ?></h1> 
     <ul class="list-inline">
      <li><a href="#"><i class="fa fa-user"></i> Profile</a></li> 
      <li><a href="#"><i class="fa fa-edit"></i> Edit Profile</a></li> 
     </ul>
     <p>You last logged in at: 6 days Ago</p>
    </div> 
   </div>

    </div>
  
    </div> 

<div class="col-md-6">
 <div class="ads-sold">
  <ul class="list-inline">
  <li>0 <br> <span>ad Sold</span></li>  
  <li>0 <br> <span>Total Listings</span></li>  
  <li>0 <br> <span>Inactve ads</span></li>  
  </ul> 
 </div> 
</div>


   </div> 

<div class="clearfix">
 <div class="profile-tabs">
    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">My Ads</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Inactive Ads</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Featured Ads</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Fav Ads</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Fav Ads</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Packages</a></li>
  </ul>
 </div> 
</div>

  </div> 


<div class="tabs-bar20" id="mangepro">
 <h1>Manage Your Profile</h1> 
      <?php $data=$this->webservice_model->get_where('users',['id'=>$userId]);
      foreach ($data as $key => $value) 
      {

           ?>
 <div class="tabls-d"> 
                  <table class="table table-user-information">
                    <tbody>

                      <tr>
                        <td><strong>Your name</strong></td>
                        <td><?php echo $value['username']?></td>
                      </tr>

                      <tr>
                        <td><strong>Email Address</strong></td>
                        <td><?php echo $value['email']?></td>
                      </tr>

                      <tr>
                         <td><strong>Phone Number</strong></td>
                        <td><?php echo $value['phone']?></td>
                      </tr>

                         
                   
                    </tbody>
                  </table>
                  
                </div>
                <?php }?>
</div>


<div class="tabs-bar20" style="display: none;" id="editshow">
 <h1>Edit Profile</h1> 
 <div class="edit-form">
   <?php $data=$this->webservice_model->get_where('users',['id'=>$userId]);
      foreach ($data as $key => $value) 
      {

           ?>
  <form class="row" method="post" action="<?php echo base_url('home/editAccount');?>"  name="sellerAccount" enctype="multipart/form-data">
   <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $userId;?>">
<div class="row">

    <div class="form-group col-md-6">
    <label>Your Name</label>
    <input type="text" class="form-control"  placeholder="" name="username" value="<?php echo $value['username'];?>">
  </div>

   <div class="form-group col-md-6">
    <label>Email Address *</label>
    <input type="email" class="form-control"  placeholder="" name="email" value="<?php echo $value['email'];?>">
  </div>

 <div class="form-group col-md-6">
    <label>Contact Number*</label>
    <input type="text" class="form-control"  placeholder="" name="phone" value="<?php echo $value['phone'];?>">
  </div>

   

  


 

  

   <div class="form-group col-md-6">
    <label>Profile Picture *</label>
    <div class="image-deit">
      <label for="for20">
       <input type="file" onchange="imagech(this,'img');" id="for20" name="image"> 
       <img id="img" src="<?php echo $no_img;?>" name="image">
      </label>
    </div>
  </div>


</div>

<div class="text-center btn-up">
   <button type="submit" class="btn btn-default">Update</button>
</div>
 
</form>
<?php }?>
 </div>
</div>


<div class="tabs-bar20" style="display: none;" id="tabsdis">

 <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home"> <h1>No Result Found1.</h1> </div>
    <div role="tabpanel" class="tab-pane" id="profile"> <h1>No Result Foun1d.</h1> </div>
    <div role="tabpanel" class="tab-pane" id="messages">...</div>
    <div role="tabpanel" class="tab-pane" id="settings">...</div>
  </div>


</div>

 </div> 
</section>
