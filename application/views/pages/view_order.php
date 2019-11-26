<?php
$order = $this->query;
$item  = $this->item;
?>
<title>Order #<?= $this->order_id ?> | AmarDokan</title>
<div class="services-breadcrumb" style="margin-bottom: 10px">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="<?= base_url() ?>">Home</a>
					<i>|</i>
				</li>
				<li>
					<a href="<?= base_url() ?>account/purchase">Order</a>
					<i>|</i>
				</li>
				<li>#<?= $this->order_id ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="container" style="margin-bottom: 50px">
	<h2>Order #<?= $this->order_id ?></h2>
	<hr>
	<div class="row">
		<div class="col-lg-6">
			<h3>Delivery Details</h3>
			<br>
			<ul class="list-group w3-agile">
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
		<div class="col-lg-6">
			<h3>Order Status</h3>
			<br>
			<?php if ($order->status == "Submitted") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-info" role="alert">
					<center><label>Submitted</label></center>
				</div>
			<?php
			endif;
			?>
			<?php
			if ($order->status == "Cancelled") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-danger" role="alert">
					<center><label>Cancelled</label></center>
				</div>
			<?php
			endif;
			?>
			<?php
			if ($order->status == "Accepted") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-warning" role="alert">
					<center><label>Accepted</label></center>
				</div>
			<?php
			endif;
			?>
			<?php
			if ($order->status == "Completed") :
				?>
				<div style="font-size: 15px; padding: 9px; margin: 0px;" class="alert alert-success" role="alert">
					<center><label>Completed</label></center>
				</div>
			<?php
			endif;
			?>
			<ul class="list-group w3-agile">
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
						Completed on: <?= date("h:i:sa d M, Y", strtotime($order->completed_time)) ?>
					</li>
				<?php
				endif;
				?>
			</ul>
		</div>

		<div class="col-lg-12">
			<h3>
				Item List
			</h3> <br>
			<table class="timetable_sub table-hover table-striped" style="margin-bottom: 30px;">
				<thead>
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Subotal</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$cnt = 0;
						foreach($item as $row) {
							$cnt++;
							?>
							<tr>
								<td style="padding: 15px; font-size: 14px">
									<?= $cnt ?>
								</td>
								<td style="padding: 15px; font-size: 14px">
									<?= $row->product_id ?>
								</td>
								<td style="padding: 15px; font-size: 14px">
									<a href="<?= base_url() . "product/view/" . $row->product_id ?>"><?= $row->product_name ?></a>
								</td>
								<td style="padding: 15px; font-size: 14px">
									<?= $row->quantity ?>
								</td>
								<td style="padding: 15px; font-size: 14px">
									৳<?= $row->amount ?>
								</td>
								<td style="padding: 15px; font-size: 14px">
									৳<?= $row->amount * $row->quantity ?>
								</td>
							</tr>
							<?php
						}
					?>
					<tr>
			<td style="text-align: right; padding: 15px; font-size: 14px" colspan="5"><label>Subtotal</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $order->total - $order->delivery_charge ?></label>
			</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 15px; font-size: 14px" colspan="5"><label>Delivery Charge</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $order->delivery_charge; ?></label>
			</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 15px; font-size: 14px" colspan="5"><label>Total</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $order->total ?></label>
			</td>
		</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>