<?php $this->session->flashdata('welcome');?>
<?php include('include/header.php');?>

 <?php //include('include/header.php');?>
 <?php
$userData = $this->session->userdata('users');
if(empty($userData)){
  $userId = '';
  redirect('home/view_load/sign-in');
}
else
{
   $userId = $userData['id'];
}
?>

<style type="text/css">
    .pt10{
      padding: 10px;
    }
    .nav-tabs {
    border-bottom: 1px solid #303030;
}
.nav-tabs .nav-link.active {
    border-color: #303030 #303030 #fff;
}
table tr:nth-child(odd){
 background-color: #f2f2f2;
 height: 20px;
 padding: 5px;
 box-shadow: 0px 0px 5px #afafaf;
}
table tr td a{
margin-left: 15px;
}
table tr th, table tr td{
  padding: 10px 15px;
  overflow: hidden;
  }
.new:hover{
  cursor: pointer;
  background-color: #ccc;
}
</style> 
<div class="container">
  <div style="min-height: 500px; margin: 15px; background: #fff; padding: 30px; box-shadow: 0px 0px 50px #c7c7c7; border-radius: 5px;">
	<div class="pt10">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ads</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Messages</a>
  </li>
<!--   <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Payments</a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link" id="Settings-tab" data-toggle="tab" href="#Settings" role="tab" aria-controls="Settings" aria-selected="false">Settings</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  	
	<div class="pt10">
		<ul class="nav" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
    

    <table width="100%">
      <tr style="height: 40px; background-color: #303030; color: #f2f2f2;">
        
        <th>Title</th>
        <th>Price</th>
        <th>Message</th>
      </tr>
      <?php 
           $arr = ['user_id'=>$userId];
             $product = $this->webservice_model->get_where('product',$arr);
             if ($product) {
              
            
            foreach ($product as $key => $value) {
            //print_r($value);
           
      ?>
      <tr style="height: 30px;">
        <td><?php echo $value['product_name'];?><br><a href="<?php echo site_url('home/view_load/singlepost/'.$value['id']);?>"><i class="fas fa-share-square"></i>Preview</a><a href=""><i class="fas fa-edit"></i>Edit</a><a href="#" onclick="deleteUsers('<?=$value["id"];?>')"><i class="fas fa-trash-alt"></i>Delete</a></td>
        <td><?php echo $value['price'];?></td>
        <td style="width: 50%"><?php echo $value['address'];?></td>
        
      </tr>
      <?php  }
          }else{

            echo "No product is avilable";
          }
      ?>
    </table>



  </div>
