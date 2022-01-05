<!DOCTYPE html>
<html>
<?php include 'include/head.php';
 
      $button = "submit";
      $btn_name = "Add My Project";
      $path = base_url("uploads/images/no_image.png");
      $id = $this->uri->segment(4);
      if($id!=''){
        $fetch = $this->admin_common_model->get_where('myProjects',['id'=>$id]);
        $row = $fetch[0];
        $button = "update";
        $btn_name = "Update My Project";        
        if($row['image']!=''){
          $path = base_url("uploads/images/".$row['image']);
        }
      }
      

 ?>

<body class="hold-transition skin-blue sidebar-mini" id="">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
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
            <label for="inputEmail3" class="col-sm-2 control-label">Project Name</label>
            <div class="col-sm-8">
              <input type="text"  class="form-control" name="project_name"  value="<?=$row['project_name'];?>">
            </div>
          </div>

            <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Webservice</label>
            <div class="col-sm-8">
                <select class="form-control" name="webservice" required > 
            <option value="">--select--</option>
            <option value="Yes" <?php if($row['webservice']=='Yes'){ echo 'selected'; } ?>>Yes</option>
            <option value="No" <?php if($row['webservice']=='No'){ echo 'selected'; } ?>>No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Admin</label>
            <div class="col-sm-8">
                <select class="form-control" name="admin" required > 
            <option value="">--select--</option>
            <option value="Yes" <?php if($row['admin']=='Yes'){ echo 'selected'; } ?>>Yes</option>
            <option value="No" <?php if($row['admin']=='No'){ echo 'selected'; } ?>>No</option>
              </select>
            </div>
          </div>

           <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
            <div class="col-sm-8">
                <select class="form-control" name="website" required > 
            <option value="">--select--</option>
            <option value="Yes" <?php if($row['website']=='Yes'){ echo 'selected'; } ?>>Yes</option>
            <option value="No" <?php if($row['website']=='No'){ echo 'selected'; } ?>>No</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Assign Date</label>
            <div class="col-sm-8">
              <input type="date"  class="form-control" name="assign_date"  value="<?=$row['assign_date'];?>">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Complete Date</label>
            <div class="col-sm-8">
              <input type="date"  class="form-control" name="complete_date"  value="<?=$row['complete_date'];?>">
            </div>
          </div>

         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Project Status</label>
            <div class="col-sm-8">
                <select class="form-control" name="status" required > 
            <option value="">--select--</option>
            <option value="Ongoing" <?php if($row['status']=='Ongoing'){ echo 'selected'; } ?>>Ongoing</option>
            <option value="Complete" <?php if($row['status']=='Complete'){ echo 'selected'; } ?>>Complete</option>
              </select>
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

    

 </body>
</html>



<?php

extract($_REQUEST);
// for add holidays
if(isset($submit)){

            $arr_data = $this->input->post();

            if($_FILES['image']['name']!=''){
    
                        $n = rand(0, 100000);
                        $img = "USER_IMG" . $n . '.png';
                        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
                        $arr_data['image'] = $img; 

            }


unset($arr_data['submit'],$arr_data['id']);
$result = $this->admin_common_model->insert_data('myProjects',$arr_data); 
//echo $this->db->last_query(); die;
             
        
if ($result) {
echo 
"<script> swal(
  'Success',
  'Add My Project Successfully',
  'success'
); 

$('.confirm').click(function(){
        window.location='".base_url('admin/view_page/myProject')."';
});

</script>";

    }else{

echo "<script> swal(
  'Error',
  'Error In Add My Project',
  'error'
); 

$('.confirm').click(function(){
        window.location='';
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
                        $img = "USER_IMG" . $n . '.png';
                        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
                        $arr_data['image'] = $img; 

            }


$arr_where = ['id'=>$arr_data['id']];
unset($arr_data['update']);
$result = $this->admin_common_model->update_data('myProjects',$arr_data, $arr_where); 
//echo $this->db->last_query(); die;
             
        
if ($result) {
echo 
"<script> swal(
  'Success',
  'Update My Project Successfully',
  'success'
); 

$('.confirm').click(function(){
        window.location='".base_url('admin/view_page/myProject')."';
});

</script>";

    }else{

echo "<script> swal(
  'Error',
  'Error In Updating My Project',
  'error'
); 

$('.confirm').click(function(){
        window.location='';
});

</script>";

}// end if result




}


?>



