<?php define("admin_assets", base_url()."assets/admincss/"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>PLENDER |  Admin Panel</title>
<link rel="icon" href="<?php echo base_url('uploads/images/logo.png'); ?>" sizes="16x16" type="image/png">
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/bootstrap.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo admin_assets; ?>js/plugins/jquery-1.7.min.js"></script>
<script language="javascript" src="<?php echo admin_assets; ?>js/bootstrap.min.js"></script>
</head>

<body class="loginpage" style="background: url(<?=base_url('uploads/images/login.jpg');?>) 50% 0 no-repeat;"">

	<div class="loginbox">
    	<div class="loginboxinner">
        	
            <div class="logo">
            	<img alt="" src="<?php echo base_url('uploads/images/logo.png'); ?>" width = "200"/>
                 
                <h1 style="margin-top:10px;"><span>FORGOT</span> PASSWORD</h1>
            </div><!--logo-->
           
            <br clear="all" />
          
          <?php include("session_msg.php");  ?>
          <?php if($this->session->flashdata('success')){ ?>
             <div class="notibar msgsuccess" style="background-position: 0 -103px;"><p><?= $this->session->flashdata('success'); ?></p></div>
            <?php } ?>

            <form id="login" action="<?php echo base_url('admin/forgot_password'); ?>" method="post">
            	
                <!--<div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="username" id="username" placeholder="Employee Code" />
                    </div>
                </div>-->
                  <div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="email" id="email" placeholder="Email" />
                    </div>
                </div>
               
                <div class="keep" style="margin-top:0px;margin-bottom:5px; float:right"><a href="<?php echo base_url(); ?>admin">Login</a></div>
                
                <button type="submit">Forgot Password</button>                
                
            
            </form>
            
        </div><!--loginboxinner-->
    </div><!--loginbox-->


</body>

</html>

<style>

</style>