
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Orders</li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-8 col-md-6">
              <h1 class="h3 mb-4 text-gray-800">Order List</h1>
            </div>
            <div class="col-lg-4 col-md-6">
              <form action="" method="post">
                <div class="input-group mb-3" style="float: right;">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Status</span>
                  </div>
                  <select class="form-control" name="status">
                    <option value="Submitted"<?php 
                      if(isset($_POST['status'])) {
                        if($_POST['status'] == "Submitted") echo "selected";
                      }
                    ?>>Submitted</option>
                    <option value="Cancelled"<?php 
                      if(isset($_POST['status'])) {
                        if($_POST['status'] == "Cancelled") echo "selected";
                      }
                    ?>>Cancelled</option>
                    <option value="Accepted"<?php 
                      if(isset($_POST['status'])) {
                        if($_POST['status'] == "Accepted") echo "selected";
                      }
                    ?>>Accepted</option>
                    <option value="Completed"<?php 
                      if(isset($_POST['status'])) {
                        if($_POST['status'] == "Completed") echo "selected";
                      }
                    ?>>Completed</option>
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
              <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive table-striped table-hover">
              	<?php
              		$orders = $this->orders;
              	?>
                <table class="table table-bordered" id="dataTable" style="font-size: 14px" width="100%" cellspacing="0">
                   <thead>
                  	<tr>
                  		<th>
                  			#
                  		</th>
                  		<th>
                  			Placed by
                  		</th>
                  		<th>
                  			Placed on
                  		</th>
                  		<th>
                  			Name
                  		</th>
                  		<th>
                  			Mobile
                  		</th>
                  		<th>
                  			Address
                  		</th>
                  		<th>
                  			City
                  		</th>
                  		<th>
                  			Status
                  		</th>
                  		<th>
                  			Action
                  		</th>
                  	</tr>
                 	</thead>
                  <tbody>
                 		<?php
                 			$cnt = 1;
                 			foreach($orders as $order) {
                 				?>
                 				<tr>
                 					<td>
                 						<?= $cnt++ ?>
                 					</td>
                 					<td>
                 						<?= $order->username ?>
                 					</td>
                 					<td>
                 						<?= date("d M, Y h:i:sa", strtotime($order->time)) ?>
                 					</td>
                 					<td>
                 						<?= $order->name ?>
                 					</td>
                 					<td>
                 						<?= $order->mobile_number ?>
                 					</td>
                 					<td>
                 						<?= $order->address ?>
                 					</td>
                 					<td>
                 						<?= $order->city ?>
                 					</td>
                 					<td>
                 						<?php 
                 						if($order->status == "Submitted"): ?>
                 							<a class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Submitted</span>
                  </a>
                 						<?php endif ?>
                 						<?php 
                 						if($order->status == "Cancelled"): ?>
                 							<a class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Cancelled</span>
                  </a>
                 						<?php endif ?>
                            <?php 
                            if($order->status == "Accepted"): ?>
                              <a class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="far fa-check-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Accepted</span>
                  </a>
                            <?php endif ?>
                            <?php 
                            if($order->status == "Completed"): ?>
                              <a class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Completed</span>
                  </a>
                            <?php endif ?>
                 					</td>
                 					<td>
                 						<a href="<?= base_url() . "admin/viewOrder/" . $order->id ?>" role="button" class="btn btn-primary">
                 							Details
                 						</a>
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