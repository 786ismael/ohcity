<!DOCTYPE html>
<html>

<?php include 'include/head.php'; ?>

<?php include 'include/script.php' ?>

<body class="hold-transition skin-blue sidebar-mini" id="" ng-app="myApp">

<div class="wrapper" >
<?php 
     include 'include/header.php';
     
       
      $userList = $this->admin_common_model->get_all('users');
     
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.css" rel="stylesheet" type="text/css">
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url('notification/sendNotification') ;?>">
          <input type="hidden"  class="form-control" name="id" value="<?=$row['id'];?>">

          <div class="col-sm-6">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Users</label>
              <div class="col-sm-8">
            
                
                                 <button type="button" class="btn btn-default chosen-toggle select">Select all</button>
  <button type="button" class="btn btn-default chosen-toggle deselect">Unselect all</button> 
                <select name="users[]" class="select2" multiple required>
                  <?php foreach($userList as $user): ?>
                   <option value="<?php echo $user['id'] ;?>"><?php echo ucfirst($user['first_name']) .' '.$user['last_name'] ?></option>
                  <?php endforeach  ?>
                </select>

              </div>
            </div>          
          </div>
          <div class="col-md-6">
              <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-8">
              <input type="text"  class="form-control" name="title" required>
            </div>
          </div>

           <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-8">
              <textarea name="message" class="form-control" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class=" col-sm-2 col-sm-offset-2">
              <button type="submit" name="<?=$button;?>" class="btn btn-dang-add mr10 ">Send</button>
            </div>
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
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.jquery.min.js"></script>

<script type="text/javascript">

     $('.select2').chosen();
        
$('.chosen-toggle').each(function(index) {
console.log(index);
    $(this).on('click', function(){
    console.log($(this).parent().find('option').text());
         $(this).parent().find('option').prop('selected', $(this).hasClass('select')).parent().trigger('chosen:updated');
    });
});
    
//   $('select').on('click',function(e){
//       e.preventDefault();
//       click = $(this);
      
//       if(click.val() == 'select-all'){
//           $('select option:first').val('unselect-all');
//           $('select option:first').text(' -- Unselect All --');
//           $('select option').prop('selected', true);
//       }else if(click.val() == 'unselect-all'){
//           $('select option:first').text(' -- Select All --');
//           $('select option:first').val('select-all');
//           $('select option').prop('selected', false);
//       }

//   });
</script>





