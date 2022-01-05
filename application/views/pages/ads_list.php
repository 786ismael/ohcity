<article>
  <div class="clearfix">
    <div class="content-part section-job-list">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2 left-box">
            <img src="<?php echo base_url();?>assets/frontcss/images/02.jpg" width="100%">
          </div>
          <div class="col-md-8 right-box">
            <div class="row add-list">
              <div class="col-md-8">
                <?php
                ?>
                <h4><?php echo $product_lists_count->ads_count?$product_lists_count->ads_count:'0';?> Ads List found</h4>
              </div>
              <div class="col-md-4">
                <label>Sort by :
                  <select>
                    <option>Relevance</option>
                  </select>
                </label>
              </div>
            </div>

            <?php

            if(!empty($product_lists)){
              $i=1;
              foreach($product_lists as $product_list) { 
              $product_image = base_url().'uploads/images/'.$product_list['image'];
                ?>

                <div class="add-list">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="media">
                        <a class="" href="<?php echo base_url('homepage/ads_details/'.$product_list['id'])?>"><img src="<?php echo $product_image;?>" width="100%" style="height:100px;"></a>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <ul>
                        <li><h4><a href="<?php echo base_url('homepage/ads_details/'.$product_list['id'])?>"><?php echo $product_list['product_name'];?></a></h4></li>
                        <li><strong>Ads detail</strong></li>
                        <?php $ads_category = $this->webservice_model->get_where('category',['id'=>$product_list['cat_id']]);?>
                        <li><small>Category : <b><?php echo $ads_category[0]['category_name']?></b></small></li>
                        <li><small>Post on : <b><?php echo $product_list['date_time'];?></b></small></li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul>
                        <li><h4>Price : <?php echo $product_list['price'];?></h4></li>
                        <li><h6>Address : <?php echo $product_list['address'];?></h6></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <?php if($i==10){break;}$i++;}}?>
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-end">
                    <li class="page-item">
                      <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
              </div>
              <div class="col-md-2 left-box">
                <img src="<?php echo base_url();?>assets/frontcss/images/01.jpg" width="100%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>