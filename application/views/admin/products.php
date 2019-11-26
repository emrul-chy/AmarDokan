
        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Products</li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-8 col-md-6">
              <h1 class="h3 mb-4 text-gray-800">Product List</h1>
            </div>
            <div class="col-lg-4 col-md-6">
              <form action="" method="post">
                <div class="input-group mb-3" style="float: right;">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Visiblity</span>
                  </div>
                  <select class="form-control" name="visible">
                    <option value="Visible"<?php 
                      if(isset($_POST['visible'])) {
                        if($_POST['visible'] == "Visible") echo "selected";
                      }
                    ?>>Visible</option>
                    <option value="Invisible"<?php 
                      if(isset($_POST['visible'])) {
                        if($_POST['visible'] == "Invisible") echo "selected";
                      }
                    ?>>Invisible</option>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Filter</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            	<div class="row">
            		<div class="col-lg-6 col-md-6">
              		<h6 class="m-0 font-weight-bold text-primary">Products</h6>
              	</div>
              	<div class="col-lg-6 col-md-6">
              		<a role="button" href="createProduct" style="float: right;" class="btn btn-success">Create New</a>
              	</div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              	<?php
              		$products = $this->products;
              	?>
                <table class="table table-bordered table-striped table-hover" id="dataTable" style="font-size: 14px" width="100%" cellspacing="0">
                   <thead>
                  	<tr>
                  		<th>
                  			#
                  		</th>
                  		<th>
                  			Code
                  		</th>
                  		<th>
                  			Name
                  		</th>
                  		<th>
                  			Categories
                  		</th>
                  		<th>
                  			Tag
                  		</th>
                  		<th>
                  			Price
                  		</th>
                  		<th>
                  			Discount
                  		</th>
                  		<th>
                  			Status
                  		</th>
                  		<th>
                  			Visitblity
                  		</th>
                  		<th>
                  			Action
                  		</th>
                  	</tr>
                 	</thead>
                  <tbody>
                 		<?php
                 			$cnt = 1;
                 			foreach($products as $product) {
                 				?>
                 				<tr>
                 					<td>
                 						<?= $cnt++ ?>
                 					</td>
                 					<td>
                 						<?= $product->id ?>
                 					</td>
                 					<td>
                 						<?= $product->name ?>
                 					</td>
                 					<td>
                 						<?= $product->category ?>
                 					</td>
                 					<td>
                 						<?= $product->tag ?>
                 					</td>
                 					<td>
                 						৳<?= $product->amount ?>
                 					</td>
                 					<td>
                 						৳<?= $product->discount ?>
                 					</td>
                 					<td>
                 						<?php 
                 						if($product->in_stock > 100): ?>
                 							<a class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px"><?= $product->in_stock ?> in stock</span>
                  </a>
                 						<?php endif ?>
                 						<?php 
                 						if($product->in_stock < 100 && $product->in_stock > 0): ?>
                 							<a class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i  class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Only <?= $product->in_stock ?> in stock</span>
                  </a>
                 						<?php endif ?>
                 						<?php 
                 						if($product->in_stock <= 0): ?>
                 							<a class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Out of stock</span>
                  </a>
                 						<?php endif ?>
                 					</td>
                 					<td>
                 						<?php 
                 						if($product->visible == 1): ?>
                 							<div class="btn btn-success btn-circle">
                 								<i class="fas fa-check-circle"></i>
                 							</div>
                 						<?php endif ?>
                 						<?php 
                 						if($product->visible == 0): ?>
                 							<div class="btn btn-danger btn-circle">
                 								<i class="fas fa-times-circle"></i>
                 							</div>
                 						<?php endif ?>
                 					</td>
                 					<td>
                 						<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </a>
                 						<div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="<?= base_url() . "admin/updateProduct/" . $product->id ?>">Update</a>        <!-- Button trigger modal -->
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteProduct_<?= $product->id ?>">
        Delete
      </button>
  </div>



<!-- Modal -->
<div class="modal fade" id="deleteProduct_<?= $product->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete <b><?= $product->name ?></b>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() . "admin/deleteProduct/" . $product->id ?>" role="button" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
                 					</td>
                 						
                 				</tr>
                 				<?php
                 			}
                 		?>
                 	</tbody>
                </table>
              </div>
            </div>
          </div>
</div>

        <!-- /.container-fluid -->

        <script>
        	$(document).ready( function () {
    $('#users').DataTable();
} );
        </script>

      </div>
      <!-- End of Main Content -->