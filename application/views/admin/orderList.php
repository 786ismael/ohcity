<!DOCTYPE html>
<html>

<?php include 'include/head.php'; ?>

<?php include 'include/script.php' ?>

<!-- for datatable -->

<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

<script>

   $(document).ready(function() {
    $('#example').DataTable({        "aaSorting": []    });
  } );

  </script>

<body class="hold-transition skin-blue sidebar-mini" id="" ng-app="myApp">

<div class="wrapper" >
<?php include 'include/header.php';
                   $this->db->order_by('id','ASC');
 $arr_get = ['status !='=>'Process'];
      $userList = $this->admin_common_model->get_where('place_order',$arr_get);
     
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
    <form action="" method="POST" id="bulk_form">

      <span class="fs30 cdG">All Order </span>   

          <!-- <div class="box-body bcw mt20 ">
              <div class="">
                <div class="row pt10 ">
              
                <div class="col-sm-2">
                  <div class="form-group">
                    <select class="form-control " tabindex="-1" aria-hidden="true" name="bulk_action">
                      <option value="">---Bulk Select---</option>
                       <option value="delete">Delete</option>                   
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <a href="#" onclick="$('#bulk_form').submit()" class=" btn btn-default-add btn-block">Bulk Action</a>  
                </div>

              </div>
              </div>
              
        </div>-->

         



        <div class="row mt10">
           <div class="col-xs-12 cdG">

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="box-body table-responsive no-padding ">
             <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                  <!--<th><div class="[ form-group ] mb0">
                              <input name="action" id="user1" class="checkboxPar" type="checkbox" value="all">
                              <div class="[ btn-group ]">
                                  <label for="user1" class="[ myradioBtn ]">
                                      <span class="[ glyphicon glyphicon-ok ]"></span>
                                      <span></span>
                                  </label>
                              </div>

                        </div> </th>-->
                  <th>Transaction Id</th> 
                  <th>User Email</th>   
                  <th>Amount</th>  
                  <th>Order Details</th>
                  <th>Payment Status</th> 
                   <th>Date</th>                

                </tr>
        </thead>
        <tfoot>
            <tr>
                  <!--<th><div class="[ form-group ] mb0">
                              <input name="action" id="user1" class="checkboxPar" type="checkbox" value="all">
                              <div class="[ btn-group ]">
                                  <label for="user1" class="[ myradioBtn ]">
                                      <span class="[ glyphicon glyphicon-ok ]"></span>
                                      <span></span>
                                  </label>
                              </div>

                        </div> </th>-->
                  <th>Transaction Id</th> 
                  <th>User Email</th>   
                  <th>Amount</th>  
                  <th>Order Details</th>
                  <th>Payment Status</th> 
                   <th>Date</th>                 
                  
                </tr>
        </tfoot>
        <tbody>
           <?php $i=2; foreach($userList as $row){ 

      $username = $this->admin_common_model->get_where('users',['id'=>$row['user_id']]);
      $payment = $this->admin_common_model->get_where('payment',['order_id'=>$row['order_id']]);

      $ticket = $this->admin_common_model->get_where('ticket_numbers',['cart_id'=>$row['cart_id']]);

               
               ?>

                <tr>
              
                  <td style="min-width:10em">
                  <div class="row">
                 
                    <div class="col-sm-10">

                    <sapn>  <?= $payment[0]['token']; ?>

                       
                    </sapn></div><!-- /row -->
                
                  </div><!-- col-sm-10 -->
                </td>
                <td><p><?= $username[0]['email']; ?></p></td>
                <td><p><?= $payment[0]['total_amount']; ?></p></td>
                <td><a href="#" class="cdG" onclick="rided('<?= $row['id']; ?>')">Order Details</a></td>

                 
                <td>
                    <div class="">
                       <?php
                        if ($row['status'] == 'Pending'){
                          $img_url = base_url('uploads/images/check.png');
                        }else{
                          $img_url = base_url('uploads/images/uncheck.png');
                        }
                      ?>
                      <img src="<?=$img_url;?>" alt="" width="50"> 
                    </div><!-- col-sm-2 --></td>
                    
                <td><p><?= $row['date_time']; ?></p></td>


           
                             </tr>


               <?php $i++; } ?>
        </tbody>
    </table>
            </div>
    </div><!--#home-->



  </div><!--tab-content-->


    </div> <!-- /.col-xs-12 -->
        </div><!-- /row -->
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
  
  
  

<!-- ride detail start -->
         <div class="modal fade" id="myModal50" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center" style=" font-size: 25px;
">Order Details</h4>
                </div>
               
                
                <div class="service-content" style="padding:20px;">
           
                <table class="table table-user-information" style="width:60%;">
                
                    <tbody>
                        
                      <tr>
                        <td>Pickup Address:</td>
                        <td>gova</td>
                      </tr>
                      
                      <tr>
                        <td>Drop Address</td>
                        <td>Mumbai</td>
                      </tr>
                      
                      <tr>
                        <td>Date</td>
                        <td>8-2-2018</td>
                      </tr>

                          <tr>
                        <td>Time</td>
                        <td>10:50 AM</td>
                      </tr>

                       <tr>
                        <td>Ride Price</td>
                        <td>$20.00</td>
                      </tr>

                  <tr>
                        <td>Seats Available</td>
                        <td>4</td>
                      </tr>
                   
                <tr>
                        <td>Luggage Size</td>
                        <td>4</td>
                      </tr>

                     <tr>
                        <td>Luggage Quantity</td>
                        <td>4</td>
                      </tr>

                        <tr>
                        <td>Picup Flexibility</td>
                        <td>4</td>
                      </tr>

                      <tr>
                        <td>No. Pets Allowed</td>
                        <td>Yes</td>
                      </tr>
                   
                    
                    </tbody>
                  </table>
           
                </div>

            
              </div>
              
            </div>
        </div>
  <!-- ride details end -->


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
          data: {'table': 'place_order', 'id': id}, // change this to send js object
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

function rided(id)
{

$.get("<?=base_url('admin/get_ride_detail');?>?id="+id, function(data, status){
           $('.service-content').html(data);
           $('#myModal50').modal('show');
           // alert("Data: " + data + "\nStatus: " + status);
        });



 
}


</script>

<style type="text/css">
.table-striped > tbody > tr:nth-of-type(2n+1){
background-color: #fff;
}

.table-striped > tbody > tr{background-color: #f6f6f6;  }

</style>

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