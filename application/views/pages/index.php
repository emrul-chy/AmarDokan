<title>AmarDokan | Your Own Grocery Shop</title>
	<!-- banner -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators-->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1" class=""></li>
			<li data-target="#myCarousel" data-slide-to="2" class=""></li>
			<li data-target="#myCarousel" data-slide-to="3" class=""></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<div class="container">
					<div class="carousel-caption">
						<h3>Big
							<span>Save</span>
						</h3>
						<p>Get flat
							<span>10%</span> Cashback</p>
						<a class="button2" href="product.html">Shop Now </a>
					</div>
				</div>
			</div>
			<div class="item item2">
				<div class="container">
					<div class="carousel-caption">
						<h3>Healthy
							<span>Saving</span>
						</h3>
						<p>Get Upto
							<span>30%</span> Off</p>
						<a class="button2" href="product.html">Shop Now </a>
					</div>
				</div>
			</div>
			<div class="item item3">
				<div class="container">
					<div class="carousel-caption">
						<h3>Big
							<span>Deal</span>
						</h3>
						<p>Get Best Offer Upto
							<span>20%</span>
						</p>
						<a class="button2" href="product.html">Shop Now </a>
					</div>
				</div>
			</div>
			<div class="item item4">
				<div class="container">
					<div class="carousel-caption">
						<h3>Today
							<span>Discount</span>
						</h3>
						<p>Get Now
							<span>40%</span> Discount</p>
						<a class="button2" href="product.html">Shop Now </a>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!-- //banner -->

	<!-- top Products -->
	<div class="ads-grid">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Our Top Products
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<!-- product left -->
			<div class="side-bar col-md-3">
				<div class="search-hotel">
					<h3 class="agileits-sear-head">Search Here..</h3>
					<form action="<?= base_url() . "pages/search"?> " method="post">
						<input id="products2" type="search" placeholder="Product name..." name="search" required="">
						<input type="submit" value=" ">
					</form>
				</div>
				
				<!-- deals -->

				<div class="deal-leftmk left-side">
					<h3 class="agileits-sear-head">Special Deals</h3>
					<?php
								$data = array(
				'visible' => 1,
				'special_deal' => 1,
			);
								$query = $this->Product_model->get_product($data)->result();
								foreach ($query as $item) {
							?>
					<div class="special-sec1">
						<div class="col-xs-4 img-deals">
							<img height="70px" width="70px" src="<?= base_url() . $item->show_img1 ?>" alt="">
						</div>
						<div class="col-xs-8 img-deal1">
							<h3><?= $item->name ?></h3>
							<a href="product/view/<?= $item->id ?>">৳<?= $item->amount ?></a>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php
				}
					?>
				</div>
				<!-- //deals -->
			</div>
			<!-- //product left -->
			<!-- product right -->
			
			<div class="agileinfo-ads-display col-md-9">
				<div class="wrapper">
					<?php
				$tags = $this->db->get_where('tags', array("top" => 1))->result();
				$cnt = 1;
				foreach($tags as $tag) {
			?>
					<div class="product-sec1">
						<h3 class="heading-tittle"><?= $tag->name ?></h3>
						<hr>
							<!-- first section (nuts) -->
							<?php
								$data = array(
				'tag' => $tag->name,
				'visible' => 1,
				'top_product' => 1,
			);
								$query = $this->Product_model->get_product($data)->result();
								foreach ($query as $item) {
							?>
								<div class="col-md-4 product-men">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item">
											<img width="150" height="150" src="<?= base_url() . $item->show_img1 ?>" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="product/view/<?= $item->id ?>" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<div class="item-info-product ">
											<h4>
												<a href="product/view/<?= $item->id ?>"><?= $item->name ?></a>
											</h4>
											<div class="info-product-price">
												<span class="item_price">৳<?= $item->amount ?></span>
												<?php if($item->discount != 0): ?>
												<del>৳<?= $item->amount + $item->discount ?></del>
												<?php endif; ?>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												<form action="#" method="post">
													<fieldset>
														<input type="hidden" name="cmd" value="_cart" />
														<input type="hidden" name="add" value="1" />
														<input type="hidden" name="business" value=" " />
														<input type="hidden" name="item_number" value="<?= $item->id ?>" />
														<input type="hidden" name="item_name" value="<?= $item->name ?>" />
														<input type="hidden" name="amount" value="<?= $item->amount ?>" />
														<input type="hidden" name="currency_code" value="USD" />
														<input type="hidden" name="return" value=" " />
														<input type="hidden" name="cancel_return" value=" " />
														<input type="submit" name="submit" value="Add to cart" class="button" />
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php

							}

								?>

						<div class="clearfix"></div>
							</div>

							<?php if($cnt == 1) { ?>

								<!-- second section (nuts special) -->
					<div class="product-sec1 product-sec2">
						<div class="col-xs-7 effect-bg">
							<h3 class="">Pure Energy</h3>
							<h6>Enjoy our all healthy Products</h6>
							<p>Get Extra 10% Off</p>
						</div>
						<h3 class="w3l-nut-middle">Nuts & Dry Fruits</h3>
						<div class="col-xs-5 bg-right-nut">
							<img src="images/nut1.png" alt="">
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- //second section (nuts special) -->
								<?php
							}
								$cnt++;
							}
							 ?>
					<!-- //first section (nuts) -->
					
					
				</div>
			</div>
			<!-- //product right -->
		</div>
	</div>
	<!-- //top products -->
	<!-- special offers -->
	<div class="featured-section" id="projects">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Special Offers
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="content-bottom-in">
				<ul id="flexiselDemo1">
					<?php
								$data = array(
				'visible' => 1,
				'special_offer' => 1,
			);
								$query = $this->Product_model->get_product($data)->result();
								foreach ($query as $item) {
							?>
					<li>
						<div class="w3l-specilamk">
							<div class="speioffer-agile">
								<a href="<?= base_url() . "product/view/" . $item->id ?>">
									<img src="<?= base_url() . "/" . $item->show_img1 ?>" alt="">
								</a>
							</div>
							<div class="product-name-w3l">
								<h4>
									<a href="<?= base_url() . "product/view/" . $item->id ?>"><?= $item->name ?></a>
								</h4>
								<div class="w3l-pricehkj">
									<h6>৳<?= $item->amount ?></h6>
									<p>Save ৳<?= $item->discount ?></p>
								</div>
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
									<a style="width: 100%; font-size: 18px" role="button" class="btn btn-warning" href="<?= base_url() . 'product/view/' . $item->id ?>" class="button">Quick View</a>
								</div>
							</div>
						</div>
					</li>
					<?php

				}?>
				</ul>
			</div>
		</div>
	</div>
	<!-- //special offers -->