<?php
require 'config.php';
session_start();

$group_id = $_POST['group_id'];
$user_id = $_POST['user_id'];

$sql = "INSERT INTO GroupRequests (group_id, user_id, decision) VALUES ('$group_id', '$user_id', 'not replied')";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);
?>