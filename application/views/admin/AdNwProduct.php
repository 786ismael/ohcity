<!DOCTYPE html>

<html>

<?php include 'include/head.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$button = "submit";

$btn_name = "Add Product";

$path = base_url("uploads/images/user.jpg");

$id = $this->uri->segment(4);

if($id!=''){

  $fetch = $this->admin_common_model->get_where('product',['id'=>$id]);
  


  $row = $fetch[0];

  $button = "update";

  $btn_name = "add promoting";        

  if($row['image']!=''){

    $path = base_url("uploads/images/".$row['image']);

  }

}

    $offers = $this->admin_common_model->get_where('offers',['status'=>'Active']);


 // $query="SELECT * FROM `offers` WHERE status = 'Active' "; 
                   //  $query="SELECT * FROM drivers WHERE vehicle_type = '$vehicle_type'"; 
//                     $sql = mysql_query($query);
//                     $result = mysql_num_rows($sql);
                     




?>



<body class="hold-transition skin-blue sidebar-mini" id="">

  <div class="wrapper">

    <?php include 'include/header.php'; ?>

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Main content -->

      <section class="content" id="crop-avatar">

       <div class="row ">

        <div class="col-sm-12 cdG">

          <span class="fs30 "><?=$btn_name;?></span> 

          <!--<p><?=$btn_name;?> and add them to this site.  </p>-->

        </div>

        <div class="col-sm-12 cdG">

          <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">

            <input type="hidden"  class="form-control" name="id" value="<?=$row['id'];?>">


            




            <div class="form-group">

              <label for="inputEmail3" class="col-sm-2 control-label">Promoting Start Date </label>

              <div class="col-sm-8">

                <input type="date"  class="form-control" name="start_date" required value="<?=$row['start_date'];?>">

              </div>

            </div>

            <div class="form-group">

              <label for="inputEmail3" class="col-sm-2 control-label">Promoting End Date</label>

              <div class="col-sm-8">

                <input type="date"  class="form-control" name="end_date" required value="<?=$row['end_date'];?>">

              </div>

            </div>

        
                <input type="hidden"  class="form-control" name="promoting_status" required value="yes">


       <div class="form-group">

        <div class=" col-sm-2 col-sm-offset-2">

          <button type="submit" name="<?=$button;?>" class="btn btn-dang-add mr10 "><?=$btn_name;?></button>

        </div>

      </div>

    </form>





  </div><!-- /.col-sm-9 -->







</div><!-- /.row -->





<!-- Cropping modal -->

<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form class="avatar-form" action="<?=base_url('crop_image/crop.php');?>" enctype="multipart/form-data" method="post">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>

        </div>

        <div class="modal-body">

          <div class="avatar-body">



            <!-- Upload image and data -->

            <div class="avatar-upload">

              <input type="hidden" class="avatar-src" name="avatar_src">

              <input type="hidden" class="avatar-data" name="avatar_data">

              <input type="hidden" name="path" value="../uploads/images/">

              <input type="hidden"  name="base_url" value="<?=base_url('uploads/images');?>/">

              <input type="hidden"  name="wth" value="150">

              <input type="hidden"  name="hth" value="150">

              <input type="hidden" value="1" id="aspectRatio" >



              <label for="avatarInput">Local upload</label>

              <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">

            </div>



            <!-- Crop and preview -->

            <div class="row">

              <div class="col-md-9">

                <div class="avatar-wrapper"></div>

              </div>

              <div class="col-md-3">

                <div class="avatar-preview preview-lg"></div>

                <div class="avatar-preview preview-md"></div>

                <div class="avatar-preview preview-sm"></div>

              </div>

            </div>



            <div class="row avatar-btns">

              <div class="col-md-9">

                <div class="btn-group">

                  <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>

                      <!--<button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>

                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>

                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>-->

                    </div>

                    <div class="btn-group">

                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>

                      <!--<button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>

                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>

                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>-->

                    </div>

                  </div>

                  <div class="col-md-3">

                    <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>

                  </div>

                </div>

              </div>

            </div>

            <!-- <div class="modal-footer">

              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div> -->

          </form>

        </div>

      </div>

    </div><!-- /.modal -->



    <!-- Loading state -->

    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>

    <!-- end Cropping modal -->





  </section>

  <!-- /.content -->

</div>

<!-- /.content-wrapper -->



</div>

<!-- ./wrapper -->



<?php include 'include/script.php' ?>





<script>



 function readURL(input,id) {

  if (input.files && input.files[0]) {

    var reader = new FileReader();



    reader.onload = function (e) {

      $('#'+id)

      .attr('src', e.target.result);



    };



    reader.readAsDataURL(input.files[0]);

  }

}



