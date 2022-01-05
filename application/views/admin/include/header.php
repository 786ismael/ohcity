<?php

  if(!$this->session->userdata('admin')){
    redirect('admin');
  }
  $admin = $this->session->userdata('admin');
  
  $page = $this->uri->segment(3);
  
        $this->load->model('webservice_model');

?>
 <!-- Main Header -->
  <header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->

      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?=base_url('uploads/images/logo.png');?>" width="55px"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
       <span class="sr-only">Toggle navigation</span>
     </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav ">


          <!-- Notifications Menu -->

          <!-- Tasks Menu --> 
                    <!-- User Account Menu -->
          <li class="dropdown user user-menu ">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle cdG" style="padding-left: 0;" data-toggle="dropdown">
             <span class="hidden-xs cdG fs18"><?= $admin->name; ?> <label class="clr"></label></span>
              <!-- The user image in the navbar-->
              <img src="<?=base_url('uploads/images/'.$admin->image);?>" class="user-image rMl0" >
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
             
            </a>
            <div class="dropdown-content">
             <a href="<?=base_url('admin/view_page/profile');?>"><i class="fa fa-user"></i> &nbsp; Profile</a>
             <a href="<?=base_url('admin/view_page/change_password');?>"><i class="fa fa-cog"></i> &nbsp; Change Password</a>
             <!--<a href="logout.php"><i class="fa fa-sign-out"></i> &nbsp; Logout</a>-->
          </div>
<!--             <ul class="dropdown-menu">
  The user image in the menu
  <li class="user-header">
    <img src="<?=base_url();?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

    <p>
      Welkon Admin
      <small>Member since Nov. 2012</small>
    </p>
  </li>
  Menu Body
  <li class="user-body">
    <div class="row">
      <div class="col-xs-4 text-center">
        <a href="#">Followers</a>
      </div>
      <div class="col-xs-4 text-center">
        <a href="#">Sales</a>
      </div>
      <div class="col-xs-4 text-center">
        <a href="#">Friends</a>
      </div>
    </div>
    /.row
  </li>
  Menu Footer
  <li class="user-footer">
    <div class="pull-left">
      <a href="#" class="btn btn-default btn-flat">Profile</a>
    </div>
    <div class="pull-right">
      <a href="#" class="btn btn-default btn-flat">Sign out</a>
    </div>
  </li>
</ul> -->
          </li>
          <li class="dropdown tasks-menu ">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle clg" data-toggle="dropdown">
            Help 
             
            </a>
          
          </li>
        <li class="dropdown tasks-menu ">
         <a  class="dropdown-toggle clg pl0 pr0" style="padding-left: 0; padding-right: 0;" data-toggle="dropdown">
           |   
            </a>
        </li>
     

           <li class="dropdown tasks-menu ">
            <!-- Menu Toggle Button -->
            <a href="<?=base_url('admin/admin_logout');?>" class="dropdown-toggle " >
           <i class="fa fa-sign-out clr loginicon" aria-hidden="true"></i>
           <span class="clg">Log Out </span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <section class="sidebar">

      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
       
        <!-- Optionally, you can add icons to the links -->
         <li class="treeview"><a href="<?=base_url('admin/dashboard');?>"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;  Dashboard</a></li>
             
 
      

        <li class="treeview <?php if($page=='userList' || $page=='AdNwUser'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-users" aria-hidden="true" > </i> &nbsp; Users Details</a>
          <ul class="treeview-menu" >
            <li class="<?php if($page=='userList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/userList');?>">All Users</a></li>
         
          </ul>
        </li>

       <li class="treeview <?php if($page=='categoryList' || $page=='AdNwCategory'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp; Category Details</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='categoryList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/categoryList');?>">All Category</a></li>

          </ul>
        </li>
        
         <li class="treeview <?php if($page=='productList' || $page=='AdNwPro'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-product-hunt" aria-hidden="true"></i>&nbsp; Product Details</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='productList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/productList');?>">All Product</a></li>

            <li class="<?php if($page=='productList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/productListNew');?>">All new Product</a></li>
            
<!--            <li class="<?php if($page=='productList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/AdNwProduct');?>">Add Product</a></li>
-->
          </ul>
        </li> 
        
         <li class="treeview <?php if($page=='ProproductList' || $page=='AdNwPro' || $page=='allProductList' || $page=='AdNwPro'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Promoting Product Details</a>
          <ul class="treeview-menu" >
          
            <li class="<?php if($page=='allProductList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/allProductList');?>">All Product</a></li>

            <li class="<?php if($page=='ProproductList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/ProproductList');?>">All Promoting Product</a></li>
            
<!--            <li class="<?php if($page=='productList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/AdNwProduct');?>">Add Product</a></li>
-->
          </ul>
        </li> 
        
          <li class="treeview <?php if($page=='issueList' || $page=='AdNwIssue'){echo 'active';}?>">
              <a href="#" att=""><i class="fa fa-bug" aria-hidden="true" > </i> &nbsp; Product Issues & Types</a>
              <ul class="treeview-menu" >
              <li class="<?php if($page=='userList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/issueList');?>">All Issue Type</a></li>
              <li class="<?php if($page=='productIssues'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/productIssues');?>">All Product Issue</a></li>

              </ul>
          </li> 

    <!--    <li class="treeview <?php if($page=='offerList' || $page=='AdNwOffer'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-gift"></i>&nbsp; Offer Details</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='offerList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/offerList');?>">All Offers</a></li>

          </ul>
        </li>

        <li class="treeview <?php if($page=='productList' || $page=='AdNwPro'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-product-hunt" aria-hidden="true"></i>&nbsp; Product Details</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='productList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/productList');?>">All Product</a></li>
            <li class="<?php if($page=='productList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/AdNwProduct');?>">Add Product</a></li>

          </ul>
        </li> 
        
         <li class="treeview <?php if($page=='orderList' || $page=='AdNwMap'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Details</a>
          <ul class="treeview-menu" >
            <li class="<?php if($page=='orderList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/orderList');?>">All Order</a></li>
          </ul>
        </li>
        
        

       <li class="treeview <?php if($page=='drowsList' || $page=='AdNwDrows'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-gift"></i>&nbsp; Drows Details</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='drowsList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/drowsList');?>">All Drows</a></li>

          </ul>
        </li> -->
       <li class="treeview <?php if($page=='bannerList' || $page=='AdNwBanner'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp; Banner Details</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='bannerList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/bannerList');?>">All Banner</a></li>

          </ul>
        </li>
        
                 <li class="treeview <?php if($page=='notificationList' || $page=='sendNotification'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp; Notification List</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='notificationList'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/notificationList');?>">All Notification</a></li>

          </ul>
        </li>
        
        <li class="treeview <?php if($page=='promotionModal' || $page=='sendNotification'){echo 'active';}?>">
          <a href="#" att=""><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp; Promotion Modal</a>
          <ul class="treeview-menu" >
                  
            <li class="<?php if($page=='promotionModal'){echo 'active';}?>"><a href="<?=base_url('admin/view_page/promotionModal');?>">Promotion Modal</a></li>

          </ul>
        </li>
      
      

        


        
       
        
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>