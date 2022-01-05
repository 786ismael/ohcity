<?php echo $this->session->flashdata('welcome'); ?>
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
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>assetsf/css/bootstrap.min.css">

<!-- Customizable CSS -->
<script type="text/javascript" src="<?php echo base_url();?>assetsf/js/search_script.js"></script>
<link rel="stylesheet" href="<?php //echo base_url();?>assetsf/css/main.css">
<link rel="stylesheet" href="<?php //echo base_url();?>assetsf/css/cutom.css">
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

  <header>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <a href="#" title="Dove Cot Market">
            <img src="images/logo-dove-cot-market.png" alt="Dove Cot Market" title="Dove Cot Market">
          </a>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
          <div style="padding: 5px 0px 0px 0px">
            <span class="searchbar">
              <span class="bar"><i class="fas fa-search"></i></span>
              <input type="text" name="Search" placeholder="Search" class="search">
              <input type="submit" class="btn" value="Submit">
            </span>
            <ul class="topbar">
              <li><a href="#" title="My Account"><i class="fas fa-user"></i> My Account</a></li>
              <li><a href="#" title="My Cart"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
            </ul>
          </div>
          <dir>
            <nav class="navbar navbar-expand-lg navbar-light">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="#" title="Home">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Service">
                      Service
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="#" title="Service 1">Service 1</a>
                      <a class="dropdown-item" href="#" title="Service 2">Service 2</a>
                      <a class="dropdown-item" href="#" title="Service 3">Service 3</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Category">
                      Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="#" title="Category 1">Category 1</a>
                      <a class="dropdown-item" href="#" title="Category 2">Category 2</a>
                      <a class="dropdown-item" href="#" title="Category 3">Category 3</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" title="About Us">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" title="Contact Us">Contact Us</a>
                  </li>
                </ul>
              </div>
            </nav>
          </dir>
        </div>
      </div>
    </div>
  </header>

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