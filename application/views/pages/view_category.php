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
			<div class="agileinfo-ads-display col-md-12">
				<div class="wrapper">
					<div class="product-sec1">
						<h3 class="heading-tittle">Subcategories</h3>
			<?php
				$data = array(
					'category' => $category->name,
				);
				$tags = $this->db->get_where('tags', $data)->result();
				foreach ($tags as $tag) {
			?>
			
								<div class="col-md-4 product-men">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="item-info-product ">
											<h4>
												<form action="" method="post">
													<input type="hidden" name="subcategories" value="<?= $tag->name ?>">
													<button type="submit" style="text-decoration: none; outline: none; width: 100%; background: #ffff; border: 0;"> <?= $tag->name ?></button>
												</form>
											</h4>
										</div>
									</div>

								<hr>
								</div>
			<?php } ?>
			<div class="clearfix"></div>
						</div>
					</div>
				</div>
		</div>