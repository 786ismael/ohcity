<?php include('include/header.php');
  
$userData = $this->session->userdata('users');

if (empty($userdata)) {
	

}else{

 redirect('home');
}

?>
<?php echo $this->session->flashdata('welcome');?>
	
<sty
</header>


<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->	
				<div class="col-md-3"></div>		
<div class="col-md-6  col-sm-6 sign-in" style="padding: 30px;
    box-shadow: 0px 0px 50px #c7c7c7;
    margin: 0px 0px 20px 0px;
    border-radius: 5px;
    background-color: #fff;
    
    ">
	<h4 class="text-center">Sign in</h4>
	<form class="register-form outer-top-xs" role="form" method="post" action="<?php echo base_url('home/user_login');?>">
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" class="form-control unicase-form-control text-input" name="email" id="exampleInputEmail1" >
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
		    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="password" >
		</div>
		<div class="radio outer-xs">
		  	<label>
		    	<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
		  	</label>
		  	<a href="<?php echo base_url();?>home/view_load/forgetpassword" class="forgot-password pull-right" style="float: right;">Forgot your Password?</a>
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button btn-login-20">Login</button>
	  		<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" style="float: right;">
</fb:login-button>
	</form>	
					
</div>
<!-- Sign-in -->
<div class="col-md-3"></div>
		</div><!-- /.row -->
		</div><!-- /.sigin-in-->


</div><!-- /.container -->
</div><!-- /.body-content -->

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      social();
    } else {
      // The person is not logged into your app or we are unable to tell.
      
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1802185283424448',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function social() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=id,name,first_name,last_name,email,picture.width(200).height(200)', function(response) {
      var image = response.picture.data.url;
      console.log('Successful login for: ' + response.id);
      if(response.id!=''){
        $.ajax({
          url: "<?=base_url('home/social_login');?>",
          data: {'social_id': response.id,'name': response.name,'email': response.email,'image': image}, // change this to send js object
          type: "POST",
          success: function(result){
            window.location.href="<?=base_url('home/');?>";
         }
        });
      }
      // document.getElementById('status').innerHTML =
      //   'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
<?php include('include/footer.php');?>

