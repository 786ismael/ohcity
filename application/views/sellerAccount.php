<?php
$userData = $this->session->userdata('users');
if(empty($userData)){
	//$userId = '';
  redirect('home/view_load/sellerlogin');
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
<style type="text/css">
/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
  box-shadow: 0px 2px 10px #d5cfcf;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
     color: #534a5e;
    font-size: 14px;
    font-weight: 600;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #fff;
  border-left: 2px solid #7c4ff4;
  margin-left: -2px;
  background: #7c4ff4;
    background: -moz-linear-gradient(top, #7c4ff4 0%, #e03fed 100%);
    background: -webkit-linear-gradient(top, #7c4ff4 0%,#e03fed 100%);
    background: linear-gradient(to bottom, #7c4ff4 0%,#e03fed 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7c4ff4', endColorstr='#e03fed',GradientType=0 );
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
  box-shadow: 0px 2px 10px #d5cfcf;
}

.form-design .form-control{
      box-shadow: none;
    border-radius: 0px;
    height: 38px;
}
.title-con p{
  font-size: 18px;
    font-weight: 600;
}

.img-upl-d{
     position: absolute;
    top: 77px;
    visibility: hidden;
}

.img-up-c {
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}

.product-upload{
    border: 3px solid #bdbaba;
    border-radius: 5px;
}

.profile-usermenu ul li:first-child{
  border-top: 1px solid #f0f4f7;
}
</style>
<div class="body-content">
  <div class="container">


<div class="seller-profile">
  <div class="row profile">
    <?php include 'include/sidebar.php';?>
    <div class="col-md-9">
            <div class="profile-content">
      <div class="form-design">

 <div class="title-con">
   <p> Edit Profile</p>
</div>
           <?php $data=$this->webservice_model->get_where('users',['id'=>$userId]);
           foreach ($data as $key => $value) {?>
           
      <form class="row" method="post" action="<?php echo base_url('home/sellerAccount');?>" id="sellerAccount" name="sellerAccount" enctype="multipart/form-data">
  <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $userId;?>">
  <div class="form-group col-md-6">
    <label for="first_name">User Name</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="username" value="<?php echo $value['username'];?>">
  </div>
  <!-- <div class="form-group col-md-6">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Last Name">
  </div> -->

    <div class="form-group col-md-6">
    <label for="phone">Phone Number</label>
    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="mobile" value="<?php echo $value['mobile'];?>">
  </div>

  <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $value['email'];?>" readonly>
  </div>

   <div class="form-group col-md-6">
    <label for="image">Your Photo</label>
    <input type="file" class="form-control" id="image" name="image">
  </div>

<div class="text-center">
  <button type="submit" class="lnk btn btn-primary">Submit</button>
</div>

</form>
<?php   //echo $value['username'];
           }
           ?>
      </div> 
            </div>
    </div>
  </div> 
</div>

  </div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
  
  $(document).ready(function (e){
$("#sellerAccount").on('submit',(function(e){
e.preventDefault();
$.ajax({
url: "<?php echo base_url()?>home/sellerAccount",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
alert(data);
location.reload();
},
error: function(){}           
});
}));
});
</script>