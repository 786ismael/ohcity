<div>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

		<div class="carousel-inner">
		<?php
		$j =1;
        if(!empty($all_banners)){

        	foreach ($all_banners as $all_banner) {
        		$banner_img = base_url().'uploads/images/'.$all_banner['image'];

		?>
			<div class="carousel-item <?php if($j==1){echo 'active';}?>">
				<img class="d-block w-100" src="<?php echo $banner_img;?>" alt="Third slide">
			</div>
			<?php $j++;}}?>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="container">
		<div class="advence">
			<button id="edit"><i class="fa fa-search"></i> Advence Search <i class="fa fa-sort-down"></i></button>
		</div>
	</div>
	<div class="search-bar" id="hide">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-3"><input type="text" name="name" placeholder="Enter Your Keyword"></div>
				<div class="col-sm-3 col-md-3"><select>
					<option>Choose Category <i class="fa fa-sort-down"></i></option>
				</select></div>
				<div class="col-sm-3 col-md-3"><select>
					<option>Choose Location <i class="fa fa-sort-down"></i></option>
				</select></div>
				<div class="col-sm-3 col-md-3"><button><i class="fa fa-search"></i> Search</button></div>
			</div>
			<div>
			</div>
		</div>
	</div>
	
</div>
<article>
	<div class="clearfix">
		<div class="content-part section-featured-ads">
			<div class="container">
				<div class="content">
					<h2>Featured-Ads</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				</div>
				<div class="content-part">
					<div class="row">
						<?php
						if(!empty($all_featured_products)){
							foreach ($all_featured_products as $all_featured_product) {
								$featured_product_image = site_url().'uploads/images/'.$all_featured_product['image'];
								?>
								<div class="col-md-3">
									<div class="box">
										<img src="<?php echo $featured_product_image;?>" width="100%" style="height:150px;">
										<button>$ <?php echo $all_featured_product['price'];?></button>
										<h5><?php echo $all_featured_product['product_name'];?></h5><hr>
										
											<div class="post-load-address"><a href="#"><i class="fa fa-map-marker"></i> <?php echo $all_featured_product['address'];?></a></div>
											<!-- <li><a href="#"><i class="fa fa-clock-o"></i> 4:00 PM</a></li> -->
										
									</div>

								</div>
								<?php }}?>
							</div>

						</div>
						<div class="content-part">
							<div class="content" style="padding-bottom:30px;">
								<a href="<?php echo base_url('homepage/ads_list');?>" style="color: #fff;background: rgba(27,179,245, .8);padding: 10px 30px;border: 1px solid #0d91ca;margin-bottom: 50px;border-radius: 5px;">View All Ads</a>
							</div>

						</div>
					</div>
				</div>
				<div class="content-part section-ads-cetegory">
					<div class="ads-category">
						<div class="container">
							<div class="content">
								<h2>Ads Category</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							</div>
							<div class="content-part">
								<div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">

									<div class="carousel-inner">
										<?php 
