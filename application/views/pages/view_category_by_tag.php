<?php
$category = $this->query;
?>
<title><?= $category->name ?> | AmarDokan</title>
<div class="services-breadcrumb" style="margin-bottom: 10px">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="<?= base_url() ?>">Home</a>
					<i>|</i>
				</li>
				<li>
					Category
					<i>|</i>
				</li>
				<li><?= $category->name ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="container" style="margin-bottom: 50px">
	<h3 class="tittle-w3l"><?= $category->name  ?>
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<?php
				$tag = $this->subcategories;
			?>
			<div class="agileinfo-ads-display col-md-12">
				<div class="wrapper">
					<div class="product-sec1">
						<h3 class="heading-tittle"><?= $tag  ?></h3>
							<!-- first section (nuts) -->
							<?php
								$data = array(
				'category' => $category->name,
				'tag' => $tag,
				'visible' => 1,
			);
								$query = $this->Product_model->get_product($data)->result();
								foreach ($query as $item) {
							?>
								<div class="col-md-4 product-men">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item">
											<img height="150" width="150" src="<?= base_url() . $item->show_img1 ?>" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="<?= base_url() ?>product/view/<?= $item->id ?>" class="link-product-add-cart">Quick View</a>
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
							<?php } ?>
							<div class="clearfix"></div>
					</div>
				</div>
			</div>
					</div>
