<?php
require('top.inc.php');
$order_id = get_safe_value($con, $_GET['id']);
$sql = "select * from users order by id desc";
$res = mysqli_query($con, $sql);
if (isset($_POST['update_order_status'])) {
	$update_order_status = $_POST['update_order_status'];
	mysqli_query($con, "UPDATE `order` SET `order_status`= '$update_order_status' WHERE `order`.`id` = '$order_id'");
}
?>

<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Order Details </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="product-thumbnail">Product Name</th>
										<th class="product-name"><span class="nobr">Product Image</span></th>
										<th class="product-price"><span class="nobr">Qty </span></th>
										<th class="product-stock-stauts"><span class="nobr">Price </span></th>
										<th class="product-add-to-cart"><span class="nobr">Total Price</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$uid = $_SESSION['user_id'];
									$result = mysqli_query($con, "SELECT DISTINCT `order_detail`.`id`, `order_detail`.*, `order`.`address`, `order`.`city`, `order`.`pincode`, `product`.`name`, `product`.`image` 
									FROM `order_detail` 
									INNER JOIN `product` ON `product`.`id` = `order_detail`.`product_id`
									INNER JOIN `order` ON `order`.`id` = `order_detail`.`order_id`
									WHERE `order_detail`.`order_id` = '$order_id'");
									$total_price = 0;
									while ($row = mysqli_fetch_assoc($result)) {

										$total_price = $total_price + ($row['price'] * $row['qty']);
										$address = $row['address'];
										$city = $row['city'];
										$pincode = $row['pincode'];
									?>
										<tr>
											<td class="product-thumbnail"><?= $row['name'] ?></td>
											<td class="product-thumbnail"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>"></td>
											<td class="product-thumbnail"><?= $row['qty'] ?></td>
											<td class="product-thumbnail"><?= $row['price'] ?></td>
											<td class="product-thumbnail"><?= $row['qty'] * $row['price'] ?></td>
										<?php
									} ?>
										</tr>
										<tr>
											<td colspan="4" class="product-thumbnail" style="font-weight: bold;">Total Price</td>
											<td class="product-thumbnail"><?= $total_price ?></td>

										</tr>

								</tbody>
							</table>


							<div id="address_details" style="margin: 5px 19px;">
								<strong>Address</strong>
								<?php echo  $address ?>, <?php echo  $city ?>, <?php echo  $pincode ?>;<br><br>
								<strong>Order Status</strong>
								<?php $order_status_arr = mysqli_fetch_assoc(mysqli_query($con, "SELECT names FROM `order_status`,`order` WHERE order.id='$order_id' AND `order`. `order_status`= `order_status`.`id` "));
								echo $order_status_arr['names'];
								?>
							</div>
							<div>
								<form method="post">
									<select class="form-control" name="update_order_status">
										<option>Select Status</option>
										<?php
										$res = mysqli_query($con, "select * from  order_status ");
										while ($row = mysqli_fetch_assoc($res)) {
											if ($row['id'] == $categories_id) {
												echo "<option selected value=" . $row['id'] . ">" . $row['names'] . "</option>";
											} else {
												echo "<option value=" . $row['id'] . ">" . $row['names'] . "</option>";
											}
										}
										?>
									</select>
									<input type="submit" class="form-control" />

								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require('footer.inc.php');
?>