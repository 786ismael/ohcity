	<?php include('include/header.php');?>
<style type="text/css">
 p{
  text-align: center;
 }
 .pre{
  box-shadow: 0px 0px 20px #ccc;
  margin: 15px;
  padding: 10px;
  flex: 22%;
 }
img.myimg {
    width: 100%;
    height: 150px;
}

</style>
</head>
<body>
	

<div class="container">
 <div class="row">
  <?php 
                          $arr_get = ['cat_id'=>$this->uri->segment('4')];
            $product = $this->webservice_model->get_where('product',$arr_get);
            
            if ($product) {
              # code...
          
               
               foreach ($product as $key => $value) {?>
  <div class="col-md-3 pre">
   <p><a href="<?php echo site_url('home/view_load/singlepost/'.$value['id']);?>"><img src="<?php echo base_url();?>uploads/images/<?php echo $value['image'];?>" alt="Mobile" title="Mobile" class="myimg"  st></a></p>
   <p><a href="<?php echo site_url('home/view_load/singlepost/'.$value['id']);?>"> <?php echo $value['product_name'];?></a></p>
   <p><i><a href="<?php echo site_url('home/view_load/singlepost/'.$value['id']);?>"><small><?php echo $value['description'];?></small></a></i></p>
   <p><strong><a href="<?php echo site_url('home/view_load/singlepost/'.$value['id']);?>"><small><?php echo $value['price'];?></small></a></strong></p>
  </div>
<?php 
         }
       }else{?>

     <div class="nodatafound" style="    height: 150px;
    
    margin-left: 370px;
    margin-top: 20px;
}">
       <p>No data found </p>
     </div>
       <?php }
        ?>

    
      
 </div>
</div>
		<?php include('include/footer.php');?>



		