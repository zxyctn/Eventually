<?PHP
require_once 'config.php';
session_destroy();
session_start();

$ppform = $_POST['profilepicture'];
$userName =$_POST['nickname'];
$firstName =$_POST['firstname'];
$lastName =$_POST['lastname'];
$userEmail = $_POST['email'];
$userPassword = $_POST['password'];
$userBirthDate = $_POST['birthday'];
$gender =$_POST['gender'];
$phoneNo = $_POST['phone_no'];
$address = $_POST['address'];
$hashedpassword = hash('sha1', $userPassword);



if ($db->connect_error) {
    die("Conection failed: " . $db->connect_error);
}

$sql0 = "SELECT nickname FROM `User`";

$result0 = mysqli_query($db, $sql0);
$myarray = array();
while ($row0 = mysqli_fetch_array($result0)) {
    echo "test";
    $myarray[$row0['nickname']] = $row0['nickname'];
}

if (array_key_exists($userName, $myarray)) {
    echo "Nickname exists in the system";
} else {
    $sql = "INSERT INTO User (nickname,firstname,lastname,birthday,email,phone_no,address,password,gender,profilepicture) 
                    VALUES  ('$userName','$firstName','$lastName','$userBirthDate','$userEmail','$phoneNo','$address','$hashedpassword','$gender','$ppform')";

    if ($db->query($sql) === TRUE) {
        echo "You signed up successfully";
    } else {
        echo "Error while signing up: " . $db->error;
    }
}
session_start();
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

session_start();
	header("Location: index.php");
    session_start();
?>

<html>

<body>
    <h2><a href="index.php">Go Back</a></h2>
</body>

<body>
    <h2><a href="createGroup.php">Create Group</a></h2>
</body>

</html>