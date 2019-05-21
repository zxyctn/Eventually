<?php
require 'config.php';
session_start();

$user_id = $_POST['user_id'];
$group_id = $_POST['group_id'];
$admin_id = $_POST['admin_id'];
$status = $_POST['status'];

 

$sql = "UPDATE Invitation set status = '$status' WHERE group_id = '$group_id' AND user_id = '$user_id' AND admin_id = '$admin_id'";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

 


?> 