</div>
	</div>

  </div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  	
	<div class="pt10">
		<ul class="nav" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="ads-tab" data-toggle="tab" href="#ads" role="tab" aria-controls="ads" aria-selected="true">Inbox</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Sent</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false">Archive</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="ads" role="tabpanel" aria-labelledby="ads-tab">
    
    <table width="100%">
      <tr style="height: 40px; background-color: #303030; color: #f2f2f2;">
        <th><input type="checkbox" name=""></th>
        <th>User</th>
        <th>Ad</th>
        <th>Date</th>
      </tr>
        <?php 

        $arr = ['receiver_id'=>$userId];
         $sender=$this->webservice_model->get_where('kaise_chat_detail',$arr);
         if (empty($sender)) {
           echo "No data found";
         }else{
       foreach ($sender as $res) {
         //print_r($res);
          $ab=$res['product_id'];
          ?>
           
          
     <tr id="mymassage" >
        <td><input type="checkbox" name=""> <i class="far fa-star"></i> <i class="far fa-trash-alt"></i></td>
        <td>me</td>
        <?php    $arr12 = ['id'=>$ab];
$pro12=$this->webservice_model->get_where('product',$arr12); 
//print_r($pro);
if (empty($pro12)) {
  # code...
}else{
foreach ($pro12 as $key => $value) {

//print_r($pros);

?> 

        <td width="50%"><p><strong><?php echo $value['product_name']; ?></strong></p><?php echo $res['chat_message']; ?></td>
        <?php  }}?>
        <td><a href="<?php echo base_url();?>home/view_load/chat_view/<?php echo $res['receiver_id'];?>/<?php echo $value['id'];?>">View massage</a><br><?php echo $res['date'];?></td>
      </tr><?php }}?>

    </table>
      
  </div>

  <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
    <table width="100%">
      <tr>
        <th><input type="checkbox" name=""></th>
        <th>User</th>
        <th>Ad</th>
        <th>Date</th>
        <th>View massage</th>
      </tr>
          <?php
        $arr = ['sender_id'=>$userId];
       $sent=$this->webservice_model->get_where('kaise_chat_detail
',$arr); $i=1;
   foreach ($sent as  $sender) {
      //print_r($sender);
     $ab=$sender['product_id'];
   
 ?>

      <tr id="mymassage<?php echo $i;?>" class="new">
        <td><input type="checkbox" name=""> <i class="far fa-star"></i> <i class="far fa-trash-alt"></i></td>
        <td>me</td>
        <?php    $arr12 = ['id'=>$ab];
$pro12=$this->webservice_model->get_where('product',$arr12); 
//print_r($pro);
if (empty($pro12)) {
  
}else{



foreach ($pro12 as $key => $value) {

//print_r($pros);

?> 

        <td width="50%"><p><strong><?php echo $value['product_name']; ?></strong></p><?php echo $sender['chat_message']; ?></td>
        <?php  }}?>
        <td><a href="<?php echo base_url();?>home/view_load/chat_view/<?php echo $sender['receiver_id'];?>/<?php echo $value['id'];?>">View massage</a><br><?php echo $sender['date'];?></td>
      </tr>
      <?php $i+=1;}?> 
    </table>
<div id="massageshow" style="display: none">
    <div style="padding-left: 100px;">
      <div style="padding:10px"><span>User</span>
      <span style="float: right;">Chat Date&Time</span></div>
      <div>
        <table width="100%">
          <tr style="background-color: #f1f1f1; height: 50px;">
            <td>Message</td>
          </tr>
          <tr>
            <td><textarea rows="5" style="width: 100%; margin: 15px 0px;"></textarea></td>
          </tr>
        </table>
    <input type="submit" name="" class="btn btn-warning">
      </div>
    </div>
  </div>
  </div>

  <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
    <table width="100%">
      <tr>
        <th><input type="checkbox" name=""></th>
        <th>User</th>
        <th>Ad</th>
        <th>Date</th>
      </tr>
      <tr>
        <td><input type="checkbox" name=""> <i class="far fa-star"></i> <i class="far fa-trash-alt"></i></td>
        <td>User</td>
        <td width="50%">more r</td>
        <td>Date</td>
      </tr>
    </table>
  </div>
</div>
	</div>
</div>

  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  	
	<div class="pt10">
		<ul class="nav" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="true">History</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="false"> E-invoices </a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="history" role="tabpanel" aria-labelledby="history-tab">1111111111</div>
  <div class="tab-pane fade" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">2222222222222222222</div>
</div>
	</div>

  </div>

  <div class="tab-pane fade" id="Settings" role="tabpanel" aria-labelledby="Settings-tab">
  	<div class="pt10">
	<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" id="changed" aria-expanded="true" aria-controls="collapseOne">
         Change contact details
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <?php $data=$this->webservice_model->get_where('users',['id'=>$userId]);
           foreach ($data as $key => $value) {
             
          
        ?>
           <form method="post" action="<?php echo base_url('home/editAccount');?>">
            <input type="hidden" name="user_id" value="<?=$userId?>">
     <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?=$value['username']?>" aria-describedby="emailHelp" placeholder="username">
    
     </div>
    <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?=$value['email']?>" aria-describedby="emailHelp" placeholder="EMAIL">
     </div>
     <button type="submit" class="btn btn-primary">Update</button>


           </form>
           <?php  }?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Change phone
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <?php $data=$this->webservice_model->get_where('users',['id'=>$userId]);
           foreach ($data as $key => $value) {
             
          //print_r($value);
        ?>
        <form method="post" action="<?php echo base_url('home/editphone');?>">
          <input type="hidden" name="user_id" value="<?=$userId?>">
       <div class="form-group">
          <label for="exampleInputEmail1">phone</label>
          <input type="text" class="form-control" id="phone" name="phone" value="<?=$value['phone']?>" aria-describedby="emailHelp" placeholder="username">
    
     </div>
        <button type="submit" class="btn btn-primary">Update phone</button>
   </form>
   <?php }?>
      </div>
    </div>
  </div>
  <div class="card">
<!--     <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Change password
        </button>
      </h5>
    </div> -->
  <!--   <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        333
      </div>
    </div> -->
  </div>
</div>
</div>
  </div>

</div>
	</div>
	</div>
</div>
<script type="text/javascript">
   
   $('document').ready(function(){
       $('changed').click(function(){


       });

       $('#mainshow').click(function(){
         //alert('ko');
        $('#massageshow').toggle();
        //$('#mainshow').hide();
       });

   });

</script>
<script type="text/javascript">


function deleteUsers(id){

 $.ajax({
          url: "<?=base_url('home/delete_data');?>",
          data: {'table': 'product', 'id': id}, // change this to send js object
          type: "POST",
          success: function(result){
            location.reload();
            //swal("Deleted!", "Your selected item has been deleted.", "success");
  
           
             

          }
        });

}
</script>
<?php include('include/footer.php');?>


