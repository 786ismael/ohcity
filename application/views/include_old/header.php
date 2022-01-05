<?php $this->session->flashdata('welcome');?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="robots" content="all">
<title>Classified</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/bootstrap.min.css">

<!-- Customizable CSS -->
<script type="text/javascript" src="<?php echo base_url();?>assetsf/js/search_script.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/cutom.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/blue.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/owl.transitions.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/rateit.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/bootstrap-select.min.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/font-awesome.css">

<!-- Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">

<header class="header-style-1"> 
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            <?php $my=$this->session->userdata('users');
                if ($my) {?>
                 <li><a href="<?php echo base_url('home/view_load/myAccount');?>"><i class="fa fa-user" aria-hidden="true"></i>
              My Account</a></li>
                  
                  <li><a href="<?php echo base_url('home/logout');?>"><i class="fa fa-user" aria-hidden="true"></i>
              Logout</a></li>
                <?php }else{?>
          <li><a href="<?php echo base_url('home/view_load/sign_up');?>"><i class="icon fa fa-lock"></i>Register</a></li>
            <li><a href="<?php echo base_url('home/view_load/sign-in');?>"><i class="icon fa fa-lock"></i>Login</a></li>

             <?php  }

            ?>
            <!-- <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>
              My Account</a></li> -->
            
          </ul>
        </div>
        <!-- /.cnt-account -->
        
        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">English</a></li>
                <li><a href="#">French</a></li>
                <li><a href="#">German</a></li>
              </ul>
            </li>
          </ul>
          <!-- /.list-unstyled --> 
        </div>
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  
  
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 logo-holder"> 
          <div class="logo"> <a href="<?php echo base_url();?>"><img style="margin-top: -35px; background-color: #fff; padding: 4px;"src="<?php echo base_url('assets/images/coting.png');?>"></a> </div>
         </div>
       
      


<div class="col-md-2 col-sm-6 col-xs-12">
  <div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary design-cat" data-target="#" href="/page.html">
                Browse Categories <span class="caret"></span>
            </a>
        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
          <?php $category=$this->webservice_model->get_all('category');

          //$allFeaturedProduct = $this->webservice_model->get_all('product');
          foreach($category as $allcategory){


         
          ?>
              <li><a href="#"><?php echo $allcategory['category_name']?></a></li>
              <?php  }?>
             <!--  <li><a href="#">Some other action</a></li>
              <li class="dropdown-submenu">
                <a tabindex="-1" href="#">Hover me for more options</a>
                <ul class="dropdown-menu">
                  <li><a tabindex="-1" href="#">Second level</a></li>
                  <li class="dropdown-submenu">
                    <a href="#">Even More..</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">3rd level</a></li>
                      <li><a href="#">3rd level</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Second level</a></li>
                  <li><a href="#">Second level</a></li> -->
                </ul>
              </li>
            </ul>
        </div>
</div>
        
        <div class="col-xs-12 col-sm-12 col-md-4 top-search-holder no-padding"> 
          <div class="search-area">
            <input class="search-field" placeholder="Search here..." id="keyword"/>
                  <a class="search-button" href="javascript:void(0);" onclick="find_product();"></a>
                  <div id="ajax_response"></div>
               
            </form>
          </div>
          </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
          <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket"> <i class="fa fa-pencil-square-o"></i> </div>
              <div class="total-price-basket">  <span class="total-price"><span class="value">Post an Ad</span> </span> </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <!-- <div class="image"> <a href=""><img src="<?php echo base_url();?>assetf/images/cart.jpg" alt=""></a> </div> -->
                    </div>
                    <!-- <div class="col-xs-7">
                      <h3 class="name"><a href="index8a95.html?page-detail">Simple Product</a></h3>
                      <div class="price">$600.00</div>
                    </div> -->
                    <!-- div class="col-xs-1 action"> <a href="#"><i class="fa fa-trash"></i></a> </div> -->
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
              <!--   <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$600.00</span> </div>
                  <div class="clearfix"></div>
                  <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div> -->
                <!-- /.cart-total--> 
                
              </li>
            </ul>
            <!-- /.dropdown-menu--> 
          </div>
         </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript">
  $( document ).ready(function() {
//     alert('lsdf');
//  $('#searchform').keyup(){

// alert('sdf');
//  }

$('#searchform').keyup(function(){
var se = $("#searchp").val();

   $.ajax({
          url: "<?=base_url('home/search_product');?>",
          data: {'key': se}, // change this to send js object
          type: "POST",
          success: function(result){
            //alert(result);
            //swal("Deleted!", "Your selected item has been deleted.", "success");
  
            $('.confirm').click(function(){
               location.reload();
            });
             

          }
        });



});

});

  </script>
  

  <script type="text/javascript">
      function find_product(){
        var keyword = $('#keyword').val();
        $.ajax({
              url:'<?php echo base_url("home/search_product");?>', 
              type:'POST', 
              data:{'keyword':keyword}, 
              success: function(result){
                alert(result);
              }
            });
      }
    </script>