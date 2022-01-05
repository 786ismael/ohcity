<footer>
	<div class="clearfix">
		<div class="content-part section-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<h2>About</h2>
						<img src="">
						<p>Sed porta ac mauris at pretium. Mauris tincidunt enim non imp Sed porta ac mauris at pretium. Mauris tincidunt enim non imp</p>
						<div class="red"><a href="about_us.html" id="red">Know More</a></div>
					</div>
					<div class="col-md-3">
						<h2>Contact</h2>
						<p><i class="fa fa-phone"></i> 000-000-0000</p>
						<p><i class="fa fa-map-marker"></i> Sed porta ac mauris at pretium. Mauris tincidunt enim non imp Sed porta ac mauris at pretium.</p>
						<p><i class="fa fa-envelope"></i> info@demo.com</p>
					</div>
					<div class="col-md-3">
						<h2>Quick Link</h2>
						<p><a href="#"><i class="fa fa-chevron-right"></i> Job</a></p>
						<p><a href="#"><i class="fa fa-chevron-right"></i> Ads</a></p>
						<p><a href="#"><i class="fa fa-chevron-right"></i> Buy</a></p>
						<p><a href="#"><i class="fa fa-chevron-right"></i> Sell</a></p>
						<p><a href="faq.html"><i class="fa fa-chevron-right"></i> Faq</a></p>
					</div>
					<div class="col-md-3">
						<h2>Newsletter</h2>
						<p>Sed porta ac mauris at pretium.  Sed porta ac mauris at pretium.</p>
						<h5>Sign Up for the Newsletter</h5>
						<input type="email" name="email" placeholder="Email">
						<div class="red"><a href="#" id="red">Sign Up</a></div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="copy-right-bar">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<ul>
							<li><a href="#" title=""><i class="fa fa-facebook-f"></i></a></li>
							<li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" title=""><i class="fa fa-instagram"></i></a></li>
							<li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<p><a href="terms_conditions.html">© 2018 - Classified</a></p>
					</div>
					<div class="col-md-5" style="margin-top: 7px">
						<ul>
							<li><a href="#" title=""><img src="images/icon-pay.png"></a></li>
							<li><a href="#" title=""><img src="images/icon-discover.png"></i></a></li>
							<li><a href="#" title=""><img src="images/icon-master.png"></i></a></li>
							<li><a href="#" title=""><img src="images/icon-visa.png"></a></li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
</footer>
<script type="text/javascript">
    $(document).ready(function(){

        $('#edit').click(function(){
      
            $('#hide').toggle();
        });

        
    });

  </script>

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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhAIStVSYCBtZXv7JaksD8F6kz3e9pYYw&sensor=false&libraries=places"></script>
<script type="text/javascript">
  var source, destination;
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  google.maps.event.addDomListener(window, 'load', function () {
    new google.maps.places.SearchBox(document.getElementById('address'));
    directionsDisplay = new google.maps.DirectionsRenderer({});
    
  });

  $(function () {
    $("#address").change(function () {
      
      var geocoder = new google.maps.Geocoder();
      var address = document.getElementById("address").value;
      geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var latitude = results[0].geometry.location.lat();
          var longitude = results[0].geometry.location.lng();
          $('#latitude').val(latitude);
          $('#longitude').val(longitude);
                    //alert("Latitude: " + latitude + "\nLongitude: " + longitude);
                  }
                });
    });
  });
</script>

  <?php if(!empty($this->session->flashdata('welcome'))){?>
<span id="welcome">
  <script>
    setTimeout(function(){alert("<?php echo $this->session->flashdata('welcome');?>");}, 1000);
  </script>
</span>
<?php }?>
</body>
</html>