function getSubCategory(category_id){

 $.ajax({

  url: "<?=base_url('admin/get_sub_category');?>",

          data: {'category_id': category_id}, // change this to send js object

          type: "POST",

          success: function(result){

            //alert(result);

            $("select[name='subcategory_id']").html(result);

            



          }

        });



}



</script>



<!-- script for add more -->

<script type="text/javascript">





 $(document).ready(function() {

      var max_fields      = 10; //maximum input boxes allowed

      var wrapper         = $(".input_fields_wrap"); //Fields wrapper

      var add_button      = $(".add_field_button"); //Add button ID

      

      var x = 1; //initlal text box count

      $(add_button).click(function(e){ //on add input button click

        e.preventDefault();

          if(x < max_fields){ //max input box allowed

              x++; //text box increment

              

              $(wrapper).append("<div class='col-sm-12 pd0'><input type='text'  class='form-control sizes' name='size[]'><a href='#' class='remove_field'><i class='fa fa-times'></i></a></div>"); 

            }else{

              alert('You can not add more Fields');

            }

            auto();

          });

      

      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text

        e.preventDefault(); $(this).closest('div').remove(); x--;

      })

    });



  </script>



  <!-- script for add more color -->

  <script type="text/javascript">





   $(document).ready(function() {

      var max_field      = 10; //maximum input boxes allowed

      var wrappers         = $(".input_fields"); //Fields wrappers

      var add_buttons      = $(".add_field"); //Add button ID

      

      var x = 1; //initlal text box count

      $(add_buttons).click(function(e){ //on add input button click

        e.preventDefault();

          if(x < max_field){ //max input box allowed

              x++; //text box increment

              

              $(wrappers).append("<div class='col-sm-12 pd0'><input type='color'  class='form-control sizes' name='color[]'><a href='#' class='remove_field'><i class='fa fa-times'></i></a></div>"); 

            }else{

              alert('You can not add more Fields');

            }

            auto();

          });

      

      $(wrappers).on("click",".remove_field", function(e){ //user click on remove text

        e.preventDefault(); $(this).closest('div').remove(); x--;

      })

    });



  </script>









</body>

</html>







<?php



extract($_REQUEST);

// for add holidays

if(isset($submit)){



  $arr_data = $this->input->post();



  if($_FILES['image']['name']!=''){



    $n = rand(0, 100000);

    $img = "PRODUCT_IMG" . $n . '.png';

    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);

    $arr_data['image'] = $img; 



  }

   $size = $arr_data['available'];




  unset($arr_data['submit'],$arr_data['id']);

   $result = $this->admin_common_model->insert_data('product',$arr_data); 

  if(!empty($result)){

if($result[0]['offer_id'] != ''){
    for($i=0;$i<$size;$i++){
        $aa = $this->admin_common_model->generateTicketString(10);

      $arr_variation = ['product_id' => $result,'ticket_number' => $aa];

      $resultVariation = $this->admin_common_model->insert_data('ticket_numbers',$arr_variation);

    }
}

  }

//echo $this->db->last_query(); die;





  if (!$result) {





 echo "<script> swal(

  'Error',

  'Error In Add Product',

  'error'

  ); 



  $('.confirm').click(function(){

    window.location='';

  });







  



  </script>";



}else{



   echo 

    "<script> swal(

    'Success',

    'Add Product Successfully',

    'success'

    ); 



    $('.confirm').click(function(){

      window.location='".base_url('admin/view_page/productList')."';

    });



</script>";



}



}// end if submit





// for update restaurant

if(isset($update)){



  $arr_data = $this->input->post();






  $user_image = $row['image'];

  if($_FILES['image']['name']!=''){



    unlink("uploads/images/" . $rest_image);

    $n = rand(0, 100000);

    $img = "PRODUCT_IMG" . $n . '.png';

    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);

    $arr_data['image'] = $img; 



  }





  $arr_where = ['id'=>$arr_data['id']];

  unset($arr_data['update'],$arr_data['size'],$arr_data['color']);

  $result = $this->admin_common_model->update_data('product',$arr_data, $arr_where); 

//echo $this->db->last_query(); die;





  if ($result) {

    echo 

    "<script> swal(

    'Success',

    'Add promoting Successfully',

    'success'

    ); 



    $('.confirm').click(function(){

      window.location='".base_url('admin/view_page/productList')."';

    });



  </script>";



}else{



  echo "<script> swal(

  'Error',

  'Error In Updating Product',

  'error'

  ); 



  $('.confirm').click(function(){

    window.location='';

  });



</script>";



}// end if result









}





?>



