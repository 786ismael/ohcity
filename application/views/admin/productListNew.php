<!DOCTYPE html>
<html>
   <?php include 'include/head.php'; ?>
   <?php include 'include/script.php' ?>
   <!-- for datatable -->
   <link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
   <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
   
   <body class="hold-transition skin-blue sidebar-mini" id="" ng-app="myApp">
      <div class="wrapper" >
         <?php include 'include/header.php';
            $productList = $this->admin_common_model->get_where('product',[delete_status=>'no']);
            
            ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
               <form action="" method="POST" id="bulk_form">
                  <span class="fs30 cdG">Products </span><!-- <a href="<?=base_url('admin/view_page/AdNwProduct');?>"><button type="button" class=" btn  btn-info-add btn-md mt-10 ml10" > Add New</button></a>
                     -->
                  <div class="row mt10">
                     <div class="col-xs-12 cdG">
                        <div class="tab-content">
                           <div id="home" class="tab-pane fade in active">
                              <div class="box-body table-responsive no-padding ">
                                 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                       <tr>
                                          <th>Product Name</th>
                                          <th>Username</th>
                                          <th>User Image</th>
                                          <th>Category</th>
                                          <th>Image1</th>
                                          <th>Image2</th>
                                          <th>Image3</th>
                                          <th>Image4</th>
                                          <th>Price</th>
                                          <th>Description </th>
                                          <th>Address</th>
                                       </tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
                                          <th>Product Name</th>
                                          <th>Username</th>
                                          <th>User Image</th>
                                          <th>Category</th>
                                          <th>Image1</th>
                                          <th>Image2</th>
                                          <th>Image3</th>
                                          <th>Image4</th>
                                          <th>Price</th>
                                          <th>Description </th>
                                          <th>Address</th>
                                       </tr>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <!--#home-->
                        </div>
                        <!--tab-content-->
                     </div>
                     <!-- /.col-xs-12 -->
                  </div>
                  <!-- /row -->
               </form>
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
      <!-- start the model here -->
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Create Shop Owner</h4>
               </div>
               <form action="<?=base_url('admin/create_owner');?>" method="POST">
                  <div class="modal-body">
                     <input type="hidden"  class="form-control" id="user_id" name="user_id">
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Select Shop</label>
                        <div class="col-sm-8">
                           <select class="form-control" name="shop_id">
                              <?php  foreach($shops as $arr){ ?>
                              <option value="<?=$arr['id'];?>"> <?=$arr['name'];?> </option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer" style="text-align: center;">
                     <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
            </div>
            </form>
         </div>
      </div>
      <!-- end the model here -->
   </body>
</html>
<script>
   // for open dialog popup
       $('select').change(function () {
           
        if ($(this).val() == "notification") {
               $('#dialog-modal').click();
           }
       });
   
</script>
<script>
   // delete function
   function deleteUsers(id)
   {
     swal({
     title: "Are you sure?",
     text: "You want to permanently remove this item!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Yes, delete it!",
     closeOnConfirm: false
   },
   function(){
   
   
   
           $.ajax({
             url: "<?=base_url('admin/delete_data');?>",
             data: {'table': 'product', 'id': id}, // change this to send js object
             type: "POST",
             success: function(result){
               //alert(result);
               swal("Deleted!", "Your selected item has been deleted.", "success");
     
               $('.confirm').click(function(){
                  location.reload();
               });
                
   
             }
           });
   
     
   
   });
   
   } 
   // end delete function
   
</script>
<style type="text/css">
   .table-striped > tbody > tr:nth-of-type(2n+1){
   background-color: #fff;
   }
   .table-striped > tbody > tr{background-color: #f6f6f6;  }
</style>
<script>
      $(document).ready(function(e){
        var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this
        $('#example').DataTable({
           "pageLength" : 10,
           "serverSide": true,
           "order": [[0, "asc" ]],
           "ajax":{
                    url :  base_url+'admin/getProductRecord',
                    type : 'POST'
                  },
                      "columns": [
                      { data: 'product_name', name: 'product_name' , 
                          render: function (data, type, column, meta) {
                            var html = `<div class="col-sm-10">
                                    <sapn> `+column.product_name+`<div><span><a href="#" class="cdG" onclick="deleteUsers('`+column.id+`')">Delete</a></span>
                                        </div>
                                    </sapn>
                                 </div>`;

                          return html;
                          }
                      },
                      { "data": "username" },
                      { data: 'user_image', name: 'user_image' , 
                          render: function (data, type, column, meta) {
                            console.log(column);
                          return '<img src="'+base_url+'uploads/images/'+column.user_image+'" width="60">'
                          }
                      },
                      { "data": "category_name" },
                      { data: 'image', name: 'image' , 
                          render: function (data, type, column, meta) {
                            console.log(column);
                          return '<img src="'+base_url+'uploads/images/'+column.image+'" width="60">'
                          }
                      },
                      { data: 'image1', name: 'image1' , 
                          render: function (data, type, column, meta) {
                            console.log(column);
                          return '<img src="'+base_url+'uploads/images/'+column.image1+'" width="60">'
                          }
                      },
                      { data: 'image2', name: 'image2' , 
                          render: function (data, type, column, meta) {
                            console.log(column);
                          return '<img src="'+base_url+'uploads/images/'+column.image2+' "width="60">'
                          }
                      },
                      { data: 'image3', name: 'image3' , 
                          render: function (data, type, column, meta) {
                            console.log(column);
                          return '<img src="'+base_url+'uploads/images/'+column.image3+'" width="60">'
                          }
                      },
                      { "data": "price" },
                      { "data": "address" },
                      { "data": "description" },
                   ]   
                  
        }); // End of DataTable
      

      
    });


   </script>
<script type="text/javascript">
   $(function () {
     $('.checkboxPar').change(function(){ 
       $("#home input:checkbox").prop('checked', $(this).prop("checked"));
     })
   })
   
   $(function () {
     $('.checkboxPar1').change(function(){ 
       $("#menu1 input:checkbox").prop('checked', $(this).prop("checked"));
     })
   })
   
   $(function () {
     $('.checkboxPa2').change(function(){ 
       $("#menu2 input:checkbox").prop('checked', $(this).prop("checked"));
     })
   })
   
</script>
