<!DOCTYPE html>
<html>
<?php include 'include/head.php'; ?>
<body class="hold-transition skin-blue sidebar-mini" id="home">
<div class="wrapper">

<?php 
// $res = $this->db->query("SELECT count(id) AS id,date_time FROM `users` GROUP BY DATE_FORMAT(date_time, '%Y-%m')")->result_array();

$res = $this->db->query("SELECT id AS id,date_time FROM `users`")->result_array();

foreach($res AS $val){
 

 $date = date('Y-m', strtotime($val['date_time'])); 
 $data[] = ['y'=>$date, 'item1'=>$val['id']];

}

$data = unique_key($data,'date_time');
$data = json_encode($data);

function unique_key($array,$keyname){

 $new_array = array();
 foreach($array as $key=>$value){

   if(!isset($new_array[$value[$keyname]])){
     $new_array[$value[$keyname]] = $value;
   }

 }
 $new_array = array_values($new_array);
 return $new_array;
}

include 'include/header.php'; ?>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
     <div class="box box-info">
            <div class="box-header " >

              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn clg btnclose" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                 <i class="fa fa-times" aria-hidden="true"></i> Dismiss</button>
              </div>
              <!-- /. tools -->
            </div>


            <div class="box-body cdG">

             
              
              <div class="col-sm-6 ">
                <h1 >Welcome to Demo</h1>
                <p class="fontOSL fs22">We’ve assembled some links to get you started:</p>
                <h3 class="fw600">Get Started</h3>
              </div><!-- /.col-sm-6 -->

              <div class="col-sm-6">
                 
                <?php // if($admin->type=='ADMIN'){ ?>
                 <div class="col-sm-6" onclick="location.href='<?=base_url('admin/view_page/userList123');?>'" style="cursor:pointer">
                   <div class="panel panel-blue panel-widget ">
                      <div class="row no-padding">
                         <div class="col-sm-3 widget-left">
                            <i class="fa fa-user-plus" aria-hidden="true" style="font-size:3em"></i>
                         </div>
                         <div class="col-sm-9 widget-right">
                            <div class="large">
                              <?= $this->db->where ("MONTH( date_time ) = MONTH( CURRENT_DATE( ) ) ")->get('users')->num_rows();?>
                            </div>
                            <div class="text-muted">New Users</div>
                         </div>
                      </div>
                   </div>
                </div>

                <div class="col-sm-6" onclick="location.href='<?=base_url('admin/view_page/userList123');?>'" style="cursor:pointer">
                   <div class="panel panel-blue panel-widget ">
                      <div class="row no-padding">
                         <div class="col-sm-3 widget-left">
                            <i class="fa fa-user" aria-hidden="true" style="font-size:3em"></i>
                         </div>
                         <div class="col-sm-9 widget-right">
                            <div class="large">
                              <?= $this->db->get('users')->num_rows();?>
                            </div>
                            <div class="text-muted">All Users</div>
                         </div>
                      </div>
                   </div>
                </div>
               <?php // } ?>
               
                
              </div><!-- /.col-sm-6 -->

  

       <div class="col-sm-12">
          <!-- AREA CHART -->
        <!--  <div class=" box box-info">
                    <div class="box-header with-border">
              <h3 class="box-title">User Registration Analysis </h3>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="revenue-chart" style="height: 300px;"></div>
            </div>
         
          </div>  -->
        </div><!--col-sm-6-->
          <!-- /.box -->

        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->  

<?php include 'include/script.php' ?>
<script src="<?=base_url('assets/admin');?>/plugins/morris/morris.min.js"></script>

<script>
  $(function () {
    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: <?=$data;?>,
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Users'],
      lineColors: ['#a0d0e0'],
      hideHover: 'auto'
    });

 
  });
</script>
</body>
</html>