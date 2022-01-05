 <?php include('include/header.php');?>
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


	<div class="container">
		<div style="background: #fff;
    padding: 30px;
    margin: 15px;
    box-shadow: 0px 0px 50px #c7c7c7;
    border-radius: 5px;">
    <form class="form-horizontal" method="POST" action="<?php echo base_url('home/addpost');?>" enctype="multipart/form-data">
    	<input type="hidden"  class="form-control" name="user_id" value="<?=$userId;?>">
			<div class="form-group row">
  <label for="example-text-input" class="col-2 col-form-label">Product Name</label>
  <div class="col-10">
   <input type="text" name="product_name"  class="form-control">
   <?php echo form_error('product_name');?>
  </div>
</div>
<div class="form-group row">
  <label for="example-search-input" class="col-2 col-form-label">category</label>
  <div class="col-10">

<select  name="cat_id" class="form-control form-control-lg">
					<?php  $category=$this->webservice_model->get_all('category');
                      foreach ($category as $key => $value) {
                      
					?>
					<option value="<?= $value['id'];?>" ><?= $value['category_name'];?></option>
					
					<?php }?>
				</select>
  </div>
</div>
  <div class="form-group row">
  <label for="example-url-input" class="col-2 col-form-label">Uplode Image</label>
  <div class="col-10">

     <input class="form-control" type="file" name="image" >
<!--       <div class="img-post-d">
      
      <p><table align="center" border="0" cellspacing="5" cellpadding="5">
        <tr>
      <?php for($i=1;$i<=5;$i++){

?>
          <td><label><input onchange="readURL(this,'img<?=$i?>');" type="file" name="product_image[]"><img src="http://technorizen.com/WORKSPACEVIJAY/SNIFF/uploads/images/no_image.png" id="img<?=$i?>"></label></td>
<?php }?>

        </tr>
      </table></p>
      
  
</div> -->
  </div>
</div>
<div class="form-group row">
  <label for="example-url-input" class="col-2 col-form-label">Price</label>
  <div class="col-10">
    <input class="form-control" type="number" name="price" >
    <?php echo form_error('price');?>
  </div>
</div>
<div class="form-group row">
  <label for="example-tel-input" class="col-2 col-form-label">Description</label>
  <div class="col-10">
    <textarea name="description" class="form-control"></textarea>
    <?php echo form_error('description');?>
  </div>
</div>
<div class="form-group row">
  <label for="example-password-input" class="col-2 col-form-label">Address</label>
  <div class="col-10">
    <input class="form-control" type="text" name="address">
    <?php echo form_error('address');?>
  </div>
</div>
<div class="form-group row">
  <label for="example-number-input" class="col-2 col-form-label">Company Name</label>
  <div class="col-10">
    <input class="form-control" type="text" name="compny_name">
  </div>
</div>
<div class="form-group row">
  <label for="example-datetime-local-input" class="col-2 col-form-label">Position</label>
  <div class="col-10">
    <input class="form-control" type="text" name="position">
  </div>
</div>
<div class="form-group row">
  <label for="example-date-input" class="col-2 col-form-label">Salary</label>
  <div class="col-10">
    <input class="form-control" type="number" name="salary">
  </div>
</div>
<div class="form-group row">
  <label for="example-month-input" class="col-2 col-form-label">Services</label>
  <div class="col-10">
    <input class="form-control" type="text" name="services">
  </div>
</div>
<div class="form-group row">
  <label for="example-week-input" class="col-2 col-form-label">Contact Details</label>
  <div class="col-10">
    <input class="form-control" type="number" name="contact_details">
  </div>
</div>
        <button type="submit" class="btn btn-primary">Post Submit</button>
    </form>
		</div>
	</div>

	<script type="text/javascript">
  window.onload = function() {

    var fileInput = document.getElementById('fileInput');
    var fileDisplayArea = document.getElementById('fileDisplayArea');

    fileInput.addEventListener('change', function(e) {
      var file = fileInput.files[0];
      var imageType = /image.*/;

      if (file.type.match(imageType)) {
        var reader = new FileReader();

        reader.onload = function(e) {
          fileDisplayArea.innerHTML = "";

          var img = new Image();
          img.src = reader.result;

          fileDisplayArea.appendChild(img);
        }

        reader.readAsDataURL(file); 
      } else {
        fileDisplayArea.innerHTML = "File not supported!"
      }
    });

    var fileInput2 = document.getElementById('fileInput2');
    var fileDisplayArea2 = document.getElementById('fileDisplayArea2');

    fileInput2.addEventListener('change', function(e) {
      var file = fileInput2.files[0];
      var imageType = /image.*/;

      if (file.type.match(imageType)) {
        var reader = new FileReader();

        reader.onload = function(e) {
          fileDisplayArea2.innerHTML = "";

          var img = new Image();
          img.src = reader.result;

          fileDisplayArea2.appendChild(img);
        }

        reader.readAsDataURL(file); 
      } else {
        fileDisplayArea2.innerHTML = "File not supported!"
      }
    });

    var fileInput3 = document.getElementById('fileInput3');
    var fileDisplayArea3 = document.getElementById('fileDisplayArea3');

    fileInput3.addEventListener('change', function(e) {
      var file = fileInput3.files[0];
      var imageType = /image.*/;

      if (file.type.match(imageType)) {
        var reader = new FileReader();

        reader.onload = function(e) {
          fileDisplayArea3.innerHTML = "";

          var img = new Image();
          img.src = reader.result;

          fileDisplayArea3.appendChild(img);
        }

        reader.readAsDataURL(file); 
      } else {
        fileDisplayArea3.innerHTML = "File not supported!"
      }
    });
    var fileInput4 = document.getElementById('fileInput4');
    var fileDisplayArea4 = document.getElementById('fileDisplayArea4');

    fileInput4.addEventListener('change', function(e) {
      var file = fileInput4.files[0];
      var imageType = /image.*/;

      if (file.type.match(imageType)) {
        var reader = new FileReader();

        reader.onload = function(e) {
          fileDisplayArea4.innerHTML = "";

          var img = new Image();
          img.src = reader.result;

          fileDisplayArea4.appendChild(img);
        }

        reader.readAsDataURL(file); 
      } else {
        fileDisplayArea4.innerHTML = "File not supported!"
      }
    });
}
</script>
 <style>

.img-post-d img{
      width: 159px;
    height: 148px;
    object-fit: cover;
}
.img-post-d input{
    visibility: hidden;
    position: absolute;
}

input[type=text]#year, input[type=text]#link {
  width: 184px;
}


.custom-file-input {
  border: 0;
  color: transparent;
  cursor: pointer;
  height: 40px;
  overflow: hidden;
  width: 115px;
  opacity: 1;
}

.custom-file-input:active {
  outline: 0;
}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}

.custom-file-input::before {
  background: #f68867;
  color: #fff;
  content: "Select the file";
  cursor: pointer;
  display: inline-block;
  font-size: 13px;
  letter-spacing: 1px;
  outline: none;
  padding: 14px;
  white-space: nowrap;
}


#fileDisplayArea, #fileDisplayArea2, #fileDisplayArea3, #fileDisplayArea4 {
  background: #fff;
  border-color: #ccc;
  box-sizing: border-box;
  border-style: dashed;
  height: 100px;
  overflow: hidden;
  padding: 10px;
  width: 115px;
}

#fileDisplayArea img, #fileDisplayArea2 img, #fileDisplayArea3 img, #fileDisplayArea4 img {
  height: auto;
  margin: -15px 0 0 -40px;
  width: 480%;
}


    </style>
<?php include('include/footer.php');?>

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
