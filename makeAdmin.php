<?php
require 'config.php';
session_start();

$group_id = $_POST['group_id'];
$user_id = $_POST['user_id'];

$sql = "INSERT INTO GroupAdmin (group_id, user_id) VALUES ('$group_id', '$user_id')";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);
?>