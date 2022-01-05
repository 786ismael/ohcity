<?php include('include/header.php');?>
<article>
    <div class="content-part category-section">
      <div class="category">
        <div class="container">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">



    <?php $banner=$this->webservice_model->get_all('banner');
           $i=0;
          foreach ($banner as $key => $value) {
            //print_r($value);
          
    ?>
    <div  <?php if($i==0){?> class="carousel-item active" <?php }  ?> class="carousel-item " style="height: 400px;">
      <img class="d-block w-100" src="<?php echo base_url();?>uploads/images/<?php echo $value['image'];?>" alt="Second slide">
    </div>
    <?php $i++;}?>
   
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        <h1>Category</h1>
          <div class="row">
            <?php $category=$this->webservice_model->get_all('category');
          foreach ($category as $key => $value) {
           //print_r($value);
          ?>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 box">
              <p><a href="<?php echo site_url('home/view_load/productpage/'.$value['id']);?>" title="Mobile" style="width: 70px; height: 70px;"><img src="<?php echo base_url();?>uploads/images/<?php echo $value['image'];?>" alt="Mobile" title="Mobile" style="width: 70px; height: 70px; border-radius: 50%;"></a></p>
              <h3><a href="<?php echo site_url('home/view_load/productpage/'.$value['id']);?>"><?php echo $value['category_name'];?></a></h3>
            </div>  <?php }?>
            
          </div>
        </div>
      
      </div>
    </div>
    <div class="content-part sell-phone-section">
      <div class="sell-phone">
        <h1>Make your Phone a  Sell phone</h1>
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <img src="<?php echo base_url('assetsf/images/images/img-sell-phone.jpg');?>" alt="" title="" style="position: absolute;
    top: 75px;
    width: 450px;
    padding-left: 50px;">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <h3>What is Lorem Ipsum?</h3>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
when an unknown printer took a galley of type and scrambled it to make a type 
specimen book. It has survived not only five centuries, but also the leap into
 electronic typesetting, remaining essentially unchanged. </p>
            <ul>
              <li><a href="#" title="Google Play"><img src="<?php echo base_url('assetsf/images/images/btn-play.png');?>"></a></li>
              <li><a href="#" title="Apple Store"><img src="<?php echo base_url('assetsf/images/images/btn-apple.png');?>"></a></li>
            </ul>
            </div>
          </div>
        </div>
      </div>
  </div>
</article>
<!-----------------------------FOOTER SECTION START------------------------------>
<?php include('include/footer.php');?>
