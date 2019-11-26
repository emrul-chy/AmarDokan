				<?php
$product = $this->query;
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel/products">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $product->name ?></li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Product</h6>
            </div>
            <div class="card-body"> 
          <form method="post" enctype="multipart/form-data" action="<?= base_url() . "admin/updateProduct_process/" . $product->id ?>">
					  <div class="form-group row">
					    <label for="name" class="col-sm-2 col-form-label">Name</label>
					    <div class="col-sm-10">
					      <input style="padding-left: 15px" name="name" type="text" class="form-control" id="name" value="<?= $product->name ?>" required="">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="description" class="col-sm-2 col-form-label">Description</label>
					    <div class="col-sm-10">
					      <textarea style="padding-left: 15px" name="description" type="text" class="form-control" id="description"><?= $product->description ?></textarea>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="category" class="col-sm-2 col-form-label">Category</label>
					    <div class="col-sm-10" on="getFoodItem()">
					      <select name="category" id="category" class="form-control"  onClick="getFoodItem()" required="">
					      	<?php
$categories = $this->db->get('categories')->result();
foreach ($categories as $category) {
?>
					      			<option value="<?= $category->name ?>" <?php
				if ($category->name == $product->category)
								echo ("selected");
?>><?= $category->name ?></option>
					      			<?php
}
?>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="tag" class="col-sm-2 col-form-label">Tag</label>
					    <div class="col-sm-10">
					      <select name="tag" id="tag" class="form-control" >
					      	<?php
$tags = $this->db->get_where('tags', array('category' => $product->category))->result();
foreach ($tags as $tag) {
?>
					      			<option value="<?= $tag->name ?>" <?php
				if ($tag->name == $product->tag)
								echo ("selected");
?>><?= $tag->name ?></option>
					      			<?php
}
?>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
					    <div class="col-sm-10">
					      <input style="padding-left: 15px" min="0" name="amount" type="number" step="0.01" class="form-control" id="amount" value="<?= $product->amount ?>" required="">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="discount" class="col-sm-2 col-form-label">Discount</label>
					    <div class="col-sm-10">
					      <input style="padding-left: 15px" min="0" type="number" name="discount" step="0.01" class="form-control" id="discount" value="<?= $product->discount ?>" required="">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="in_stock" class="col-sm-2 col-form-label">In Stock</label>
					    <div class="col-sm-10">
					      <input style="padding-left: 15px" min="0" type="number" name="in_stock" step="0.01" class="form-control" id="in_stock" value="<?= $product->in_stock ?>" required="">
					    </div>
					  </div>
					  <fieldset class="form-group">
					    <div class="row">
					      <legend class="col-form-label col-sm-2 pt-0">Visiblity</legend>
					      <div class="col-sm-10">
					        <div class="form-check">
									  <input class="form-check-input" type="checkbox" name="visible" value="option1" <?php if($product->visible == 1) echo "checked" ?>>
									  <label class="form-check-label" for="exampleRadios1">
									    Visible
									  </label>
									</div>
					      </div>
					    </div>
					  </fieldset>
					  <fieldset class="form-group">
					    <div class="row">
					      <legend class="col-form-label col-sm-2 pt-0">Top Product</legend>
					      <div class="col-sm-10">
					        <div class="form-check">
									  <input class="form-check-input" type="checkbox" name="top_product" value="option1" <?php if($product->top_product == 1) echo "checked" ?>>
									  <label class="form-check-label" for="exampleRadios1">
									    Yes
									  </label>
									</div>
					      </div>
					    </div>
					  </fieldset>
					  <fieldset class="form-group">
					    <div class="row">
					      <legend class="col-form-label col-sm-2 pt-0">Special Deal</legend>
					      <div class="col-sm-10">
					        <div class="form-check">
					          <input class="form-check-input" type="checkbox" name="special_deal" value="option1" <?php if($product->special_deal == 1) echo "checked" ?>>
									  <label class="form-check-label" for="exampleRadios1">
									    Yes
									  </label>
					        </div>
					      </div>
					    </div>
					  </fieldset>
					   <fieldset class="form-group">
					    <div class="row">
					      <legend class="col-form-label col-sm-2 pt-0">Special Offer</legend>
					      <div class="col-sm-10">
					        <div class="form-check">
					          <input class="form-check-input" type="checkbox" name="special_offer" value="option1" <?php if($product->special_offer == 1) echo "checked" ?>>
									  <label class="form-check-label" for="exampleRadios1">
									    Yes
									  </label>
					        </div>
					      </div>
					    </div>
					  </fieldset>
					  <div class="form-group">
					  	<div class="row">
					  		<div class="col-sm-2">
					    		<label for="show_img1">Cover Image</label>
					    	</div>
					  		<div class="col-sm-10">
					  			<?php
					  					if($product->show_img1 != "") {
					  						?>
					  						<img width="70px" height="70px" src="<?= base_url() . $product->show_img1 ?>">
					  						<?php
					  					}
					  			?>
					    		<input type="file" class="form-control-file" name="show_img1" id="show_img1">
					    	</div>
					    </div>
					  </div>
					  <div class="form-group">
					  	<div class="row">
					  		<div class="col-sm-2">
					    		<label for="show_img2">Image #2</label>
					    	</div>
					  		<div class="col-sm-10">
					  			<?php
					  					if($product->show_img2 != "") {
					  						?>
					  						<img width="70px" height="70px" src="<?= base_url() . $product->show_img2 ?>">
					  						<?php
					  					}
					  			?>
					    		<input type="file" class="form-control-file" name="show_img2" id="show_img2">
					    	</div>
					    </div>
					  </div>
					  <div class="form-group">
					  	<div class="row">
					  		<div class="col-sm-2">
					    		<label for="show_img3">Image #3</label>
					    	</div>
					  		<div class="col-sm-10">
					  			<?php
					  					if($product->show_img3 != "") {
					  						?>
					  						<img width="70px" height="70px" src="<?= base_url() . $product->show_img3 ?>">
					  						<?php
					  					}
					  			?>
					    		<input type="file" class="form-control-file" name="show_img3" id="show_img3">
					    	</div>
					    </div>
					  </div>
					  <div class="form-group row">
					    <div class="col-sm-10">
					      <button type="submit" class="btn btn-primary">Update</button>
					    </div>
					  </div>
					</form>
				</div>
			</div>
		
        <!-- /.container-fluid -->

        <script>
        	$(document).ready( function () {
    $('#users').DataTable();
} );
        </script>

        <script>
        	function getFoodItem(){
 
            var list1 = document.getElementById('category');
            var list2 = document.getElementById("tag");
            var list1SelectedValue = list1.options[list1.selectedIndex].value;
            <?php
            $f = 0;
foreach ($categories as $category) {
	if($f) echo "else ";
?>
            	if (list1SelectedValue == '<?= $category->name ?>')
            	{
            	    <?php
				$tags = $this->db->get_where('tags', array(
								'category' => $category->name
				))->result();
				$cnt  = 0;
?>
list2.options.length = 0;
            	     <?php
				foreach ($tags as $tag) {
?>
            	     	list2.options[<?= $cnt++ ?>] = new Option('<?= $tag->name ?>', '<?= $tag->name ?>');
            	     	<?php
				}
?>

            	}
            	<?php
}
?>

}
        </script>

      </div>
      <!-- End of Main Content -->