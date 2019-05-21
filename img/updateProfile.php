<?php
require 'config.php';

$user_id = $_POST['user_id'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$pass = $_POST['password'];
$birthday = $_POST['birthday'];
$phone_no = $_POST['phone_no'];
$address = $_POST['address'];

$sql1 = "SELECT * FROM User WHERE user_id = '$user_id'";
$result1 = mysqli_query($db,$sql1);
$user = mysqli_fetch_object($result1);

if($pass != $user->password){
	$pass = hash('sha1', $pass);
}

$sql = "UPDATE User set firstname = '$fname' AND lastname = '$lname' AND email = '$email' AND password = '$pass' AND birthday = '$birthday' AND phone_no = '$phone_no' AND address = '$address' WHERE user_id = '$user_id'";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

?>
