<?php
require('connection.inc.php');
require('functions.inc.php');
echo '<b>Transaction In Process, Please do not reload</b>';
echo '<pre>';
print_r($_POST);
$payment_mode = $_POST['mode'];
$pay_id = $_POST['mihpayid'];
$status = $_POST["status"];
$firstname = $_POST["firstname"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$MERCHANT_KEY = "gtKFFx";
$SALT = "eCwWELxi";
$udf5 = '';
//$keyString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||' . $udf5 . '|||||';
//$keyArray = explode("|", $keyString);
//$reverseKeyArray = array_reverse($keyArray);
//$reverseKeyString = implode("|", $reverseKeyArray);
//$CalcHashString = strtolower(hash('sha512', $SALT . '|' . $status . '|' . $reverseKeyString)); //
$keyString 	= $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||' . $udf5 . '|||||';
$keyArray 	= explode("|", $keyString);
$reverseKeyArray = array_reverse($keyArray);
$reverseKeyString =	implode("|", $reverseKeyArray);
$saltString     = $SALT . '|' . $status . '|' . $reverseKeyString;
$sentHashString = strtolower(hash('sha512', $saltString));
//echo $CalcHashString;

if ($sentHashString == $posted_hash) {
	mysqli_query($con, "UPDATE `order` SET payment_status='$status', mihpayid='$pay_id' WHERE txnid='$txnid'");
?>
	<script>
		window.location.href = 'payment_fail.php';
	</script>
<?php
} else {
	mysqli_query($con, "UPDATE `order` SET payment_status='$status', mihpayid='$pay_id' WHERE txnid='$txnid'");
?>
	<script>
		window.location.href = 'thank_you.php';
	</script>
<?php
}
?>