<?php
require 'config.php';
session_start();

$user1 = $_POST['user_id1'];
$user2 = $_POST['user_id2'];

$sql = "INSERT INTO UserFriend (user_id1, user_id2) VALUES ('$user1', '$user2')";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

$sql0 = "INSERT INTO UserFriend (user_id1, user_id2) VALUES ('$user2', '$user1')";
$stmt0 = mysqli_prepare($db, $sql0);
mysqli_stmt_execute($stmt0);
?>