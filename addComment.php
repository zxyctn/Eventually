<?php
require 'config.php';
session_start();

$event_id = $_GET['event_id'];
$user_id = $_GET['user_id'];
$content = $_POST['content'];
$date = date("Y-m-d");
$time = date("h:i:sa");

$sql = "INSERT INTO Comment (comment, date, time) VALUES ('$content', '$date', '$time')";
$res = mysqli_query($db, $sql);
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

$sql0 = "SELECT * FROM Comment WHERE comment='$content' AND date='$date' AND time='$time'";
$res0 = mysqli_query($db, $sql0);
$comment = mysqli_fetch_object($res0);

$sql1 = "INSERT INTO UserComment (user_id, comment_id) VALUES ('$user_id', '$comment->comment_id')";
$res1 = mysqli_query($db, $sql1);
$stmt1 = mysqli_prepare($db, $sql1);
mysqli_stmt_execute($stmt1);

$sql2 = "INSERT INTO EventComment (event_id, comment_id) VALUES ('$event_id', '$comment->comment_id')";
$res2 = mysqli_query($db, $sql2);
$stmt2 = mysqli_prepare($db, $sql2);
mysqli_stmt_execute($stmt2);

header("Location: event.php?id=$event_id");
?>