//echo "<pre>";print_r($all_categories);
										if(!empty($all_categories)){



											$categories = array_chunk($all_categories,6);
											$i=1;
											foreach ($categories as $category) {


												?>
												<div class="carousel-item <?php if($i==1){echo 'active';}?>">
													<div class="row">
														<?php foreach ($category as $cat) {
															$cat_img = base_url().'uploads/images/'.$cat['image'];
															?>
															<div class="col-md-2">
																<div class="box">
																	<div class="content-box"><a href="#"><img src="<?php echo $cat_img;?>" width="100%"></a></div>
																	<div class="content-box"><a href="#"><?php echo $cat['category_name'];?></a></div>
																</div>
															</div>
															<?php } ?>
														</div>
													</div>
													<?php $i++; }} ?>
												</div>
												<a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>

										</div>
										<div class="content-part">
										</div>
									</div>

								</div>

							</div>
							<div>
								<div class="container">
									<img src="<?php echo base_url();?>assets/frontcss/images/img-ad-banner.jpg" width="100%">
								</div>

							</div>
							<div class="content-part section-testimonials">
								<div class="container">
									<h2>Testimonials</h2>
									<div>
										<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
											<div class="carousel-inner">
												<div class="carousel-item active">
													<div class="row">
														<div class="col-md-6 big">
															<div class="carousel-caption">
																<i class="fa fa-quote-left"></i>
																<p>Sed porta ac mauris at pretium. Aenean metus magna, consectetur sit amet venenatis ac, suscipit 
																	Mauris tincidunt enim non imperdiet consequat Nunc sed velit vel lacus pellentesque finibus vel
																	Suspendisse non justo justo.</p>

																	<p><i>"Aenean metus"</i></p>
																</div>
																<img class="d-block " src="<?php echo base_url();?>assets/frontcss/images/img-1.png" alt="First slide">
															</div>
															<div class="col-md-6 big">
																<div class="carousel-caption">
																	<i class="fa fa-quote-left"></i>
																	<p>Sed porta ac mauris at pretium. Aenean metus magna, consectetur sit amet venenatis ac, suscipit 
																		Mauris tincidunt enim non imperdiet consequat Nunc sed velit vel lacus pellentesque finibus vel
																		Suspendisse non justo justo.</p>

																		<p><i>"Aenean metus"</i></p>
																	</div>
																	<img class="d-block " src="<?php echo base_url();?>assets/frontcss/images/img-2.png" alt="3 slide">
																</div>
															</div>
														</div>
														<div class="carousel-item">

															<div class="row">
																<div class="col-md-6 big">
																	<div class="carousel-caption">
																		<i class="fa fa-quote-left"></i>
																		<p>Sed porta ac mauris at pretium. Aenean metus magna, consectetur sit amet venenatis ac, suscipit 
																			Mauris tincidunt enim non imperdiet consequat Nunc sed velit vel lacus pellentesque finibus vel
																			Suspendisse non justo justo.</p>

																			<p><i>"Aenean metus"</i></p>
																		</div>
																		<img class="d-block " src="<?php echo base_url();?>assets/frontcss/images/img-1.png" alt="4 slide">
																	</div>
																	<div class="col-md-6 big">
																		<div class="carousel-caption">
																			<i class="fa fa-quote-left"></i>
																			<p>Sed porta ac mauris at pretium. Aenean metus magna, consectetur sit amet venenatis ac, suscipit 
																				Mauris tincidunt enim non imperdiet consequat Nunc sed velit vel lacus pellentesque finibus vel
																				Suspendisse non justo justo.</p>

																				<p><i>"Aenean metus"</i></p>
																			</div>
																			<img class="d-block " src="<?php echo base_url();?>assets/frontcss/images/img-1.png" alt="5 slide">
																		</div>
																	</div>
																</div>
																<div class="carousel-item">
																	<div class="row">
																		<div class="col-md-6 big">
																			<div class="carousel-caption">
																				<i class="fa fa-quote-left"></i>
																				<p>Sed porta ac mauris at pretium. Aenean metus magna, consectetur sit amet venenatis ac, suscipit 
																					Mauris tincidunt enim non imperdiet consequat Nunc sed velit vel lacus pellentesque finibus vel
																					Suspendisse non justo justo.</p>

																					<p><i>"Aenean metus"</i></p>
																				</div>
																				<img class="d-block " src="images/img-1.png" alt="1 slide">
																			</div>
																			<div class="col-md-6 big">
																				<div class="carousel-caption">
																					<i class="fa fa-quote-left"></i>
																					<p>Sed porta ac mauris at pretium. Aenean metus magna, consectetur sit amet venenatis ac, suscipit 
																						Mauris tincidunt enim non imperdiet consequat Nunc sed velit vel lacus pellentesque finibus vel
																						Suspendisse non justo justo.</p>

																						<p><i>"Aenean metus"</i></p>
																					</div>
																					<img class="d-block " src="<?php echo base_url();?>assets/frontcss/images/img-1.png" alt="6 slide">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</article>