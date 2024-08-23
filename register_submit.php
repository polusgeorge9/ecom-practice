<?php require "connection.inc.php"; 
require "functions.inc.php";

$name = get_safe_value($con,$_POST['name']);
$email = get_safe_value($con,$_POST['email']);
$mobile = get_safe_value($con,$_POST['mobile']);
$password = get_safe_value($con,$_POST['password']);
$added_on = date("Y-m-d H:i:s" );
 
$check_user=mysqli_num_rows(mysqli_query($con,"SELECT * FROM users where email='$email'"));
 if($check_user>0){
    echo "email_present";
 }else{
    mysqli_query($con,"INSERT INTO users (name, email, mobile, password, added_on) 
    VALUES ('$name', '$email', '$mobile', '$password', '$added_on')");
    echo "insert";
 }
 ?>