
<?php
$item = $this->query;
?>

	<title><?= $item->name ?> | AmarDokan</title>
	<!-- banner-2 -->
	<div class="page-head_agile_info_w3l">

	</div>
	<!-- //banner-2 -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="<?= base_url() ?>">Home</a>
						<i>|</i>
					</li>
					<li>
						Products
						<i>|</i>
					</li>
					<li><?= $item->name ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits">
		<div class="container">
			<div class="col-md-5 single-right-left ">
				<div class="grid images_3_of_2">
					<div class="flexslider">
						<ul class="slides">
							<?php
if ($item->show_img1 != ""):
?>
							<li data-thumb="<?= base_url() . $item->show_img1 ?>">
								<div class="thumb-image">
									<img width="150" height="150" src="<?= base_url() . $item->show_img1 ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
							<?php
endif;
?>
							<?php
if ($item->show_img2 != ""):
?>
							<li data-thumb="<?= base_url() . $item->show_img2 ?>">
								<div class="thumb-image">
									<img width="150" height="150" src="<?= base_url() . $item->show_img2 ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
							<?php
endif;
?>
							<?php
if ($item->show_img3 != ""):
?>
							<li data-thumb="<?= base_url() . $item->show_img3 ?>">
								<div class="thumb-image">
									<img width="150" height="150" src="<?= base_url() . $item->show_img3 ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
							<?php
endif;
?>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="col-md-7 single-right-left simpleCart_shelfItem">
				<h3><?= $item->name ?></h3>
				<div class="rating1">
					<span class="starRating">
						<input id="rating5" type="radio" name="rating" value="5">
						<label for="rating5">5</label>
						<input id="rating4" type="radio" name="rating" value="4">
						<label for="rating4">4</label>
						<input id="rating3" type="radio" name="rating" value="3" checked="">
						<label for="rating3">3</label>
						<input id="rating2" type="radio" name="rating" value="2">
						<label for="rating2">2</label>
						<input id="rating1" type="radio" name="rating" value="1">
						<label for="rating1">1</label>
					</span>
				</div>
				<p>
					<span class="item_price">৳<?= $item->amount ?></span>
<?php if($item->discount != 0): ?>
												<del>৳<?= $item->amount + $item->discount ?></del>
												<?php endif; ?>
					<label>Free delivery</label>
				</p>
				<div class="single-infoagile">
					<ul>
						<li>
							Cash on Delivery Eligible.
						</li>
						<li>
							Shipping Speed to Delivery.
						</li>
					</ul>
				</div>
				<div class="product-single-w3l">
					<ul>
						<li>
							<?= $item->in_stock ?> available
						</li>
						<li>
							<?= $item->description ?>
						</li>
					</ul>
					<p>
						<i class="fa fa-refresh" aria-hidden="true"></i>All food products are
						<label>non-returnable.</label>
					</p>
				</div>
				<div class="occasion-cart">
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
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //Single Page -->
