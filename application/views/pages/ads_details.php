<article>
  <div class="clearfix">
    <div class="content-part section-job-detail">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2 left-box">
                <a><img src="<?php echo base_url();?>assets/frontcss/images/02.jpg" alt="" title="" width="100%"></a>
                <a><img src="<?php echo base_url();?>assets/frontcss/images/02.jpg" alt="" title="" width="100%"></a>
          </div>
          <div class="col-md-8 right-box">
            <div class="row add-list">
              <div class="col-md-2">
                <div class="media">
                  <a class=""><img src="<?php echo base_url('uploads/images/'.$product_detail[0]['image'])?>" width="100%" style="height:100px;"></a>
                </div>
              </div>
              <div class="col-md-8">
                <ul>
                  <li><h4><?php echo $product_detail[0]['product_name'];?></h4></li>
                  <li> <?php echo $product_detail[0]['address'];?></li>
                </ul>
              </div>
              <div class="col-md-2">
                <ul>
                  <li><a href="#"><i class="fa fa-heart"></i></a></li>
                  <li><a href="#"><i class="fa fa-share-alt"></i></a></li>
                  <li><a href="#"><i class="fa fa-comments"></i></a></li>
                </ul>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 left">
                <p><?php echo $product_detail[0]['description'];?></p>
                <button class="btn btn-success">Apply Now</button>
                <button class="btn btn-success">Modify Ad</button>
              </div>
              <div class="col-md-5">
                <div class="table ad_data">
                  <table border="1" class="table">
                    <tr>
                      <td colspan="2">More Information</td>
                    </tr>
                    <tr>
                      <td>Contact :</td>
                      <td><?php echo $user_detail[0]['phone'];?></td>
                    </tr>
                    <tr>
                      <td>Email :</td>
                      <td><?php echo $user_detail[0]['email'];?></td>
                    </tr>
                    <tr>
                      <td>Post On :</td>
                      <td><?php echo $product_detail[0]['date_time'];?></td>
                    </tr>
                  </table>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 left-box">
                <a><img src="<?php echo base_url();?>assets/frontcss/images/01.jpg" alt="" title="" width="100%"></a>
                <a><img src="<?php echo base_url();?>assets/frontcss/images/01.jpg" alt="" title="" width="100%"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>