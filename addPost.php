<?php
require 'config.php';
session_start();

$group_id = $_GET['group_id'];
$user_id = $_GET['user_id'];
$content = $_POST['content'];
$date = date("Y-m-d");
$time = date("h:i:sa");

$sql = "INSERT INTO Message (user_id, group_id, text, date, time) VALUES ('$user_id', '$group_id', '$content', '$date', '$time')";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

header("Location: {$_SERVER['HTTP_REFERER']}");
?>