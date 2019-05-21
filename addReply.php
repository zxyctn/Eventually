<?php
require 'config.php';
session_start();

$c_id_replied = $_POST['c_id_Replied'];
$user_id = $_SESSION['login_user_id'];
$content = $_POST['content'];
$date = date("Y-m-d");
$time = date("h:i:sa");

$sql = "INSERT INTO Comment (comment, date, time) VALUE ('$content', '$date', '$time')";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

$sql0 = "SELECT * FROM Comment WHERE comment='$content' AND date='$date' AND time='$time'";
$res = mysqli_query($db, $sql0);
$comment_new = mysqli_fetch_object($res);

$sql1 = "INSERT INTO CommentReply (c_id_Reply, c_id_Replied) VALUES ('$comment_new->comment_id', '$c_id_replied')";
$stmt0 = mysqli_prepare($db, $sql1);
mysqli_stmt_execute($stmt0);

$sql50 = "INSERT INTO UserComment (user_id, comment_id) VALUES ('$user_id', '$comment_new->comment_id')";
$stmt04 = mysqli_prepare($db, $sql50);
mysqli_stmt_execute($stmt04);
?>