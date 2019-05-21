<?php
require 'config.php';

$user_id = $_GET['user_id'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$pass = $_POST['password'];
$birthday = $_POST['birthday'];
$phone_no = $_POST['phone_no'];
$address = $_POST['address'];


$pass = hash('sha1', $pass);


$sql = "UPDATE User set firstname = '$fname', lastname = '$lname' , email = '$email' , password = '$pass' , birthday = '$birthday' , phone_no = '$phone_no' , address = '$address' WHERE user_id = '$user_id'";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

header("Location: {$_SERVER['HTTP_REFERER']}");

?>
