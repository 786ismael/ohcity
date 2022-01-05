<?php define("admin_assets", base_url()."assets/admincss/"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title> Admin Panel</title>
<link rel="icon" href="<?php echo base_url('uploads/images/logo.png'); ?>" sizes="16x16" type="image/png">
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/bootstrap.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo admin_assets; ?>js/plugins/jquery-1.7.min.js"></script>
<script language="javascript" src="<?php echo admin_assets; ?>js/bootstrap.min.js"></script>
</head>

<style>
.loginboxinner{
    background: rgba(255, 255, 255, 0.51) !important;
}
.loginbox{
border-radius:inherit !important;
}
.loginbox button{
    background: rgb(0, 121, 254) url(../images/btngrad.png) repeat-x top left !important;
}
</style>

<body class="loginpage" style="background: url(<?=base_url('uploads/images/login.jpg');?>) 50% 0 no-repeat;">


	<div class="loginbox">
    	<div class="loginboxinner">
        	
            <div class="logo" style="padding: 5px;">
            	<img alt="" src="<?php echo base_url('uploads/images/logo.png'); ?>" width = "150"/>
                 
                <!--<h1 style="margin-top:10px;"><span>ADMIN</span> LOGIN</h1>-->
            </div><!--logo or login-->
           
            <br clear="all" />

             <?php if($this->session->flashdata('success')){ ?>
             <div class="notibar msgerror" style="background: rgba(76, 175, 80, 0.81) url(assets/admincss/images/notifications.png) no-repeat 0 0;
    background-position: 0 -103px;"><p style="color:#fff"><?= $this->session->flashdata('success'); ?></p></div>
            <?php } ?>
          
          <?php include("session_msg.php");  ?>
            <form id="login" action="<?php echo base_url(); ?>admin/go" method="post">
            	
                <div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="username" id="username" placeholder="Username or Email" />
                    </div>
                </div>
                
                <div class="password">
                	<div class="passwordinner">
                    	<input type="password" name="password" id="password" placeholder="Password" />
                    </div>
                </div>

                <div class="keep" style="margin-top:0px;margin-bottom:5px; float:right"><a href="<?php echo base_url('admin/view_page/forgotpassword'); ?>">Forgot Password?</a></div>
                
                <button type="submit">Sign In</button>
                
                  
            
            </form>
            
        </div><!--loginboxinner-->
    </div><!--loginbox-->


</body> 

</html>