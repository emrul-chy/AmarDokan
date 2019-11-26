
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
            <div class="col-lg-8">
              <h1 class="h3 mb-4 text-gray-800">Order List</h1>
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
                  			Deadline
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
                            if(date("d M, Y", strtotime($order->deadline)) == date("d M, Y")) { ?>
                              <a class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Today is the deadline</span>
                  </a>
                            <?php } 
                            else if(date("Y-m-d", strtotime($order->deadline)) < date("Y-m-d")) { ?>
                              <a class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Deadline is over!</span>
                  </a> <?php
                            }
                            else {
                              ?>
                              <a class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-calendar-alt"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">                            <?= date("d M, Y", strtotime($order->deadline)) ?>
                          </span>
                        </a>
                            <?php
                            } ?>
                 					</td>
                          <td>
                            <a href="<?= base_url() . "delivery/viewOrder/" . $order->id ?>" role="button" class="btn btn-primary">
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