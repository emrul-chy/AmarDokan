				<?php
$order = $this->query;
$item = $this->item;
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel/orders">Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Order #<?= $order->id ?></li>
  </ol>
</nav>

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Order #<?= $order->id ?></h1>
          <div class="card shadow mb-4">
          	<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
            </div>
          <div class="row" style="padding: 20px">
		<div style="margin-top: 10px" class="col-lg-6">
			<h3>Delivery Details</h3>

			<ul class="list list-group">
				<li class="list-group-item">
					Name: <?= $order->name ?>
				</li>
				<li class="list-group-item">
					Mobile Number: <?= $order->mobile_number ?>
				</li>
				<li class="list-group-item">
					Address: <?= $order->address ?>
				</li>
				<li class="list-group-item">
					City: <?= $order->city ?>
				</li>
			</ul>
		</div>
		<div style="margin-top: 10px" class="col-lg-6">
			<h3>Order Status</h3>
			<?php
			if ($order->status == "Submitted") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-info" role="alert">
					<center><b>Submitted</b></center>
				</div>
			<?php
			endif;
			?>
			<?php
			if ($order->status == "Cancelled") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-danger" role="alert">
					<center><b>Cancelled</b></center>
				</div>
			<?php
			endif;
			?>
			<?php
			if ($order->status == "Accepted") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-warning" role="alert">
					<center><b>Accepted</b></center>
				</div>
			<?php
			endif;
			?>
			<?php
			if ($order->status == "Completed") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-success" role="alert">
					<center><b>Completed</b></center>
				</div>
			<?php
			endif;
			?>
			<ul class="list-group">
				<li class="list-group-item">
					Submitted By: <?= $order->username ?>
				</li>
				<li class="list-group-item">
					Submitted on: <?= date("h:i:sa d M, Y", strtotime($order->time)) ?>
				</li>
				<?php
				if ($order->status == "Cancelled") :
					?>
					<li class="list-group-item">
						Cancelled on: <?= date("h:i:sa d M, Y", strtotime($order->cancelled_time)) ?>
					</li>
				<?php
				endif;
				?>
				<?php
				if ($order->status == "Accepted") :
					?>
					<li class="list-group-item">
						Accepted on: <?= date("h:i:sa d M, Y", strtotime($order->accepted_time)) ?>
					</li>
					<li class="list-group-item">
						Assigned to: <?= $order->assigned_to ?>
					</li>
					<li class="list-group-item">
						Delivery Deadline: <?= date("d M, Y", strtotime($order->deadline)) ?>
					</li>
					<?php if($order->note != ""): ?>
					<li class="list-group-item">
						<b>Note:</b> <?= $order->note ?>
					</li>
					
					<?php endif ?>
				<?php
				endif;
				?>
				<?php
				if ($order->status == "Completed") :
					?>
					<li class="list-group-item">
						Accepted on: <?= date("h:i:sa d M, Y", strtotime($order->accepted_time)) ?>
					</li>
					<li class="list-group-item">
						Assigned to: <?= $order->assigned_to ?>
					</li>
					<li class="list-group-item">
						Delivery Deadline: <?= date("d M, Y", strtotime($order->deadline)) ?>
					</li>
					<?php if($order->note != ""): ?>
					<li class="list-group-item">
						<b>Note:</b> <?= $order->note ?>
					</li>
					<?php endif ?>
					<li class="list-group-item">
						Completed on: <?= date("h:i:sa d M, Y", strtotime($order->completed_time)) ?>
					</li>
				<?php
				endif;
				?>
			</ul>
		</div>
	</div>
	<hr>
	<div class="row" style="padding: 20px">
		<div class="col-lg-12">
			<h3>
				Item List
			</h3>
			<table class="table table-bordered table-hover table-striped" style="margin-bottom: 30px;">
				<thead>
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Name</th>
						<th <?php if($order->status == "Submitted") echo 'colspan="2"'; ?> >Quantity</th>
						<th>Price</th>
						<th>Subotal</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$cnt = 0;
						$not_ok = 0;
						foreach($item as $row) {
							$cnt++;
							$product = $this->db->get_where('products', array('id' => $row->product_id))->row();
							?>
							<tr>
								<td style="padding: 15px;">
									<?= $cnt ?>
								</td>
								<td style="padding: 15px;">
									<?= $row->product_id ?>
								</td>
								<td style="padding: 15px;">
									<a href="<?= base_url() . "admin/updateProduct/" . $row->product_id ?>"> <?= $row->product_name ?></a>
								</td>
								<td style="padding: 15px;">
									<?= $row->quantity ?>
								</td>
								<?php if($order->status == "Submitted"):?>
								<td>
									<?php if($row->quantity <= $product->in_stock) {
									?>
									<a class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Available</span>
                  </a>
									<?php } else { $not_ok = 1; ?>
<a class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px"><?= $row->quantity - $product->in_stock ?> needed</span>
                  </a>
									<?php } ?>
								</td>
								<?php endif; ?>
								<td style="padding: 15px;">
									৳<?= $row->amount ?>
								</td>
								<td style="padding: 15px;">
									৳<?= $row->amount * $row->quantity ?>
								</td>
							</tr>
							<?php
						}
					?>
					<tr>
						<?php
						$colspan = 5;
						if($order->status=='Submitted') $colspan++;
						?>
			<td style="text-align: right; padding: 15px;" colspan="<?= $colspan ?>"><label>Subtotal</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $order->total - $order->delivery_charge ?></label>
			</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 15px;" colspan="<?= $colspan ?>"><label>Delivery Charge</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $order->delivery_charge; ?></label>
			</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 15px;" colspan="<?= $colspan ?>"><label>Total</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $order->total ?></label>
			</td>
		</tr>
				</tbody>
			</table>
		</div>
	</div>
	<?php if($order->status == 'Submitted'): ?>

	<hr>
	<div class="row" style="padding: 20px">
		<?php if($not_ok): ?>
			<div style="margin: 10px; width: 100%; font-size: 20px; text-align: center;" class="alert alert-warning">Please refill item(s) to accept this order!</div>
		<?php endif ?>
		<?php if(!$not_ok): ?>
		<div class="col-lg-12">
			<h3>Accept Order</h3>
			<form method="post" action="<?= base_url() ?>admin/acceptOrder">
				<input type="hidden" name="order_id" value="<?= $order->id ?>">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							Assign this order to
						</div>
						<div class="col-sm-8">
							<select style="width: 100%" name="assigned_to" class="form-control" required="">
							<?php 
								$users = $this->db->get_where('users', array('role' => "Delivery Man"))->result();
								foreach ($users as $user) {
									?>
									<option value="<?= $user->username ?>"><?= $user->name ?></option>
									<?php
								}
							?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							Deadline
						</div>
						<div class="col-sm-8">
							<input required="" type="date" class="form-control" name="deadline">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							Note
						</div>
						<div class="col-sm-8">
							<textarea type="date" class="form-control" name="note"></textarea>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success">Accept Order</button>
			</form>
		</div>
		<?php endif ?>
	</div>
	<?php endif ?>

	<?php if($order->status == 'Accepted'): ?>

	<hr>
	<div class="row" style="padding: 20px">
		<div class="col-lg-12">
			<h3>Update Order</h3>
			<form method="post" action="<?= base_url() ?>admin/updateOrder">
				<input type="hidden" name="order_id" value="<?= $order->id ?>">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							Assign this order to
						</div>
						<div class="col-sm-8">
							<select style="width: 100%" name="assigned_to" class="form-control" required="">
							<?php 
								$users = $this->db->get_where('users', array('role' => "Delivery Man"))->result();
								foreach ($users as $user) {
									?>
									<option value="<?= $user->username ?>" <?php if($order->assigned_to == $user->username) echo "selected"; ?>><?= $user->name ?></option>
									<?php
								}
							?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							Deadline
						</div>
						<div class="col-sm-8">
							<input value="<?= $order->deadline ?>" required="" type="date" class="form-control" name="deadline">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							Note
						</div>
						<div class="col-sm-8">
							<textarea type="date" class="form-control" name="note"><?= $order->note ?></textarea>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success">Update Order</button>
			</form>
		</div>
		<?php endif ?>
</div>
      </div>
      <!-- End of Main Content -->