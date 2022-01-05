  <!-- SIDEBAR USERPIC -->
  <?php $userData = $this->session->userdata('users');
         $userId = $userData['id'];
    $data=$this->webservice_model->get_where('users',['id'=>$userId]);
           foreach ($data as $key => $value) {
            $siteUrl = site_url();
if(empty($userData['image'])){
 $no_img = $siteUrl.'assetsf/images/user.png';
  
   
}
else
{

 $no_img = $siteUrl.'uploads/images/'.$value['image'];
}
   ?>
        <div class="profile-userpic">
          <img src="<?php echo $no_img;?>" class="img-responsive" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
           <?php echo $value['username'];?>
          </div>
          <div class="profile-usertitle-job">
        UserName
          </div>
        </div>
       
        <div class="profile-usermenu">
          <ul class="nav">
            <li class="active">
              <a href="#">
              <i class="glyphicon glyphicon-user"></i>
              User Profile </a>
            </li>
           
     
            <li>
              <a href="#">
              <i class="fa fa-cart-plus" aria-hidden="true"></i>
              All Products List</a>
            </li>

           
            
          </ul>
        </div>
        <!-- END MENU -->
        <?php }?>