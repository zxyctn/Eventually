<?php
require 'config.php';
session_start();

$user_id = $_GET['user_id'];
$group_id = $_GET['group_id'];
$admin_id = $_SESSION['login_user_id'];

$sql = "INSERT INTO Invitation (user_id, group_id,admin_id,status) VALUES ('$user_id', '$group_id','$admin_id','not replied')";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);


header("Location: {$_SERVER['HTTP_REFERER']}");


?> 