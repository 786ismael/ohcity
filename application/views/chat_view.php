<?php $this->session->flashdata('welcome');?>
<?php include('include/header.php');?>

<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">

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
 $reciver=$this->uri->segment('4');
 $product=$this->uri->segment('5');


?>

<style type="text/css">
.desifb-chatt10 h4{
font-size: 15px;
    margin-left: 15px;
}

.desifb-chatt10 p{
  background-color: #f1eded;
    padding: 15px;
    border-radius: 6px;
    width:100%;
    margin-left: 13px;
}

.desifb-chatt10{
     margin-left: 26%;
}

.desifb-chatt img{
      width: 44px;
    margin-top: 6px;
}
.desifb-chatt h4{
    font-size: 15px;
    margin-left: 15px;
}

.desifb-chatt span{
    margin-left: 23px;
    font-size: 12px;
}

.desifb-chatt p{
  background-color: #f1eded;
    padding: 15px;
    border-radius: 6px;
    width: 79%;
    margin-left: 13px;
}


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
<?php    $ar = ['receiver_id'=>$reciver,'product_id'=>$product];
$sender=$this->webservice_model->get_where('kaise_chat_detail',$ar);
if (empty($sender)) {
 
}else{
 foreach ($sender as $rec) {
   //print_r($value);


 ?>
<div class="desifb-chatt">
<div class="media">
  <div class="media-left media-middle">
    <!-- <a href="#">
      <img class="media-object" src="https://i1.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100" alt="...">
    </a> -->
  </div>
  <div class="media-body">
    <h4 class="media-heading">sender <span class="text-right"><i class="far fa-clock"></i> <?php echo $rec['date'] ?></span></h4>
   <p><?php echo $rec['chat_message'];?> </p>
  </div>
</div>
</div>
<?php }} ?>
<?php    $ar = ['sender_id'=>$userId,'product_id'=>$product];
$sender1=$this->webservice_model->get_where('kaise_chat_detail',$ar);
if (empty($sender1)) {
 
}else{
 foreach ($sender1 as $send) {
   //print_r($value);


 ?>

<div class="desifb-chatt10">
<div class="media">
  <div class="media-body">
    <h4 class="media-heading">me</h4>
   <p><?php echo $send['chat_message'];?></p>
  </div>
</div>
</div>
<?php 
 }
} ?>

<!-- <div class="desifb-chatt">
<div class="media">
  <div class="media-left media-middle">
    <a href="#">
      <img class="media-object" src="https://i1.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100" alt="...">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Johan Doe <span class="text-right"><i class="far fa-clock"></i> 2:00 AM</span></h4>
   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </p>
  </div>
</div>
</div> -->
<form method="post" action="<?php echo base_url('home/chat_insert');?>">
<div class="sent-message">
<div class="form-group">
    <label for="exampleInputEmail1">Message</label>
    <input type="hidden" name="product_id" value="<?php echo $product?>">
    <input type="hidden" name="sender_id"  value="<?php echo $userId;?>">
   
    <input type="hidden" name="receiver_id"  value="<?php echo $reciver;?>">
    
     <textarea class="form-control" id="exampleFormControlTextarea1" name="chat_message" rows="3"></textarea>
  </div>


<div class="text-center">

<input type="submit"  value="send" class="btn btn-success">
</div>

</div></form>
  
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


