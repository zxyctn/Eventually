<?PHP
require 'config.php';
session_start();

$user_id = $_SESSION['login_user_id'];

$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$time = $_POST['time'];
$city = $_POST['city'];

$group_id = $_GET['group_id'];
$flag = $_GET['f'];

$category = $_POST['category'];
$privacy = $_POST['privacy'];
$maxnumberofmember = $_POST['maxnumberofmember'];
$profilepicture = $_POST['profilepicture'];

$sql = "INSERT INTO Event (title,description,date,time,city,country,privacy,maxnumberofmember,profilepicture) VALUES ('$title','$description','$date','$time','$city','$country','$privacy','$maxnumberofmember','$profilepicture')";
$stmt1 = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt1);

$sql1 = "SELECT * FROM Event WHERE title='$title' AND description='$description' AND date='$date' AND time='$time' AND city='$city' AND country='$country' AND privacy='$privacy' AND maxnumberofmember='$maxnumberofmember' AND profilepicture='$profilepicture'";
$res1 = mysqli_query($db, $sql1);
$event = mysqli_fetch_object($res1);

$sql0 = "INSERT INTO EventOrganizes (event_id, group_id) VALUES ('$event->event_id', '$group_id')";
$stmt = mysqli_prepare($db, $sql0);
mysqli_stmt_execute($stmt);

$sql2 = "SELECT * FROM GroupParticipants WHERE group_id='$group_id'";
$res2 = mysqli_query($db, $sql2);
while ($user = mysqli_fetch_object($res2)) {
    $sql3 = '';
    if ($user_id == $user->user_id) {
        $sql3 = "INSERT INTO EventParticipants (event_id, usersDecision, user_id) VALUES ('$event->event_id', 'coming', '$user_id')";
        $stmt0 = mysqli_prepare($db, $sql3);
        mysqli_stmt_execute($stmt0);
    } else {
        $sql3 = "INSERT INTO EventParticipants (event_id, usersDecision, user_id) VALUES ('$event->event_id', 'not replied', '$user->user_id')";
        $stmt0 = mysqli_prepare($db, $sql3);
        mysqli_stmt_execute($stmt0);
    }
}

$sql4 = "INSERT INTO EventCategory (category_name, event_id) VALUES ('$category', '$event->event_id')";
$stmt04 = mysqli_prepare($db, $sql4);
mysqli_stmt_execute($stmt04);

header ("Location: event.php?id=$event->event_id"); 
?>