
<?php
require('top.php');
//echo '<pre>';
print_r($_POST);
$pay_id = $_POST['mihpayid'];
$status = $_POST["status"];
$firstname = $_POST["firstname"];
$email= $_POST["email"];
$amount = $_POST["amount"];
$txnid =$_POST["txnid"];
$error=$_POST["error_msg"];
mysqli_query($con, "UPDATE `order` SET payment_status='$status', mihpayid='$pay_id' WHERE txnid='$txnid'");
?>
<div class="center">
       <h1 style="color: red;">Transaction FAILED <?=$error?></h1>
       <div class="center">
       <h3 style="color: #333;">Transaction ID: <?=$txnid?></h3>
    <h3 style="color: #333;">Amount: <?= $amount?></h3>
    <h3 style="color: #333;">Firstname: <?= $firstname?></h3>
    <h3 style="color: #333;">Email: <?= $email?></h3>
    <h3 style="color: #333;">Mihpay ID: <?= $pay_id?></h3>

<script>
   window.location.href = 'index.php';
</script>
</div>
</div