<?php require "connection.inc.php"; 
require "functions.inc.php";

unset( $_SESSION['user_login']);
unset( $_SESSION['user_id']);
unset( $_SESSION['user_name']);

header('Location: login.php');

?>