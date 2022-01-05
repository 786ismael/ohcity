<?php include('include/header.php');?>
<?php $this->session->flashdata('welcome');?>
<?php 

 $userData = $this->session->userdata('users');
 if(empty($userData)){
  $userId = '';
  redirect('home/view_load/sign-in');
}
else
{
   $sender = $userData['id'];
}

?>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.carousel.min.css'>
	<style type="text/css">
		.box{
			margin: 5px;
			padding: 4px 10px;
      background: #fff;
    box-shadow: 0px 0px 50px #c7c7c7;
    border-radius: 5px;
		}
		.icon li{
			list-style: none;
			float: left;
			width: 50%;
		}
		.rate{
			margin: 5px;
			text-align: center;
			background-color: #ffee7e;
			padding: 10px;
			color: #3d3d3d;
		}
		.chat{
			margin: 5px;
			box-shadow: 0px 0px 1px #bdbdbd;
			padding: 3px 10px; 
			text-align: center;
		}
		.btn-warning{
			padding: 15px 65px;
			margin: 5px;
		}
		.safety{
			margin: 5px;
			box-shadow: 0px 0px 1px #bdbdbd;
			padding: 4px 10px;
		}
		.report{
			margin: 5px;
			box-shadow: 0px 0px 1px #bdbdbd;
			padding: 4px 10px;
		}
		.icon li .fa:before{
			margin-left: -15px;
		}
	</style>
	     <style type="text/css">
        #sync1 .item {
  
  margin: 5px;
  color: #000;
  border-radius: 3px;
  text-align: center;
  width: 600px;
  height: 400px;
}
#sync2 .item {
  margin: 5px;
  color: #000;
  border-radius: 3px;
  text-align: center;
  cursor: pointer;
  height: 75px;
}
#sync2 .item h1 {
  font-size: 18px;
}

.owl-theme .owl-nav {
  /*default owl-theme theme reset .disabled:hover links */
}
.owl-theme .owl-nav [class*='owl-'] {
  -webkit-transition: all .3s ease;
  transition: all .3s ease;
}
.owl-theme .owl-nav [class*='owl-'].disabled:hover {
  background-color: #D6D6D6;
}
#sync1.owl-theme {
  position: relative;
}
#sync1.owl-theme .owl-next,
#sync1.owl-theme .owl-prev {
  width: 22px;
  height: 40px;
  margin-top: -20px;
  position: absolute;
  top: 50%;
}
#sync1.owl-theme .owl-prev {
  left: 10px;
}
#sync1.owl-theme .owl-next {
  right: 10px;
}

      </style>
<div class="container">
		<div class="row">
			<div class="col-md-2">
				<div class="box">
					
				</div>
			</div>
			<div class="col-md-7">
				<?php $arr_get = ['id'=>$this->uri->segment('4')];
                 $product = $this->webservice_model->get_where('product',$arr_get);

                   foreach ($product as $key => $value) {
                    

				?>
				<div class="box">
					<h3><?php echo $value['product_name'];?></h3>
					<ul class="icon">
						<li><a href="#"><i class="fa fa-map-marker"></i><?php echo $value['address'];?></a></li>
						<li><a href="#"><i class="fa fa-mobile"></i><?php echo $value['contact_details'];?></a></li>
					</ul>
					 
					<p style="opacity: 0">.</p>
			
					
					  <div id="sync1" class="owl-carousel owl-theme">
    <div class="item">
            
    	<img src="<?php echo base_url();?>uploads/images/<?php echo $value['image'];?>" alt="1"></div>


  
 
</div>

<div id="sync2" class="owl-carousel owl-theme">
  
 

  
  <div class="item">  
            	           <div class="item"  style="display: none;"></div> 
            <img src="<?php echo base_url();?>uploads/images/<?php echo $value['image'];?>" alt="1"></div>
</div>
					<p><i><?php echo $value['description'];?></i></p>
					
				</div>
		
		
	<?php  } ?>
			</div>
			<?php $arr_get = ['id'=>$this->uri->segment('4')];
                 $product = $this->webservice_model->get_where('product',$arr_get);

                   foreach ($product as $key => $value) {
                   //$userid=;
                   $productid=$value['id'];
				?>
			<div class="col-md-3">
				<div class="box">
					<div class="rate">
						<h3><?php echo $value['price'];?></h3>
					</div>
					<div class="chat">
						<i class="fa fa-user-circle" style="font-size: 36px; color: #ccc;"></i>
            <?php 
                  $arr = ['id'=>$value['user_id']];

               $user = $this->webservice_model->get_where('users',$arr); 
               if (empty($user)) {
               echo "no user avilable";
               }else{
              foreach ($user as  $usern) {
                //print_r($usern);
                 $reciver=$usern['id'];
              
             ?>
						<p><strong><?php echo $usern['username'];?></strong></p>
				<!-- 		<p>Away</p> -->
						<p>(Active on site since 1 Month)</p>
            <?php }} ?>
						<a href="#">User Ads</a>
					</div>
          <?php if(empty($userData)){?>
<a href="<?php echo base_url('home/view_load/sign-in');?>" class="btn btn-warning" style="padding: 15px 60px;">Login To Chat</a>

 <?php
}else{?>
<form method="post" action="<?php echo base_url('home/chat_insert');?>">
    <input type="hidden" name="product_id" value="<?php echo $productid?>">
  <input type="hidden" name="receiver_id"  value="<?php echo $reciver;?>">
<input type="hidden" name="sender_id"  value="<?php echo $sender;?>">
<textarea required="" rows="5" style="width: 100%" name="chat_message"></textarea>
          <input type="submit" name="" value="Send to chat" class="btn btn-warning">
</form>
<?php
    
}?>
          
					<div class="safety">

						<p><strong>Safety Tips for Buyers</strong></p>
						<ol>					
						<li>Meet seller at a safe location</li>
                         <li>Check the item before you buy</li>
                         <li>Pay only after collecting item</li>
						</ol>
						<a href="#">Know More<i class="fa fa-angle-double-right"></i></a>
					</div>
					<div class="report">
						<a href="#"><i class="fa fa-flag" style="font-size: 36px; color: #ccc;"></i>
						<p><strong>Report</strong></p></a>
					</div>
				</div>
			</div>	<?php  } ?>
		</div>
		
		
	</div><script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.min.js'></script>
	 <script type="text/javascript">
    $(document).ready(function() {

  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  var slidesPerPage = 4; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1.owlCarousel({
    items : 1,
    slideSpeed : 2000,
    nav: true,
    autoplay: true,
    dots: true,
    loop: true,
    responsiveRefreshRate : 200,
    navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>','<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
  }).on('changed.owl.carousel', syncPosition);

  sync2
    .on('initialized.owl.carousel', function () {
      sync2.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
    items : slidesPerPage,
    dots: true,
    nav: true,
    smartSpeed: 200,
    slideSpeed : 500,
    slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
    responsiveRefreshRate : 100
  }).on('changed.owl.carousel', syncPosition2);

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();
    
    if (current > end) {
      sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }
  
  function syncPosition2(el) {
    if(syncedSecondary) {
      var number = el.item.index;
      sync1.data('owl.carousel').to(number, 100, true);
    }
  }
  
  sync2.on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).index();
    sync1.data('owl.carousel').to(number, 300, true);
  });
});
  </script>
	<?php include('include/footer.php');?>