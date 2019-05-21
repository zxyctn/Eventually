<?PHP
require_once 'config.php';
session_start();

$login_user_id = $_SESSION['login_user_id'];

$title = $_POST['title'];
$description =$_POST['description'];
$date =$_POST['date'];
$time =$_POST['time'];
$city = $_POST['city'];
$category = $_POST['category'];

$group_id = $_GET['group_id'];
$flag = $_GET['f'];

$country =$_POST['country'];
$privacy =$_POST['privacy'];
$maxnumberofmember =$_POST['maxnumberofmember'];
$profilepicture =$_POST['profilepicture'];

if ($db->connect_error) {
    die("Conection failed: " . $db->connect_error);
}

echo "test";

$sql = "INSERT INTO Event (title,description,date,time,city,country,privacy,maxnumberofmember,profilepicture) 
		VALUES ('$title','$description','$date','$time','$city','$country','$privacy','$maxnumberofmember','$profilepicture')";

echo "Sameodoooooo";
if ($db->query($sql) === TRUE) {
    echo "Added successfully";
} else {
    echo "Error while adding a group: " . $db->error;
}

$sql1 = "SELECT * FROM Event WHERE title='$title' AND description='$description' AND date='$date' AND time='$time' AND city='$city' AND country='$country' AND privacy='$privacy' AND maxnumberofmember='$maxnumberofmember' AND profilepicture='$profilepicture'";
$res1 = mysqli_query($db, $sql1);
$event = mysqli_fetch_object($res1);

$sql3 = "INSERT INTO EventCategory (category_name, event_id) VALUES ('$category', '$event->event_id')";
$stmt0 = mysqli_prepare($db, $sql3);
mysqli_stmt_execute($stmt0);

$sql2 = "INSERT INTO EventHost (host_id, event_id) VALUES ('$login_user_id', '$event->event_id')";
$stmt = mysqli_prepare($db, $sql2);
mysqli_stmt_execute($stmt);

$sql20 = "INSERT INTO EventParticipants (user_id, event_id, usersDecision) VALUES ('$login_user_id', '$event->event_id', 'coming')";
$stmt20 = mysqli_prepare($db, $sql20);
mysqli_stmt_execute($stmt20);

header("Location: event.php?id=$event->event_id");
?>
