<!DOCTYPE html>
<html>
<?php include 'include/head.php';
     
      
      $path = base_url("uploads/images/no_image.png");
      $id = $this->session->userdata('admin')->id;
      
        $fetch = $this->admin_common_model->get_where('admin',['id'=>$id]);
        $row = $fetch[0];
        $button = "update";
        $btn_name = "Update Profile";        
        if($row['image']!=''){
          $path = base_url("uploads/images/".$row['image']);
        }
      
      

 ?>

<body class="hold-transition skin-blue sidebar-mini" id="">
<div class="wrapper">
<?php include 'include/header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
   <div class="row ">
      <div class="col-sm-12 cdG">
      <span class="fs30 "><?=$btn_name;?></span> 
      <!--<p><?=$btn_name;?> and add them to this site.  </p>-->
    </div>
   <div class="col-sm-12 cdG">
          <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
          <input type="hidden"  class="form-control" name="id" value="<?=$row['id'];?>">
         
         

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Admin Name</label>
            <div class="col-sm-8">
              <input type="text"  class="form-control" name="name" value="<?=$row['name'];?>">
            </div>
          </div>
         

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
              <input type="text"  class="form-control" name="email" require value="<?=$row['email'];?>">
            </div>
          </div>
         
 
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
               <img src="<?=$path;?>" width="200" id="img">              
            </div>
          </div>


         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Profile Image</label>
            <div class="col-sm-8">
              <input type="file"  class="form-control" name="pro_image" onchange="readURL(this,'img');">
            </div>
         </div>


  <div class="form-group">
    <div class=" col-sm-2 col-sm-offset-2">
      <button type="submit" name="<?=$button;?>" class="btn btn-dang-add mr10 "><?=$btn_name;?></button>
    </div>
  </div>
</form>


   </div><!-- /.col-sm-9 -->


  
  </div><!-- /.row -->


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

</script>

<script src="editor/editor.js"></script>
    
    <script>
      $(document).ready(function() { 
        $("#txtEditor").Editor();
      });
    </script>


    <style type="text/css">
      #statusbar{ display: none; }
      a.btn-default[title="Source"]{ display: none; }
    </style>
    <script>
       $(document).ready(function () {
            
            $(".Editor-editor").html('<?= base64_decode($row['description']);?>');
           
            $(".Editor-editor").focus(function(){
                $(this).keyup(function() {
                    var content = $(this).html();
                   
                    $("#Text_Editor").val(content);
                });
              });
        
        });
    </script>
    
    

 </body>
</html>



<?php

extract($_REQUEST);

// for update profile
if(isset($update)){

$arr_data = $this->input->post();
$admin = $this->session->userdata('admin');

            $pro_image = $row['image'];

            if($_FILES['pro_image']['name']!=''){
    
                        unlink("uploads/images/" . $pro_image);
                        $n = rand(0, 100000);
                        $img = "PRO_IMG" . $n . '.png';
                        move_uploaded_file($_FILES['pro_image']['tmp_name'], "uploads/images/" . $img);
                        $arr_data['image'] = $img;                         
                        $admin->image  = $img;
            }


$arr_where = ['id'=>$arr_data['id']];
unset($arr_data['update']);
$result = $this->admin_common_model->update_data('admin',$arr_data, $arr_where); 
//echo $this->db->last_query(); die;

$admin->name  = $arr_data['name'];
$this->session->set_userdata('admin',$admin);

        
if ($result) {
echo 
"<script> swal(
  'Success',
  'Update Profile Successfully',
  'success'
); 

$('.confirm').click(function(){
        window.location='".base_url('admin/view_page/dashboard')."';
});

</script>";

    }else{

echo "<script> swal(
  'Error',
  'Error In Updating Profile',
  'error'
); 

$('.confirm').click(function(){
        window.location='';
});

</script>";

}// end if result




}


?>






