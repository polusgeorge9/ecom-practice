<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == 'delete') {
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql = "delete from users where id='$id'";
		mysqli_query($con, $delete_sql);
	}
}

$sql = "select * from users order by id desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Order Master </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>

									<tr>
										<th class="product-thumbnail">Order_ID</th>
										<th class="product-name"><span class="nobr">Order Date</span></th>
										<th class="product-price"><span class="nobr"> Address</span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>

									</tr>
								</thead>
								<tbody>
									<?php
									$uid = $_SESSION['user_id'];
									$result = mysqli_query($con, "SELECT `order`.*,order_status.names AS order_status_str FROM `order`, order_status WHERE order_status.id = `order`.order_status");
									while ($row = mysqli_fetch_assoc($result)) {
									?>
										<tr>
											<td class="product-add-to-cart"><a href="order_master_detail.php?id=<?= $row['id'] ?>"><?= $row['id'] ?></a> </td>
											<td class="product-name"><?= $row['added_on'] ?></a></td>
											<td class="product-name">
												<?= $row['address'] ?><br>
												<?= $row['city'] ?><br>
												<?= $row['pincode'] ?>
												</a></td>
											<td class="product-name"><?= $row['payment_type'] ?></a></td>
											<td class="product-name"><?= $row['payment_status'] ?></a></td>
											<td class="product-name"><?= $row['order_status_str'] ?></a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
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