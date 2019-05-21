<?php
require 'config.php';
session_start();

$group_id = $_POST['group_id'];
$user_id = $_POST['user_id'];
 
$sql = "UPDATE GroupRequests set decision = 'rejected' WHERE group_id = '$group_id' AND user_id = '$user_id'";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);
 
?>