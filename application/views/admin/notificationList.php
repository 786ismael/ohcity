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
    $('#example').DataTable();
  } );

  </script>
<body class="hold-transition skin-blue sidebar-mini" id="" ng-app="myApp">

<div class="wrapper" >
<?php 
        include 'include/header.php';

        $this->db->select('*');
		$this->db->from('notifications');
	    $this->db->order_by("notification_id","desc");
		$sql= $this->db->get();
		if($sql->num_rows()>0){
			$notificationList = $sql->result_array();
		}else{
			$notificationList = array();
		}
     
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
            <span class="fs30 cdG">Notifications </span> <a href="<?=base_url('admin/view_page/sendNotification');?>"><button type="button" class=" btn  btn-info-add btn-md mt-10 ml10" > Send Notification</button></a>

        <div class="row mt10">
           <div class="col-xs-12 cdG">

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="box-body table-responsive no-padding ">
             <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
               <th>Sr.</th>
               <th>Title</th>  
               <th>Message</th>
               <th>Date</th>
            </tr>
        </thead>
        <tbody>
           <?php $i=2; foreach($notificationList as $key => $row){ ?>
            <tr>
               <td><?php echo ++$key ;?></td>
               <td><?php echo $row['title']?></td>
               <td><?php echo $row['message']?></td>
               <td><?php echo date('d M Y' , strtotime($row['created_at'])).' at '.date('H :s A' , strtotime($row['created_at'])) ?></td>
            </tr>
          <?php } ?>
        </tbody>
         </table>
    </div>
    </div><!--#home-->
  </div><!--tab-content-->


    </div> <!-- /.col-xs-12 -->
        </div><!-- /row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

 </body>
</html>

  <?php if($this->session->flashdata('message')){

echo
"<script> swal(
'Success',
'Successfully sent notifications',
'success'
);
</script>";

  } ?> 