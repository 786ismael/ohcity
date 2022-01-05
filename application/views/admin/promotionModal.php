<!DOCTYPE html>
<html>
<?php include 'include/head.php';
      $button = "Update";
      $btn_name = "Update Offer Pop up";
      $path = base_url("uploads/images/no_image.png");
    //  $id = $this->uri->segment(4);
        $id = 3;
      if($id!=''){
        $fetch = $this->admin_common_model->get_where('config',['key'=> 'app_offer_pop_up' ]);
        $offer_image = $this->admin_common_model->get_where('config',['key'=> 'app_offer_image' ]);
        $offer_image = $offer_image[0]['value'];
        $offer_image = "https://ohcityzgz.com/uploads/images/".$offer_image;
        $row = $fetch[0];
        $button = "Update";
        $btn_name = "Update Offer Pop Up";        
      }
 ?>
<script>
    
</script>
<style>
    .offer-img {
        text-align: center;
    }
    .offer-img h2 {
        font-size: 20px;
        margin: 0 0 15px;
        font-weight: 600;
    }
    .offer-img .hide-img img{
        opacity: 0.3;
    }
    .offer-img .o-img img{
        height: 280px;
        transition: all 0.3s;
    }
    .offer-img .custom-radio label span {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        display: block;
        padding: 4px 0;
    }
    .offer-img .custom-radio label {
            background: #000;
            color: #fff;
            border: 0;
            border-radius: 4px;
            font-size: 13px;
            padding: 13px 41px;
            margin: 0 5px;
            display: inline-block;
            position: relative;
            overflow: hidden;
    }
    .offer-img .custom-radio{
        margin-top: 10px;
    }
    .offer-img .custom-radio label input{
        position: absolute;
        left: 6px;
        top: 4px;
    }
    .offer-img .custom-radio label [type="radio"]:checked + span{
        
    }
    .offer-img .custom-radio label input span{
        
    }
    
</style>
<body class="hold-transition skin-blue sidebar-mini" id="">
<div class="wrapper">
<?php include 'include/header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
   <div class="row ">
      <div class="col-sm-12 cdG">
      <span class="fs30 "></span> 
      <!--<p><?=$btn_name;?> and add them to this site.  </p>-->
    </div>
    
    <div class="offer-img">
        <h2><?=$btn_name;?></h2>
      <form method="POST" method="POST" enctype="multipart/form-data">
          
        <div class="o-img <?= $row['value'] == '0' ? 'hide-img' : ''  ;?>">
        <!-- <img src="https://ohcityzgz.com/uploads/system/popup.png" id="imagePreview">-->
        <img src="<?= $offer_image ;?>" id="imagePreview">
        </div>
        
        <div class="image-wrapper">
          <input type="file" name="image" id="image">
        </div>
        
        <div class="custom-radio">
          <label>
              <input type="radio" name="offer_pop_up" <?= $row['value'] == '1' ? 'checked' : ''  ;?> value="1"/>
              <span>Show</span>
          </label>
             <label>
             <input type="radio" name="offer_pop_up" <?= $row['value'] == '0' ? 'checked' : ''  ;?> value="0"/>
             <span>Hide</span>
            </label>
        </div>
        
        <div class="submit-btn">
             <button class="btn btn-succes">Update</button>
        </div>
        
      </form>
    </div>

  </div><!-- /.row -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<style>
    .offer-img .image-wrapper {
    margin-left: 209px;
}
</style>

<?php include 'include/script.php' ?>


<script>
 /*
 $('input[type="radio"]').on('click',function(e){
    //  e.preventDefault();
    $('.offer-img .o-img').toggleClass('hide-img');
    $('form').submit();
 });
 */
        $('#image').change(function (event) {
           var tmppath = URL.createObjectURL(event.target.files[0]);
           $('#imagePreview').attr('src',tmppath);
       });
       
       $('#upload-image').on('change',function(e){
           $('form').submit(); 
       });

</script>

 </body>
</html>



<?php

// for update restaurant
if( !empty($_POST) || $_POST['$offer_pop_up'] == '1' || $_POST['$offer_pop_up'] == '0' ){
    
        $arr_data = $this->input->post();
        $img = null;
         if($_FILES['image']['name']!=''){
          $n = rand(0, 100000);
          $img = "USER_IMG" . $n . '.png';
          move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
         }
         
$offer_pop_up = $_POST['offer_pop_up'];

$arr_where  = ['key'   => 'app_offer_pop_up' ];
$arr_update = ['value' => $offer_pop_up];


$result = $this->admin_common_model->update_data('config',$arr_update, $arr_where);

if($img){
    $arr_where  = ['key'   => 'app_offer_image' ];
    $arr_update = ['value' => $img];
    $this->admin_common_model->update_data('config',$arr_update, $arr_where);
}
        
if ($result) {
echo 
"<script> swal(
  'Success',
  'Update Offer Pop Up Successfully',
  'success'
); 

$('.confirm').click(function(){
        window.location='".base_url('admin/view_page/promotionModal')."';
});

</script>";

    }else{

echo "<script> swal(
  'Error',
  'Error In Updating Offer Pop Up',
  'error'
); 

$('.confirm').click(function(){
        window.location='';
});

</script>";

}// end if result



}


?>



