<title>Checkout | AmarDokan</title>
<div class="services-breadcrumb" style="margin-bottom: 10px">
        <div class="agile_inner_breadcrumb">
            <div class="container">
                <ul class="w3_short">
                    <li>
                        <a href="<?= base_url() ?>">Home</a>
                        <i>|</i>
                    </li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
    </div>
<div class="container" style="margin-bottom: 50px">
	<h3 class="tittle-w3l">Checkout
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
<?php

$cnt = 0;
for ($i = 1; ; $i++) {
				if (isset($_POST['item_name_' . $i])) {
								$cnt = $i;
				} else {
								break;
				}
}
?>
<h3 style="color: #FF3333">You have <?= $cnt ?> items in your cart</h3>
<br>
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

		<form action="<?= base_url() ?>order/process" method="post">
		<?php
		$total = 0;
		for($i = 1; $i <= $cnt; $i++) {
			?>
			<tr>
				<td style="padding: 15px; font-size: 14px">
					<?= $i ?>
				</td>
				<td style="padding: 15px; font-size: 14px">
					<?php if(isset($_POST['item_number_' . $i])) {
						echo $_POST['item_number_' . $i]; 
						?>
						<input type="hidden" name="<?= 'item_number_' . $i ?>" value="<?= $_POST['item_number_' . $i] ?>">
						<?php
					}?>
				</td>
				<td style="padding: 15px; font-size: 14px">
					<input type="hidden" name="<?= 'item_name_' . $i ?>" value="<?= $_POST['item_name_' . $i] ?>">
					<a href="<?= base_url() . "product/view/" . $_POST['item_number_' . $i] ?>"><?= $_POST['item_name_' . $i] ?></a>
				</td>
				<td style="padding: 15px; font-size: 14px">
					<input type="hidden" name="<?= 'quantity_' . $i ?>" value="<?= $_POST['quantity_' . $i] ?>">
					<?=$_POST['quantity_' . $i] ?>
				</td>
				<?php
					$price = $_POST['amount_' . $i];
				?>
				<td style="padding: 15px; font-size: 14px">
					<input type="hidden" name="<?= 'amount_' . $i ?>" value="<?= $_POST['amount_' . $i] ?>">
					
					৳<?= $price ?>
				</td>
				<td style="padding: 15px; font-size: 14px">
					৳<?= $price * $_POST['quantity_' . $i] ?>
					<?php
						$total += $price * $_POST['quantity_' . $i];
					?>
				</td>
			</tr>
			<?php

			$delivery_charge = 0;
			if($total < 3000) {
				$total += 20;
				$delivery_charge = 20;
			}
		}
		?>
		<tr>
			<td style="text-align: right; padding: 15px; font-size: 14px" colspan="5"><label>Subtotal</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $total - $delivery_charge ?></label>
			</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 15px; font-size: 14px" colspan="5"><label>Delivery Charge</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $delivery_charge; ?></label>
			</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 15px; font-size: 14px" colspan="5"><label>Total</label></td>
			<td style="padding: 15px; font-size: 14px">
				<label>৳<?= $total ?></label>
			</td>
		</tr>

	</tbody>
</table>

<?php 
	if($this->session->userdata('username') != "") {
		?>
		<h3>Please fill the form for Checkout</h3>
		<br>
		<input style="z-index: 0" type="hidden" name="total" value="<?= $total ?>">
                        <div class="input-group" style="width: 100%; height: 30px;">
                        	<input style="z-index: 0" style="font-size: 16px; height: 40px" type="text" class="form-control" placeholder="Enter Your Name" name="name" required="">
                    	</div>
                    	<div class="input-group" style="width: 100%; height: 30px;">
                        	<input style="z-index: 0" style="font-size: 16px; height: 40px" type="text" pattern="[0-9]+" class="form-control" placeholder="Enter Your Mobile Number" name="mobile_number" required="">
                    	</div>
                    	<div class="input-group" style="width: 100%; height: 30px;">
                        	<input style="z-index: 0" style="font-size: 16px; height: 40px" type="text" class="form-control" placeholder="Enter Your Address" name="address" required="">
                    	</div>
                    	<div class="input-group" style="font-size: 16px; width: 100%; height: 30px;">
                        	<select style="z-index: 0" name="city" class="form-control" style="font-size: 16px" required="">
                        		<option style="font-size: 16px; display:none;">Select Your City</option>
                        		<option style="font-size: 16px">Dhaka</option>
                        		<option style="font-size: 16px">Sylhet</option>
                        	</select>
                    	</div>
		<button type="submit" class="btn btn-success btn-lg" name="confirmed">Confirm Order</button>
	</form>
		<?php
	}
	else {
		?>
		<h3><label>Please <a href="#" data-toggle="modal" data-target="#myModal1">Sign In</a> or <a href="#" data-toggle="modal" data-target="#myModal2">Sign Up</a> for Checkout</label></h3>
		<?php
	}
?>
</div>