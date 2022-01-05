<?php include('include/header.php');?>

<?php $siteUrl = base_url(); ?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 


<div class="col-md-12">
  <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
             <?php
                          $allBanners = $this->webservice_model->get_all('banner');
                          foreach ($allBanners as $banner) {
                           $bannerImage = base_url().'uploads/images/'.$banner['image'];
                           ?>
            <div class="item" style="background-image: url('<?= $bannerImage;?>');">
            </div>
            <!-- /.item -->
            <?php }?>
        
            <!-- /.item --> 
            
          </div>
          <!-- /.owl-carousel --> 
        </div>
        
      
</div>

      
      <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder"> 



  

        <section class="section wow fadeInUp new-arriavls" style="margin-top: 25px;">
          <h3 class="section-title">Product Ads</h3>
      
        <div class="clearfix">
             <?php $allFeaturedProduct = $this->webservice_model->get_all('product');
    foreach ($allFeaturedProduct as $featuredProduct) {
     
      $productImage = $siteUrl.'uploads/images/'.$featuredProduct['image'];
      $productId=$featuredProduct['id'];
      ?> 
         <div class="col-md-3 padding-manage">

          <div class="products">
                
                
                <div class="product">
                  <div class="product-image pro-imgs">
                    <div class="image"> <a href=""><img  src="<?=$productImage;?>" alt="" class="img-thumbnail"></a> </div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="#"><?php echo $featuredProduct['product_name'];?></a></h3>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> <?php echo $featuredProduct['price'];?> </span> </div>
                    <p><?php echo $featuredProduct['description'];?></p>
                    <!-- /.product-price --> 
                    
                  </div>

                </div>
                <!-- /.product --> 
                
              </div> 
             
         </div> 

 <?php }?>
 

         

         
         

        
         
         

         
                

                

                

     


        </div>
      
        </section>




        <!-- /.section --> 
      </div>
    </div>
  
   
  </div>
  <!-- /.container --> 
</div>


<?php include('include/footer.php');?>