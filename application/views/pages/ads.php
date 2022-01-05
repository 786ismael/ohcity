<style type="text/css">
  .custom-file-input {
    border: 0;
    color: transparent;
    cursor: pointer;
    height: 40px;
    overflow: hidden;
    width: 115px;
    opacity: 1;
  }

  .custom-file-input:active {
    outline: 0;
  }

  .custom-file-input::-webkit-file-upload-button {
    visibility: hidden;
  }

  .custom-file-input::before {
    color: black;
    content: "browse";
    cursor: pointer;
    display: inline-block;
    font-size: 13px;
    letter-spacing: 1px;
    outline: none;
    white-space: nowrap;
  }


  #fileDisplayArea, #fileDisplayArea2, #fileDisplayArea3, #fileDisplayArea4 {
    background: #fff;
    border-color: #ccc;
    box-sizing: border-box;
    border-style: dashed;
    height: 100px;
    overflow: hidden;
    padding: 1px;
    width: 115px;
  }

  #fileDisplayArea img, #fileDisplayArea2 img, #fileDisplayArea3 img, #fileDisplayArea4 img {
    height: 100%;
    width: 100%;
    margin: 0 auto;

  }


</style>
<article>
  <div class="container">
   <div class="row">
    <div class="col-md-3">
      <img src="<?php echo base_url();?>assets/frontcss/images/02.jpg" width="100%">
    </div>
    <div class="col-md-6 box">
     <form action="<?php echo base_url('homepage/submit_ads');?>" method="post" id="ads_form" enctype="multipart/form-data">
       <h4>Ad Post</h4><hr> 

       <?php 
       $loggedin_user = $this->session->userdata('logged_in');
       if(!empty($loggedin_user)){
        $loggedin_userid = $loggedin_user['id'];
      }
      ?>

      <input type="hidden" id="user_id" name="user_id" value="<?php echo $loggedin_userid;?>">

      <select style="width: 100%;padding: 5px 15px;background: #eef1f2;border: 1px solid #ccd1d4;color: #484646;" name="cat_id" id="cat_id">
        <option value="">Select Cetegory</option> 
        <?php
        if(!empty($ads_categories)){
          foreach ($ads_categories as $ads_category) {
           ?>
           <option value="<?php echo $ads_category['id'];?>"><?php echo $ads_category['category_name'];?></option>
           <?php }}?>
         </select>
         <br><br>

         <section class="all">
          <label for="product_name">Ad Title</label>
          <input type="text" id="product_name" name="product_name" required placeholder="Ad Title">

          <label for="product_name">Price</label>
          <input type="text" id="price" name="price" required placeholder="Price">

          <label for="description">Ad Description</label>
          <textarea name="description" id="description" rows="5" required style="width: 100%; resize: none;"></textarea>

          <!-- <label for="username">Name</label>
          <input type="text" id="username" name="username" placeholder="Name" required>

          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="Phone Number" required> -->

          <label for="address">Address</label>
          <input type="text" id="address" name="address" placeholder="Address" required>


          <label for="compny_name" style="display:none">Company Name</label>
          <input type="text" id="compny_name" name="compny_name" placeholder="Company Name" style="display:none">

          <label for="position" style="display:none">Position</label>
          <input type="text" id="position" name="position" placeholder="Position" style="display:none">

          <label for="salary" style="display:none">Salary</label>
          <input type="text" id="salary" name="salary" placeholder="Salary" style="display:none">

          <label for="services" style="display:none">Services</label>
          <input type="text" id="services" name="services" placeholder="Services" style="display:none">

          <label for="contact_details" style="display:none">Contact Details</label>
          <input type="text" id="contact_details" name="contact_details" placeholder="Contact Cetails" style="display:none">



          <div class="row">
            <div class="col-md-3">
              <div style="text-align: center;">
                <div id="fileDisplayArea"></div>
              </div>
              <div style="text-align: center;" class="btnn">
              <input type="file" id="fileInput" name="image" class="custom-file-input" />
              </div>
            </div>
            <div class="col-md-3">
              <div style="text-align: center;">
                <div id="fileDisplayArea2"></div>
              </div>
              <div style="text-align: center;" class="btnn">
                <input type="file" id="fileInput2" name="image1" class="custom-file-input" />
              </div>
            </div>
            <div class="col-md-3">
              <div style="text-align: center;">
                <div id="fileDisplayArea3"></div>
              </div>
              <div style="text-align: center;" class="btnn">
                <input type="file" id="fileInput3" name="image2" class="custom-file-input" />
              </div>
            </div>
            <div class="col-md-3">
              <div style="text-align: center;">
                <div id="fileDisplayArea4"></div>
              </div>
              <div style="text-align: center;" class="btnn">
                <input type="file" id="fileInput4" name="image3" class="custom-file-input" />
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-md-3 btnn">

            </div>
            <div class="col-md-3 btnn">

            </div>
            <div class="col-md-3 btnn">

            </div>
            <div class="col-md-3 btnn">

            </div>
          </div> 
        </section>
        <div style="text-align: center;"><input type="submit" name="submit_ads" value="Submit Ads" style="background-color: rgba(27,179,245,.8); width: 40%; color: #fff;"></div>
      </form>
    </div>
    <div class="col-md-3">
      <img src="<?php echo base_url();?>assets/frontcss/images/01.jpg" width="100%">
    </div>
  </div>
</div>
</article>

<script type="text/javascript">
  $(document).ready(function(){
    $('#cat_id').change(function(){
      var category =$(this).find("option:selected").text();
      if(category=='Jobs'){
        $('input[id^="compny_name"]').show();
        $('input[id^="position"]').show();
        $('input[id^="salary"]').show();
        $('label[for^="compny_name"]').show();
        $('label[for^="position"]').show();
        $('label[for^="salary"]').show();

      //Hide Input Fields//

      $('input[id^="services"]').hide();
      $('input[id^="contact_details"]').hide();
      $('label[for^="services"]').hide();
      $('label[for^="contact_details"]').hide();



      
    }
    else if(category=='Services'){
      $('input[id^="compny_name"]').show();
      $('input[id^="services"]').show();
      $('input[id^="contact_details"]').show();
      $('label[for^="compny_name"]').show();
      $('label[for^="services"]').show();
      $('label[for^="contact_details"]').show();

      //Hide Input Fields//


      $('input[id^="position"]').hide();
      $('input[id^="salary"]').hide();
      $('label[for^="position"]').hide();
      $('label[for^="salary"]').hide();

    }

    else
    {
      $('input[id^="compny_name"]').hide();
      $('input[id^="position"]').hide();
      $('label[for^="salary"]').hide();
      $('input[id^="services"]').hide();
      $('input[id^="contact_details"]').hide();
      $('label[for^="compny_name"]').hide();
      $('label[for^="position"]').hide();
      $('label[for^="salary"]').hide();
      $('label[for^="services"]').hide();
      $('label[for^="contact_details"]').hide();
    }
  });
  });
</script>