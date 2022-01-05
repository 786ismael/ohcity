<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OhCity-ZGZ</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
  


  <!-- css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/support/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/support/css/style.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/support/css/responsive.css" />
  <!--[if IE]>
          <script src="js/html5shiv.js"></script>
      <![endif]-->
      <style>
        .bttn-icon{
            color: #ffff48;
            background : black;
            padding: 16px;
            display: inherit;
            margin: 5px;
        }
        .bttn-icon:hover{
            text-decoration : none;
            color : #ffff48;
            display: inherit;
        }
        .btn-icon-row{
            margin-bottom : 16px;
        }
    
         
      </style>
</head>
<body>

  <section class="slider">
    <div class="hdrLogo"><img class="logoDefault" alt="Logo" src="<?php echo base_url() ?>assets/support/images/logo.png"></div>
  	<!--<div class="sldr-mrt clearfix">-->
  	<!--	<div class="container">-->
  	<!--		<div class="bnr-text">-->
  	<!--			<h1>Apoyo</h1>-->
  	<!--			<p>cómo podemos ayudarle</p>-->
  	<!--		</div> -->
  	<!--	</div>-->
  	<!--</div>-->
  </section>

  <section class="form-support">
      
    <div class="container">
    <div class="row btn-icon-row">
          <div class="col-sm-12 col-xs-12 col-md-6">
              <div class="btn-icon left">
                 <a href="https://apps.apple.com/us/app/ohcityzgz/id1455351231" class="bttn-icon wow fadeIn" data-wow-delay="0.8s">
                <span class="bttn-content">
                    <span class="icon">
                       <img src="https://ohcityzgz.com/assets/Home/images/app-store.png" alt="">
                    </span>
                    <small>Consíguelo  </small>
                    <strong>AppStore</strong>
                </span>
            </a>
            </div>                  
        </div>

    <div class="col-sm-12 col-xs-12 col-md-6">
          <div class="btn-icon right">
                <a href="https://play.google.com/store/apps/details?id=com.tech.ohcity" class="bttn-icon wow fadeIn" data-wow-delay="1s">
        <span class="bttn-content">
            <span class="icon">
                <img src="https://ohcityzgz.com/assets/Home/images/play-store.png" alt="">
            </span>
            <small>Consíguelo  </small>
            <strong>PlayStore</strong>
        </span>
    </a>
    </div>
          </div>
    </div>
    </div>
  	<div class="container">
  	    
   <div class="row">
     <div class="col-sm-12">
        <?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-<?= $this->session->flashdata('class') ?>"> <?= $this->session->flashdata('msg') ?> </div>
        <?php } ?>
     </div>
   </div>

  		<div class="fs-inner">
  			<form action="<?php echo base_url('homepage/support_email') ?>" method="post">
  				<h2 class="text-center">Enviar una solicitud de soporte!</h2>
          <div class="row">
              <div class="col-sm-6">
                <input type="text" name="first_name" class="form-control" id="validationCustom01" placeholder="Nombre de pila"  required>
              </div>
              <div class="col-sm-6">
                <input type="text" name="last_name" class="form-control" id="validationCustom02" placeholder="Apellido" required>
              </div>
              <div class="col-sm-6">
                <input type="email" name="email_address" class="form-control" id="validationCustom01" placeholder="Email"  required>
              </div>
              <div class="col-sm-6">
                <input type="text" name="contact_number" class="form-control" id="validationCustom02" placeholder="Número de teléfono"  required>
              </div>
               <div class="col-sm-12">
                <input type="text" name="subject" class="form-control" id="validationCustom02" placeholder="tema"  required>
              </div>
              <div class="col-sm-12">
                <textarea name="message" class="form-control" rows="5" id="comment" placeholder="Mensaje"></textarea>
              </div>
            
              <div class="col-sm-12">
                <div class="text-center">
                    <button class="btn btn-primary support-btn" name="submit" type="submit">Enviar</button>
                </div>
              </div>
          </div>
        </form>
  		</div>
  	</div>
  </section>

  <footer>
  	<div class="container">
    		<ul>
          <li><span>Copyright © 2019 OhCity. All rights reserved. </span></li>
        </ul>
    </div>
  </footer>

</body>
</html>