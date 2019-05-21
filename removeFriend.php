<?php
require 'config.php';
session_start();

$user1 = $_POST['user_id1'];
$user2 = $_POST['user_id2']; 

$sql = "DELETE from UserFriend WHERE user_id1 = '$user1' AND user_id2 = '$user2' "; 
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

$sql = "DELETE from UserFriend WHERE user_id2 = '$user1' AND user_id1 = '$user2' "; 
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);



?>